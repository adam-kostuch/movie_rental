<html>
  <body>
    <header id="oferta">
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
		<div id="form4">
			<h1 style="float: left;">OFERTA:</h1>
			<div id="wyszukaj">
			<form method="post">
            	WYSZUKAJ:             
           	 	<input type="text" placeholder="..." name="nazwa">
            	<select name="wybrana">
					<option value='id_filmu'>ID</option>
                	<option value='nazwa'>Nazwa</option>
					<option value='rezyser'>Rezyser</option>
					<option value='gatunek'>Gatunek</option>
                	<option value='data_wydania'>Data Wydania</option>
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

						if(@$_SESSION['uzytkownik'] == TRUE){
							if($_SESSION['rola'] == 'uzytkownik'){
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
								} else{
									$pytanie="SELECT * FROM filmy WHERE ".$_POST['wybrana']." LIKE '%".$_POST['nazwa']."%' ORDER BY id_filmu";
               						$wynik = $polaczenie -> query($pytanie);
									$ile_znalezionych = $wynik -> num_rows;
									echo "<table><div id='offers'><tr><th>ID FILMU</th><th>NAZWA</th><th>REZYSER</th><th>GATUNEK</th><th>DATA WYDANIA</th><th>KUP</th></tr>";
									for($i = 0; $i < $ile_znalezionych; $i++){
										$wiersz = $wynik -> fetch_row();
										echo "<tr><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td><td>".$wiersz[2]."</td><td>".$wiersz[3]."</td><td>".$wiersz[4]."</td><td style='width: 6vw;'><a style='font-size: 0;' href='kup.png'><img src='img/pay.png' width='40%;'></a></td></tr>";
									}
									echo "</div></table>";
								}
							} elseif(@$_SESSION['rola'] == 'administrator'){
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
										<div id="edit_offer">
											<button style="margin-left: 4vw;"><a href="edytuj.php">EDYTUJ</a></button>
											<button><a href="dodaj.php">DODAJ</a></button>
											<button><a href="usun.php">USUN</a></button>
										</div>
									<?php
								} else{
									$pytanie="SELECT * FROM filmy WHERE ".$_POST['wybrana']." LIKE '%".$_POST['nazwa']."%' ORDER BY id_filmu";
               						$wynik = $polaczenie -> query($pytanie);
									$ile_znalezionych = $wynik -> num_rows;
									echo "<table><tr><th>ID FILMU</th><th>NAZWA</th><th>REZYSER</th><th>GATUNEK</th><th>DATA WYDANIA</th><th>KUP</th></tr>";
									for($i = 0; $i < $ile_znalezionych; $i++){
										$wiersz = $wynik -> fetch_row();
										echo "<tr><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td><td>".$wiersz[2]."</td><td>".$wiersz[3]."</td><td>".$wiersz[4]."</td><td style='width: 6vw;'><a style='font-size: 0;' href='kup.png'><img src='img/pay.png' width='40%;'></a></td></tr>";
									}
									echo "</table>";
									?>
										<div id="edit_offer">
											<button style="margin-left: 4vw;"><a href="edytuj.php">EDYTUJ</a></button>
											<button><a href="dodaj.php">DODAJ</a></button>
											<button><a href="usun.php">USUN</a></button>
										</div>
									<?php
								}
							}
					} else{
						if(!isset($_POST['wyszukaj'])){
							$pytanie="SELECT * FROM filmy ORDER BY id_filmu";
							   $wynik = $polaczenie -> query($pytanie);
							$ile_znalezionych = $wynik -> num_rows;
							echo "<table><tr><th>ID FILMU</th><th>NAZWA</th><th>REZYSER</th><th>GATUNEK</th><th>DATA WYDANIA</th></tr>";
							for($i = 0; $i < $ile_znalezionych; $i++){
								$wiersz = $wynik -> fetch_row();
								echo "<tr><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td><td>".$wiersz[2]."</td><td>".$wiersz[3]."</td><td>".$wiersz[4]."</td></tr>";
							}
							echo "</table>";
						} else{
							$pytanie="SELECT * FROM filmy WHERE ".$_POST['wybrana']." LIKE '%".$_POST['nazwa']."%' ORDER BY id_filmu";
							   $wynik = $polaczenie -> query($pytanie);
							$ile_znalezionych = $wynik -> num_rows;
							echo "<table><tr><th>ID FILMU</th><th>NAZWA</th><th>REZYSER</th><th>GATUNEK</th><th>DATA WYDANIA</th></tr>";
							for($i = 0; $i < $ile_znalezionych; $i++){
								$wiersz = $wynik -> fetch_row();
								echo "<tr><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td><td>".$wiersz[2]."</td><td>".$wiersz[3]."</td><td>".$wiersz[4]."</td></tr>";
							}
							echo "</table>";
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
<?php } $polaczenie -> close(); ?> 
