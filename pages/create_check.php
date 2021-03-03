<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="none,noindex,nofollow">
    <title>登録内容確認</title>
    <link rel="stylesheet" href="../css/3.css">
</head>
<body>
    <?php
    session_start();
    if ($_SESSION['new_user_id'] === "" ||
        $_SESSION['new_user_name'] === "" ||
        $_SESSION['new_user_pass'] === "") {
        header('location:../pages/create_account.php');
        exit;
    }
    ?>
    <div class="wrapper">
    <div class="textarea">
        <h1><a href="../1/1.html"><img src="../images/logo2.png" class="logo" width="300px" height="90px"></a></h1>

        <hr>
        
        <div class="formtable" align="center">
            <h2>登録内容確認</h2>
                <table border="0" cellspacing="45">
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            <?php
                                echo $_POST['new_user_id'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ユーザネーム
                        </th>
                        <td>
                            <?php
                                echo $_POST['new_user_name'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            パスワード
                        </th>
                        <td>
                            <?php
                                echo $_POST['new_user_pass'];
                            ?>
                        </td>
                    </tr>
                </table>
                <div class="submit">
                    <?php
                    $_SESSION['user_id'] = "hew2020";
                    ?>
                    <a href="./create_account.php"><input type="submit" value="戻る" class="button0"></a>
                    <a href="./mypage.php"><input type="submit" value="登録する" class="button"></a>
                </div>
        </div>
    </div>
</div>
    <footer>
        <a href="./pages/contact.html" class="question"><P>お問い合わせ</P></a>
        <small>Copyright ©︎ 2021 HAL Tokyo</small>
    </footer>
</body>
</html>