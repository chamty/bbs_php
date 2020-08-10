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
  <div id="app">
  <div id="container">
    <h1 id="appTitle">ひとこと掲示板</h1>
    <div id="inputBox">
      <div id="inputMessage">
        <p>メッセージ<span class="error">※メッセージを入力してください</span></p>
        <textarea cols="30" rows="10"></textarea>
      </div>
      <button id="inputSubmit">書き込む</button>
    </div>
    <hr width="100%">
    <div id="tweets">
      <div class="tweetBox">
        <div class="tweetUser">
          <p class="tweetName">ユーザー名</p>
          <p class="tweetTime">時間</p>
        </div>
        <p class="tweet"><?php print(htmlspecialchars($_POST['message'], ENT_QUOTES)); ?></p>
      </div>
    </div>
  </div>
  </div>
</body>
</html>