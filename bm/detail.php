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
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id=:id');
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
<!-- Main[Start] -->
<form method="post" action="update.php">
  <div>
   <fieldset>
    <legend>更新ページ</legend>
     <label>書籍名：<input type="text" name="book" value="<?=$rs['book']?>"></label><br>
     <label>書籍URL：<input type="text" name="url" value="<?=$rs['url']?>"></label><br>
     <label>書籍コメント：<textArea name="detail" rows="4" cols="40"><?=$rs['comment']?></textArea></label><br>
     <input type="submit" value="送信">
     <!-- idは変えたくない = ユーザーから見えないようにする type="hidden"-->
     <input type="hidden" name="id" value="<?=$rs['id']?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
