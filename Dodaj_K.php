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

$polaczenie =  @new mysqli($host,$db_user,$db_password,$db_name); 
$sql = "SELECT * FROM klasy";
$result = $polaczenie->query($sql);

?>

<div id="napis_kl">
	<h1> Wpisz dane nowego urządzenia</h1> 
</div>
<div class="Dokument" style="text-align: center">
		<a href='index.php'>Powrót do strony głównej</a>
</div>
</br>
<div id="container_kl_dev">
	   <div class="indeks_kl"> ID_Urządzenia </div>
	   <div class="indeks_kl"> Producent - Model </div>
	   <div class="indeks_kl"> Kiedy kupiony </div>
	   <div class="indeks_kl"> Za ile kupiony </div>
	   <div class="indeks_kl"> Klasa urządzenia </div>
   <form action="Upewnij_Dodaj_K.php" method="post" id="new_dev">
	   <input type="text" name="ID_nowe" value="<?php if(isset($_SESSION['ID_nowe']))
	   {
		   echo $_SESSION['ID_nowe'];
		   unset($_SESSION['ID_nowe']);
	   }
	   ?>" required class="okno_kl">
	   <input type="text" name="Model_nowe" value="<?php if(isset($_SESSION['Model_nowe']))
	   {
			echo $_SESSION['Model_nowe'];
			unset($_SESSION['Model_nowe']);
	   }
	   ?>" required class="okno_kl">
	   <input type="text" name="Kiedy_kupiony_nowe" value="<?php if(isset($_SESSION['Kiedy_kupiony_nowe']))
	   {
			echo $_SESSION['Kiedy_kupiony_nowe'];
			unset($_SESSION['Kiedy_kupiony_nowe']);		
	   }
	   ?>" class="okno_kl">
	   <input type="text" name="Za_ile_nowe" value="<?php if(isset($_SESSION['Za_ile_nowe']))
	   {
			echo $_SESSION['Za_ile_nowe'];
			unset($_SESSION['Za_ile_nowe']);	 
	   }
	   ?>" class="okno_kl">
	   <select name="klasy" id="klasy" form="new_dev" class="okno_kl">
	   		<?php 
				while($row = $result->fetch_assoc())
				{
					echo "<option value='".$row['klasa']."'>".$row['klasa']."</option>";
				}   
			?>
            </select>
			</br>
	   <input type="submit" value="Dodaj urządzenie" class="przycisk_kl"> 
	</form>
	<?php 
		if(isset($_SESSION['blad_k']))
		{
			echo $_SESSION['blad_k'];
			unset($_SESSION['blad_k']);
		}
		unset($_SESSION['blad_k']);
	?>
</div>


<?php $polaczenie->close();?>

</body>
</html>

   
 
 