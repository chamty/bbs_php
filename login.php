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
  <div id="container">
    <h1 id="appTitle">掲示板</h1>
    <form action="" method="post">
    <dl id="inputItems">
      <dt>メールアドレス</dt>
      <dd>
        <input type="text" name="email" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>">
      </dd>
      <?php if ($error['email'] === 'blank'): ?>
        <p class="error">※メールアドレスを入力してください</p>
      <?php endif; ?>
      <?php if ($error['email'] === 'duplicate'): ?>
        <p class="error">※指定されたメールアドレスは、既に登録されています</p>
      <?php endif; ?>
      <dt>パスワード</dt>
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
    <div><input type="submit" id="inputSubmit" value="ログイン"> | <a href="join/index.php">新規登録はこちら</a></div>
    </form>
  </div>
</body>
</html>