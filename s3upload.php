<?php
ini_set('display_errors',1);
// header('Content-Type: text/plain; charset=utf-8'); 
require_once  realpath(__DIR__ . '/vendor/autoload.php');
use Aws\S3\S3Client;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


/* s3に保存しObjectURLを取得
 * @param string $images ファイル名
 * @return string $result
 */
function s3getObject($save_filename) {

  //aws
  // $bucket  = $_ENV['BUCKET'];
  // $key     =  $_ENV['KEY'];
  // $secret =  $_ENV['SECRET_KEY'];
  // $baseUrl =  $_ENV['BASE_URL'];
  $bucket  = 'tsumami-log';
  $key     = 'AKIAT2CBCKREQSSRQPDK';
  $secret = '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';
  //ファイル関連取得
  $file = $_FILES['image'];
  $filename = basename($file['name']);
  $tmp_path = $file['tmp_name'];
  $save_filename = date('YmdHis') . $filename;
  // $save_path = $baseUrl . $save_filename;

  //追記
  // $credentials = new Aws\Credentials\Credentials('key', 'secret');
  $s3 = new S3Client(array(
     'credentials' => array(
      'key' =>$key,
      'secret' => $secret,
    ),
      'region' => 'ap-northeast-1',
      'version' => 'latest',
  ));
  
   if (!is_uploaded_file($tmp_path)) {
     return;
   }
  
  $S3result = $s3->putObject(array(
    'Bucket' => $bucket,
    'Key' => 'log-data/'.time().'-'.$save_filename,
    'Body' => fopen($tmp_path,'rb'),
    'ACL' => 'public-read',
    'ContentType' => mime_content_type($tmp_path),
  ));

  return  $S3result['ObjectURL'];
}
