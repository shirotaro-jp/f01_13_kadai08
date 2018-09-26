<?php
//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=gs_f01_db13;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('dbError:'.$e->getMessage());
  }
  
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY 'date' DESC LIMIT 3");
$status = $stmt->execute();
$last="";
if($status==false){
    errorMsg($stmt);
  }else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $last .= '<p><a href="detail.php?id='.$result['id'].'">';
    $last .= $result["book"]." -URL:".$result["url"]." -".$result["comment"]." -".$result["date"];
    $last .= "</a>";
    $last .= ' ';
    $last .= '<a href="delete.php?id='.$result['id'].'">'; 
    $last .= '［削除］</a></p>';
    }
  }
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマークアプリ</title>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<div>
<?=$last?>
</div>
<form method="post" action="insert.php">
  <div>
   <fieldset>
    <legend>ブックマーク</legend>
     <label>書籍名：<input type="text" name="book"></label><br>
     <label>書籍URL：<input type="text" name="url"></label><br>
     <label>書籍コメント：<textArea name="detail" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>


</body>
</html>
