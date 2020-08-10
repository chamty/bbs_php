<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time();

  $members = $db->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
} else {
  header('Location: login.php');
  exit();
}

if (!empty($_POST)) {
  if ($_POST['message'] !== '') {
    $message = $db->prepare('INSERT INTO posts SET member_id=?, reply_message_id=0, message=?, created=NOW()');
    $message->execute(array(
      $member['id'],
      $_POST['message']
    ));

    header('Location: index.php');
    exit();
  }
}

$posts = $db->query('SELECT m.name, p.* FROM members m, posts p WHERE m.id=member_id ORDER BY p.created DESC');

if (isset($_REQUEST['res'])) {
  $response = $db->prepare('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=?');
  $response->execute(array($_REQUEST['res']));

  $table = $response->fetch();
  $message = '@' . $table['name'] . ' ' . $table['message'];
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
  <div id="container">
    <h1 id="appTitle">ひとこと掲示板</h1>
    <form action="" method="post">
      <div id="inputBox">
        <p><?php print(htmlspecialchars($member['name'], ENT_QUOTES)); ?>さん</p>
        <div id="inputMessage">
          <textarea name="message" cols="30" rows="10"><?php print(htmlspecialchars($message, ENT_QUOTES)); ?></textarea>
        </div>
        <button id="inputSubmit">書き込む</button>
      </div>
    </form>
    <hr width="100%">
    <div id="tweets">
      <?php foreach($posts as $post): ?>
      <div class="tweetBox">
        <div class="tweetInfo">
          <p class="tweetName"><?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?></p>
          <p class="tweetTime"><?php print(htmlspecialchars($post['created'],ENT_QUOTES)); ?></p>
          <p class="reply"><a href="index.php?res=<?php print(htmlspecialchars($post['id'],ENT_QUOTES)); ?>">[ Re ]</a></p>
        </div>
        <p class="tweet"><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>