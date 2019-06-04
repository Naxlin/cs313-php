<?php  

session_start();
require("connect.php");

$username = $_POST['user'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

$db = connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$sql = 'INSERT INTO credentials (username, password) VALUES (:user, :pass)';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':user', $username, PDO::PARAM_STR);
	$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
	$stmt->execute();
	header("Location:login.php");
} 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$sql = 'SELECT username, password FROM credentials WHERE username = :user';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':user', $username, PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch();
	var_dump(json_encode($_POST));
	var_dump($row);
	if (array_key_exists('username', $row)) {
		if (password_verify($_POST['pass'], $row['password'])) {
			session_start();
			$_SESSION['logged in'] = true;
			$_SESSION['user'] = $row['username'];
			header("Location:welcome.php");
		}
	} else {
		// header("Location:signup.php");
	}
}

?>