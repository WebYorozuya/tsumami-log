<?php

$name = $_POST['name'];
$mail = $_POST['mail'];
$contact = $_POST['contact'];
$mailTO = $mail;
$mailHeader = "From from@from.com";
$mailBody = $name . "様お問い合わせありがとうございます。";
$mailBody .= "¥n"; 
$mailBody .= "ご返信まで～～～～";
// mail($mailTO, $mailSubject, $mailBody, $mailHeader);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ内容確認</title>
</head>
<body>
  <p>お問合せありがとうございました。</p>
  <a href="index.php"> Topに戻る</a>
</body>
</html>