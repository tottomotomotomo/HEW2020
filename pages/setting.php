<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/6.css">
    <meta name="robots" content="none,noindex,nofollow">
    <title>プロフィール変更</title>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['login_user_id'])) {
      
    }else{
      header('location: ../index.html');
      exit;
    }
    ?>
    <div class="wrapper">
        <header>
            <h1><a href="../index.html"><img src="../images/logo2.png" alt="logo" width="300px" class="logo"></a></h1>
        </header>
        <hr class="header">
        <div class="textform" align="center">
            <form action="../process/update.php" method="post" enctype="multipart/form-data">
                <table border="0" cellspacing="60">
                    <?php
                    echo "<td colspan='2' style='text-align:center'>".$_SESSION['err']."</td>";
                    $_SESSION['err'] = "";
                    ?>
                    <tr>
                        <th>
                            ユーザーID
                        </th>
                        <td>
                        <?php
                            echo $_SESSION['login_user_id'];
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            アイコン
                        </th>
                        <td>
                            <input type="file" name="icon" value="ファイル選択" size="15">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ユーザネーム
                        </th>
                        <td>
                        <?php
                            // echo '<input type="text" name="update_name" placeholder="Username" value="'.$_SESSION['login_user_name'].'" size="32">';
                            echo '<input type="text" name="update_name" placeholder="Username" value="HEW2020 size="32">';
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            パスワード
                        </th>
                        <td>
                            <?php
                                echo '<input type="password" name="pass" placeholder="Password" value="'.$_SESSION["user_password"].'" size="32">';
                            ?>
                        </td>
                    </tr>
                </table>
                
                <div class="submit">
                    <div class="back_btn">
                        <a href="./mypage.php">　戻る　</a>
                    </div>
                    <input type="submit" value="変更する" class="button">
                </div>
            </form>
        </div>
        <hr class="footer">
        <footer>
            <a href="./contact.html" class="question"><P>お問い合わせ</P></a>
            <small>Copyright ©︎ 2021 HAL Tokyo</small>
        </footer>
    </div>
</body>
</html>