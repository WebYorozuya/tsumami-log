<?php
// ini_set('display_errors',On);
// require_once (dirname(__FILE__) .'/env.php');
require_once(__DIR__ . '/vendor/autoload.php');

use Dotenv\Dotenv;

//.envファイルがあるディレクトリを指定
$dotenv = Dotenv::createImmutable(__DIR__);
//.envファイルから環境変数から読み込み
$dotenv->load();

function connect()
{
   $host = $_ENV['DB_HOST'];
   $db   = $_ENV['LOGINDB_NAME'];
   $user = $_ENV['LOGINDB_USER'];
   $pass = $_ENV['LOGINDB_PASS'];
   $dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

   try {
      $pdo  = new PDO($dsn, $user, $pass, [
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
      return $pdo;
   } catch (PDOExeption $e) {
      echo '接続失敗です' . $e->getMessage();
      exit();
   }
}
