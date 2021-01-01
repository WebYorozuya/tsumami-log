<?php
require_once(dirname(__FILE__) . '/tsumami.php');

$blogs = $_POST;
$tsumami = new Tsumami();
$tsumami->confirmValidate($blogs);
$name = $blogs['name'];
$mail = $blogs['mail'];
$contact = $blogs['contact'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ内容</title>
  <link rel="icon" href="./favicon/favicon.ico" id="favicon">
  <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon-180x180.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<body>
  <header class="header pb-5">
    <div class="main_menu">
      <nav class="navbar-dark bg-dark navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="index.php"><i class="fas fa-beer"></i></a>
      </nav>
  </header>

  <form action='complete.php' method='post'>
    <input type='hidden' name='name' value='$name'>
    <input type='hidden' name='mail' value='$mail'>
    <input type='hidden' name='contact' value='$contact'>
    <div class="card pt-2">
      <div class="card-body">
        <h5 class="card-title">お名前：<?php echo $name; ?></h5>
        <h5 class="card-title">アドレス：<?php echo $mail; ?></h5>
        <p class="card-text">お問い合わせ内容：<?php echo $contact; ?></p>
        <input type='submit' value='確認' class="btn btn-primary"></a>
      </div>
      <a href="index.php"> Topに戻る</a>
    </div>
</body>

</html>