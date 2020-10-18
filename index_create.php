<?php
require_once(dirname(__FILE__) .'/tsumami.php');
  $blogs = $_POST;
  $tsumami =new Tsumami();
  $tsumami->logValidate($blogs);
  $tsumami->logCreate($blogs);
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