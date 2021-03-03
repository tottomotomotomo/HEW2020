<?php
   session_start();

   $U_id = $_POST['user_id'];
   $U_pass = $_POST['user_password'];
   $_SESSION['err'] = "";

   // 入力値チェック(id,pass)
   if ($U_id === "") {
      $_SESSION['err'] .= "ユーザーIDを入力してください<br>";
   }
   if ($U_pass === "") {
      $_SESSION['err'] .= "パスワードを入力してください<br>";
   }

   // エラーあり
   if ($_SESSION['err'] !== "") {
      header('location:../pages/login_page.php');
      exit;
   }
   
   // 全角->半角
   mb_convert_kana($U_id, "a");
   mb_convert_kana($U_pass, "a");

   try {
      $db = new PDO('mysql:dbname=hew2020_91316;host=127.0.0.1;charset=utf8mb4',"hew2020","");         
      //PDOの動作モード変更
      $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      //error時、サイレント→例外発生へ変更
      $db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

      // id,passを同時にチェック
      $sql = "SELECT user_id,user_password,user_name,user_img from user where user_id = :name";
      $stmt = $db->prepare($sql);
      //プレースホルダ(仮置き場(?))に値をセット
      $stmt->bindValue(':name', $U_id);
      $stmt ->execute();
      $users = $stmt->fetch(PDO::FETCH_ASSOC);
      // print_r($users);
      // exit;
   } catch (PDOException $e) {
      echo '接続エラー：' . $e->getMessage();
   }

   if ($U_id === $users['user_id']) {
      if ($U_pass === $users['user_password']) {
         $_SESSION['login_user_pass'] = $users['user_password'];
         $_SESSION['login_user_id'] = $users['user_id'];
         $_SESSION['login_user_name'] = $users['user_name'];
         $_SESSION['login_user_img'] = $users['user_img'];
         header('location:../pages/mypage.php');
      }else{
         $_SESSION['err'] = 'ユーザーIDとパスワードが一致しません<br>';
         header('location:../pages/login_page.php');
         exit;
      }
   }else {
      $_SESSION['err'] = '存在しないユーザーIDです<br>';
      header('location:../pages/login_page.php');
      exit;
   }

?>