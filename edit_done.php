<?php
session_start();
$id = $_POST[ 'id' ];
$name = $_POST[ 'name' ];
$mail = $_POST[ 'mail' ];
$pass = $_POST[ 'pass' ];
$_SESSION[ 'search' ] = $_POST[ 'search' ];

$dsn = 'mysql:dbname=foodpad;host=localhost';
$user = 'root';
$password = 'root';
$dbh = new PDO( $dsn, $user, $password );
$dbh->query( 'SET NAMES utf8' );

$name = htmlspecialchars( $name );
$mail = htmlspecialchars( $mail );

$sql = 'update users set name = ?,mail = ?,pass = ? where id = ?';
$stmt = $dbh->prepare( $sql );
$data[] = $name;
$data[] = $mail;
$data[] = $pass;
$data[] = $id;
$stmt->execute( $data );

$_SESSION[ 'name' ] = $name;

$dbh = null;
$_SESSION[ 'message3' ] = 'OK';
if ( isset( $_POST[ 'home' ] ) == true ) {
  header( 'location:index.php' );
} elseif ( isset( $_POST[ 'list' ] ) == true ) {
  header( 'location:admin/kensaku.php' );
} elseif ( isset( $_POST[ 'concept' ] ) == true ) {
  header( 'location:concept.php' );
} else {
  header( 'location:shop.php' );
}

?>