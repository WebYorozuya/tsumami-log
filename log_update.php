<?php 
require_once('tsumami.php');
$blogs = $_POST;
$tsumami =new Tsumami();
$tsumami->logValidate($blogs);
$tsumami->logUpdate($blogs);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <br>
  <a href="index.php">TOPへ</a>
</body>
</html>
