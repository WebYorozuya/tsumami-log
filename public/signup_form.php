<?php
ini_set('display_errors',On);

session_start();
require_once (dirname(__FILE__) . '/../functions.php');
require_once (dirname(__FILE__) . '/../classes/UserLogic.php');

$result = UserLogic::checkLogin();

if($result){
  header('Location:mypage.php');
  return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="../css/bootstrap.css">
   <title>ユーザ登録</title>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card login">
        <div class="card-body">
          <h1 class="top">ユーザ登録フォーム</h1>
          <?php if (isset($login_err)):?>
          <p><?php echo $login_err; ?></p>
          <?php endif ;?>
          <form action="register.php" method="POST">
            <div class="form-group">
              <label for="username">ユーザ名：</label>
              <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">メールアドレス：</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">パスワード：</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="password_conf">パスワード確認：</label>
              <input type="password" name="password_conf" class="form-control">
            </div>
            <p><input type="hidden" name="csrf_token" value = "<?php echo h(setToken()); ?>"></p>
            <p><input type="submit" value="新規登録" class="btn btn-primary w-100"></p>
            <a href="login_form.php">ログインする</a>
            <a href="../index.php">トップへ戻る</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>