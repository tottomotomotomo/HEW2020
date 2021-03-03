<?php
session_start();

// 空欄チェック
if ($_POST['update_name'] === "") {
      $_SESSION['err'] = "ユーザーネームが空欄です<br>";
}
if ($_POST['pass'] === "") {
      $_SESSION['err'] .= "パスワードを入力してください<br>";
      header('location:../pages/setting.php');
      exit;
}
if ($_POST['pass'] !== $_SESSION['login_user_pass']) {
      $_SESSION['err'] .= "パスワードが一致しません<br>";
      header('location:../pages/setting.php');
      exit;
}

// 文字種・文字数チェック
if(!preg_match('/[a-zA-Z0-9]{6,32}/',$_POST['update_name'] )){ 
      // ユーザー名が半角英数字6~32回の繰り返しでない
      $_SESSION['err'] .= "ユーザー名は半角英数字6～32文字で入力してください<br>";
}

if ($_SESSION['err'] !== "") {
      header('location:../pages/setting.php');
      exit;
}

// 画像ファイルチェック
      $icon = uniqid(mt_rand()); //ランダムな仮ファイル名を生成
      $icon .= '.' . substr(strrchr($_FILES['icon']['name'], '.'), 1); //仮ファイル名に拡張子を付ける
      move_uploaded_file($_FILES['icon']['tmp_name'], '../images/user_img/' .$icon); //ローカルディレクトリにファイルを保存
      $file_dir = "../images/user_img/$icon"; //画像のファイルパスを取得
if (exif_imagetype($file_dir)) { //画像ファイルかどうかを確認
      unlink($_SESSION['login_user_img']); //元のアイコン画像を削除
      $_SESSION['login_user_img'] = $file_dir; //新しいファイルパスをセッションに保存
}else {
      unlink($file_dir);
      $_SESSION['err'] = "画像ファイルを選択してください";
      header('location:../pages/setting.php');
      exit;
}

try {
      $db = new PDO('mysql:dbname=hew2020_91316;host=127.0.0.1;charset=utf8mb4',"root","");         
      //PDOの動作モード変更
      $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      //error時、サイレント→例外発生へ変更
      $db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

      $sql = 'UPDATE user SET user_name = :name , user_img = :img WHERE user_id = :id';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':name', $_POST['update_name']);
      $stmt->bindValue(':img', $_SESSION['login_user_img']);
      $stmt->bindValue(':id', $_SESSION['login_user_id']);

      $stmt ->execute();
      $_SESSION['msg'] = "変更しました。";

      header('location:../pages/mypage.php');
      exit;

}catch (PDOException $e) {
      echo '接続エラー：' . $e->getMessage();
}

?>