<?php
session_start();
// ini_set('display_errors',On);
require_once (dirname(__FILE__) .'/../classes/UserLogic.php');
require_once (dirname(__FILE__) .'/../functions.php');

$result = UserLogic::checkLogin();

if(!$result) {
  $_SESSION['login_err'] = 'ユーザ登録をしてログインをしてください';
  header('Location:signup_form.php');
  return;
}
$login_user = $_SESSION['login_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
</head>
<body>
<h2>マイページ</h2>
<p>ログインユーザー：<?php echo h($login_user['name'])?></p>
<p>メールアドレス：<?php echo h($login_user['email'])?></p>
<form action="./login.php" method = "POST">
<input type="submit" name="logout" value="ログアウト">
</form>
</body>
</html>