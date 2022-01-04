<?php
include_once('db_conn.php');

$event_name = $_POST['event_name'];
$content = $_POST['content'];
$artist = $_POST['artist'];
$start = $_POST['start'];
echo $start;
$end = $_POST['end'];
echo $start;
if (isset($_POST['submit'])) {
    if ($_FILES['uploadFile']['name'] != null) {
        echo "have image";
        echo "<br>";
        if ($_FILES['uploadFile']['type'] == "image/jpeg" || $_FILES['uploadFile']['type'] == "image/gif" || $_FILES['uploadFile']['type'] == "image/png") {
            // CREATE PATH AND MOVE FILE TO IMAGES folder
            $path = "images/";
            $tmp_name = $_FILES['uploadFile']['tmp_name'];
            $name = $_FILES['uploadFile']['name'];
            move_uploaded_file($tmp_name, $path . $name);
            $url = $path . $name;
            //SQL
            $sql = "INSERT INTO `tb_event` (`name`,`content`,`time_start`,`time_end`,`artist`,`photo`) VALUES ('$event_name', '$content' ,'$start','$end', '$artist', '$url')";
            $statement = mysqli_prepare($conn, $sql) or die(mysqli_error($conn));
            if (mysqli_stmt_execute($statement)) {
                echo "写真を追加しました。！";
                header("refresh:1;url=admin_event.php");
            } else {
                echo "写真を追加できない。！";
                header("refresh:1;url=admin_event.php");
            }
        } else {
            echo "写真がない！";
            header("refresh:1;url=admin_event.php");
        }
    }
}
