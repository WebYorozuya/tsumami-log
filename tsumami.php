<?php
require_once(dirname(__FILE__) . '/dbc.php');
require_once(dirname(__FILE__) . '/s3upload.php');

class Tsumami extends dbc
{
  protected $table_name = 'tsumamilog';
  //カテゴリー名のセット
  public function setCategoryName($category)
  {
    if ($category === '1') {
      return 'ビールにあう';
    } elseif ($category === '2') {
      return 'ワインにあう';
    } elseif ($category === '3') {
      return 'ウイスキーにあう';
    } elseif ($category === '4') {
      return '焼酎にあう';
    } else {
      return 'つまみ';
    }
  }

  public function logCreate($blogs, $save_path)
  {

    $s3image = s3getObject($save_path);
    $sql = "INSERT INTO
                  $this->table_name(title,users,images,category,content)
              VALUES
                 (:title,:users,:images,:category,:content)";

    $dbh = $this->dbConnect();
    $dbh->beginTransaction();
    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':title', $blogs['タイトル'], PDO::PARAM_STR);
      $stmt->bindValue(':users', $blogs['ユーザー名'], PDO::PARAM_STR);
      $stmt->bindValue(':images', $s3image, PDO::PARAM_STR);
      $stmt->bindValue(':category', $blogs['カテゴリー'], PDO::PARAM_INT);
      $stmt->bindValue(':content', $blogs['投稿内容'], PDO::PARAM_STR);
      $stmt->execute();
      $dbh->commit();
      echo '投稿しました';
    } catch (PDOException $e) {
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $dbh->rollBack();
      exit($e);
    }
  }

  public function logUpdate($blogs)
  {
    $sql = "UPDATE $this->table_name SET
        title=:title,users=:users,images=:images,category=:category,content=:content
        WHERE
          id=:id";

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
      echo '投稿しました';
    } catch (PDOException $e) {
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $dbh->rollBack();
      exit($e);
    }
  }
  //ログのバリデーション
  public function logValidate($blogs)
  {
    if (empty($blogs['タイトル'])) {
      exit('タイトルを入力してください');
    }
    if (mb_strlen($blogs['タイトル']) > 191) {
      exit('タイトルは191文字以下で入力してください');
    }
    if (empty($blogs['ユーザー名'])) {
      exit('投稿者名を入力してください');
    }
    if (empty($blogs['投稿内容'])) {
      exit('本文を入力してください');
    }
    if (empty($blogs['カテゴリー'])) {
      exit('カテゴリーは必須です');
    }
  }
}
