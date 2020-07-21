<?php
require_once('dbc.php');
$dbc = new Dbc();
//dbからつまみログのデータを取得
$tsumamiDate = $dbc->getAlltsumami();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </div>
    <p class="menu_nav"> お酒のお供は人それぞれ<br>この「つまみログ」は皆さんのお勧めのおつまみを投稿し共有できるサイトです。<br>素敵な出会いがあるかも知れません</p>
  </header>
  
  <h2>新規投稿一覧</h2>
  <table>
    <tr>
      <th>NO</th>
      <th>タイトル</th>
      <th>カテゴリ</th>
    </tr>
    <tr>
      <?php foreach($tsumamiDate as $column):  ?>
      <td><?php echo $column['id']?></td>
      <td><?php echo $column['title']?></td>
      <td><?php echo $dbc->setCategoryName($column['category'])?></td>
      <td><?php echo $column['users']?></td>
      <td><a href="detail.php?id=<?php echo $column['id']?>">詳細</a></td>
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