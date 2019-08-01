<?php
session_start();
if(!isset($_SESSION['message'])){
	$_SESSION['message']='';
}
if(!isset($_SESSION['message2'])){
	$_SESSION['message2']='';
}
if(!isset($_SESSION['name'])){
	$_SESSION['name']='';
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Food Pad</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="foodpad">
<meta name="description" content="Food Padは、訳アリ料理、まかない料理、試作料理、シェフのきまぐれオリ ジナル料理などをお得にお持ち帰りできるサイトです。">
<meta name="keywords" content="food pad,グルメ,テイクアウト,フードロス,フードシェアリング">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Food Pad">
<meta property="og:title" content="グルメ・レストランガイド">
<meta property="og:image" content="image/ogp.gif">
<meta property="og:description" content="FoodPadは、訳アリ料理、まかない料理、試作料理、シェフのきまぐれオリ ジナル料理などをお得にお持ち帰りできるサイトです。">
<link href="css/normalize.css" rel="stylesheet">
<link href="css/slide.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/mobile.css" rel="stylesheet" media= "screen and (max-width:600px)">
<link rel="icon" href="image/favicon.gif">
<link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
</head>

<body>
<div id="container">
  <header>
    <div class="slideshow">
      <div><img src="image/slide01.jpg" alt="" width="1280" height="540"></div>
      <div><img src="image/slide02.jpg" alt="" width="1280" height="540"></div>
      <div><img src="image/slide03.jpg" alt="" width="1280" height="540"></div>
    </div>
  </header>
  <nav>
    <ul>
      <li><a href="#1">新着情報</a></li>
      <li><a href="#">エリア検索</a></li>
      <li><a href="concept.php">ABOUT</a></li>
    </ul>
  </nav>
  <div id="slidespace">
    <div id="main" class="grid-container clearfix">
      <h1>訳アリ料理、まかない料理、試作料理、シェフの気まぐれ料理も！？<br>
        ぜ～んぶお得にお持ち帰りできちゃいます！</h1>
      <section id="step">
        <h1>ご利用は簡単3ステップ</h1>
        <div id="step2"><span><img src="image/step1.png" alt="エリアを検索"></span> <span><img src="image/step2.png" alt="出品された商品を選ぶ"></span> <span><img src="image/step3.png" alt="お店でテイクアウト"></span></div>
        <p>※サイトの登録費、月会費など一切かかりません。
          料理のテイクアウト代だけで利用できます。</p>
      </section>
      <section id="news">
       <div id="1"> <h1>新着情報</h1>
        <time datetime="2018-12-30T16:15:00">Latest update at 16:15 Dec.30 2018</time>
        <div id="news2"> 
        <?php
		
$dsn='';
$user='';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='SELECT*FROM foodpad WHERE 1<=id and id<=5';

$stmt=$dbh->prepare($sql);
$stmt->execute();

while(1)
{
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	$rec2[]=$rec;	
}        
print'<div id="';
print $rec2[1]['name'];
print'" class="shop" style="background-image:url(image/';
print $rec2[1]['photo'];
print '.png)">';
print'<div class="text">';
print'<p>';
print $rec2[1]['menu'];
print'</p>';
print'<p>&yen;<s>';
print $rec2[1]['price01'];
print'</s> → <span>&yen;';
print $rec2[1]['price02'];
print'</span></p>';
print'<p>';
print $rec2[1]['name'];
print'</p><p>';
print $rec2[1]['time'];
print'</p></div></div>';
print'<div id="';
print $rec2[2]['name'];
print'" class="shop" style="background-image:url(image/';
print $rec2[2]['photo'];
print '.png)">';
print'<div class="text">';
print'<p>';
print $rec2[2]['menu'];
print'</p>';
print'<p>&yen;<s>';
print $rec2[2]['price01'];
print'</s> → <span>&yen;';
print $rec2[2]['price02'];
print'</span></p>';
print'<p>';
print $rec2[2]['name'];
print'</p><p>';
print $rec2[2]['time'];
print'</p></div></div>';
print'<div id="';
print $rec2[3]['name'];
print'" class="shop" style="background-image:url(image/';
print $rec2[3]['photo'];
print '.png)">';
print'<div class="text">';
print'<p>';
print $rec2[3]['menu'];
print'</p>';
print'<p>&yen;<s>';
print $rec2[3]['price01'];
print'</s> → <span>&yen;';
print $rec2[3]['price02'];
print'</span></p>';
print'<p>';
print $rec2[3]['name'];
print'</p><p>';
print $rec2[3]['time'];
print'</p></div></div>';
print'<div id="';
print $rec2[4]['name'];
print'" class="shop" style="background-image:url(image/';
print $rec2[4]['photo'];
print '.png")>';
print'<div class="text">';
print'<p>';
print $rec2[4]['menu'];
print'</p>';
print'<p>&yen;<s>';
print $rec2[4]['price01'];
print'</s> → <span>&yen;';
print $rec2[4]['price02'];
print'</span></p>';
print'<p>';
print $rec2[4]['name'];
print'</p><p>';
print $rec2[4]['time'];
print'</p></div></div>';
?></div>
        <a href="admin/kensaku.php">
        <input type="button" value="もっと見る&gt;&gt;" id="more">
        </a></div> </section>
      <div id="sub" class="clearfix">
        <aside>
          <p>スマホで簡単に料理が買えるアプリ</p>
          <p>今すぐ無料ダウンロード！</p>
          <a href="#"><img src="image/appstore.png" alt="#"></a><a href="#"><img src="image/googleplay.png" alt="#"></a>
          <div id="searchbox">
            <form action="admin/kensaku.php" method="post">
              <label><input type="search" name="search" placeholder="エリアを探す"><input type="submit" value="検索"></label>
            </form>
          </div>
          <?php if(!isset($_SESSION['login'])){
print'<div id="login"> <span>ログイン</span> </div>';
};?>
<?php if(isset($_SESSION['login'])){
print'<div id="login"> <a href="logout.php"><span>ログアウト</span></a> </div>';
};?>
          <div id="loginformbox"> <span>閉じる×</span>
            <div id="loginform">
              <form action="check_user.php" method="post">
                <span id="alert"><?php
				print $_SESSION['message'];
				$_SESSION['message']='';
print $_SESSION['message2'];
$_SESSION['message2']='';
?></span>
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
                <input type="hidden" name="home">
                <div class="logintext">
                  <p><a href="#">パスワードをお忘れですか？</a></p>
                  <p>初めてご利用の方はこちら → <a>新規会員登録</a></p>
                </div>
              </form>
            </div>
          </div>
          <div id="add">
            <form action="done.php" method="post">
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
              <input type="hidden" name="home">
            </form>
          </div>
        <div id="searchbox2"><form action="shop.php" method="post">
              <label><input type="search" name="search">
              <input type="submit" value="検索"></label>
            </form></div>
        </aside>
      </div>
    </div>
    <footer id="footer" class="clearfix">
      <div id="about">
        <p><a href="concept.php">FOOD PADについて</a></p>
        <p><a href="#">飲食店の掲載方法について</a></p>
      </div>
      <div id="footer_menu">
        <div id="area">
          <p>エリアから探す</p>
          <ul>
          <div id="area1">
            <li> <a href="#">博多</a> </li>
            <li> <a href="#">中州</a> </li>
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
            <li> <a href="admin/kensaku.php">新着情報</a> </li>
            <li> <a href="terms.php">利用規約</a> </li>
            <li> <a href="privacy.php">プライバシーポリシー</a> </li>
            <li> <a href="#">運営団体</a> </li>
          </ul>
        </div>
      </div>
      <div id="last"><small>&copy;2018 FOOD PAD</small></div>
    </footer>
  </div>
</div>
<script src="js/jquery-3.1.1.min.js"></script> 
<script src="js/app.js"></script>
</body>
</html>
