<?php
session_start();
if ($_SESSION['new_user_id'] === "" || $_SESSION['new_user_name'] === "") {
   header('location:../index.html');
   exit;
}

$insert_id = $_SESSION['new_user_id'];
$insert_pass = $_SESSION['new_user_pass'];
$insert_name = $_SESSION['new_user_name'];

$_SESSION['new_user_id'] === "";
$_SESSION['new_user_name'] === "";
$_SESSION['new_user_pass'] === "";

try {
   $db = new PDO('mysql:dbname=hew2020_91316;host=127.0.0.1;charset=utf8mb4',"hew2020","");         
   //PDOの動作モード変更
   $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
   //error時、サイレント→例外発生へ変更
   $db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

   
   $sql = "INSERT INTO user(User_id, User_password, User_name,User_created_date) VALUES (:id,:pass,:name,now())";
   $stmt = $db->prepare($sql);
   //プレースホルダ(仮置き場(?))に値をセット
   $params = array(':id' => $insert_id, ':pass' => $insert_pass, ':name' => $insert_name);
   $stmt ->execute($params);

   $_SESSION['login_user_id'] = $insert_id;
   $_SESSION['login_user_name'] = $insert_name;
   $_SESSION['login_user_pass'] = $insert_pass;
   $_SESSION['login_user_img'] = "";

   header('location:../pages/mypage.php');
   exit;
} catch (PDOException $e) {
   echo '接続エラー：' . $e->getMessage();
}
?>