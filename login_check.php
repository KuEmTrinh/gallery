<?php
session_start();
error_reporting(0);
?>

<?php
//データベースに接続
include "db_conn.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM tb_user WHERE username='$username' AND password='$password'";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['username'] === $username  && $row['password'] === $password) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        header('Location: admin_home.php');
    } else {
        header("Location: index.php?error=Incorect User name or password");
        exit();
    }
} else {
    echo '認証に失敗しました';
    header("refresh:1;url=login.php");
    exit();
}
?>
