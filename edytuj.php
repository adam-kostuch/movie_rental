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
						<li style="border:none;"><a href="index.php?id=oferta#oferta">Oferta</a>
				</ul>
			</div>
		</nav>
		<div id="form4" style="top: 23%;">
			<h1 style="float: left; margin-top:3vw;">EDYTUJ:</h1>
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

							if(isset($_POST['edytuj2'])){
								$edyt="UPDATE filmy SET nazwa = '".$_POST['nazwa']."', rezyser = '".$_POST['rezyser']."', gatunek = '".$_POST['gatunek']."', data_wydania = '".$_POST['data_wydania']."' WHERE id_filmu=".$_POST['id_filmu'];
								if($polaczenie->query($edyt)== TRUE){
									echo "<h2 style='float: right; margin-top: 7vw; margin-right: 2vw;'>ZMODYFIKOWANO</h2>";
								}
							}
							
                            if((!isset($_POST['edytuj']))){
                                $pytanie="SELECT * FROM filmy ORDER BY id_filmu";
                                $wynik = $polaczenie -> query($pytanie);
                                $ile_znalezionych = $wynik -> num_rows;
                                echo "<table><tr><th>ID FILMU</th><th>NAZWA</th><th>REZYSER</th><th>GATUNEK</th><th>DATA WYDANIA</th><th>KUP</th></tr>";
                                for($i = 0; $i < $ile_znalezionych; $i++){
                                    $wiersz = $wynik -> fetch_row();
                                    echo "<tr><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td><td>".$wiersz[2]."</td><td>".$wiersz[3]."</td><td>".$wiersz[4]."</td><td style='width: 6vw;'><a style='font-size: 0;' href='kup.png'><img src='img/pay.png' width='40%;'></a></td></tr>";
                                }
                                echo "</table>";
                                ?>
                                <form method='post'>
                                    <div id="edit_offers">
                                        ID: <input type="text" name="id_filmu">
                                        <button type='submit' name='edytuj' value='edytuj'>Edytuj</button>
                                    </div>
                                </form>
                                <?php
                            } elseif(isset($_POST['edytuj'])){ 
								$id = $_POST['id_filmu'];
								$pytanie = "SELECT * FROM filmy WHERE id_filmu=$id";	
								$wynik=mysqli_query($polaczenie, $pytanie);
								$wiersz = $wynik->fetch_row();
								echo '<form method="POST">
									<table>
										<tr><td>ID: </td><td><input type="text" name="id_filmu" value="'.$wiersz[0].'"></td></tr>
                                        <tr><td>NAZWA: </td><td><input type="text" name="nazwa" value="'.$wiersz[1].'"></td></tr>
                                        <tr><td>REZYSER: </td><td><input type="text" name="rezyser" value="'.$wiersz[2].'"></td></tr>
                                        <tr><td>GATUNEK: </td><td><input type="text" name="gatunek" value="'.$wiersz[3].'"></td></tr>
                                        <tr><td>DATA WYDANIA: </td><td><input type="date" name="data_wydania" value="'.$wiersz[4].'"></td></tr>
                                        <tr><td colspan=2><button type="submit" name="edytuj2" value="edytuj2">Edytuj</button></td></tr>
                                    </table>
            						</form> ';
                    } } ?>
				</table>
			</div>
		</div>
	</header>
	<footer> &copy; Adam Kostuch </footer>
  </body>
</html>
<?php } $polaczenie -> close(); ?> 