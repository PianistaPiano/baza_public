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
    $Imie_nowy_kl = $_SESSION['Imie_nowe'];
    $Nazwisko_nowy_kl = $_SESSION['Nazwisko_nowe'];
    $Pesel_nowy_kl = $_SESSION['Pesel_nowe'];
    $Telefon_nowy_kl = $_SESSION['Telefon_nowe'];
    $sql_nowy_kl = "INSERT INTO klienci (Imie, Nazwisko, Pesel,Telefon) VALUES ('$Imie_nowy_kl', '$Nazwisko_nowy_kl',
    '$Pesel_nowy_kl', '$Telefon_nowy_kl')";
    $sql_zab_kl = "SELECT * FROM klienci WHERE klienci.Pesel = '$Pesel_nowy_kl'";
    $rezultat_kl = $polaczenie->query($sql_zab_kl);
    $wiersz_kl = $rezultat_kl->fetch_assoc();
    $ile_wierszy_kl = $rezultat_kl->num_rows;
    if($ile_wierszy_kl>0)
    {
        $_SESSION['blad_kl'] = '<span style="color:red"> Klient o takim numerze pesel istnieje w bazie!</span>';
        header('Location: Dodaj_Kl.php');
        exit();
        
    }  
    ?>
   <?php if($polaczenie->query($sql_nowy_kl) == TRUE) :?>
        <div id="container_W">
				<div class="napis_koncowy_W">
					<h1>Dodano nowego klienta</h1>
					<div class="napis_K"><?=$Imie_nowy_kl?></div><div class="napis_K"><?=$Nazwisko_nowy_kl?></div>
                    <div class="napis_K"><?=$Pesel_nowy_kl?></div>
					<div class="napis_K"><?=$Telefon_nowy_kl?></div>
				</div>
					<img width="200" height="200" src="zdj/fajka.png" />
				<div class="powrot_glowna_W">
					<a href='index.php'>Powrót do strony głównej</a>
				</div>
                <div class="powrot_glowna_W">
					<a href='Cofnij_Klienta.php'>Cofnij klienta</a>
				</div>
			</div>	
		<?php else : ?>
			Error:.<br>.<?=$polaczenie->error?>
		<?php endif ; ?>

<?php 
unset($_SESSION['Imie_nowe']);
unset($_SESSION['Nazwisko_nowe']);
unset($_SESSION['Pesel_nowe']);
unset($_SESSION['Telefon_nowe']);

$polaczenie->close();?>

</body>
</html>

   
 
 