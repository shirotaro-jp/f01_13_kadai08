<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_f01_db13;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbError:'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_php02_table WHERE id=1 OR id=3 OR id=5");
$status = $stmt->execute();

//３．データ表示
$view1="";
while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  $view1 .= "<p>".$result["email"]." -age".$result["age"]." -".$result["indate"]."</p>";
}

$stmt = $pdo->prepare("SELECT * FROM gs_php02_table WHERE id>=4 AND id<=8");
$status = $stmt->execute();
$view2="";
while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  $view2 .= "<p>".$result["email"]." -age".$result["age"]." -".$result["indate"]."</p>";
}

$stmt = $pdo->prepare("SELECT * FROM gs_php02_table WHERE email LIKE'%test1%'");
$status = $stmt->execute();
$view3="";
while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  $view3 .= "<p>".$result["email"]." -age".$result["age"]." -".$result["indate"]."</p>";
}

$stmt = $pdo->prepare("SELECT * FROM gs_php02_table ORDER BY indate DESC");
$status = $stmt->execute();
$view4="";
while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  $view4 .= "<p>".$result["email"]." -age".$result["age"]." -".$result["indate"]."</p>";
}

$stmt = $pdo->prepare("SELECT * FROM gs_php02_table WHERE age=20 AND indate LIKE '2017-05-26%'");
$status = $stmt->execute();
$view5="";
while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  $view5 .= "<p>".$result["email"]." -age".$result["age"]." -".$result["indate"]."</p>";
}

$stmt = $pdo->prepare("SELECT * FROM gs_php02_table ORDER BY indate DESC LIMIT 5");
$status = $stmt->execute();
$view6="";
while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  $view6 .= "<p>".$result["email"]." -age".$result["age"]." -".$result["indate"]."</p>";
}

$stmt = $pdo->prepare("SELECT age, count(*) FROM gs_php02_table GROUP BY age=10");
$status = $stmt->execute();
$view7="わからんかった";
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>課題１ SQL練習</title>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<!-- Main[Start] -->
<div>
<p>1</p>
    <div><?=$view1?></div>
</div>
<div>
<p>2</p>
    <div><?=$view2?></div>
</div>
<div>
<p>3</p>
    <div><?=$view3?></div>
</div>
<div>
<p>4</p>
    <div><?=$view4?></div>
</div>
<div>
<p>5</p>
    <div><?=$view5?></div>
</div>
<div>
<p>6</p>
    <div><?=$view6?></div>
</div>
<div>
<p>7</p>
    <div><?=$view7?></div>
</div>
<!-- Main[End] -->

</body>
</html>
