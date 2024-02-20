<?php

session_start();
if( isset($_SESSION['id_konc']))
{
	$_POST['ID_konc'] = $_SESSION['id_konc'];
	unset($_SESSION['id_konc']);
}
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
	 
		 <?php $id_konc = $_POST['ID_konc']; $_SESSION['id_konc'] = $id_konc?>
		 <?php if(isset($id_konc)) :?>
		 
					<?php	// do aktualnego wypo
							$sql_naglowek = "SELECT koncentratory.Model, koncentratory.is_ok, koncentratory.Aktualny_przebieg FROM koncentratory WHERE ID_Koncentratora = '$id_konc'";
							$sql = "SELECT koncentratory.ID_Koncentratora,wypozyczenie_akt.Nazwisko,wypozyczenie_akt.Data_od,
							wypozyczenie_akt.Imie, wypozyczenie_akt.Uwagi
							FROM koncentratory INNER JOIN wypozyczenie_akt ON koncentratory.ID_Koncentratora = wypozyczenie_akt.ID_Koncentratora
							WHERE koncentratory.ID_Koncentratora = '$id_konc'";
							$sql_zabezpieczenie = "SELECT * FROM koncentratory WHERE ID_Koncentratora = '$id_konc'";
							$rezultat_zabezpieczenie = $polaczenie->query($sql_zabezpieczenie);
							$ile_konc = $rezultat_zabezpieczenie->num_rows;
							$rezultat_naglowek = $polaczenie->query($sql_naglowek);
							$wiersz_naglowek = $rezultat_naglowek->fetch_assoc();
							$model_naglowek = $wiersz_naglowek['Model'];
							$is_ok_naglowek = $wiersz_naglowek['is_ok'];
							$Aktualny_przebieg = $wiersz_naglowek['Aktualny_przebieg'];;
							$sql_kasa = "SELECT koncentratory.Kiedy_kupiony,koncentratory.Za_ile FROM koncentratory WHERE
							koncentratory.ID_Koncentratora = '$id_konc'";
							$rezultat_kasa = $polaczenie->query($sql_kasa);
							$wiersz_kasa = $rezultat_kasa ->fetch_assoc();
							$Kiedy_kupiony = date('d-m-Y',strtotime($wiersz_kasa['Kiedy_kupiony']));
							$Za_ile = $wiersz_kasa['Za_ile'];
							 ?>


			<?php if($ile_konc>0) : ?>
			
		
					<?php if($rezultat = $polaczenie->query($sql)) : ?>
					
				
						  <?php
								  if($rezultat->num_rows!=0)
								  {
									$wiersz = $rezultat->fetch_assoc();
									$Imie = $wiersz['Imie'];
									$nazwisko = $wiersz['Nazwisko'];
									$data_od = date('d-m-Y',strtotime($wiersz['Data_od']));
									$Uwagi = $wiersz['Uwagi'];
									$sql_telefon = "SELECT klienci.Telefon FROM klienci WHERE klienci.Imie = '$Imie' AND klienci.Nazwisko = '$nazwisko'";
									$rezultat_telefon = $polaczenie->query($sql_telefon);
									$wiersz_telefon = $rezultat_telefon->fetch_assoc();
									$telefon = $wiersz_telefon['Telefon'];
								  } 
								  else
								  {
									$Imie = "";
									$nazwisko = "";
									$data_od = "";
									$Uwagi = "";
									$telefon = "";
								  }	
						  ?>
				

   
   							<div id="tb">
            					<div id="logo"><h1>Podsumowanie historii</h2></div>
							</div>
						    <div id="naglowek_K">
								<div class="napis_K"><h1>ID Urządzenia: </h1></div><div class="napis_K"><h1><?=$id_konc?> </h1></div>
								<div class="napis_K"> <h1> Model: </h1></div><div class="napis_K"> <h1> <?=$model_naglowek?></h1></div>
								</br>
								<div class="napis_K"> <h1> Kiedy kupiony: </h1></div><div class="napis_K"> <h1> <?=$Kiedy_kupiony?></h1></div>
								<div class="napis_K"> <h1> Za ile: </h1></div><div class="napis_K"> <h1> <?=$Za_ile?></h1> </div>
								</br>
								<div class="napis_K"> <h1> Przebieg: </h1></div><div class="napis_K"> <h1> <?=$Aktualny_przebieg?></h1> </div>
            					<div style="clear: both;"></div>
								<a href="index.php" class="napis_K">Powrót do strony głównej</a></br>
								<form action="is_ok.php" method="post">
								<input type="checkbox" style="width: 20px; height: 20px;" name="is_ok" id="is_ok">
								<label for="is_ok">Czy gotowy do wypożyczenia?</label></br>
								Opis: <input type="text" name="O2_PSI" required> </br> </br>
								<input type="submit" value="Zapisz gotowość">
								</form></br>
								<?php if($is_ok_naglowek == 1) :?>
									Aktualnie zapisany jako gotowy
								<?php else :?>
									Aktualnie zapisany jako nie gotowy
								<?php endif ;?>
								<?php if (isset($_SESSION['success'])) :?>
										<h4 style="color: red;"><?=$_SESSION['success']?></h4>
								<?php endif; unset($_SESSION['success']);?>
							</div>
							</br>
						<div id="tb">
							<table border="1" cellpadding="10" cellspacing="0" class="table">
								
									<tr>
											<td colspan="2" align="center"><b>Aktualne wypożyczenie</b></td> 	
									</tr>                          
									<tr>
											<td>Wypozyczony przez</td> <td align="center"><?=$Imie?> <?=$nazwisko?></td>
									</tr>
									<tr>
											<td>Data od</td> <td align="center"><?=$data_od?></td>
									</tr>
									<tr>
											<td>Uwagi</td> <td align="center"><?=$Uwagi?></td>
									</tr>
									<tr>
											<td>Telefon</td> <td align="center"><?=$telefon?></td>
									</tr>
								
							</table>
						</div>
						
					
					<?php else : ?>
					
							echo "nie wszedlem do ifa";
					<?php endif ;?>	 
					
						<?php 	// do zakonczonego wypo
							//$sql_dwa = "SELECT Count(zakonczonewypo.ID_Koncentratora) AS Ile_razy FROM zakonczonewypo GROUP BY 
										//zakonczonewypo.ID_Koncentratora HAVING zakonczonewypo.ID_Koncentratora = '$id_konc'";
								$sql_dwa = "SELECT koncentratory.ID_Koncentratora,Count(wypozyczenie_zak.ID_Koncentratora) AS Ile_razy
								FROM koncentratory INNER JOIN wypozyczenie_zak ON koncentratory.ID_Koncentratora = wypozyczenie_zak.ID_Koncentratora
								GROUP BY koncentratory.ID_Koncentratora HAVING koncentratory.ID_Koncentratora = '$id_konc'";
							//$sql_trzy = "SELECT  zakonczonewypo.Data_do,zakonczonewypo.Nazwisko FROM zakonczonewypo WHERE zakonczonewypo.ID_Koncentratora = '$id_konc' 
							//ORDER BY (zakonczonewypo.Data_do)  DESC";
							$sql_trzy = "SELECT * FROM koncentratory INNER JOIN wypozyczenie_zak ON koncentratory.ID_Koncentratora = wypozyczenie_zak.ID_Koncentratora
							WHERE koncentratory.ID_Koncentratora = '$id_konc'  ORDER BY wypozyczenie_zak.Data_do DESC"; 
								
						?>
							
			<!--UPDATE wypozyczenie_akt SET Uwagi = 'M' WHERE ID_Koncentratora = 'H72293KS'
			UPDATE licznik_od SET Data_od = '2019-08-10' WHERE ID_Koncentratora = 'F609573KS',
			2019-08-10-->
				<?php if($rezultat_dwa =  @$polaczenie->query($sql_dwa)) : ?>
				
				
					<?php  
						if($rezultat_dwa->num_rows!=0)
						{
							$wiersz_dwa = $rezultat_dwa->fetch_assoc();
							$ile_razy = $wiersz_dwa['Ile_razy'];
							/*$model_dwa = $wiersz_dwa['Model'];
							$nazwisko_dwa = $wiersz_dwa['Nazwisko'];
							$data_od_dwa = $wiersz_dwa['Data_od'];
							$data_do = $wiersz_dwa['Data_do'];*/
						}
						else
						{
							$ile_razy= "";
						}
					?>		
                            <?php if($rezultat_trzy = $polaczenie->query($sql_trzy)) : ?>
							
							<?php 	
								if($rezultat_trzy->num_rows!=0)
								{
									$wiersz_trzy = $rezultat_trzy->fetch_assoc();
									$Imie_trzy = $wiersz_trzy['Imie'];
									$ostatnio_oddany = date('d-m-Y',strtotime($wiersz_trzy['Data_do']));
									$nazwisko_trzy = $wiersz_trzy['Nazwisko'];
									$model_trzy = $wiersz_trzy['Model']; 
									$sql_tel_trzy = "SELECT klienci.Telefon FROM klienci WHERE klienci.Imie = '$Imie_trzy'
									AND klienci.Nazwisko = '$nazwisko_trzy'";
									$rezultat_tel_trzy = $polaczenie->query($sql_tel_trzy);
									$wiersz_tel_trzy = $rezultat_tel_trzy->fetch_assoc();
									$telefon_trzy = $wiersz_tel_trzy['Telefon'];
								}
								else
								{
									$Imie_trzy = "";
									$ostatnio_oddany = "";
									$nazwisko_trzy = "";
									$model_trzy = ""; 
									$telefon_trzy = "";
								}		
							?>
							
							<?php else : ?>
							
							  nie wszedlem do ifa 3
							<?php endif ;?>

				<div id="tb">
					<table border="1" cellpadding="10" cellspacing="0" class="table">
					<tr>
							<td colspan="2" align="center"><b>Zakończone wypożyczenie</b></td> 
					</tr>
					<tr>
							<td>Wypozyczony był</td> <td align="center"><?=$ile_razy?> raz(y)</td>
					</tr>
					<tr>
							<td>Ostatnio oddany</td> <td align="center"><?=$ostatnio_oddany?></td>
					</tr>
					<tr>
							<td>Oddany przez</td>  <td align="center"><?=$Imie_trzy?> <?=$nazwisko_trzy?></td>
					</tr>
					<tr>
							<td>Telefon</td>  <td align="center"><?=$telefon_trzy?></td>
					</tr>
						</table>
				</div>
				
				<?php else : ?>
				
						echo "nie wszedlem do ifa 2";
				 <?php endif ;?>
				<?php // do serwisu
				 $sql_cztery = "SELECT * FROM koncentratory INNER JOIN serwis ON koncentratory.ID_Koncentratora = serwis.ID_Koncentratora
				 WHERE koncentratory.ID_Koncentratora= '$id_konc' ORDER BY Data DESC"; ?>
				 	<?php if($rezultat_cztery = @$polaczenie->query($sql_cztery)) : ?>
				 	
						 <?php//echo "$wiersz_cztery";
					 //print_r($wiersz_cztery); ?>
					<div id="tb">
						 <table border="1" cellpadding="10" cellspacing="0" class="table">
							<tr>
								<td  align="center"><b>Serwis</b></td> <td  align="center"><b>Uwagi</b></td> <td  align="center"><b>Licznik</b></td> <td  align="center"><b>Data</b></td>
							</tr>
						 <?php while($row = $rezultat_cztery->fetch_assoc()) : ?>
							<tr>
							<?php
							  $data_ser = date('d-m-Y',strtotime($row['Data']))
							?>
								<td align="center"><?=$row['Czego']?></td> <td align="center"><?=$row['Uwagi']?></td> <td align="center"><?=$row['licznik']?></td> <td align="center"><?=$data_ser?></td> 
							</tr>
						 <?php endwhile ;?>
               			    </table>
					</div>
					 
					<?php else : ?>
					
						echo "nie wszdlem do ifa 4";
					<?php endif ;?>
				<?php //licznik_od
					$sql_pięć = "SELECT licznik_od.Data_od, licznik_od.licznik FROM koncentratory INNER JOIN licznik_od ON
					koncentratory.ID_Koncentratora = licznik_od.ID_Koncentratora WHERE koncentratory.ID_Koncentratora = '$id_konc' ORDER BY licznik_od.Data_od DESC";?>
				<?php if($rezultat_pięć = @$polaczenie->query($sql_pięć)) : ?>

						<div id="tb">
							<table border="1"  class="table">
								<tr>
									<td colspan="2" align="center" ><b>Licznik</b></td>
								</tr>
						<?php while($row_dwa= $rezultat_pięć->fetch_assoc()) : ?>
								<tr>
										<?php
							  			$data_licz = date('d-m-Y',strtotime($row_dwa['Data_od']))
										?>
									<td align="center"><?=$row_dwa['licznik']?></td> <td align="center"><?=$data_licz?> </td>
								</tr>
						<?php endwhile ;?>
						</div>
				<?php else :?>
					nie wszedlem do ifa 5
				<?php endif ;?>
				
				
			<?php else :
			
				$_SESSION['blad_konc'] ='<span style="color:red"> Nie ma takiego koncentratora! </span>';
				header('Location: HistoriaID_K.php');
				
			 endif ;?>
		   
		   
		  <?php endif ; ?>
	
	<?php endif ;?>
	
    
  
		 
		 
	 
	<?php @$polaczenie->close();?>

</body>
</html>

   
 
 