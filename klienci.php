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
    <header id="dodaj">
		<nav>
			<div id="logo"><a href="index.php"><img src="img/logo.png" alt="logo"></a></div>
			<div id="links">
				<ul>
					<?php if(empty($_SESSION['uzytkownik'])){ ?>
						<li><a href="rejestracja.php"><li>Zarejestruj</li></a></li>
						<li><a href="zaloguj.php"><li>Zaloguj</li></a></li>
					<?php } else{ ?>
						<li><a href="wyloguj.php"><li>Wyloguj</li></a></li>
					<?php } if((!empty($_SESSION['rola'])) && ($_SESSION['rola'] == 'administrator')){ ?>
						<li><a href="klienci.php"><li>Klienci</li></a></li>
						<li><a href="kup.php"><li>Wynajmij</li></a></li>
                    <?php } elseif((!empty($_SESSION['rola'])) && ($_SESSION['rola'] == 'uzytkownik')){	?>
                        <li><a href="kup.php"><li>Wynajmij</li></a></li>
					<?php } ?>
						<li style="border:none;"><a href="index.php?id=oferta#oferta">Oferta</a></li>
				</ul>
			</div>
		</nav>
		<div id="form4" style="top: 23%;">
            <h1 style="float: left; margin-top:3vw;">KLIENCI:</h1>
            <div id="wyszukaj">
			<form method="post">
            	WYSZUKAJ:             
           	 	<input type="text" placeholder="..." name="nazwa">
            	<select name="wybrana">
					<option value='id_klienta'>ID</option>
                	<option value='login'>Login</option>
					<option value='imie'>Imie</option>
					<option value='nazwisko'>Nazwisko</option>
                	<option value='mail'>Mail</option>
            	</select>
            	<button type="submit" name="wyszukaj" value="Szukaj!" style="min-width: 2vw; height: 1.7vw; padding: .1vw; margin-left: .1vw; margin-bottom: .1vw;">Szukaj!</button>
			</form>
			</div>
			<div id="offer_table">
				<?php
					$polaczenie = new mysqli('localhost', 'root', '' ,'wypozyczalnia_filmow');

					if($polaczenie -> connect_error){ 
						die("Connection failed: ".$polaczenie->connect_error);
					} else{
						$polaczenie -> select_db("wypozyczalnia_filmow");

						if((empty($_SESSION['rola'])) || ($_SESSION['rola'] == 'uzytkownik')){
                            echo "<h2 style='text-align: center; margin-top: 6vw;'>wstep nieautoryzowany</h2>";
                        } else{
							
                            if(!isset($_POST['wyszukaj'])){
                                $pytanie="SELECT * FROM klienci ORDER BY id_klienta";
                                $wynik = $polaczenie -> query($pytanie);
                                $ile_znalezionych = $wynik -> num_rows;
                                echo "<table><tr><th>ID KLIENTA</th><th>LOGIN</th><th>IMIE</th><th>NAZWISKO</th><th>MAIL</th></tr>";
                                for($i = 0; $i < $ile_znalezionych; $i++){
                                    $wiersz = $wynik -> fetch_row();
                                    echo "<tr><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td><td>".$wiersz[3]."</td><td>".$wiersz[4]."</td><td>".$wiersz[5]."</td></tr>";
                                }
                                echo "</table>";
                            } else{
                                $pytanie="SELECT * FROM klienci WHERE ".$_POST['wybrana']." LIKE '%".$_POST['nazwa']."%' ORDER BY id_klienta";
                                $wynik = $polaczenie -> query($pytanie);
                                $ile_znalezionych = $wynik -> num_rows;
                                echo "<table><div id='offers'><tr id='klient_tr'><th>ID KLIENTA</th><th>LOGIN</th><th>IMIE</th><th>NAZWISKO</th><th>MAIL</th></tr>";
                                for($i = 0; $i < $ile_znalezionych; $i++){
                                    $wiersz = $wynik -> fetch_row();
                                    echo "<tr><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td><td>".$wiersz[3]."</td><td>".$wiersz[4]."</td><td>".$wiersz[5]."</td></tr>";
                                }
                                echo "</div></table>";
                            }
                    ?>
				</table>
			</div>
		</div>
	</header>
	<footer> &copy; Adam Kostuch </footer>
  </body>
</html>
<?php } } $polaczenie -> close(); ?> 