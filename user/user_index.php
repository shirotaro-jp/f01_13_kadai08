<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー管理</title>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<form method="post" action="user_insert.php">
  <div>
   <fieldset>
    <legend>ユーザー追加</legend>
     <label>ユーザー名：<input type="text" name="name"></label><br>
     <label>ID：<input type="text" name="lid"></label><br>
     <label>PASSWORD：<input type="text" name="lpw"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>


</body>
</html>
