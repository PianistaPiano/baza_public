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
   <link rel="stylesheet" href="style/style_do_bazy_2.css" type="text/css"/>
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

<div id="napis_kl">
	<h1> Wpisz dane nowego klienta</h1> 
</div>
<div id="container_kl">
	   <div class="indeks_kl"> Imie </div>
	   <div class="indeks_kl"> Nazwisko </div>
	   <div class="indeks_kl"> Pesel </div>
	   <div class="indeks_kl"> Telefon </div>
   <form action="Upewnij_Dodaj_Kl.php" method="post">
	   <input type="text" name="Imie_nowe" value ="<?php if(isset($_SESSION['Imie_nowe']))
	   {
		   echo $_SESSION['Imie_nowe'];
		   unset($_SESSION['Imie_nowe']);
	   }	
	   ?>" required class="okno_kl">
	   <input type="text" name="Nazwisko_nowe" required value="<?php if(isset($_SESSION['Nazwisko_nowe']))
		{
		   echo $_SESSION['Nazwisko_nowe'];
		   unset($_SESSION['Nazwisko_nowe']);
		}
	   ?>" class="okno_kl">
	   <input type="text" name="Pesel_nowe" required  value ="<?php if(isset($_SESSION['Pesel_nowe']))
		{
		   echo $_SESSION['Pesel_nowe'];
		   unset($_SESSION['Pesel_nowe']);
		}
	   ?>"class="okno_kl">
	   <input type="text" name="Telefon_nowe" required value="<?php if(isset($_SESSION['Telefon_nowe']))
		{
		   echo $_SESSION['Telefon_nowe'];
		   unset($_SESSION['Telefon_nowe']);
		}
	   ?>" class="okno_kl">
	   <input type="submit" value="Dodaj klienta" required class="przycisk_kl"> 
	</form>
	<?php 
		if(isset($_SESSION['blad_kl']))
		{
			echo $_SESSION['blad_kl'];
			unset($_SESSION['blad_kl']);
		}
		unset($_SESSION['blad_kl']);
	?>
	</br>
	<div class="Dokument">
		<a href='index.php'>Powrót do strony głównej</a>
</div>
</div>


<?php $polaczenie->close();?>

</body>
</html>

   
 
 