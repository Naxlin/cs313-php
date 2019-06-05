<?php  

session_start();
require("connect.php");
$_SESSION['match'] = 'true';

$username = $_POST['user'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
var_dump($_POST['pass']);
var_dump($_POST['passC']);


$db = connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['check'] == 'false') {
		if (strcmp($_POST['pass'], $_POST['passC']) != 0) {
			$_SESSION['match'] = 'false';
			header("Location:signup.php");
		}
		$sql = 'INSERT INTO credentials (username, password) VALUES (:user, :pass)';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':user', $username, PDO::PARAM_STR);
		$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
		$stmt->execute();
		// header("Location:login.php");
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
				// header("Location:welcome.php");
			}
		} else {
			// header("Location:signup.php");
		}
	}
} 

?>