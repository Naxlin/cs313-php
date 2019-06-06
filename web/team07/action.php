<?php  

session_start();
require("connect.php");
$username = htmlspecialchars($_POST['user']);
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$db = connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['check'] == 'false') {
		if (strcmp($_POST['pass'], $_POST['passC']) != 0) {
			$_SESSION['valid'] = 'mismatch';
			header("Location:signup.php");
			die();
		} else if (strlen($_POST['pass']) < 7) {
			$_SESSION['valid'] = 'length';
			header("Location:signup.php");
			die();
		} else if (!(preg_match('/[A-Za-z]/', $_POST['pass']) && preg_match('/[0-9]/', $_POST['pass']))) {
			$_SESSION['valid'] = 'number';
			header("Location:signup.php");
			die();
		} else {
			$sql = 'INSERT INTO credentials (username, password) VALUES (:user, :pass)';
			$stmt = $db->prepare($sql);
			$stmt->bindValue(':user', $username, PDO::PARAM_STR);
			$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
			$stmt->execute();
			header("Location:login.php");
			die();
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
				die();
			}
		} else {
			header("Location:signup.php");
			die();
		}
	}
} 

?>