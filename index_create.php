<?php
require_once('dbc.php');
$blogs = $_POST;

//投稿内容に不備があった歳の処理

if(empty($blogs['タイトル'])){
  exit('タイトルを入力してください');
}
if(mb_strlen($blogs['タイトル'])>191){
  exit('タイトルは191文字以下で入力してください');
}
if(empty($blogs['ユーザー名'])){
  exit('投稿者名を入力してください');
}
if(empty($blogs['投稿内容'])){
  exit('本文を入力してください');
}
if(empty($blogs['カテゴリー'])){
  exit('カテゴリーは必須です');
}

$dbc = new Dbc();
$dbc->logCreate($blogs);

?>
<!DOCTYPE html>
<html lang=ja>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規投稿</title>
</head>
<body>
  <br>
  <a href="index.php">戻る</a>
</body>
</html>