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
   <link rel="stylesheet" href="style_do_bazy_2.css" type="text/css"/>
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
 $pesel = $_SESSION['Pesel'];
 $sql = "DELETE FROM wypozyczenie_akt WHERE Pesel = $pesel";
 $licznik = $_SESSION['Licznik'];
 $Data_od = $_SESSION['Data_od'];
 $ID_kon = $_SESSION['id_konc'];
 $sql_licz = "DELETE FROM licznik_od WHERE licznik = '$licznik' AND Data_od = '$Data_od' AND ID_Koncentratora = '$ID_kon'";
 ?>
<?php if( ($polaczenie->query($sql) == True) && ($polaczenie->query($sql_licz) == True)) : ?>
<div id=container_W>
    <div class="napis_koncowy_W">
    <h1>Cofnięto wypożyczenie</h1>
        <div class="powrot_glowna_W">
	      <a href='index.php'>Powrót do strony głównej</a>
        </div>
    </div>
</div>
 <?php else : ?>
     <?php echo "Error cofania: ".$polaczenie->error;?>
     <?php echo "Error cofania: ".$polaczenie_dwa->error;?>
<?php endif ; ?>
