<?php
session_start();
unset($_SESSION);
session_destroy();
?>

<h3>ログアウトしました！</h3>
<?php
header("refresh:1;url=login.php");
?>