<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/2.css">
    <meta name="robots" content="none,noindex,nofollow">
    <title>新規会員登録</title>
</head>

<body>
    <?php
        session_start();
    ?>
    <div class="textbody">
        <h1><a href="../index.html"><img src="../images/logo2.png" class="logo" width="300px" height="90px"></a></h1>
        <div class="formtable">
            <form action="../process/registration.php" method="POST">
                <table border="0" cellspacing="30">
                    <tr>
                        <th>ID</th>
                        <td>
                            <input type="text" name="new_user_id" placeholder="ID" size="24">
                        </td>
                    </tr>
                    <tr>
                        <th>ユーザネーム</th>
                        <td>
                            <input type="text" name="new_user_name" placeholder="Username" value="" size="24">
                        </td>
                    </tr>
                    <tr>
                        <th>パスワード</th>
                        <td>
                            <input type="password" name="new_user_password" placeholder="Password" value="" size="24">
                        </td>
                    </tr>
                    <tr>
                        <th>確認</th>
                        <td>
                            <input type="text" name="password_check" placeholder="Password確認用" value="" size="24">
                        </td>
                    </tr>
                </table>
                <div class="submit">
                    <input type="submit" value="次へ" class="button">
                </div>
                <?php
                if (isset($_SESSION['err'])) {
                    echo "<br><p style='text-align:center'>".$_SESSION['err']."</p>";
                    $_SESSION['err'] = "";
                }else{
                    echo "";
                }
                ?>
            </form>
        </div>
    </div>




    <footer>
        <a href="./contact.html" class="question">
            <P>お問い合わせ</P>
        </a>
        <small>Copyright ©︎ 2021 HAL Tokyo</small>
    </footer>
</body>

</html>