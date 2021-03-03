<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="none,noindex,nofollow">
    <title>マイページ</title>
    <link rel="stylesheet" href="../css/5.css">
</head>
<body>
  <?php
    session_start();
    if (isset($_SESSION['user_id'])) {
      
    }else{
      header('location: ../pages/login_page.php');
      exit;
    }
  ?>
    <div class="wrapper">
        <header>
            <!-- <a href="../index.html"> -->
              <img src="../images/logo2.png" alt="logo" width="300px" class="logo">
            <!-- </a> -->
            <hr>
        </header>

        <div class="body">
          <div class="profile">
            <div class="icon">
            <?php
              echo "<img src='../images/user_img/1225829029603d0cdeaddb3.png' alt='icon'>";
            ?>
            </div>
            
            <div class="contents">
              <div class="name">
                <p class="name_midasi">user name</p>
                <?php
                  // echo "<p class='name_user'>".$_SESSION['login_user_name']."</p>";
                  echo "<p class='name_user'>HEW2020</p>";
                ?>
              </div>


              <div class="id">
                <p class="id_midasi">user id</p>
                <?php
                  echo "<p class='id_user'>".$_SESSION['user_id']."</p>";
                  ?>
              </div>

              <div class="setting">
                <a href="./setting.php"><p class="change">設定変更</p></a>
                <a href="../index.php"><p class="change">ログアウト</p></a>
              </div>
            </div>
          </div>

          <div class="room">
            <?php
              echo '<a href="../JS/chat.html" class="btn btn-flat"><span>ルーム入室</span></a>';
            ?>
          </div>
        </div>
    </div>
        <hr class="foot_line">
        <footer>
            <a href="./contact.html" class="question"><P>お問い合わせ</P></a>
            <small>Copyright ©︎ 2021 HAL Tokyo</small>
        </footer>

</body>
</html>
