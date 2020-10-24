<?php
  require_once(dirname(__FILE__) . '/tsumami.php');

  $tsumami = new Tsumami();
  $result = $tsumami->delete($_GET['id']);
  
?>
<p><a href="index.php">戻る</a></p>