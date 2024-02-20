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

<?php
	$_SESSION['Imie_nowe']=$_POST['Imie_nowe'];
	$_SESSION['Nazwisko_nowe']=$_POST['Nazwisko_nowe'];
	$_SESSION['Pesel_nowe']=$_POST['Pesel_nowe'];
	$_SESSION['Telefon_nowe']=$_POST['Telefon_nowe'];
?>

<div id="napis_kl">
	<h1 align="center"> Czy dane na pewno są poprawne?</h1> 
</div>
<div id="container_kl">
	   <div class="indeks_kl"> Imie </div>
	   <div class="indeks_kl"> Nazwisko </div>
	   <div class="indeks_kl"> Pesel </div>
	   <div class="indeks_kl"> Telefon </div>
       <div class="indeks_kl"> <?=$_SESSION['Imie_nowe']?> </div>
	   <div class="indeks_kl"> <?=$_SESSION['Nazwisko_nowe']?>  </div>
	   <div class="indeks_kl"> <?=$_SESSION['Pesel_nowe']?> </div>
	   <div class="indeks_kl"> <?=$_SESSION['Telefon_nowe']?> </div> 
	   <a href="Dodaj_Kl.php" class="przycisk_kl">Nie są poprawne</a>
	   <a href="Wynik_Dodaj_Kl.php" class="przycisk_kl">Tak są poprawne</a>
	   
</div>


<?php $polaczenie->close();?>

</body>
</html>

   
 
 