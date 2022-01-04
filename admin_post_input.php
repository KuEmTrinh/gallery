<?php
require "db_conn.php";
?>
<?php
$title = $_POST['title'];
$content = $_POST['content'];
$sql = "INSERT INTO post(title,content) VALUES('$title','$content')";
$rs = $conn->query($sql);
if (!$rs) die('エラー: ' . $conn->error);
echo 'ok';
header("refresh:1;url=admin_post.php");
?>