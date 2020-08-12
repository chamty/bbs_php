<?php
session_start();
require('../dbconnect.php');

if (!isset($_SESSION['join'])) {
  header('Location: index.php');
  exit();
}

if (!empty($_POST)) {
  $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');
  echo $statement->execute(array(
    $_SESSION['join']['name'],
    $_SESSION['join']['email'],
    sha1($_SESSION['join']['password'])
  ));
  unset($_SESSION['join']);

  header('Location: thanks.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>掲示板</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>
<body>
  <header>
    <div id="header-left">
      <h1 id="appTitle">みんなのつぶやき</h1>
    </div>
    <div id="header-right">
      <p id="logout"></p>
    </div>
  </header>
  <div id="container">
    <form action="" method="post">
    <input type="hidden" name="action" value="submit">
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
    <div><a href="index.php?action=rewrite">&laquo;&nbsp;修正する</a> | <input type="submit" id="inputSubmit" value="登録する"></div>
    </form>
  </div>
</body>
</html>