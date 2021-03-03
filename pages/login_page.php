<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="none,noindex,nofollow">
    <title>ログイン</title>
    <link rel="stylesheet" href="../css/4.css">
</head>
<body>
    <?php
        session_start();
    ?>
    <div class="body">
        <div class="header">
          <div><a href="../index.php"><img src="../images/logo2_white.png" alt="logo" width="400px" class="logo"></a></div>
        </div>
        <br>
        <div class="login">
            <form action="./mypage.php" method="post">
                <input type="text" placeholder="User ID"   name="user_id" value="hew2020"><br>
                <input type="password" placeholder="Password"   name="user_password" value="hew2020"><br>
                <button type="submit">Login</button>
                <?php
                    $_SESSION['user_id'] = "hew2020";
                    $_SESSION['user_pass'] = "hew2020";

                    if (isset($_SESSION['err'])) {
                        echo "<br>".$_SESSION['err'];
                        $_SESSION['err'] = "";
                    }else{
                        echo "";
                    }
                ?>
            </form>
        </div>
    </div>

    <footer>
        <a href="./contact.html" class="question"><P>お問い合わせ</P></a>
        <small>Copyright ©︎ 2021 HAL Tokyo</small>
    </footer>
</body>
</html>