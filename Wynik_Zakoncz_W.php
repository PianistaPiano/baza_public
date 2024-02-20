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
    $ID_konc_Z = $_SESSION['ID_konc_Z'];
    $Data_zak = $_SESSION['Data_zak'];
    $Uwagi_zak = $_SESSION['Uwagi_zak'];
    $Aktualny_przebieg = $_SESSION['Aktualny_przebieg'];
    $sql_dane_K = "SELECT * FROM wypozyczenie_akt WHERE wypozyczenie_akt.ID_Koncentratora = '$ID_konc_Z'";
    $sql_ZAB = "SELECT * FROM koncentratory WHERE koncentratory.ID_Koncentratora = '$ID_konc_Z'";
    $rezultat_ZAB = $polaczenie->query($sql_ZAB);
    $ile_ZAB = $rezultat_ZAB->num_rows;
    $rezultat_dane_K = $polaczenie->query($sql_dane_K);
    $ile_akt =  $rezultat_dane_K->num_rows;
    if($ile_akt < 1)
    {
        $_SESSION['ile_ZAB'] = '<span style="color:red">Takie urządzenie nie jest wypożyczone! </span>';
        header('Location: Zakoncz_W.php');
        exit;
    }
    if($ile_ZAB == 0)
    {
        $_SESSION['ile_ZAB'] = '<span style="color:red">Nie ma takiego urządzenia! </span>';
        header('Location: Zakoncz_W.php');
        exit;
    }
    if($ile_akt == 1)
    {
        $rezultat_dane_K = $polaczenie->query($sql_dane_K);
        $wiersz_dane_k = $rezultat_dane_K->fetch_assoc();
        $Imie_Z = $wiersz_dane_k['Imie'];
        $Nazwisko_Z = $wiersz_dane_k['Nazwisko'];
        $Data_od_Z = $wiersz_dane_k['Data_od'];
        $Pesel_Z = $wiersz_dane_k['Pesel'];
        $Okres_wypo = $wiersz_dane_k['Okres_wypo'];
        $Cena = $wiersz_dane_k['Cena'];
        $sql_zak_W = "INSERT INTO wypozyczenie_zak (ID_Koncentratora, Imie, Nazwisko,Data_od,Data_do,Okres_wypo,Cena,Pesel,Uwagi)
        VALUES ('$ID_konc_Z', '$Imie_Z', '$Nazwisko_Z', '$Data_od_Z', '$Data_zak', '$Okres_wypo', '$Cena', '$Pesel_Z', '$Uwagi_zak')";
        if($polaczenie->query($sql_zak_W) == TRUE)
        {
            $sql_usun_W = "DELETE FROM wypozyczenie_akt WHERE wypozyczenie_akt.ID_Koncentratora = '$ID_konc_Z'"; 

            $sql = "UPDATE koncentratory SET Aktualny_przebieg = $Aktualny_przebieg WHERE ID_Koncentratora = '$ID_konc_Z'";
            $result = $polaczenie->query($sql);
            if(!$result)
            {
                echo("Error: ").$polaczenie->error;
            }

        }
        else
        {
            echo("Error: ").$polaczenie->error;
        }
    }
    else
    {
        echo("Error: ").$polaczenie->error;
    }
    
    ?>
   <?php if($polaczenie->query($sql_usun_W) == TRUE) :?>
        <div id="container_W">
				<div class="napis_koncowy_W">
					<h1>Zakończono wypożyczenie</h1>
					<div class="napis_K"><?=$ID_konc_Z?></div><div class="napis_K"><?=$Imie_Z?></div>
                    <div class="napis_K"><?=$Nazwisko_Z?></div>
					<div class="napis_K"><?=$Data_od_Z?></div>
                    <div class="napis_K"><?=$Data_zak?></div>
                    <div class="napis_K"><?=$Pesel_Z?></div>
				</div>
					<img width="200" height="200" src="zdj/fajka.png" />
				<div class="powrot_glowna_W">
					<a href='index.php'>Powrót do strony głównej</a>
				</div>
			</div>	
		<?php else : ?>
			Error:.<br>.<?=$polaczenie->error?>
		<?php endif ; ?>

<?php 
   unset($_SESSION['ID_konc_Z']);
   unset($_SESSION['Data_zak']);
   unset($_SESSION['Uwagi_zak']);
   unset($_SESSION['Aktualny_przebieg']);

$polaczenie->close();?>

</body>
</html>

   
 
 