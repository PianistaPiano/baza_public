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
	 	$id_konc = $_POST['ID_konc'];
		$sql = "SELECT * FROM wypozyczenie_zak WHERE ID_Koncentratora = '$id_konc'";
		$rezultat = $polaczenie->query($sql);
		$ile_konc = $rezultat->num_rows;
     ?>
	 <?php endif;?>
	 <?php if($rezultat) :?>

<div id="logo"><h1>Historia zakończonych wypożyczeń</h1>
Ilość: <?=$ile_konc?>
<div class="Dokument">
		<a href='index.php'>Powrót do strony głównej</a>
</div>
<br> </br>

					<table border="1" cellpadding="10" cellspacing="0" id="tb">
					<tr>
							<td align="center"><b>ID_Urządzenia</b></td> <td align="center"><b>Imie</b></td> <td align="center"><b>Nazwisko</b></td> <td align="center"><b>Data_od</b></td> <td align="center"><b>Data_do</b></td> <td align="center"><b>Uwagi</b></td>
					</tr>
					<?php while($wiersz= $rezultat->fetch_assoc()) :?>
					<tr>
					     <td align="center"><?=$wiersz['ID_Koncentratora']?></td>  <td align="center"><?=$wiersz['Imie']?></td> <td align="center"><?=$wiersz['Nazwisko']?></td> <td align="center"><?=date('d-m-Y',strtotime($wiersz['Data_od']))?></td>
						 <td align="center"><?=date('d-m-Y',strtotime($wiersz['Data_do']))?></td> <td align="center"><?=$wiersz['Uwagi']?></td>     
					</tr>
					<?php endwhile ;?>
					</table>
					
</div>
	<?php else : ?>

		"Error: ".<?=$polaczenie->connect_errno; ?>

	<?php endif ;?>
	<?php @$polaczenie->close();?>

</body>
</html>