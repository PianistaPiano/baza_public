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

<?php  if ($polaczenie->connect_errno!=0) : ?>
	 
		"Error: ".<?=$polaczenie->connect_errno; ?>
	 
	 <?php else :?>
	 
		 <?php $Nazwisko = $_POST['Nazwisko']; ?>
		 
					<?php	// do aktualnego wypo
							$sql_zab = "SELECT * FROM klienci WHERE klienci.Nazwisko = '$Nazwisko'";
							$rezultat_zab = $polaczenie->query($sql_zab);
							$ile_klientow = $rezultat_zab->num_rows;
					 ?>


			<?php if($ile_klientow>0) : ?>
			
   							<div id="tb">
            					<div id="logo"><h1>Podsumowanie historii</h2></div>
							</div>
					<?php while($wiersz = $rezultat_zab->fetch_assoc()) : ?>
						    <div id="naglowek_K">
								<div class="napis_K"><h1>Imie: </h1></div><div class="napis_K"><h1><?=$wiersz['Imie']?> </h1></div>
								<div class="napis_K"> <h1> Nazwisko: </h1></div><div class="napis_K"> <h1> <?=$wiersz['Nazwisko']?></h1></div>
								</br>
								<div class="napis_K"> <h1> Pesel: </h1></div><div class="napis_K"> <h1> <?=$wiersz['Pesel']?></h1></div>
								<div class="napis_K"> <h1> Telefon: </h1></div><div class="napis_K"> <h1> <?=$wiersz['Telefon']?></h1> </div>
								</br>
								<div class="napis_K"> <h1> Adres: </h1></div><div class="napis_K"> <h1> <?=$wiersz['Adres']?></h1> </div>
            					<div style="clear: both;"></div>
								<a href="index.php" class="napis_K">Powrót do strony głównej</a>
							</div>
							<?php
									// do aktualnego wypo
									$sql = "SELECT * FROM wypozyczenie_akt WHERE wypozyczenie_akt.Pesel = '$wiersz[Pesel]'";
									$rezultat = $polaczenie->query($sql);

								
									// do zak wypo
									$sql_Z = "SELECT * FROM wypozyczenie_zak WHERE wypozyczenie_zak.Pesel = '$wiersz[Pesel]'";
									$rezultat_Z = $polaczenie->query($sql_Z);
							?>
						<?php while($wiersz_1 = $rezultat->fetch_assoc()) : ?>	
						<div id="tb">
							<table border="1" cellpadding="10" cellspacing="0" class="table">
								
									<tr>
											<td colspan="2" align="center"><b>Aktualne wypożyczenie</b></td> 	
									</tr>                          
									<tr>
											<td>ID Urządzenia</td> <td align="center"><?=$wiersz_1['ID_Koncentratora']?></td>
									</tr>
									<tr>
											<td>Data od</td> <td align="center"><?=date('d-m-Y',strtotime($wiersz_1['Data_od']));?></td>
									</tr>
									<tr>
											<td>Uwagi</td> <td align="center"><?=$wiersz_1['Uwagi']?></td>
									</tr>
								
							</table>
						</div>
						<?php endwhile ; ?> 
						<?php while($wiersz_Z = $rezultat_Z->fetch_assoc()) : ?>
							<div id="tb">
									<table border="1" cellpadding="10" cellspacing="0" class="table">
								
										<tr>
											<td colspan="2" align="center"><b>Zakonczone wypożyczenie</b></td> 	
										</tr>                          
										<tr>
											<td>ID Urządzenia</td> <td align="center"><?=$wiersz_Z['ID_Koncentratora']?></td>
										</tr>
										<tr>
											<td>Data od</td> <td align="center"><?= date('d-m-Y',strtotime($wiersz_Z['Data_od']))?></td>
										</tr>
										<tr>
											<td>Data do</td> <td align="center"><?= date('d-m-Y',strtotime($wiersz_Z['Data_do']))?></td>
										</tr>
										<tr>
											<td>Uwagi</td> <td align="center"><?=$wiersz_Z['Uwagi']?></td>
										</tr>
								
								</table>
							</div>
					<?php endwhile ; ?> 
					<?php endwhile ; ?>
					
					<?php else : ?>
							<?php
									$_SESSION['blad_klient'] ='<span style="color:red"> Nie ma takiego klienta! </span>';
									header('Location: Historia_Nazwisko.php');
						    ?>
					<?php endif ;?>	 
			
		   
		   
		  
	
	<?php endif ;?>
	<?php @$polaczenie->close();?>

</body>
</html>

   
 
 