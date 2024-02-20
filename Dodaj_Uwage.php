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
   <link rel="stylesheet" href="style/style_do_bazy_5.css" type="text/css"/>
   <script src=JS/autoload_IDUwaga_Dodaj.js></script>
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
	<h1> Wpisz Uwagę</h1> 
</div>
<div class="Dokument" style="text-align: center">
		<a href='index.php'>Powrót do strony głównej</a>
</div>
</br>
<div id="container_kl">
	   <div class="indeks_kl"> ID_Urządzenia </div>
	   <div class="indeks_kl"> Uwagi </div>
   <form action="Wynik_Dodaj_Uwage.php" method="post">
	   <input type="text" name="ID_konc_U" onkeyup="load_dataID(this.value)" required class="okno_kl">
	   <input type="text" name="Uwagi_U" required class="okno_kl">
	   <input type="submit" value="Dodaj Uwagę" class="przycisk_kl"> 
	</form>
	<span id=search_result></span>
	<?php 
		if(isset($_SESSION['blad_U']))
		{
			echo $_SESSION['blad_U'];
			unset($_SESSION['blad_U']);
		}
		unset($_SESSION['blad_U']);
	?>
</div>


<?php $polaczenie->close();?>

</body>
</html>

   
 
 