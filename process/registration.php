<?php
   session_start();
   
   $NU_id = $_POST['new_user_id'];
   $NU_name = $_POST['new_user_name'];
   $NU_pass = $_POST['new_user_password'];
   $pass_check = $_POST{'password_check'};
   $_SESSION['err'] = "";


   // 入力値チェック
   if ($NU_id === "") {
      $_SESSION['err'] .= "ユーザーIDを入力してください<br>";
   }
   if ($NU_name === "") {
      $_SESSION['err'] .= "ユーザー名を入力してください<br>";
   }
   if ($NU_pass === "") {
      $_SESSION['err'] .= "パスワードを設定してください<br>";
   }
   if ($pass_check === "") {
      $_SESSION['err'] .= "確認用のパスワードを入力してください<br>";
   }

   // 入力値エラーあり
   if ($_SESSION['err'] !== "") {
      header('location:../pages/create_account.php');
      exit;
   }
   
   // 空欄でない
   // 全角->半角
   mb_convert_kana($NU_id, "a");
   mb_convert_kana($NU_name, "a");
   mb_convert_kana($NU_pass, "a");
   mb_convert_kana($pass_check, "a");

   //文字種・文字数チェック
   if(!preg_match('/[a-zA-Z0-9]{6,32}/', $NU_id)){ 
      // IDが半角英数字6~32回の繰り返しでない
      $_SESSION['err'] .= "IDは半角英数字6～32文字で入力してください<br>";
   }
   if(!preg_match('/[a-zA-Z0-9]{6,32}/', $NU_name)){ 
      // ユーザー名が半角英数字6~32回の繰り返しでない
      $_SESSION['err'] .= "ユーザー名は半角英数字6～32文字で入力してください<br>";
   }
   if(!preg_match('/[a-zA-Z0-9]{8,16}/', $NU_pass)){ 
      // パスワードが半角英数字8~16回の繰り返しでない
      $_SESSION['err'] .= "パスワードは半角英数字8～16文字で入力してください<br>";
   }

   // 文字数・文字種エラーあり
   if ($_SESSION['err'] !== "") {
      header('location:../pages/create_account.php');
      exit;
   }
   
   // ID被りチェック
   try {
      $db = new PDO('mysql:dbname=hew2020_91316;host=127.0.0.1;charset=utf8mb4',"root","");         
      //PDOの動作モード変更
      $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      //error時、サイレント→例外発生へ変更
      $db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

      $sql = "SELECT user_id from user where user_id = :name";
      $stmt = $db->prepare($sql);
      //プレースホルダ(仮置き場(?))に値をセット
      $stmt->bindValue(':name', $NU_id);
      $stmt ->execute();
      $users = $stmt->fetch(PDO::FETCH_ASSOC);
      
      if ($NU_id === $users['user_id']) {
         $_SESSION['err'] = "既に登録されているIDです<br>";
         header('location:../pages/create_account.php');
         exit;
      }
   } catch (PDOException $e) {
      echo '接続エラー：' . $e->getMessage();
   }

   // パスワードチェック
   if ($NU_pass !== $pass_check) {
      $_SESSION['err'] = "パスワードが確認用と一致しません。<br>";
      header('location:../pages/create_account.php');
      exit;
   }

   // 全てOK
   $_SESSION['new_user_id'] = $NU_id;
   $_SESSION['new_user_name'] = $NU_name;
   $_SESSION['new_user_pass'] = $NU_pass;
   header('location:../pages/create_check.php');
   exit;

?>