<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST['book']) || $_POST['book']=='' ||
  !isset($_POST['url']) || $_POST['url']=='' ||
  !isset($_POST['detail']) || $_POST['detail']==''
){
  exit('ParamError');
}

//1. POSTデータ取得
$id     = $_POST['id'];
$book   = $_POST['book'];
$url  = $_POST['url'];
$detail = $_POST['detail'];

//2. DB接続します(エラー処理追加)
try {
    $pdo = new PDO('mysql:dbname=gs_f01_db13;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('dbError:'.$e->getMessage());
  }


//3．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE gs_bm_table SET book=:a1, url=:a2, comment=:a3 WHERE id=:id');
$stmt->bindValue(':a1', $book, PDO::PARAM_STR);
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);
$stmt->bindValue(':a3', $detail, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
  header('location: index.php'); //locationの後に必ず半角スペース
  exit;
}
?>
