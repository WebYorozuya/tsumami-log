<?php
ini_set('display_errors',On);

Class Dbc {
  protected $table_name;
      //dbに接続
  public function dbConnect(){
    $dsn = 'mysql:host=localhost;dbname=tsumami_log;charset=utf8';
    $user= 'tsumami_user';  
    $pass= '08120337';
  
    
   try{
      $dbh = new \PDO($dsn,$user,$pass,[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,]); 
       }catch(PDOException $e){
        echo 'error' . $e->getMeage();
        exit();
        };
        return $dbh;
      }

    //dbから情報を取得
  public function getAlltsumami(){
    $dbh = $this->dbConnect();
    $sql = "SELECT*FROM tsumamilog";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(\PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
   }


    //カテゴリー名のセット
  public function setCategoryName($category){
    if($category === '1'){
      return 'ビールにあう';
    }elseif($category ==='2'){
      return 'ワインにあう';
    }elseif($category ==='3'){
      return 'ウイスキーにあう';
    }elseif($category ==='4'){
      return '焼酎にあう';
    }else{
      return 'つまみ';
    }
  }


    //dbのID
  public function getRog($id){
    if(empty($id)){
      exit('IDが不正です');
      }
        
    $dbh = $this->dbConnect();
    $stmt = $dbh->prepare('SELECT * FROM tsumamilog where id = :id');
    $stmt->bindValue(':id',(int)$id,\PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        //  var_dump($result);      
    if(!$result){
      exit('記事がありません');
        }
        return $result;
      }

     
  public function logCreate($blogs){
    $sql = 'INSERT INTO
    tsumamilog(title,users,category,content)
    VALUES
    (:title,:users,:category,:content)';

    $dbh = $this->dbConnect();
    $dbh->beginTransaction();
    try{
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':title',$blogs['タイトル'],PDO::PARAM_STR);
      $stmt->bindValue(':users',$blogs['ユーザー名'],PDO::PARAM_STR);
      $stmt->bindValue(':category',$blogs['カテゴリー'],PDO::PARAM_INT);
      $stmt->bindValue(':content',$blogs['投稿内容'],PDO::PARAM_STR);
      $stmt->execute();
      $dbh->commit();
      echo '投稿しました';
    }catch(PDOException $e){
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $dbh->rollBack();
      exit ($e);
      }
    }
  } 
?>
