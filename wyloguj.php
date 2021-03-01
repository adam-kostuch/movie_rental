<?php session_start(); ?>
<!doctype HTML>
<html lang="PL-pl">
  <head>
		<title>Wypożyczalnia filmów | Adam Kostuch</title>
		<meta charset="UTF-8">
		<meta name="author" contet="Adam Kostuch">
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
						<li><a href="rejestracja.php">Zarejestruj</a></li>
						<li><a href="zaloguj.php">Zaloguj</a></li>
						<li style="border:none;"><a href="index.php?id=oferta#oferta">Oferta</a></li>
					</ul>
				</div>
     	 	</nav>
       	<div id="form">
       	<?php
					unset($_SESSION['uzytkownik']);
					unset($_SESSION['rola']);
         	if(!isset($_SESSION['uzytkownik']) && !isset($_SESSION['rola'])){ 
				?>
					<h1 style="margin-top:4vw; margin-bottom: 1vw;">Wylogowano:</h1>
					<a href="index.php" id="powrot">Powrot do strony glownej</a>
					<p style="text-align:center;">(Automatycznie przekierowanie nastapi za 3 sekudny...)</p>
				<?php	header("Refresh:5; url=index.php", true, 3000); } ?>
				</div>
		</header>
		<footer> &copy; Adam Kostuch </footer>
	</body>
</html>