<?php
// getで送信されたidを取得
$id = $_GET['id'];

//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=gs_f01_db13;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('dbError:'.$e->getMessage());
  }


//２．データ登録SQL作成，指定したidのみ表示する
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE id=:id');
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if($status==false){
  // エラーのとき
  errorMsg($stmt);
}else{
  // エラーでないとき
  $rs = $stmt->fetch();
  // fetch()で1レコードを取得して$rsに入れる
  // $rsは配列で返ってくる．$rs["id"], $rs["name"]などで値をとれる
  // var_dump()で見てみよう
}
?>

<!-- htmlは「index.php」とほぼ同じです -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>更新ページ</title>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<form method="post" action="user_update.php">
  <div>
   <fieldset>
    <legend>ユーザー更新</legend>
     <label>ユーザー名：<input type="text" name="name" value="<?=$rs['name']?>"></label><br>
     <label>ID：<input type="text" name="lid" value="<?=$rs['lid']?>"></label><br>
     <label>PASSWORD：<input type="text" name="lpw" value="<?=$rs['lpw']?>"></label><br>
     <input type="submit" value="送信">
     <input type="hidden" name="id" value="<?=$rs['id']?>">
    </fieldset>
  </div>
</form>


</body>
</html>
