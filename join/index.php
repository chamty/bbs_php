<?php
session_start();
require('../dbconnect.php');

  if (!empty($_POST)) {
    if ($_POST['name'] === '') {
      $error['name'] = 'blank';
    }
    if ($_POST['email'] === '') {
      $error['email'] = 'blank';
    }
    if (strlen($_POST['password']) < 4) {
      $error['password'] = 'length';
    }
    if ($_POST['password'] === '') {
      $error['password'] = 'blank';
    }

    // アカウントの重複チェック
    if (empty($error)) {
      $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
      $member->execute(array($_POST['email']));
      $record = $member->fetch();
      if ($record['cnt'] > 0 ) {
        $error['email'] = 'duplicate';
      }
    }

    if (empty($error)) {
      $_SESSION['join'] = $_POST;
      header('Location: check.php');
      exit();
    }
  }

  if ($_REQUEST['action'] === 'rewrite' && isset($_SESSION['join'])) {
    $_POST = $_SESSION['join'];
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
      <dt>ニックネーム<span class="required">必須</span></dt>
      <dd>
        <input type="text" name="name" value="<?php print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>">
      </dd>
      <?php if ($error['name'] === 'blank'): ?>
        <p class="error">※名前を入力してください</p>
      <?php endif; ?>
      <dt>メールアドレス<span class="required">必須</span></dt>
      <dd>
        <input type="text" name="email" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>">
      </dd>
      <?php if ($error['email'] === 'blank'): ?>
        <p class="error">※メールアドレスを入力してください</p>
      <?php endif; ?>
      <?php if ($error['email'] === 'duplicate'): ?>
        <p class="error">※指定されたメールアドレスは、既に登録されています</p>
      <?php endif; ?>
      <dt>パスワード<span class="required">必須</span></dt>
      <dd>
        <input type="text" name="password" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>">
      </dd>
      <?php if ($error['password'] === 'length'): ?>
        <p class="error">※パスワードは4文字以上で入力してください</p>
      <?php endif; ?>
      <?php if ($error['password'] === 'blank'): ?>
        <p class="error">※パスワードを入力してください</p>
      <?php endif; ?>
    </dl>
    <div><button id="inputSubmit">確認画面へ</button> | <a href="../login.php">ログインはこちら</a></div>
    </form>
  </div>
</body>
</html>