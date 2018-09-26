<?php
//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=gs_f01_db13;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('dbError:'.$e->getMessage());
  }
  
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();
$list="";
if($status==false){
    errorMsg($stmt);
  }else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $list .= '<p><a href="user_detail.php?id='.$result['id'].'">';
    $list .= $result["name"]." -権限:".$result["kanri_flg"];
    $list .= "</a>";
    $list .= ' ';
    $list .= '<a href="user_delete.php?id='.$result['id'].'">'; 
    $list .= '［削除］</a></p>';
    }
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー管理</title>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<div>
<?=$list?>
</div>
</body>
</html>