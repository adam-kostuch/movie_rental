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
						<li><a href="rejestracja.php">Zarejestruj</a></li>
						<li><a href="zaloguj.php">Zaloguj</a></li>
					<?php } else{ ?>
						<li><a href="wyloguj.php">Wyloguj</a></li>
					<?php } if((!empty($_SESSION['rola'])) && ($_SESSION['rola'] == 'administrator')){ ?>
						<li><a href="klienci.php">Klienci</a></li>
						<li><a href="kup.php">Wynajmij</a></li>
					<?php } elseif((!empty($_SESSION['rola'])) && ($_SESSION['rola'] == 'uzytkownik')){	?>
						<li><a href="kup.php">Wynajmij</a></li>
					<?php } ?>
						<li style="border:none;"><a href="index.php?id=oferta#oferta">Oferta</a></li>
				</ul>
			</div>
		</nav>
		<div id="form4" style="top: 23%">
			<h1 style="float: left;">DODAJ:</h1>
			<div id="offer_table" style="overflow:hidden;">
				<?php
					$polaczenie = new mysqli('localhost', 'root', '' ,'wypozyczalnia_filmow');

					if($polaczenie -> connect_error){ 
						die("Connection failed: ".$polaczenie->connect_error);
					} else{
						$polaczenie -> select_db("wypozyczalnia_filmow");

						if((empty($_SESSION['rola'])) || ($_SESSION['rola'] == 'uzytkownik')){
                            echo "<h2 style='text-align: center; margin-top: 6vw;'>wstep nieautoryzowany</h2>";
                        } else{
                            if(isset($_POST['dodaj'])){
                                $nazwa = $_POST['nazwa'];
				                $rezyser = $_POST['rezyser'];
				                $gatunek = $_POST['gatunek'];
				                $data = $_POST['data_wydania'];
						
				                $pytanie = "INSERT INTO filmy VALUES ('', '$nazwa', '$rezyser', '$gatunek', '$data')";
								if(!empty($nazwa) && !empty($rezyser) && !empty($gatunek) && !empty($data)){
									if($polaczenie->query($pytanie) == TRUE){
				                    	echo "<h2  style='float: right; margin-top: 7vw; margin-right: 2vw;'>DODANO</h2>";
									}
								}
                            }
                            
                            ?>
	                        <form method='post'>
                                <table>
                                    <tr><td>NAZWA:</td><td><input type="text" name="nazwa"></td></tr>
                                    <tr><td>REZYSER:</td><td><input type="text" name="rezyser"></td></tr>
                                    <tr><td>GATUNEK:</td><td><input type="text" name="gatunek"></td></tr>
                                    <tr><td>DATA WYDANIA:</td><td><input type="date" name="data_wydania"></td></tr>
                                </table>
                                <button type='submit' name='dodaj' value='dodaj' style="position: absolute; top: 80%; right: 5%;">Dodaj</button>
		                    </form>
                            <?php
                        }
				?>
				</table>
			</div>
		</div>
	</header>
	<footer> &copy; Adam Kostuch </footer>
  </body>
</html>
<?php } $polaczenie -> close(); ?> 
