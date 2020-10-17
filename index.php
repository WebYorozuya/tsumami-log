  <?php
  ini_set('display_errors',On);
  require_once('tsumami.php');

  $tsumami = new Tsumami('tsumamilog');
  //dbからつまみログのデータを取得
  $tsumamiData = $tsumami->getAll();
  function h($s){
    return htmlspecialchars($s,ENT_QUOTES,"utf-8");
  }
  ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
<title>ログ一覧</title>
</head>
<body>
<header class="header">
<div class="main_menu">
    <!-- <h1 class="header_logo">つまみログ</h1> -->
<nav class="navbar-dark bg-dark navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="#">つまみログ</a>
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
          <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<img src="./images/phot02.jpeg" class="img-fluid" alt="Responsive image">

</div>
<p class="menu_nav"> お酒のお供は人それぞれ<br>「つまみログ」は、お勧めのおつまみを投稿し共有できるサイトです。
<br>素敵な出会いがあるかも知れません</p>
</header>
  
<h2 id="new-content">新規投稿一覧</h2>
<div class="container">
  <div class="row">
    <?php foreach($tsumamiData as $column):?>
      <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <img src="<?php echo h($column['images']) ?>" 
            class="card-img-top" alt="...">
            <h5 class="card-title"><?php echo h($column['title'])?></h5>
            <p class="card-text"><?php echo h($column['content'])?></p>
            <a class="btn btn-primary stretched-link" href="detail.php?id=<?php echo $column['id']?>">詳細</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>

<footer>
  <div class="footer" style="background-color:gray;">
      <p>sakesuki</p>
      <a href="#">TOP</a>
  </div>
</footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>