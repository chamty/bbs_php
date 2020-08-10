<?php
session_start();
require('dbconnect.php');

if (empty($_REQUEST['id'])) {
  header('Location: index.php');
  exit();
}

$posts = $db->prepare('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=?');
$posts->execute(array($_REQUEST['id']));

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
  <div id="container">
    <h1 id="appTitle">ひとこと掲示板</h1>
    <div id="tweets">
      <div class="tweetBox">
      <?php if ($post = $posts->fetch()): ?>
        <div class="tweetInfo">
          <p class="tweetName"><?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?></p>
          <p class="tweetTime"><?php print(htmlspecialchars($post['created'],ENT_QUOTES)); ?></p>
          <p class="reply"><a href="index.php?res=<?php print(htmlspecialchars($post['id'],ENT_QUOTES)); ?>">[ Re ]</a></p>
          <p class="re_message"><a href="#">返信元のメッセージ</a></p>
        </div>
        <p class="tweet"><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?></p>
      <?php else: ?>
        <p>その投稿は削除されたか、URLが間違っています</p>
      <?php endif; ?>
      </div>
    </div>
    <p><a href="index.php">一覧に戻る</a></p>
  </div>
</body>
</html>