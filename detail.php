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
  <link rel="icon" href="./favicon/favicon.ico" id="favicon">
  <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon-180x180.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <title>記事詳細</title>
</head>

<body>
  <!-- ヘッダー -->
  <header class="header"> 
   <div class="main_menu">
      <nav class="navbar-dark bg-dark navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="index.php"><i class="fas fa-beer"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <li class="nav-item">
              <a class="nav-link" href="#new-content">新規投稿</a></li>
            <a class="nav-link " href="index.html">投稿する<span class="sr-only">(current)</span></a></li>
            <li class="nav-item">
              <a class="nav-link" href="./public/signup_form.php">ユーザ登録</a></li>
            <li class="nav-item">
              <a class="nav-link" href="./public/login.php">ログイン</a></li>
          </ul>
        </div>
      </nav>
  <!-- </header> -->

  <div class="container">
    <h2 id="new-content">記事詳細</h2>
    <!-- <div class="row"> -->
      <div class="col-12">
        <div class="card">
          <div class="card-body mt-5">
            <h2><?php echo $result['title'] ?></h2>
            <img class="w-50 h-auto card-img-top rounded mx-auto d-block" src="<?php echo $result['images'] ?>" alt="写真データ">
            <p>ユーザー名:<?php echo $result['users'] ?></p>
            <p>カテゴリー:<?php echo $tsumami->setCategoryName($result['category']) ?></p>
            <hr>
            <p>本文<?php echo $result['content'] ?></p>
            <br>
          </div>
        </div>
      </div>
      <div class="mx-auto" style="width: 200px;">
        <button type="button" class="btn btn-light rounded-pill mx-auto"><a href="index.php" class="text-info"> Topに戻る</a></button>
      </div>
    

    </div>
  </div>
  </div>

  <!--フッター部分-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>