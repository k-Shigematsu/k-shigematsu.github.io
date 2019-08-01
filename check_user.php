<?php
session_start();


$dsn='mysql:dbname=foodpad;host=localhost';
$user='root';
$password='root';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');


$_SESSION['search'] = $_POST['search'];
$mail = $_POST['mail'];
$pass = $_POST['pass'];

	$name=htmlspecialchars($mail);
	$pass=htmlspecialchars($pass);
	$pass = md5($pass);


$sql = 'select*from users where mail=? and pass=?';
$stmt = $dbh->prepare($sql);
$data[] =$mail;
$data[] =$pass;

$stmt->execute($data);


$rec = $stmt->fetch(PDO::FETCH_ASSOC);
if($rec==true){
	$_SESSION['login']=session_id();
	$_SESSION['name']=$rec['name'];
	
	if(isset($_POST['home'])==true){
		header('location:index.php');
	}elseif(isset($_POST['list'])==true){
		header('location:admin/kensaku.php');
	}elseif(isset($_POST['concept'])==true){
		header('location:concept.php');
	}else{
		header('location:shop.php');
	}
	
}else{
	$_SESSION['message']='ユーザー名またはパスワードが違っています。';
	if(isset($_POST['home'])==true){
		header('location:index.php');
	}elseif(isset($_POST['list'])==true){
		header('location:admin/kensaku.php');
	}elseif(isset($_POST['concept'])==true){
		header('location:concept.php');
	}else{
		header('location:shop.php');
	}
}

$dbh = null;
?>