<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
</head>


<body>
    <header class="header">
        <div class="logo">
            <a href="home.php">
                <img src="images/gyalarylogo.png">
            </a>
        </div>

        <div class="nav">
            <ul class="nav-ul">
                <li class="link"><a href="home.php">ホームページ</a></li>
                <li class="link">
                    <a href="#">
                        イベント
                    </a>
                    <ul class="link-sub">
                        <li><a href="event.php">開催中のイベント</a></li>
                        <li><a href="#">開催予定のイベント</a></li>
                        <li><a href="#">過去のイベント</a></li>
                    </ul>
                </li>
                <li class="link"><a href="gallery.php">ギャラリー</a></li>
                <li class="link"><a href="notice.php">お知らせ</a></li>
                <li class="link"><a href="contract.php">契約内容・注意事項</a>
                </li>

                <li class="link"><a href="mail.php">お問い合わせ</a></li>
            </ul>
        </div>
    </header>
</body>

</html>