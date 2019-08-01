<?php
session_start();
if ( !isset( $_POST[ 'search' ] ) ) {
  $_POST[ 'search' ] = '';
}
$search = $_POST[ 'search' ];
if ( !isset( $_SESSION[ 'message' ] ) ) {
  $_SESSION[ 'message' ] = '';
}
if ( !isset( $_SESSION[ 'message2' ] ) ) {
  $_SESSION[ 'message2' ] = '';
}
if ( !isset( $_SESSION[ 'name' ] ) ) {
  $_SESSION[ 'name' ] = '';
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>ショップリスト</title>
<link href="css/normalize.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../css/mobile.css" rel="stylesheet" media= "screen and (max-width:600px)">
<link rel="icon" href="../image/favicon.gif">
<link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
</head>

<body id="shoplist">
<div id="container">
  <header>
    <div><a href="../index.php"><img src="../image/teamc_logo2.gif" alt="foodpad" height="50"></a></div>
  </header>
  <nav>
    <ul>
      <li><a href="../index.php">ホーム</a></li>
      <li><a href="#">エリア検索</a></li>
      <li><a href="../concept.php">ABOUT</a></li>
    </ul>
  </nav>
  <div id="main" class="grid-container">
    <section id="news">
      <h1>
        <?php
        if ( $search == '' ) {
          print '新着情報';
        } else {
          print $search;
          print 'の店舗一覧！';
        }
        ?>
      </h1>
      <div id="news2">
        <?php

        try {

          $dsn = '';
          $user = '';
          $password = '';
          $dbh = new PDO( $dsn, $user, $password );
          $dbh->query( 'SET NAMES utf8' );

          $sql = 'SELECT*FROM foodpad WHERE ';
          if ( $search == '' ) {
            $sql = $sql . ' 1';
            $stmt = $dbh->prepare( $sql );
            $stmt->execute();
          } else {
            $sql = $sql . ' area = ?';
            $stmt = $dbh->prepare( $sql );
            $data[] = $search;
            $stmt->execute( $data );
          };

          //print $sql;

          /*if($search=='')
          {
          	


          }
          else
          {


          }*/


          while ( 1 ) {
            $rec = $stmt->fetch( PDO::FETCH_ASSOC );
            if ( $rec == false ) {
              break;
            }


            print '<div id="';
            print $rec[ 'name' ];
            print '" class="list row1" style="background-image:url(../image/';
            print $rec[ 'photo' ];
            print '.png)">';

            print '<div class="text">';
            print '<p>';

            print $rec[ 'menu' ];
            print '</p><p>&yen;<s>';

            print $rec[ 'price01' ];
            print '</s>→ <span>&yen;';
            print $rec[ 'price02' ];
            print '</span></p>';
            print '<p>';
            print $rec[ 'name' ];
            print '</p><p>';
            print $rec[ 'time' ];
            print '</p></div></div>';

          }


          $dbh = null;

        } catch ( Exception $e ) {
          print 'ただいま障害により大変ご迷惑をお掛けしております。';
        }

        ?>
      </div>
    </section>
  </div>
  <?php
  if ( isset( $_SESSION[ 'login' ] ) ) {
    print '<div id="guestname">';
    print '<span>ようこそ <span>';
    print $_SESSION[ 'name' ];
    print '</span> 様</span></div>';
  };
  ?>
  <div id="sub" class="clearfix">
    <aside>
      <div id="searchbox">
        <form action="kensaku.php" method="post">
          <label>
            <input type="search" name="search" placeholder="エリアで探す" >
            <input type="submit" value="検索">
          </label>
        </form>
      </div>
      <?php
      if ( !isset( $_SESSION[ 'login' ] ) ) {
        print '<div id="login">';
        print ' <span>ログイン</span>';
        print ' </div>';
      };
      ?>
      <?php
      if ( isset( $_SESSION[ 'login' ] ) ) {
        print '<div id="account">';
        print '<span>アカウント情報▼</span><ul>';
        print '<li><a href="#">アカウント設定</a></li>';
        print '<li><a href="../logout.php">ログアウト</a></li>';
        print '</ul></div>';
      };
      ?>
      <div id="loginformbox"> <span>閉じる×</span>
        <div id="loginform">
          <form action="../check_user.php" method="post">
            <span id="alert">
            <?php
            print $_SESSION[ 'message' ];
            $_SESSION[ 'message' ] = '';
            print $_SESSION[ 'message2' ];
            $_SESSION[ 'message2' ] = '';
            ?>
            </span>
            <p>
              <label>
                <input type="email" name="mail" placeholder="メールアドレス">
              </label>
            </p>
            <p>
              <label>
                <input type="password" name="pass" placeholder="パスワード">
              </label>
            </p>
            <p>
              <input type="submit" value="ログインする">
            </p>
            <input type="hidden" name="list">
            <div class="logintext">
              <p><a href="#">パスワードをお忘れですか？</a></p>
              <p>初めてご利用の方はこちら → <a>新規会員登録</a></p>
            </div>
          </form>
        </div>
      </div>
      <div id="add">
        <form action="../done.php" method="post">
          <div class="logintext">
            <p>新規会員登録</p>
            <p>下記項目を入力してください。</p>
          </div>
          <p>
            <label>
              <input type="text" name="name" placeholder="ユーザー名">
            </label>
          </p>
          <p>
            <label>
              <input type="email" name="mail" placeholder="メールアドレス">
            </label>
          </p>
          <p>
            <label>
              <input type="password" name="pass" placeholder="パスワード">
            </label>
          </p>
          <p>
            <input type="submit" value="登録する">
          </p>
          <input type="hidden" name="list">
        </form>
      </div>
      <div id="edit">
        <?php

        $name = $_SESSION[ 'name' ];

        $dsn = '';
        $user = '';
        $password = '';
        $dbh = new PDO( $dsn, $user, $password );
        $dbh->query( 'SET NAMES utf8' );
        $sql2 = 'select*from users where name = ?';
        $data2[] = $name;
        $stmt2 = $dbh->prepare( $sql2 );
        $stmt2->execute( $data2 );
        $rec2 = $stmt2->fetch( PDO::FETCH_ASSOC );
        print_r( $rec2 );


        ?>
        <form action="../edit_done.php" method="post">
          <div class="logintext">
            <p>登録情報変更</p>
            <p>下記項目から変更内容を入力してください。</p>
          </div>
          <input type="hidden" name="id" value="<?php print $rec2['id'];?>">
          <p>
            <label>
              <input type="text" name="name" value="<?php print $rec2['name'];?>">
            </label>
          </p>
          <p>
            <label>
              <input type="email" name="mail" value="<?php print $rec2['mail'];?>">
            </label>
          </p>
          <p>
            <label>
              <input type="password" name="pass" value="<?php print $rec2['mail'];?>">
            </label>
          </p>
          <p>
            <input type="submit" value="変更する">
          </p>
          <input type="hidden" name="list">
        </form>
      </div>
      <?php
      if ( isset( $_SESSION[ 'message3' ] ) ) {
        print '<div id="confirm2">';
        print '<div class="logintext">';
        print '<p>登録情報の変更が完了しました。</p>';
        print '</div>';
        print '<button type="button">';
        print $_SESSION[ 'message3' ];
        print $_SESSION[ 'message3' ] = '';
        print '</button></div>';
      };
      ?>
      <div id="searchbox2">
        <form action="../shop.php" method="post">
          <label>
            <input type="search" name="search">
            <input type="submit" value="検索">
          </label>
        </form>
      </div>
    </aside>
  </div>
  <footer id="footer" class="grid-container clearfix">
    <div id="about">
      <p><a href="#">FOOD PADについて</a></p>
      <p><a href="#">飲食店の掲載方法について</a></p>
    </div>
    <div id="footer_menu">
      <div id="area">
        <p>エリアから探す</p>
        <ul>
          <div id="area1">
            <li> <a href="#">博多</a> </li>
            <li> <a href="#">中洲</a> </li>
            <li> <a href="#">春吉</a> </li>
            <li> <a href="#">呉服町</a> </li>
          </div>
          <div id="area2">
            <li> <a href="#">天神</a> </li>
            <li> <a href="#">大名</a> </li>
            <li> <a href="#">今泉</a> </li>
            <li> <a href="#">赤坂</a> </li>
          </div>
          <div id="area3">
            <li> <a href="#">薬院</a> </li>
            <li> <a href="#">六本松</a> </li>
            <li> <a href="#">西新・百道</a> </li>
            <li> <a href="#">その他</a> </li>
          </div>
        </ul>
      </div>
      <div id="sitemap">
        <p>サイトマップ</p>
        <ul>
          <li> <a href="kensaku.php">新着情報</a> </li>
          <li> <a href="../term.php">利用規約</a> </li>
          <li> <a href="../privacy.php">プライバシーポリシー</a> </li>
          <li> <a href="#">運営団体</a> </li>
        </ul>
      </div>
    </div>
    <div id="last"><small>&copy;2018 FOOD PAD</small></div>
  </footer>
</div>
<script src="../js/jquery-3.1.1.min.js"></script> 
<script src="../js/app.js"></script>
</body>
</html>
