<?php
include_once('db_conn.php');

$photo_name = $_POST['photo_name'];
echo $photo_name;
if (isset($_POST['submit'])) {
    if ($_FILES['uploadFile']['name'] != null) {
        echo "写真あり";
        echo "<br>";
        if ($_FILES['uploadFile']['type'] == "image/jpeg" || $_FILES['uploadFile']['type'] == "image/gif" || $_FILES['uploadFile']['type'] == "image/png") {
            // CREATE PATH AND MOVE FILE TO IMAGES folder
            $path = "images/";
            $tmp_name = $_FILES['uploadFile']['tmp_name'];
            $name = $_FILES['uploadFile']['name'];
            move_uploaded_file($tmp_name, $path . $name);
            $url = $path . $name;
            echo $url;
            //SQL
            $sql = "INSERT INTO `tb_photo` (`name`,`url`) VALUES ('$photo_name', '$url')";
            $statement = mysqli_prepare($conn, $sql) or die(mysqli_error($conn));
            if (mysqli_stmt_execute($statement)) {
                echo "写真を追加しました。！";
                header("refresh:1;url=admin_gallery.php");
            } else {
                echo "写真を追加できない。！";
                header("refresh:1;url=admin_gallery.php");
            }
        } else {
            echo "写真がない！";
            header("refresh:1;url=admin_gallery.php");
        }
    }
}
