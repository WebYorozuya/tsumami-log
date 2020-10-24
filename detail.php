<?php
// 0ini_set('display_errors',On);
  require_once(dirname(__FILE__) . '/tsumami.php');
    $tsumami = new Tsumami();
    $result = $tsumami->getById($_GET['id']);
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
  <img src="<?php echo $result['images']?>" alt="写真データ">
  <p>ユーザー名:<?php echo $result['users']?></p>
  <p>カテゴリー:<?php echo $tsumami->setCategoryName($result['category'])?></p>
  <hr>
  <p>本文<?php echo $result['content']?></p>
  <br>
  <a href="index.php"> Topに戻る</a>
</body>
</html>