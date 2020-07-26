<?php
// 0ini_set('display_errors',On);
require_once('dbc.php');
$dbc = new Dbc();
$result = $dbc->getRog($_GET['id']);
?>

<!DOCTYPE html>
<html lang=ja>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>記事詳細</title>
</head>
<body>
  <h2>記事詳細</h2>
  <h3>タイトル:<?php echo $result['title']?></h3>
  <p>投稿日:<?php echo $result['post_at']?></p>
  <p>ユーザー名:<?php echo $result['users']?></p>
  <p>カテゴリー:<?php echo $dbc->setCategoryName($result['category'])?></p>
  <hr>
  <p>本文<?php echo $result['content']?></p>
  <br>
  <a href="index.php"> topに戻る</a>
</body>
</html>