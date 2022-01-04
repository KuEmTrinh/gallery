<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: "textarea#editor",
            skin: "bootstrap",
            plugins: "lists, link, image, media",
            toolbar: "h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help",
            menubar: false,
        });
    </script>
</head>

<style>
    .nav-ul {
        display: flex;
        justify-content: space-between;
    }



    .admin_logo {
        font-size: 2rem;
        font-weight: bold;
        padding: 2rem;
    }
</style>
<?php
session_start();
?>

<body>
    <header class="header">
        <div class="login">
            <div class="login-button">
                <a href="admin_logout.php">LOGOUT</a>
            </div>
        </div>
        <div class="logo-box">
            <h1 class="admin_logo">
                <?php
                // echo $_SESSION['name']."さん！管理画面へようこそ！";
                ?>
            </h1>
        </div>

        <div class="nav">
            <ul class="nav-ul">
                <li class="link"><a href="admin_gallery.php">ギャラリー管理</a></li>
                <li class="link"><a href="admin_event.php">イベント管理</a></li>
                <li class="link"><a href="admin_notice.php">お知らせ管理</a></li>
                <li class="link"><a href="admin_contract.php">契約内容・注意事項管理</a></li>
            </ul>
        </div>
    </header>
</body>

</html>