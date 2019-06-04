<?php  
require("connect.php");

$user = $_POST['user'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

$db = connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$sql = 'INSERT INTO credentials (username, password) VALUES (:user, :pass)';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
	$stmt->execute();
} 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$sql = 'SELECT username, password FROM credentials WHERE username = :user AND password = :pass';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch();
	if (array_key_exists('username', $row) && array_key_exists('password', $row)) {
		echo true;
	} else {
		echo false;
	}
}

?>