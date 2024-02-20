<?php

session_start();

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
   <meta charset="utf-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
   <title>Baza - testuje</title>
   <link rel="stylesheet" href="style/style do bazy.css" type="text/css"/>
</head>



<body>
<?php require_once "connect.php";


$polaczenie =  @new mysqli($host,$db_user,$db_password,$db_name); ?>

<?php  if ($polaczenie->connect_errno!=0) : ?>
	 
		"Error: ".<?=$polaczenie->connect_errno; ?>
	 
	 <?php else :?>
	 <?php 
		$sql = "SELECT koncentratory.ID_Koncentratora,koncentratory.Model, koncentratory.O2_PSI, koncentratory.Aktualny_przebieg FROM koncentratory
		LEFT JOIN sprzedane ON koncentratory.ID_Koncentratora = sprzedane.ID_Koncentratora  
		LEFT JOIN wypozyczenie_akt  ON wypozyczenie_akt.ID_Koncentratora = koncentratory.ID_Koncentratora 
		WHERE sprzedane.ID_Koncentratora Is Null AND wypozyczenie_akt.ID_Koncentratora Is Null AND is_ok = 0";
		$rezultat = $polaczenie->query($sql);
		$ile_konc = $rezultat->num_rows;
		$sql_ok = "SELECT koncentratory.ID_Koncentratora,koncentratory.Model, koncentratory.O2_PSI, koncentratory.Aktualny_przebieg FROM koncentratory
		LEFT JOIN sprzedane ON koncentratory.ID_Koncentratora = sprzedane.ID_Koncentratora  
		LEFT JOIN wypozyczenie_akt  ON wypozyczenie_akt.ID_Koncentratora = koncentratory.ID_Koncentratora 
		WHERE sprzedane.ID_Koncentratora Is Null AND wypozyczenie_akt.ID_Koncentratora Is Null AND is_ok = 1";
		$r_ok = $polaczenie->query($sql_ok);
		$ile_ok = $r_ok->num_rows;

     ?>

<?php if($r_ok) :?>

<div id="logo"><h1>Gotowe urządzenia</h1>
Dostępnych urządzeń: <?=$ile_ok?>
<div class="Dokument">
		<a href='index.php'>Powrót do strony głównej</a>
</div>
<br> </br>

					<table border="1" cellpadding="10" cellspacing="0" id="tb">
					<tr>
							<td align="center"><b>ID_Urządzenia</b></td> <td align="center"><b>Model</b></td> <td align="center"><b>Opis</b></td> <td align="center"><b>Przebieg</b></td>
					</tr>
					<?php while($wiersz= $r_ok->fetch_assoc()) :?>
					<tr>
					     <td align="center"><?=$wiersz['ID_Koncentratora']?></td>  <td align="center"><?=$wiersz['Model']?></td> <td align="center"><?=$wiersz['O2_PSI']?></td> <td align="center"><?=$wiersz['Aktualny_przebieg']?></td>
					</tr>
					<?php endwhile ;?>
					</table>
					
</div>
	<?php else : ?>

		"Error: ".<?=$polaczenie->connect_errno; ?>

	<?php endif ;?>



<?php if($rezultat) :?>

<div id="logo"><h1>Nie gotowe urządzenia</h1>
Dostępnych urządzeń: <?=$ile_konc?>
<div class="Dokument">
		<a href='index.php'>Powrót do strony głównej</a>
</div>
<br> </br>

					<table border="1" cellpadding="10" cellspacing="0" id="tb">
					<tr>
							<td align="center"><b>ID_Urządzenia</b></td> <td align="center"><b>Model</b></td> <td align="center"><b>Opis</b></td> <td align="center"><b>Przebieg</b></td>
					</tr>
					<?php while($wiersz= $rezultat->fetch_assoc()) :?>
					<tr>
					     <td align="center"><?=$wiersz['ID_Koncentratora']?></td>  <td align="center"><?=$wiersz['Model']?></td> <td align="center"><?=$wiersz['O2_PSI']?></td> <td align="center"><?=$wiersz['Aktualny_przebieg']?></td>   
					</tr>
					<?php endwhile ;?>
					</table>
					
</div>
	<?php else : ?>

		"Error: ".<?=$polaczenie->connect_errno; ?>

	<?php endif ;?>




<?php endif ;?>


	 
	<?php @$polaczenie->close();?>

</body>
</html>

   
 
 