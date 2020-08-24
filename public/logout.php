<?php
session_start();
// ini_set('display_errors',On);
require_once '../classes/UserLogic.php';

if(!$logout = filter_input(INPUT_POST,'logout')){
  exit('不正なリクエストです');
}

$result = UserLogic::checkLogin();

if(!$result) {
  exit('セッションが切れました、ログインし直してください');
}

UserLogic::logout();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログアウト</title>
</head>
<body>
<h2>ログアウト</h2>
<p>ログアウトしました</p>
<a href="login_form.php">ログイン画面へ</a>
</body>
</html>