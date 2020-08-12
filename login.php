<?php
session_start();
require('dbconnect.php');

if ($_COOKIE['email'] !== '') {
  $email = $_COOKIE['email'];
}

if (!empty($_POST)) {
  $email = $_POST['email'];

  if ($_POST['email'] !== '' && $_POST['password'] !== '') {
    $login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?');
    $login->execute(array(
      $_POST['email'],
      sha1($_POST['password'])
    ));
    $member = $login->fetch();

    if ($member) {
      $_SESSION['id'] = $member['id'];
      $_SESSION['time'] = time();

      if ($_POST['save'] === 'on') {
        setcookie('email', $_POST['email'], time()+60*60*24*14);
      }

      header('Location: index.php');
      exit();
    } else {
      $error['login'] = "failed";
    }
  } else {
    $error['login'] = 'blank';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ひとこと掲示板</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
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
    <dl id="inputItems">
      <?php if ($error['login'] === 'blank'): ?>
        <p class="error">※メールアドレスとパスワードを入力してください</p>
      <?php endif; ?>
      <?php if ($error['login'] === 'failed'): ?>
        <p class="error">※メールアドレスまたはパスワードが異なっています</p>
      <?php endif; ?>
      <dt>メールアドレス</dt>
      <dd>
        <input type="text" name="email" value="<?php print(htmlspecialchars($email, ENT_QUOTES)); ?>">
      </dd>
      <dt>パスワード</dt>
      <dd>
        <input type="text" name="password" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>">
      </dd>
      <input type="checkbox" name="save" value="on">
      <label for="save">メールアドレスを記憶する</label>
    </dl>
    <div><input type="submit" id="inputSubmit" value="ログイン"> | <a href="join/index.php">新規登録はこちら</a></div>
    </form>
  </div>
</body>
</html>