<?php
ini_set('display_errors',On);
session_start();
require_once (dirname(__FILE__) . '/../classes/UserLogic.php');
//エラーメッセージを入れる
$err = [];

//バリデーション
if(!$email = filter_input(INPUT_POST,'email')){
  $err['email'] = 'メールアドレスを記入してください';
};
if(!$password = filter_input(INPUT_POST,'password')){
  $err['password'] = 'パスワードを記入してください';
};

if(count($err) > 0){
  //ユーザ登録処理
  $_SESSION = $err;
  header('Location:login_form.php');
  return;
}
//ログイン成功時の処理
  $result = UserLogic::login($email,$password);
//ログイン失敗時の処理
  if (!$result){
    header('Location:login_form.php');
    return;
  }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン完了</title>
</head>
<body>
<h2>ログイン完了</h2>
<p>ログインしました</p>
<a href="./mypage.php">マイページへ</a>
</body>
</html>