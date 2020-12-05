<?php
require_once(dirname(__FILE__) . '/tsumami.php');
require_once(dirname(__FILE__) . '/s3upload.php');

$blogs = $_POST;
  //ファイル関連取得
$file = $_FILES['image'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$save_filename = date('YmdHis') . $filename;
$save_path = s3getObject($save_filename);
$tsumami = new Tsumami();
$tsumami->logValidate($blogs);
$tsumami->logCreate($blogs ,$save_path);
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