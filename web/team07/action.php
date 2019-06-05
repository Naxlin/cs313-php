<?php  

session_start();
require("connect.php");
$_SESSION['match'] = 'true';
$username = $_POST['user'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$db = connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['check'] == 'false') {
		if (strcmp($_POST['pass'], $_POST['passC']) != 0) {
			$_SESSION['match'] = 'mismatch';
			header("Location:signup.php");
		} else if (strlen($_POST['pass']) < 7) {
			$_SESSION['match'] = 'length';
			header("Location:signup.php");
		} else if (preg_match('/[A-Za-z]/', $myString) && preg_match('/[0-9]/', $myString)) {
			$_SESSION['match'] = 'number';
			header("Location:signup.php");
		} else {
			$sql = 'INSERT INTO credentials (username, password) VALUES (:user, :pass)';
			$stmt = $db->prepare($sql);
			$stmt->bindValue(':user', $username, PDO::PARAM_STR);
			$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
			$stmt->execute();
			header("Location:login.php");
		}
	} else if ($_POST['check'] == 'true') {
		$sql = 'SELECT username, password FROM credentials WHERE username = :user';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':user', $username, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch();
		if (array_key_exists('username', $row)) {
			if (password_verify($_POST['pass'], $row['password'])) {
				$_SESSION['logged in'] = true;
				$_SESSION['user'] = $row['username'];
				header("Location:welcome.php");
			}
		} else {
			header("Location:signup.php");
		}
	}
} 

?>