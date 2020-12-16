<?php
require_once realpath(__DIR__ . '/s3upload.php');
require_once realpath(__DIR__ . '/vendor/autoload.php');
use Dotenv\Dotenv;
//.envファイルがあるディレクトリを指定
$dotenv = Dotenv::createImmutable(__DIR__);

//.envファイルから環境変数から読み込み
$dotenv->load();

class Dbc
{
  //$table_nameを固定
  protected $table_name;
  public function dbConnect()
  {
    $host    = $_ENV['DB_HOST'];
    $dbname  = $_ENV['DB_NAME'];
    $dbuser  = $_ENV['DB_USER'];
    $dbpass  = $_ENV['DB_PASS'];

    $dsn     = "mysql:host=$host;dbname=$dbname;charset=utf8";

    try {
      $dbh = new \PDO($dsn, $dbuser, $dbpass, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,]);
    } catch (PDOException $e) {
      echo 'error' . $e->getMessage();
      exit();
    };
    return $dbh;
  }

  //dbから情報を取得(ページネーション用)
  public function getPages()
  {
    if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
      $page = $_REQUEST['page'];
    } else {
      $page = 1;
    }
    $start = 5 * ($page - 1);

    $dbh = $this->dbConnect();
    $sql = "SELECT * FROM $this->table_name ORDER BY id DESC LIMIT ? , 6";
    $pages = $dbh->prepare($sql);
    $pages->bindParam(1, $start, \PDO::PARAM_INT);
    $pages->execute();
    return $pages;
    // $result = $pages->fetch(\PDO::FETCH_ASSOC);
    // return $result;
    $dbh = null;
  }

  public function countPage()
  {
    $dbh = $this->dbConnect();
    $sql = "SELECT COUNT(*) as cnt FROM $this->table_name";
    $counts = $dbh->query($sql);
    $count = $counts->fetch();
    $max_page = ceil($count['cnt'] / 6);
    return $max_page;
  }

  //dbのIDを取得
  public function getById($id)
  {
    if (empty($id)) {
      exit('IDが不正です');
    }
    $dbh = $this->dbConnect();
    $stmt = $dbh->prepare("SELECT * FROM $this->table_name where id = :id");
    $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    if (!$result) {
      exit('記事がありません');
    }
    return $result;
  }

  //ログの更新
  public function logUpdate($blogs)
  {
    $sql = "UPDATE $this->table_name SET
          title=:title, users=:users, images=:images, category=:category, content=:content;
      WHERE
            id =:id";

    $dbh = $this->dbConnect();
    $dbh->beginTransaction();

    $s3image = s3getObject($blogs);
   
    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':title', $blogs['タイトル'], PDO::PARAM_STR);
      $stmt->bindValue(':users', $blogs['ユーザー名'], PDO::PARAM_STR);
      $stmt->bindValue(':images', $s3image, PDO::PARAM_STR);
      $stmt->bindValue(':category', $blogs['カテゴリー'], PDO::PARAM_INT);
      $stmt->bindValue(':content', $blogs['投稿内容'], PDO::PARAM_STR);
      $stmt->bindValue(':id', $blogs['id'], PDO::PARAM_INT);
      $stmt->execute();
      $dbh->commit();
      echo 'ログを更新しました';
    } catch (PDOException $e) {
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $dbh->rollBack();
      exit($e);
    }
  }

  //削除機能
  public function delete($id)
  {
    if (empty($id)) {
      exit('IDが不正です');
    }
    $dbh = $this->dbConnect();

    $stmt = $dbh->prepare("DELETE FROM $this->table_name where id = :id");
    $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);
    $stmt->execute();
    echo '削除しました';
  }
}
