  <?php
  require_once(dirname(__FILE__) . '/tsumami.php');
  $tsumami = new Tsumami('tsumamilog');

  //dbからつまみログのデータを取得
  // $tsumamiData = $tsumami->getAll();
  $tsumamiData = $tsumami->getPages();
  $pages = $tsumami->countPage();
  $page = $_REQUEST['page'];

  function h($str)
  {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }
  ?>

  <!DOCTYPE html>
  <html lang="ja">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="./favicon/favicon.ico" id="favicon">
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon-180x180.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <title>ログ一覧</title>
  </head>

  <body>
    <!-- ヘッダー -->
    <header class="header">
      <div class="main_menu">
        <nav class="navbar-dark bg-dark navbar navbar-expand-lg navbar-light bg-light fixed-top">
          <a class="navbar-brand" href="#"><i class="fas fa-beer"></i></a>
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
    </header>
    <img src="./img/tsumami-top.png" class="rounded mx-auto d-block container-lg img-fluid" alt="Responsive image">
    </div>

    <div class="container bg-white py-5 my-5">
      <!-- タブ -->
      <div class="tav">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item col-6 p-0" role="presentation">
            <a class="nav-link active text-center" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">つまみログとは？</a>
          </li>
          <li class="nav-item col-6 p-0" role="presentation">
            <a class="nav-link text-center" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="col-md-8 col-12 my-5 mx-auto">
              お酒のお供は人それぞれ「つまみログ」は、皆さんのおつまみを投稿し共有できるサイトです。
            </div>
          </div>
          <div class="tab-pane fade col-md-8 col-12 my-5 mx-auto" id="contact" role="tabpanel" aria-labelledby="contact-tab">お問い合わせフォームをいれる</div>
        </div>
      </div>

      <!-- 投稿部分-->
      <h2 id="new-content">新規投稿一覧</h2>
      <div class="container">
        <div class="row">
          <?php foreach ($tsumamiData as $column) : ?>
            <div class="col-md-4 col-12">
              <div class="card">
                <div class="card-body">
                  <img src="<?php echo h($column['images']) ?>" class="card-img-top" alt="...">
                  <h5 class="card-title"><?php echo h($column['title']) ?></h5>
                  <p class="card-text"><?php echo h($column['content']) ?></p>
                  <a class="btn btn-primary stretched-link" href="detail.php?id=<?php echo $column['id'] ?>">詳細</a>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>

    <!--ページネーション-->
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <!-- <li class="page-item disabled">
      <a class="page-link" href="index.php" tabindex="-1" aria-disabled="true">Previous</a>
    </li> -->
        <?php if ($page >= 2) : ?>
          <li class="page-item"><a class="page-link" href="index.php?page=<?php print($page - 1); ?>">前←</a></li>
        <?php endif; ?>

        <?php if ($page < $pages) : ?>
          <li class="page-item"><a class="page-link" href="index.php?page=<?php print($page + 1); ?>">次→</a></li>
        <?php endif; ?>
        <!-- <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li> -->
      </ul>
    </nav>
    <!--フッター部分-->
    <footer class="bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-12">
            <div class="py-4">
              <h4 class="d-inlineblock py-3 border-bottom border-info">Profile</h4>
            </div>
            <div class="mx-5">
              <img class="img-fluid rounded-circle" src="./img/profile.png" alt="">
            </div>
            <p>お酒が好きな31歳、R1.11月〜プログラミング学習を始めました。将来はwebエンジニア転職を目指していきたいです。
          </div>
          <div class="col-md-4 col-12">
            <div class="py-4">
              <h4 class="d-inlineblock py-3 border-bottom border-info">Portfolio</h4>
            </div>
            <div class="mx-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="https://sakesuki.github.io/frontend-dev/">Sass/JavaScriptを使用したWEBページ</a></li>
                <li class="list-group-item"><a href="https://sakesuki.github.io/TypingGame/">タイピングゲーム</a></li>
                <!-- <li class="list-group-item"><a href="">>ポートフォリオサイト</a></li> -->
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-12">
            <div class="py-4">
              <h4 class="d-inlineblock py-3 border-bottom border-info">Twitter</h4>
            </div>
            <div class="mx-5">
              <a class="twitter-timeline" data-lang="ja" data-height="500" href="https://twitter.com/sakesuki4?ref_src=twsrc%5Etfw">Tweets by sakesuki4</a>
              <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-dark text-white text-center p-3">
        Copyright - osakesuki.2020 All Rights Reserved.
      </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>

  </html>