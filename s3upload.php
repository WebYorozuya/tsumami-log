<?php
require_once  realpath(__DIR__ . '/vendor/autoload.php');

use Aws\S3\S3Client;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/** s3に保存しObjectURLを取得
 * @param string $images ファイル名
 * @return string $result
 */
function s3getObject($save_filename)
{
  //aws
  $bucket  = $_ENV['BUCKET'];
  $key     =  $_ENV['KEY'];
  $secret =  $_ENV['SECRET_KEY'];
  $baseUrl =  $_ENV['BASE_URL'];

  //ファイル関連取得
  $file = $_FILES['image'];
  $filename = basename($file['name']);
  $tmp_path = $file['tmp_name'];
  $save_filename = date('YmdHis') . $filename;

  $s3 = new S3Client(array(
    'credentials' => array(
      'key' => $key,
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
    'Key' => 'log-data/' . time() . '-' . $save_filename,
    'Body' => fopen($tmp_path, 'rb'),
    'ACL' => 'public-read',
    'ContentType' => mime_content_type($tmp_path),
  ));

  return  $S3result['ObjectURL'];
}
