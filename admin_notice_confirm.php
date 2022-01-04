<?php
include 'db_conn.php';

$title = $_POST['title'];
$text = $_POST['text'];

$sql = "INSERT INTO `tb_notice` (`title`,`content`) VALUES ('$title', '$text')";

if ($conn->query($sql) === TRUE) {
    echo "新しく追加しました！";
    header("refresh:1;url=admin_notice.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
