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
						<li><a href="zaloguj.php"><li>Zaloguj</a></li>
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

			if(!empty($_POST['login']) && !empty($_POST['haslo']) && !empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['email'])){
				$login = $_POST['login'];
				$haslo = sha1($_POST['haslo']);
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $email = $_POST['email'];

				$zapytanie = "INSERT INTO uzytkownicy VALUES ('', '$login', '$haslo', 'uzytkownik');";
        $zapytanie .= "INSERT INTO klienci VALUES ('', '$login', '$haslo', '$imie', '$nazwisko', '$email')";

				if($polaczenie -> multi_query($zapytanie) === TRUE){
          header("Location: zaloguj.php");
        } 
      } ?>
		<div id="form2">
      <h1 style="margin-top: 2vw;">REJESTRACJA: </h1>
		  <form method="post">
			  <table>
				  <tr><td>Login: </td><td> <input type="text" name="login"> </td></tr>
			    <tr><td>Hasło: </td><td> <input type="password" name="haslo"> </td></tr>
          <tr><td>Imie: </td><td> <input type="text" name="imie"> </td></tr>
          <tr><td>Nazwiko: </td><td> <input type="text" name="nazwisko"> </td></tr>
          <tr><td>Mail: </td><td> <input type="email" name="email"> </td></tr>
			  </table>
        <a href="index.php" style="margin-left: 10vw;"><button>Powrót!</button></a><button type="submit">Zarejestruj!</button>
      </form><br>
		</div>
	</header>
	<footer> &copy; Adam Kostuch </footer>
	</body>
</html>
<?php } $polaczenie -> close(); ?>