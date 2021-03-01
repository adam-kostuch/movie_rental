<?php session_start(); ?>
<!doctype HTML>
<html lang="PL-pl">
  <head>
		<title>Wypożyczalnia filmów | Adam Kostuch</title>
		<meta charset="UTF-8">
		<meta name="author" content="Adam Kostuch">
		<meta name="description" content="Project made for school classes">
		<meta name="keywords" content="filmy, wypozyczalnia, films, video, rent">
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="img/video.png">
		<link href="https://fonts.googleapis.com/css2?family=Squada+One&display=swap" rel="stylesheet">	
	</head>
	<body>
		<header>
			<nav>
				<div id="logo"><a href="index.php"><img src="img/logo.png" alt="logo"></a></div>
				<div id="links">
					<ul>
						<?php if(empty($_SESSION['uzytkownik'])){ ?>
							<li><a href="rejestracja.php">Zarejestruj</a></li>
							<li><a href="zaloguj.php">Zaloguj</a></li>
						<?php	}	else{ ?>
							<li><a href="wyloguj.php">Wyloguj</a></li>
						<?php } if((!empty($_SESSION['rola'])) && ($_SESSION['rola'] == 'administrator')){ ?>
							<li><a href="klienci.php">Klienci</a></li>
							<li><a href="kup.php">Wynajmij</a></li>
						<?php } elseif((!empty($_SESSION['rola'])) && ($_SESSION['rola'] == 'uzytkownik')){	?>
							<li><a href="kup.php">Wynajmij</a></li>
						<?php	} ?>
						<li style="border:none;"><a href="index.php?id=oferta#oferta">Oferta</a></li>
					</ul>
				</div>
			</nav>
			<div id="form3">
				<?php if(!isset($_SESSION['uzytkownik'])){ ?>
					<h1 style="margin: 5vw 0 1vw 6vw;">WITAJ, </h1>
					<p>Aby cos kupic zaloguj sie, albo zarejestruj.</p>
				<?php } elseif($_SESSION['rola'] == 'uzytkownik'){
						echo '<h1 style="margin: 5vw 0 1vw 6vw;" id="up">WITAJ <em>'.$_SESSION['uzytkownik'].', </em></h1>';
						echo '<p>Zyczymy udanych zakupow!</p>';
					} elseif($_SESSION['rola'] == 'administrator'){
						echo '<h1 style="margin: 5vw 0 1vw 6vw;" id="up">WITAJ <em>'.$_SESSION['uzytkownik'].', </em></h1>';
						echo '<p>Milego administrowania!</p>'; }	
				?>
			</div>
		</header>
		<?php
      		@$id=$_GET['id'];
      		if($id == 'oferta') require('oferta.php');
      	?>
		<footer> &copy; Adam Kostuch </footer>
	</body>
</html>