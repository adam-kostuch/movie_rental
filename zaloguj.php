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
			<?php 
				$polaczenie = new mysqli('localhost', 'root', '' ,'wypozyczalnia_filmow');

				if($polaczenie -> connect_error){ 
					die("Connection failed: ".$polaczenie->connect_error);
				} else{
					$polaczenie -> select_db("wypozyczalnia_filmow");

				if(isset($_POST['login']) && isset($_POST['haslo'])){
					$login = $_POST['login'];
					$haslo = $_POST['haslo'];
					$haslo = sha1($haslo);

					$zapytanie = "SELECT * FROM uzytkownicy WHERE login LIKE'".$login."' AND haslo LIKE '".$haslo."'";
					$wynik = $polaczenie -> query($zapytanie);

					$wiersz = $wynik->fetch_row();
					$_SESSION['rola'] = $wiersz[3];

					if($wynik -> num_rows > 0){
						$_SESSION['uzytkownik'] = $login;
					}
		
					if(@$_SESSION['uzytkownik'] == TRUE){ 
						header("Location: index.php"); 
					} else{	
						echo sha1($_POST['haslo']);?>
				<div id="form">
					<h1>LOGOWANIE: </h1>
					<form method="post">
						<table>
							<tr><td>Login: </td><td> <input type="text" name="login"> </td></tr>
							<tr><td>Hasło: </td><td> <input type="password" name="haslo"> </td></tr>
						</table>
      			<a href="index.php" style="margin-left: 10vw;"><button>Powrót!</button></a><button type="submit">Loguj!</button>
					</form><br>
					<p style="text-align: right; margin-right: 1vw;">Nieudana próba logowania</p>
				</div>
			<?php
					}	if($_SESSION['rola'] == "administrator"){
						echo "<p><a href='panel.php'>Panel</a></p>";
					}
				}	?>
			<div id="form" <?php if((@$_SESSION['uzytkownik'] == FALSE) && isset($_POST['login']) && isset($_POST['haslo'])){ echo "style='display:none;'"; } ?>>
				<h1>LOGOWANIE: </h1>
				<form method="post">
					<table>
						<tr><td>Login: </td><td> <input type="text" name="login"> </td></tr>
						<tr><td>Hasło: </td><td> <input type="password" name="haslo"> </td></tr>
					</table>
    			<a href="index.php" style="margin-left: 11vw;"><button>Powrót!</button></a><button type="submit">Loguj!</button>
    		</form><br>
			</div>
		</header>
		<footer>
			<?php 
      	$pytanie = "SELECT COUNT(*) FROM uzytkownicy";
      	$wynik = $polaczenie -> query($pytanie);
      	$ile = $wynik -> num_rows;
      	for($i = 0; $i < $ile; $i++){
      		$wiersz = $wynik -> fetch_row();
      		echo "Obecnie mamy ".$wiersz[0]." uzytkownikow;";
      	} ?> &copy; Adam Kostuch 
		</footer>
	</body>
</html>
<?php } $polaczenie -> close(); ?>