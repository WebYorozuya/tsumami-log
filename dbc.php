<?php
// ini_set('display_errors',On);
require_once(__DIR__ . '/env.php');

Class Dbc {
  //$table_nameを固定
  protected $table_name;
  public function dbConnect() {
    $host    = DB_HOST;
    $dbname  = DB_NAME;
    $dbuser  = DB_USER;  
    $dbpass  = DB_PASS;
    $dsn     = "mysql:host=$host;dbname=$dbname;charset=utf8";
    
    try {
      $dbh = new \PDO($dsn,$dbuser,$dbpass,
      [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,]); 
     }catch(PDOException $e){
      echo 'error' . $e->getMeage();
      exit();
      };
      return $dbh;
    }

    //dbから情報を取得
    public function getAll() {
      $dbh = $this->dbConnect();
      $sql = "SELECT * FROM $this->table_name";
      $stmt = $dbh->query($sql);
      $result = $stmt->fetchall(\PDO::FETCH_ASSOC);
      return $result;
      $dbh = null;
    }

    //dbのIDを取得
    public function getById($id) {
      if(empty($id)) {
        exit('IDが不正です');
        }
      $dbh = $this->dbConnect();

      $stmt = $dbh->prepare("SELECT * FROM $this->table_name where id = :id");
      $stmt->bindValue(':id',(int)$id,\PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);

       if(!$result) {
        exit('記事がありません');
       }
        return $result;
    }

    //ログの更新
    public function logUpdate($blogs) {
      $sql = "UPDATE $this->table_name SET
          title=:title, users=:users, images=:images, category=:category, content=:content;
      WHERE
            id =:id";

      $dbh = $this->dbConnect();
      $dbh->beginTransaction();
      try{
          $stmt = $dbh->prepare($sql);
          $stmt->bindValue(':title',$blogs['タイトル'],PDO::PARAM_STR);
          $stmt->bindValue(':users',$blogs['ユーザー名'],PDO::PARAM_STR);
          $stmt->bindValue(':images',$_FILES['image']['name'],PDO::PARAM_STR);
          $stmt->bindValue(':category',$blogs['カテゴリー'],PDO::PARAM_INT);
          $stmt->bindValue(':content',$blogs['投稿内容'],PDO::PARAM_STR);
          $stmt->bindValue(':id',$blogs['id'],PDO::PARAM_INT);
          $stmt->execute();
          $dbh->commit();
          echo 'ログを更新しました';
          }catch(PDOException $e) {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->rollBack();
            exit ($e);
        }
      }
    
    //削除機能
    public function delete($id) {
        if(empty($id)) {
          exit('IDが不正です');
          }
        $dbh = $this->dbConnect();

        $stmt = $dbh->prepare("DELETE FROM $this->table_name where id = :id");
        $stmt->bindValue(':id',(int)$id,\PDO::PARAM_INT);
        $stmt->execute();
        echo '削除しました';
        // return $result;
      } 
    }
?>
