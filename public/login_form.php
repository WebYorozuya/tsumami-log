<?php
// ini_set('display_errors',On);
//セッション作成
session_start();

require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if($result){
  header('Location:mypage.php');
  return;
}
$err = $_SESSION;

//セッションを消す
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="../css/bootstrap.css">
  <title>ログイン画面</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card login">
          <div class="card-body">
            <h1 class="top">ログインフォーム</h1>
            <?php if (isset($err['msg'])):?>
               <p><?php echo $err['msg']; ?></p>
            <?php endif ;?>
            <form action="login.php" method="POST">
             <div class="form-grpup">
               <label for="email">メールアドレス：</label>
               <input type="email" name="email" class="form-control">
                  <?php if (isset($err['email'])):?>
                    <p><?php echo $err['email']; ?></p>
                  <?php endif ;?>
             </div>
              <div class="form-group">
                <label for="password">パスワード：</label>
                <input type="password" name="password" class="form-control">
                <?php if (isset($err['password'])):?>
                    <p><?php echo $err['password']; ?></p>
                  <?php endif ;?>
              </div>
            <p>
              <input type="submit" value="ログイン" class="btn btn-primary w-100">
            </p>
          </form>
          <a href="signup_form.php">新規登録はこちら</a>
          <br>
          <a href="../index.php">トップへ</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>