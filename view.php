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
  <header>
    <div id="header-left">
      <h1 id="appTitle">みんなのつぶやき</h1>
    </div>
    <div id="header-right">
      <p id="logout"></p>
    </div>
  </header>
  <div id="container">
    <div id="tweets">
      <div class="tweetBox">
      <?php if ($post = $posts->fetch()): ?>
        <div class="tweetInfo">
          <p class="tweetName"><?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?></p>
          <p class="tweetTime"><?php print(htmlspecialchars($post['created'],ENT_QUOTES)); ?></p>
        </div>
        <p class="tweet"><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?></p>
        <div class="tweetInfo_2">
          <p class="reply"><a href="index.php?res=<?php print(htmlspecialchars($post['id'],ENT_QUOTES)); ?>">[ Re ]</a></p>
          <?php if ($post['reply_message_id'] > 0): ?>
            <p class="re_message"><a href="view.php?id=<?php print(htmlspecialchars($post['reply_message_id'], ENT_QUOTES)); ?>">[ 返信元のメッセージ ]</a></p>
          <?php endif; ?>
          <?php if ($_SESSION['id'] == $post['member_id']): ?>
            <p class="delete"><a href="delete.php?id=<?php print(htmlspecialchars($post['id'], ENT_QUOTES)); ?>">[ 削除 ]</a></p>
          <?php endif; ?>
        </div>
      <?php else: ?>
        <p>その投稿は削除されたか、URLが間違っています</p>
      <?php endif; ?>
      </div>
    </div>
    <p><a href="index.php">一覧に戻る</a></p>
  </div>
</body>
</html>