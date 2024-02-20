<?php

session_start();

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
   <meta charset="utf-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
   <title>Baza - testuje</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
   integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
   <link rel="stylesheet" href="style/style do bazy.css" type="text/css"/>
</head>



<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<?php require_once "connect.php";

$polaczenie =  @new mysqli($host,$db_user,$db_password,$db_name); ?>

<?php
  
  if($polaczenie->connect_errno!=0)
  {
	echo "Error: ".$polaczenie->connect_errno;
  }
  else
  {
 	$Imie = $_POST['Imie'];
	$Nazwisko = $_POST['Nazwisko'];
	$Telefon = $_POST['nr_tel'];
	$Adres = $_POST['Adres'];
	$Pesel = $_POST['Pesel'];
	$Seria_dowodu = $_POST['Seria_dowodu'];
	$Numer_dowodu = $_POST['Numer_dowodu'];
	$Data_od = $_POST['Data_od'];
	$Data_do = $_POST['Data_do'];
	$id_konc = $_POST['ID_konc'];
	$Model = $_POST['Model'];
	$Licznik = $_POST['Licznik'];
	$Tlen = $_POST['tlen'];
	$Okres_wypo = $_POST['Okres_wypo'];
	$Cena = $_POST['Cena'];
	$Uwagi = $_POST['Uwagi'];
// dane w bazie:
    $_SESSION['Model'] = $Model;
	$_SESSION['id_konc'] = $id_konc; //wypozyczenie_akt
 	$_SESSION['Imie'] = $Imie; //wypozyczenie_akt
 	$_SESSION['Nazwisko'] = $Nazwisko; //wypozyczenie_akt
	$_SESSION['Adres'] = $Adres;
 	$_SESSION['Data_od'] = $Data_od; //wypozyczenie_akt
 	$_SESSION['Pesel'] = $Pesel; //wypozyczenie_akt
 	$_SESSION['Uwagi'] = $Uwagi; //wypozyczenie_akt
	$_SESSION['Licznik'] = $Licznik;
	$_SESSION['Okres_wypo'] = $Okres_wypo; //wypozyczenie_akt
	$_SESSION['Cena'] = $Cena; //wypozyczenie_akt
	$_SESSION['nr_tel'] = $Telefon;
// dane tylko do umowy:
   $_SESSION['Seria_dowodu'] = $Seria_dowodu;
   $_SESSION['Numer_dowodu'] = $Numer_dowodu;
   $_SESSION['Data_do'] = $Data_do;
   $_SESSION['tlen'] = $Tlen;
   

 	$sql = "INSERT INTO wypozyczenie_akt (ID_Koncentratora, Imie, Nazwisko, Data_od, Pesel, Okres_wypo, Cena, Uwagi) VALUES('$id_konc','$Imie',
	'$Nazwisko', '$Data_od', '$Pesel','$Okres_wypo','$Cena','$Uwagi')";

	$sql_licznik = "INSERT INTO licznik_od (ID_Koncentratora, Data_od, licznik) VALUES('$id_konc','$Data_od','$Licznik')";

	$sql_adres = "UPDATE klienci SET Adres = '$Adres' WHERE Pesel = '$Pesel'";
	//$rezultat_licznik = $polaczenie->query($sql_licznik); 

	$sql_zab_ID = "SELECT koncentratory.ID_koncentratora FROM koncentratory WHERE koncentratory.ID_koncentratora = '$id_konc'";

	$sql_zab_Per = "SELECT * FROM klienci WHERE klienci.Imie = '$Imie' 
	AND klienci.Nazwisko ='$Nazwisko' AND klienci.Pesel = '$Pesel'";

	$sql_czy_pow = "SELECT * FROM wypozyczenie_akt WHERE wypozyczenie_akt.ID_Koncentratora = '$id_konc'";
	/*$sql_zab_Nazwisko = "SELECT klienci.Nazwisko FROM klienci WHERE klienci.Nazwisko = '$Nazwisko'";
	$sql_zab_Pesel = "SELECT klienci.Pesel FROM klienci WHERE klienci.Pesel = '$Pesel'";*/
	}
	$rezultat_zab = $polaczenie->query($sql_zab_Per);
	$zab_rows = $rezultat_zab->num_rows;
	$rezultat_zab_dwa = $polaczenie->query($sql_zab_ID);
	$zab_rows_dwa = $rezultat_zab_dwa->num_rows;
	$rezultat_pow = $polaczenie->query($sql_czy_pow);
	$pow_rows = $rezultat_pow->num_rows; 

	// ============== Klasa urzadzenia ==================
	$sql_class = "SELECT klasa FROM koncentratory WHERE ID_Koncentratora = '$id_konc'";
	$result_class = $polaczenie->query($sql_class);
	$row_class = $result_class->fetch_assoc();
	$_SESSION['klasa'] = $row_class['klasa'];
?>
<?php if(($zab_rows>0) && ($zab_rows_dwa>0) && ($pow_rows==0)) : ?>
		<?php if(($polaczenie->query($sql) == TRUE) && ($rezultat_licznik = $polaczenie->query($sql_licznik) ) && ($polaczenie->query($sql_adres))  )   : ?>
			<div id="container_W">
				<div class="napis_koncowy_W">
					<h1>Dodano nowe wypożyczenie</h1>
					<div class="napis_K"><?=$id_konc?></div><div class="napis_K"><?=$Imie?></div><div class="napis_K"><?=$Nazwisko?></div>
					<div class="napis_K"><?=$Data_od?></div><div class="napis_K"><?=$Pesel?></div><div class="napis_K"><?=$Uwagi?></div>
				</div>
					<img width="200" height="200" src="zdj/fajka.png" />
				<div class="powrot_glowna_W">
					<a href='Dokument.php' class="doc-style">Wygeneruj umowę</a>
				</div>
				<div class="Dokument">
					<a href='index.php'>Powrót do strony głównej</a>
				</div>
				<div class="Dokument">
					<a href='Cofnij_Wypo.php'>Cofnij wypożyczenie</a>
				</div>
			</div>	
		<?php else : ?>
			Error: .<?=$sql?>.<br>.<?=$polaczenie->error?>
		<?php endif ; ?>
<?php else : ?>
  <?php
  if($pow_rows>0)
  {
	  $_SESSION['blad_D_W_pow'] = '<span style="color:red">Takie urządzenie jest już wypożyczone!</span>';
	//  header('Location: Dodaj_W.php');
  }
  if($zab_rows==0)
  {
	$_SESSION['blad_D_W'] = '<span style="color:red">Niepoprawne dane: imie, nazwisko lub pesel! </span>';
  }
  if($zab_rows_dwa == 0)
  {
	  $_SESSION['blad_K_J'] = '<span style="color:red">Takie urządzenie nie jest w bazie! </span>';
  }
  header('Location: Dodaj_W.php');
  ?>
 <?php endif ; ?>

<?php $polaczenie->close();?>

</body>
</html>

   
 
 