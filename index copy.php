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
  <!-- <link rel="stylesheet" href="styles/styles.css"> -->
  <title>ログ一覧</title>
</head>
<body>
<header class="header">
  <div class="main_menu">
    <h1 class="header_logo">つまみログ</h1>
      <ul class='menu'>
        <li><a href="index.html" class="btn btn-primary" role="button">新規登録</a></li>
        <li><a href="#" class="btn btn-primary" role="button">検索</li></a>
        <li><a href="./public/signup_form.php" class="btn btn-primary" role="button">ユーザ登録</a></li>
       <li><a href="./public/login.php" class="btn btn-primary" role="button">ログイン</a></li>
      </ul>
  </div>
  <p class="menu_nav"> お酒のお供は人それぞれ<br>この「つまみログ」は皆さんのお勧めのおつまみを投稿し共有できるサイトです。
  <br>素敵な出会いがあるかも知れません</p>
</header>
  
  <h2>新規投稿一覧</h2>
  <!-- <table>
    <tr>
      <th>タイトル</th>
      <th>カテゴリ</th>
      <th>ユーザー名</th>
      <th>本文</th>
    </tr>
    <tr>
      <?php foreach($tsumamiData as $column):  ?>
        <td><?php echo h($column['title'])?></td>
        <td><?php echo h($tsumami->setCategoryName($column['category']))?></td>
        <td><?php echo h($column['users'])?></td>
        <td><?php echo h($column['content'])?></td>
        <td><a href="detail.php?id=<?php echo $column['id']?>">詳細</a></td>
        <td><a href="update_form.php?id=<?php echo $column['id']?>">編集</a></td>
        <td><a href="log_delete.php?id=<?php echo $column['id']?>">削除</a></td>
    </tr>
      <?php endforeach ?>
  </table> -->

    <!-- <tr>
      <th>タイトル</th>
      <th>カテゴリ</th>
      <th>ユーザー名</th>
      <th>本文</th> -->
    <!-- <div class='main_content'>
      <?php foreach($tsumamiData as $column):?>
        <div class='contents'> 
          <p><?php echo h($column['title'])?></p><br>
          <p><?php echo h($tsumami->setCategoryName($column['category']))?></p><br>
          <p><?php echo h($column['users'])?></p><br>
          <p><?php echo h($column['content'])?></p><br>
          <a href="detail.php?id=<?php echo $column['id']?>">詳細</a><br>
          <a href="update_form.php?id=<?php echo $column['id']?>">編集</a><br>
          <a href="log_delete.php?id=<?php echo $column['id']?>">削除</a><br>
          <hr>
        </div>
        <?php endforeach ?>
    </div> -->
<!--     
<?php foreach($tsumamiData as $column):?>
<div class="container">
    <div class="row">
      <div class="col-md">
          <div class="card" style="width: 18rem;">
            <img src="./images/phot01.jpeg" class="card-img-top" alt="...">
          </div>
            <div class="card-body">
            <h5 class="card-title"><p><?php echo h($column['title'])?></p><br></h5>
            <p class="card-text"><p><?php echo h($column['content'])?></p><br></p>
          <a href="#" class="btn btn-primary stretched-link" href="detail.php?id=<?php echo $column['id']?>">詳細</a>
          <a href="update_form.php?id=<?php echo $column['id']?>" class="btn btn-primary stretched-link">編集</a><br>
          <a href="log_delete.php?id=<?php echo $column['id']?>" class="btn btn-primary stretched-link">削除</a><br>
     </div>
     <?php endforeach ?>
   </div>
 </div>
</div> -->
<div class="container">
  <?php foreach($tsumamiData as $column):?>
   <div class="row">
    <div class="col-sm">
     <div class="card" style="width: 18rem;">
       <img src="./images/phot01.jpeg" class="card-img-top" alt="...">
         <div class="card-body">
            <h5 class="card-title"><?php echo h($column['title'])?></h5>
              <p class="card-text"><?php echo h($column['content'])?></p>
              <a class="btn btn-primary stretched-link" href="detail.php?id=<?php echo $column['id']?>">詳細</a>
            </div>
          </div>
        </div>
     <div class="col-sm">
      <div class="card" style="width: 18rem;">
        <img src="./images/phot01.jpeg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo h($column['title'])?></h5>
             <p class="card-text"><?php echo h($column['content'])?></p>
              <a class="btn btn-primary stretched-link" href="detail.php?id=<?php echo $column['id']?>">詳細</a>
            </div>
          </div>
        </div>
     </div>
    <div class="col-sm">
     <div class="card" style="width: 18rem;">
       <img src="./images/phot01.jpeg" class="card-img-top" alt="...">
         <div class="card-body">
           <h5 class="card-title"><?php echo h($column['title'])?></h5>
             <p class="card-text"><?php echo h($column['content'])?></p>
              <a class="btn btn-primary stretched-link" href="detail.php?id=<?php echo $column['id']?>">詳細</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>

<!-- グリッドしていない -->
<!-- <div class="card" style="width: 18rem;">
  <?php foreach($tsumamiData as $column):?>
   <img src="./images/phot01.jpeg" class="card-img-top" alt="...">
   <div class="card-body">
            <h5 class="card-title"><p><?php echo h($column['title'])?></p></h5>
            <p class="card-text"><p><?php echo h($column['content'])?></p></p>
            <a href="#" class="btn btn-primary stretched-link" href="detail.php?id=<?php echo $column['id']?>">詳細</a>
          </div>
  <?php endforeach ?>
</div> -->


  <footer>
  <div class="footer">
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