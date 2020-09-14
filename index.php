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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styles/style.css">
  <title>ログ一覧</title>
</head>
<body>
<header class="header">
  <div class="main_menu">
    <h1 class="header_logo">つまみログ</h1>
      <ul class='menu'>
        <a href="index.html"><li class='menu_list'>新規登録</li></a>
        <a href="#"><li class='menu_list'>検索</li></a>
      </ul>
      <a href="./public/signup_form.php">ユーザ登録ページへ</a>
      <br>
      <a href="./public/login.php">ログインページへ</a>
  </div>
      <p class="menu_nav"> お酒のお供は人それぞれ<br>この「つまみログ」は皆さんのお勧めのおつまみを投稿し共有できるサイトです。
      <br>素敵な出会いがあるかも知れません</p>
  </header>
  
  <h2>新規投稿一覧</h2>
  <table>
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
  </table>

  <footer>
  <div class="footer">
      <p>sakesuki</p>
      <a href="#">TOP</a>
  </div>
</footer>
</body>
</html>