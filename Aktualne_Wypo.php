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
	 
		"Error1: ".<?=$polaczenie->connect_errno; ?>
	 
	 <?php else :?>
	 <?php 
	 	$sql = "SELECT * FROM wypozyczenie_akt";
		$rezultat = $polaczenie->query($sql);
		$ile_wypo = $rezultat->num_rows;
	 	// Mati
		$sql = "SELECT * FROM wypozyczenie_akt WHERE Uwagi LIKE '%Mati%' ORDER BY Data_od DESC";
		$rezultat1 = $polaczenie->query($sql);
		$ile_wypo1 = $rezultat1->num_rows;
		$sql = "SELECT SUM(Cena) AS zarobek FROM wypozyczenie_akt WHERE Uwagi LIKE '%Mati%' ORDER BY Data_od DESC";
		$rezultat8 = $polaczenie->query($sql);
		$zarobek_Mati = $rezultat8->fetch_assoc()['zarobek'];
		// Ela
		$sql = "SELECT * FROM wypozyczenie_akt WHERE Uwagi LIKE '%Ela%' ORDER BY Data_od DESC";
		$rezultat2 = $polaczenie->query($sql);
		$ile_wypo2 = $rezultat2->num_rows;
		$sql = "SELECT SUM(Cena) AS zarobek FROM wypozyczenie_akt WHERE Uwagi LIKE '%Ela%' ORDER BY Data_od DESC";
		$rezultat9 = $polaczenie->query($sql);
		$zarobek_Mama = $rezultat9->fetch_assoc()['zarobek'];
		//Piotr
		$sql = "SELECT * FROM wypozyczenie_akt WHERE Uwagi LIKE '%Piotr%' ORDER BY Data_od DESC";
		$rezultat3 = $polaczenie->query($sql);
		$ile_wypo3 = $rezultat3->num_rows;
		$sql = "SELECT SUM(Cena) AS zarobek FROM wypozyczenie_akt WHERE Uwagi LIKE '%Piotr%' ORDER BY Data_od DESC";
		$rezultat10 = $polaczenie->query($sql);
		$zarobek_Piotr = $rezultat10->fetch_assoc()['zarobek'];
		//Kik
		$sql = "SELECT * FROM wypozyczenie_akt WHERE Uwagi LIKE '%Kik%' ORDER BY Data_od DESC";
		$rezultat4 = $polaczenie->query($sql);
		$ile_wypo4 = $rezultat4->num_rows;
		$sql = "SELECT SUM(Cena) AS zarobek FROM wypozyczenie_akt WHERE Uwagi LIKE '%Kik%' ORDER BY Data_od DESC";
		$rezultat11 = $polaczenie->query($sql);
		$zarobek_Kik = $rezultat11->fetch_assoc()['zarobek'];
		// Wiki
		$sql = "SELECT * FROM wypozyczenie_akt WHERE Uwagi LIKE '%Wiki%' ORDER BY Data_od DESC";
		$rezultat5 = $polaczenie->query($sql);
		$ile_wypo5 = $rezultat5->num_rows;
		$sql = "SELECT SUM(Cena) AS zarobek FROM wypozyczenie_akt WHERE Uwagi LIKE '%Wiki%' ORDER BY Data_od DESC";
		$rezultat12 = $polaczenie->query($sql);
		$zarobek_Wiki = $rezultat12->fetch_assoc()['zarobek'];
		define("WARNING",3);
		// obliczenie zarobku miesięcznego
		$sql = "SELECT SUM(Cena) AS zarobek FROM wypozyczenie_akt WHERE Okres_wypo='miesiac'";
		$rezultat6 = $polaczenie->query($sql);
		$zarobek = $rezultat6->fetch_assoc()['zarobek'];
		// obliczenie zarobku z tygodniowych wypo
		$sql = "SELECT *  FROM wypozyczenie_akt WHERE Okres_wypo='tydzien'";
		$rezultat7 = $polaczenie->query($sql);
		$zarobek_tyg = 0;
		while($wypo_tydz = $rezultat7->fetch_assoc())
		{
			$day = date('d', strtotime($wypo_tydz['Data_od'])); // dzien wypozyczenia
			$current_day = date('d'); // aktualny dzień
			if($current_day == $day)
			{
				$ile_tygodni_w_miesiacu = ($current_day - $day)%6 + 1; // liczymy dzień wypo również jako już jeden dzien wypozyczenia
				$zarobek_tyg += $wypo_tydz['Cena'] * $ile_tygodni_w_miesiacu;
			}
			elseif($current_day > $day)
			{
				$ile_tygodni_w_miesiacu = ($current_day - $day)%6; // liczymy dzień wypo również jako już jeden dzien wypozyczenia
				$zarobek_tyg += $wypo_tydz['Cena'] * $ile_tygodni_w_miesiacu;
			}
			elseif($current_day < $day)
			{
				// to develop
			}
			$ile_tygodni_w_miesiacu = 0;
		}

     ?>
	 <?php if($rezultat) :?>

<div id="logo"><h1>Aktulane wypożyczenia</h1>
Aktualnych wypożyczeń: <?=$ile_wypo?> </br> </br>
Zarobek miesięczny: <?=$zarobek?> zł </br> </br>
Zarobek z wypożyczeń tygodniowych: <?=$zarobek_tyg?> zł (niedopracowane, brać jako mniejwięcej)
<div class="Dokument">
		<a href='index.php'>Powrót do strony głównej</a>
</div>
<div class="Dokument">
		<a >Mati, wypożyczone: <?=$ile_wypo1?>, zarobek/msc(chwilowy w dany dzień): <?=$zarobek_Mati?> zł</a>
</div>
<br> </br>

					<table border="1" cellpadding="10" cellspacing="0" id="tb">
					<tr>
							<td align="center"><b>ID_Koncentratora</b></td> <td align="center"><b>Imie</b></td> <td align="center"><b>Nazwisko</b></td>
							<td align="center"><b>Data_od</b></td> <td align="center"><b>Data_do</b></td> <td align="center"><b>Pesel</b></td> <td align="center"><b>Okres_wypo</b></td> <td align="center"><b>Cena</b></td> <td align="center"><b>Uwagi</b></td> 
					</tr>
		<?php while($wiersz = $rezultat1->fetch_assoc()) :?>
		<?php $date = date('d-m-Y',strtotime($wiersz['Data_od'])); $last_day = date('d',strtotime($wiersz['Data_od'])) - 1;?>
					<tr>
							<td><?=$wiersz['ID_Koncentratora']?></td> <td align="center"><?=$wiersz['Imie']?></td>
							<td align="center"><?=$wiersz['Nazwisko']?></td> <td align="center"><?=$date?></td>
							<?php if($last_day - date('d') <=constant("WARNING") && $last_day - date('d') >=0 ) :?>
								  <td align="center" bgcolor="red"><?=$last_day?><?="-"?><?=date('m-Y')?></td>
							<?php else :?>
								  <td align="center"><?=$last_day?><?="-"?><?=date('m-Y')?></td>
							<?php endif; ?>
							<td align="center"><?=$wiersz['Pesel']?></td>  <td align="center"><?=$wiersz['Okres_wypo']?></td> <td align="center"><?=$wiersz['Cena']?></td> <td align="center"><?=$wiersz['Uwagi']?></td>
					</tr>				
					
		<?php endwhile ;?>
					</table>
</div>
	<?php if($rezultat2) : ?>
	<div id="logo">
		<div class="Dokument">
				<a >Ela, wypożyczone: <?=$ile_wypo2?>, zarobek/msc(chwilowy w dany dzień): <?=$zarobek_Mama?> zł</a>
		</div>
		<br> </br>

					<table border="1" cellpadding="10" cellspacing="0" id="tb">
					<tr>
							<td align="center"><b>ID_Koncentratora</b></td> <td align="center"><b>Imie</b></td> <td align="center"><b>Nazwisko</b></td>
							<td align="center"><b>Data_od</b></td> <td align="center"><b>Data_do</b></td> <td align="center"><b>Pesel</b></td> <td align="center"><b>Okres_wypo</b></td> <td align="center"><b>Cena</b></td> <td align="center"><b>Uwagi</b></td> 
					</tr>
		<?php while($wiersz2 = $rezultat2->fetch_assoc()) :?>
		<?php $date = date('d-m-Y',strtotime($wiersz2['Data_od'])); $last_day = date('d',strtotime($wiersz2['Data_od'])) - 1;?>
					<tr>
							<td><?=$wiersz2['ID_Koncentratora']?></td> <td align="center"><?=$wiersz2['Imie']?></td>
							<td align="center"><?=$wiersz2['Nazwisko']?></td> <td align="center"><?=$date?></td>
							<?php if($last_day - date('d') <=constant("WARNING") && $last_day - date('d') >=0 ) :?>
								  <td align="center" bgcolor="red"><?=$last_day?><?="-"?><?=date('m-Y')?></td>
							<?php else :?>
								  <td align="center"><?=$last_day?><?="-"?><?=date('m-Y')?></td>
							<?php endif; ?>
							<td align="center"><?=$wiersz2['Pesel']?></td>  <td align="center"><?=$wiersz2['Okres_wypo']?></td> <td align="center"><?=$wiersz2['Cena']?></td>  <td align="center"><?=$wiersz2['Uwagi']?></td>
					</tr>				
					
		<?php endwhile ;?>
					</table>
		</div>
	<?php endif;?>
	<?php if($rezultat3) : ?>
	<div id="logo">
		<div class="Dokument">
				<a >Piotr, wypożyczone: <?=$ile_wypo3?>, zarobek/msc(chwilowy w dany dzień): <?=$zarobek_Piotr?> zł</a>
		</div>
		<br> </br>

					<table border="1" cellpadding="10" cellspacing="0" id="tb">
					<tr>
							<td align="center"><b>ID_Koncentratora</b></td> <td align="center"><b>Imie</b></td> <td align="center"><b>Nazwisko</b></td>
							<td align="center"><b>Data_od</b></td> <td align="center"><b>Data_do</b></td> <td align="center"><b>Pesel</b></td> <td align="center"><b>Okres_wypo</b></td> <td align="center"><b>Cena</b></td> <td align="center"><b>Uwagi</b></td> 
					</tr>
		<?php while($wiersz3 = $rezultat3->fetch_assoc()) :?>
		<?php $date = date('d-m-Y',strtotime($wiersz3['Data_od'])); $last_day = date('d',strtotime($wiersz3['Data_od'])) - 1; ?>
					<tr>
							<td><?=$wiersz3['ID_Koncentratora']?></td> <td align="center"><?=$wiersz3['Imie']?></td>
							<td align="center"><?=$wiersz3['Nazwisko']?></td> <td align="center"><?=$date?></td>
							<?php if($last_day - date('d') <=constant("WARNING") && $last_day - date('d') >=0 ) :?>
								  <td align="center" bgcolor="red"><?=$last_day?><?="-"?><?=date('m-Y')?></td>
							<?php else :?>
								  <td align="center"><?=$last_day?><?="-"?><?=date('m-Y')?></td>
							<?php endif; ?>
							<td align="center"><?=$wiersz3['Pesel']?></td> <td align="center"><?=$wiersz3['Okres_wypo']?></td> <td align="center"><?=$wiersz3['Cena']?></td> <td align="center"><?=$wiersz3['Uwagi']?></td>
					</tr>				
					
		<?php endwhile ;?>
					</table>
	</div>	
	<?php endif ;?>
	<?php if($rezultat4) : ?>
	<div id="logo">
		<div class="Dokument">
				<a >Kik, wypożyczone: <?=$ile_wypo4?>, zarobek/msc(chwilowy w dany dzień): <?=$zarobek_Kik?> zł</a>
		</div>
		<br> </br>

					<table border="1" cellpadding="10" cellspacing="0" id="tb">
					<tr>
							<td align="center"><b>ID_Koncentratora</b></td> <td align="center"><b>Imie</b></td> <td align="center"><b>Nazwisko</b></td>
							<td align="center"><b>Data_od</b></td> <td align="center"><b>Data_do</b></td> <td align="center"><b>Pesel</b> <td align="center"><b>Okres_wypo</b></td> <td align="center"><b>Cena</b></td></td><td align="center"><b>Uwagi</b></td> 
					</tr>
		<?php while($wiersz4 = $rezultat4->fetch_assoc()) :?>
		<?php $date = date('d-m-Y',strtotime($wiersz4['Data_od'])); $last_day = date('d',strtotime($wiersz4['Data_od'])) - 1; ?>
					<tr>
							<td><?=$wiersz4['ID_Koncentratora']?></td> <td align="center"><?=$wiersz4['Imie']?></td>
							<td align="center"><?=$wiersz4['Nazwisko']?></td> <td align="center"><?=$date?></td>
							<?php if($last_day - date('d') <=constant("WARNING") && $last_day - date('d') >=0 ) :?>
								  <td align="center" bgcolor="red"><?=$last_day?><?="-"?><?=date('m-Y')?></td>
							<?php else :?>
								  <td align="center"><?=$last_day?><?="-"?><?=date('m-Y')?></td>
							<?php endif; ?>
							<td align="center"><?=$wiersz4['Pesel']?></td>  <td align="center"><?=$wiersz4['Okres_wypo']?></td> <td align="center"><?=$wiersz4['Cena']?></td> <td align="center"><?=$wiersz4['Uwagi']?></td>
					</tr>				
					
		<?php endwhile ;?>
					</table>
	</div>	
	<?php endif ;?>
	<?php if($rezultat5) : ?>
	<div id="logo">
		<div class="Dokument">
				<a >Wiki, wypożyczone: <?=$ile_wypo5?>, zarobek/msc(chwilowy w dany dzień): <?=$zarobek_Wiki?> zł</a>
		</div>
		<br> </br>

					<table border="1" cellpadding="10" cellspacing="0" id="tb">
					<tr>
							<td align="center"><b>ID_Koncentratora</b></td> <td align="center"><b>Imie</b></td> <td align="center"><b>Nazwisko</b></td>
							<td align="center"><b>Data_od</b></td> <td align="center"><b>Data_do</b></td> <td align="center"><b>Pesel</b></td> <td align="center"><b>Okres_wypo</b></td> <td align="center"><b>Cena</b></td><td align="center"><b>Uwagi</b></td> 
					</tr>
		<?php while($wiersz5 = $rezultat5->fetch_assoc()) :?>
		<?php $date = date('d-m-Y',strtotime($wiersz5['Data_od']));  $last_day = date('d',strtotime($wiersz5['Data_od'])) - 1;?>
					<tr>
							<td><?=$wiersz5['ID_Koncentratora']?></td> <td align="center"><?=$wiersz5['Imie']?></td>
							<td align="center"><?=$wiersz5['Nazwisko']?></td> <td align="center"><?=$date?></td>
							<?php if($last_day - date('d') <=constant("WARNING") && $last_day - date('d') >=0 ) :?>
								  <td align="center" bgcolor="red"><?=$last_day?><?="-"?><?=date('m-Y')?></td>
							<?php else :?>
								  <td align="center"><?=$last_day?><?="-"?><?=date('m-Y')?></td>
							<?php endif; ?>
							<td align="center"><?=$wiersz5['Pesel']?></td>  <td align="center"><?=$wiersz5['Okres_wypo']?></td> <td align="center"><?=$wiersz5['Cena']?></td> <td align="center"><?=$wiersz5['Uwagi']?></td>
					</tr>				
					
		<?php endwhile ;?>
					</table>
	</div>	
	<?php endif ;?>
	<?php else : ?>

		"Error2: ".<?=$polaczenie->connect_errno; ?>

	<?php endif ;?>

<?php endif ;?>
	 
	<?php @$polaczenie->close();?>

</body>
</html>

   
 
 