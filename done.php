<?php
session_start();
try {


  $dsn = 'mysql:dbname=foodpad;host=localhost';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO( $dsn, $user, $password );
  $dbh->query( 'SET NAMES utf8' );

  $_SESSION[ 'search' ] = $_POST[ 'search' ];
  $name = $_POST[ 'name' ];
  $mail = $_POST[ 'mail' ];
  $pass = $_POST[ 'pass' ];

  $name = htmlspecialchars( $name );
  $pass = htmlspecialchars( $pass );
  $pass = md5( $pass );


  if ( $name === '' || $mail === '' || $pass === '' ) {

    $_SESSION[ 'message2' ] = '登録内容が不十分です。';
    if ( isset( $_POST[ 'home' ] ) == true ) {
      header( 'location:index.php' );
    } elseif ( isset( $_POST[ 'list' ] ) == true ) {
      header( 'location:admin/kensaku.php' );
    } elseif ( isset( $_POST[ 'concept' ] ) == true ) {
      header( 'location:concept.php' );
    } else {
      header( 'location:shop.php' );
    }
  } else {

    $sql = 'INSERT INTO users (name,mail,pass) VALUES (?,?,?)';
    $stmt = $dbh->prepare( $sql );
    $data[] = $name;
    $data[] = $mail;
    $data[] = $pass;
    $stmt->execute( $data );

    $dbh = null;


    $_SESSION[ 'message2' ] = '登録完了！続けてログインしてください。';
    if ( isset( $_POST[ 'home' ] ) == true ) {
      header( 'location:index.php' );
    } elseif ( isset( $_POST[ 'list' ] ) == true ) {
      header( 'location:admin/kensaku.php' );
    } elseif ( isset( $_POST[ 'concept' ] ) == true ) {
      header( 'location:concept.php' );
    } else {
      header( 'location:shop.php' );
    }

  }
} catch ( Exception $e ) {
  ?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>無題ドキュメント</title>
</head>

<body>
<p>ただいま障害により大変ご迷惑をおかけしております。</p>
</body>
</html>
<?php } ?>