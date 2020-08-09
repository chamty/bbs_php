<?php
session_start();

if (!isset($_SESSION['join'])) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ひとこと掲示板</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>
<body>
  <div id="container">
    <h1 id="appTitle">ひとこと掲示板</h1>
    <form action="" method="post">
    <dl id="inputItems">
      <dt>ニックネーム</dt>
      <dd>
        <?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?>
      </dd>
      <dt>メールアドレス</dt>
      <dd>
        <?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?>
      </dd>
      <dt>パスワード</dt>
      <dd>
        <?php print(htmlspecialchars($_SESSION['join']['password'], ENT_QUOTES)); ?>
      </dd>
    </dl>
    <button id="inputModify">修正する</button>
    <button id="inputSubmit">登録する</button>
    </form>
  </div>
</body>
</html>