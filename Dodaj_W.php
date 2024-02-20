<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
   <meta charset="utf-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
   <title>Baza - testuje</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="style/style_do_bazy_W.css" type="text/css">
   <link rel="stylesheet" href="style/style_do_bazy_2.css" type="text/css"/>
   <script src="JS/autoload.js"></script> 
   <script src="JS/autoload_ID.js"></script> 
</head>



<body>
<?php require_once "connect.php";

$polaczenie =  @new mysqli($host,$db_user,$db_password,$db_name); ?>

<div id="napis">
	<h1> Wpisz dane nowego wypożyczenia</h1>
</div>
<div class="Dokument" style="text-align: center">
		<a href='index.php'>Powrót do strony głównej</a>
</div>
</br>
<div id="kontener">     
	   <span id="search_result"></span>                     
	   <div class="indeks_W"> Imie </div>
	   <div class="indeks_W"> Nazwisko </div>
	   <div class="indeks_W"> Telefon </div>
	   <div class="indeks_Ad"> Adres </div>
	   <!--<div class="indeks_W"> Adres </div>-->

   <form action="Wynik_Dodaj_W.php" method="post" id="new_wypo">
	   <input type="text" name="Imie" required value="<?php if(isset($_SESSION['Imie']))
	   {
		   echo $_SESSION['Imie'];
		   unset($_SESSION['Imie']);
	   }?>" class="okno_W">
	  
	   <input type="text" name="Nazwisko" onkeyup="load_data(this.value)" required value="<?php if(isset($_SESSION['Nazwisko']))
	 	{
			echo $_SESSION['Nazwisko'];
			unset($_SESSION['Nazwisko']);
		}?>" class="okno_W">
		<input type="text" name="nr_tel"  value="<?php if(isset($_SESSION['nr_tel']))
	   		{
				echo $_SESSION['nr_tel'];
				unset($_SESSION['nr_tel']);
			}
			?>" class="okno_W">
		<input type="text" name="Adres" value="<?php if(isset($_SESSION['Adres']))
	   		{
				echo $_SESSION['Adres'];
				unset($_SESSION['Adres']);
			}
			?>" class="Adres"> 	 

		<div class="indeks_W"> Pesel </div>
		<div class="indeks_W"> Seria dowodu </div>
		<div class="indeks_W"> Numer dowodu </div>
		<div class="indeks_W"> Data_od </div>
		<div class="indeks_W"> Data_do </div>
		<input type="text" name="Pesel" required value="<?php if(isset($_SESSION['Pesel']))
			{
				echo $_SESSION['Pesel'];
				unset($_SESSION['Pesel']);
			}?>" class="okno_W">
		<input type="text" name="Seria_dowodu" value="<?php if(isset($_SESSION['Seria_dowodu']))
			{
				echo $_SESSION['Seria_dowodu'];
				unset($_SESSION['Seria_dowodu']);
			}
			?>" class="okno_W">
	 	<input type="text" name="Numer_dowodu" value="<?php if(isset($_SESSION['Numer_dowodu']))
	   		{
				echo $_SESSION['Numer_dowodu'];
				unset($_SESSION['Numer_dowodu']);
			}
			?>" class="okno_W">
		<input type="text" name="Data_od" required value="<?php if(isset($_SESSION['Data_od']))
			{
				echo $_SESSION['Data_od'];
				unset($_SESSION['Data_od']);
			} ?>" class="okno_W">
		<input type="text" name="Data_do" value="<?php if(isset($_SESSION['Data_do']))
	   		{
				echo $_SESSION['Data_do'];
				unset($_SESSION['Data_do']);
			}
			?>" class="okno_W">

		<div class="indeks_W"> ID_Urządzenia </div>
		<div class="indeks_W"> Producent - Model </div>
		<div class="indeks_W"> Licznik </div>
		<div class="indeks_W"> Tlen/Opis </div>
		<div class="indeks_W"> Uwagi </div>	
		<input type="text" name="ID_konc" onkeyup="load_dataID(this.value)" required value="<?php if(isset($_SESSION['id_konc']))
	   		{
				echo $_SESSION['id_konc'];
				unset($_SESSION['id_konc']);
			}
			?>" class="okno_W">
		<input type="text" name="Model"  value="<?php if(isset($_SESSION['Model']))
	   		{
				echo $_SESSION['Model'];
				unset($_SESSION['Model']);
			}
     		?>" class="okno_W">
		<input type="text" name="Licznik" required value="<?php if(isset($_SESSION['Licznik']))
			{
				echo $_SESSION['Licznik'];
				unset($_SESSION['Licznik']);
			}  ?>" class="okno_W">	
		<input type="text" name="tlen" value="<?php if(isset($_SESSION['tlen']))
	   		{
				echo $_SESSION['tlen'];
				unset($_SESSION['tlen']);
			}
			?>" class="okno_W">
		<input type="text" name="Uwagi" value="<?php if(isset($_SESSION['Uwagi']))
			{
				echo $_SESSION['Uwagi'];
				unset($_SESSION['Uwagi']);
			}  ?>" class="okno_W">

		<div class="indeks_W"> Okres wypo </div>
		<div class="indeks_W"> Cena </div>	
		<div class="indeks_W"> not used </div>
		<div class="indeks_W"> not used </div>
		<div class="indeks_W"> not used </div>
		<select name="Okres_wypo" id="Okres_wypo" required form="new_wypo" class="okno_kl">
			<option value="miesiac">Miesiąc</option>
			<option value="tydzien">Tydzień</option>
			<option value="specyficzny">Specyficzny</option>
		</select>
		<input type="text" name="Cena" required value="<?php if(isset($_SESSION['Cena']))
			{
				echo $_SESSION['Cena'];
				unset($_SESSION['Cena']);
			}  ?>" class="okno_W">
		<input type="text" name="none" value="" class="okno_W">
		<input type="text" name="none" value="" class="okno_W">
		<input type="text" name="none" value="" class="okno_W">

		<span id="search_result2"></span>
		<input type="submit" value="Dodaj wypożyczenie" class="przycisk">
		</br>
		<div style="align: center">
			<?php 
				if(isset($_SESSION['blad_D_W']))
				{
					echo $_SESSION['blad_D_W'];
					unset($_SESSION['blad_D_W']);
					
				}
				if(isset($_SESSION['blad_D_W_pow']))
					{
						echo $_SESSION['blad_D_W_pow'];
						unset($_SESSION['blad_D_W_pow']);
					}
				if(isset($_SESSION['blad_K_J']))
				{
					echo $_SESSION['blad_K_J'];
					unset($_SESSION['blad_K_J']);
				}
				unset($_SESSION['blad_D_W']);
				unset($_SESSION['blad_D_W_pow']);
				unset($_SESSION['blad_K_J']);
			?>
		</div>

    				
</div> <!--end kontener-->
	</form>
	</br>
	<div style="text-align: center">Specyficzny okres wypożyczenia nie jest brany pod uwagę do wyliczeń przychodu miesięcznego </div>
	<div style="text-align: center">W liczniku nie trzeba dodawać "h", w tlenie podać wszystko np 5L/94,0%, jeżeli firma to w nazwisko nazwa a w imie Sp. z.o.o. a w pesel nip bez kresek. </div>
</div>

<?php $polaczenie->close();?>

</body>
</html>

   
 
 