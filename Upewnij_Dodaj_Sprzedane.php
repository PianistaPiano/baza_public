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
	$_SESSION['ID_Kon_S']=$_POST['ID_Kon_S'];
	$_SESSION['Data_S']=$_POST['Data_S'];
	$_SESSION['Za_ile_S']=$_POST['Za_ile_S'];
	$_SESSION['Uwagi_S']=$_POST['Uwagi_S'];
?>

<div id="napis_kl">
	<h1 align="center"> Czy dane na pewno są poprawne?</h1> 
</div>
<div id="container_kl">
	   <div class="indeks_kl"> ID_Urządzenia </div>
	   <div class="indeks_kl"> Data </div>
	   <div class="indeks_kl"> Za_ile </div>
	   <div class="indeks_kl"> Uwagi </div>
       <div class="indeks_kl"> <?=$_SESSION['ID_Kon_S']?> </div>
	   <div class="indeks_kl"> <?=$_SESSION['Data_S']?>  </div>
	   <div class="indeks_kl"> <?=$_SESSION['Za_ile_S']?> </div>
	   <div class="indeks_kl"> <?=$_SESSION['Uwagi_S']?> </div> 
	   <a href="Dodaj_Sprzedane.php" class="przycisk_kl">Nie są poprawne</a>
	   <a href="Wynik_Dodaj_Sprzedane.php" class="przycisk_kl">Tak są poprawne</a>
	   
</div>


<?php $polaczenie->close();?>

</body>
</html>

   
 
 