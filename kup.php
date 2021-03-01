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
		<div id="form4" style="top: 23%;">
			<h1 style="float: left; margin-top:3vw;">WYNAJMIJ:</h1>
			<div id="offer_table">
				<?php
					$polaczenie = new mysqli('localhost', 'root', '' ,'wypozyczalnia_filmow');

					if($polaczenie -> connect_error){ 
						die("Connection failed: ".$polaczenie->connect_error);
					} else{
						$polaczenie -> select_db("wypozyczalnia_filmow");

                        if(isset($_POST['kup'])){
                            $data_w = $_POST['data_wypozyczenia'];
                            $data_o = $_POST['data_oddania'];
                            $id = $_POST['id_filmu'];
                    
                            $pytanie = "INSERT INTO zamowienia VALUES ('', '$data_w', '$data_o', '$id');";
                            if(!empty($data_w) && !empty($data_o) && !empty($id)){
                                if($polaczenie->query($pytanie) == TRUE){
                                    echo "<h2  style='text-align: center; margin: 1vw;'>FILM ZOSTAL WYPOZYCZONY</h2>";
                                }
                           }
                        }

						if((empty($_SESSION['rola']))){
                            echo "<h2 style='text-align: center; margin-top: 6vw;'>Przed korzystaniem z uslug zaloguj sie.</h2>";
                        } else{


                            if(@$_SESSION['uzytkownik'] == TRUE){
                                if(!isset($_POST['wyszukaj'])){
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
                                    <form method="POST">
                                        <div id="edit_offer">
                                            <table>
                                                <tr><td style="width: 10vw;">DATA WYPOZYCZENIA: </td><td><input type="date" name="data_wypozyczenia"></td></tr>
                                                <tr><td>DATA ODDANIA:</td><td><input type="date" name="data_oddania"></td></tr>
                                                <tr><td>ID FILMU: </td><td><input type="number" name="id_filmu"></td></tr>
                                                <tr><td colspan=2><button type="submit" name="kup" value="kup">WYNAJMIJ</button></td></tr>
                                            </table>
                                        </div>
                                    </form>
                                <?php

                                 } else{
                                    $pytanie="SELECT * FROM filmy WHERE ".$_POST['wybrana']." LIKE '%".$_POST['nazwa']."%' ORDER BY id_filmu";
                                    $wynik = $polaczenie -> query($pytanie);
                                    $ile_znalezionych = $wynik -> num_rows;
                                    echo "<table><div id='offers'><tr><th>ID FILMU</th><th>NAZWA</th><th>REZYSER</th><th>GATUNEK</th><th>DATA WYDANIA</th><th>KUP</th></tr>";
                                    for($i = 0; $i < $ile_znalezionych; $i++){
                                        $wiersz = $wynik -> fetch_row();
                                        echo "<tr><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td><td>".$wiersz[2]."</td><td>".$wiersz[3]."</td><td>".$wiersz[4]."</td><td style='width: 6vw;'><a style='font-size: 0;' href='kup.png'><img src='img/pay.png' width='40%;'></a></td></tr>";
                                    }
                                    echo "</table></div>";
                                    ?>
                                        <form method="POST">
										    <div id="edit_offer">
											    <table>
                                                    <tr><td style="width: 10vw;">DATA WYPOZYCZENIA: </td><td><input type="date" name="data_wypozyczenia"></td></tr>
                                                    <tr><td>DATA ODDANIA:</td><td><input type="date" name="data_oddania"></td></tr>
                                                    <tr><td>ID FILMU: </td><td><input type="number" name="id_filmu"></td></tr>
                                                    <tr><td colspan=2><button type="submit" name="kup" value="kup">WYNAJMIJ</button></td></tr>
                                                </table>
                                            </div>
                                        </form>
									<?php
                                }
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