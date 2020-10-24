<?php
// 0ini_set('display_errors',On);
  require_once(dirname(__FILE__) . '/tsumami.php');
    $tsumami = new Tsumami();
    $result = $tsumami->getById($_GET['id']);

    $id = $result['id'];
    $title = $result['title'];
    $content = (int)$result['content'];
    $category = $result['category'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>つまみログ</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body >
  <h2>ログ編集</h2>
  <form action="log_update.php" method='POST'>
    <input type="hidden" name ="id" value="<?php echo $id?>">
      <p>タイトル</p>
    <input type="text" name='タイトル' value='<?php echo $title?>'>
      <p>投稿者名</p>
    <input type="text" name='ユーザー名'>  
       <p>カテゴリー</p>
      <select name="カテゴリー">
        <option value="1"<?php if($category===1) echo 'selected'?>>ビールに合う</option>
        <option value="2"<?php if($category===2) echo 'selected'?>>ワインに合う</option>
        <option value="3"<?php if($category===3) echo 'selected'?>>ウイスキーに合う</option>
        <option value="4"<?php if($category===4) echo 'selected'?>>焼酎に合う</option>
        <option value="5"<?php if($category===5) echo 'selected'?>>日本酒に合う</option>
        <option value="6"<?php if($category===6) echo 'selected'?>>チューハイに合う</option>
      </select>
    <p>説明</p>
    <textarea name="投稿内容" id="content" cols="30" rows="10"><?php echo $content ?></textarea>
    <br>
    <input type="submit" value='送信'>
    <p><a href="index.php">戻る</a></p>
  </form>
</body>
</html>