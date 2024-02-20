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
    $ID_konc_S = $_SESSION['ID_konc_S'];
    $Data_S = $_SESSION['Data_S'];
    $Licznik_S = $_SESSION['Licznik_S'];
    $Czego_S = $_SESSION['Czego_S'];
    $Uwagi_S = $_SESSION['Uwagi_S'];
    $sql_nowy_S = "INSERT INTO serwis (ID_Koncentratora, Data, licznik,Czego,Uwagi) VALUES ('$ID_konc_S', '$Data_S','$Licznik_S' ,'$Czego_S', '$Uwagi_S')";
    $sql_zab_S = "SELECT * FROM koncentratory WHERE koncentratory.ID_Koncentratora = '$ID_konc_S'";
    $rezultat_S = $polaczenie->query($sql_zab_S);
    $ile_wierszy_S = $rezultat_S->num_rows;
    if($ile_wierszy_S==0)
    {
        $_SESSION['blad_S'] = '<span style="color:red"> Takiego urządzenia nie ma w bazie!</span>';
        header('Location: Dodaj_S.php');
        
    }  
    ?>
   <?php if($polaczenie->query($sql_nowy_S) == TRUE) :?>
        <div id="container_W">
				<div class="napis_koncowy_W">
					<h1>Dodano nowy serwis</h1>
					<div class="napis_K"><?=$ID_konc_S?></div><div class="napis_K"><?=$Data_S?></div>
                    <div class="napis_K"><?=$Czego_S?></div>
					<div class="napis_K"><?=$Uwagi_S?></div>
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
 unset($_SESSION['ID_konc_S']);
 unset($_SESSION['Data_S']);
 unset($_SESSION['Licznik_S']);
 unset($_SESSION['Czego_S']);
 unset($_SESSION['Uwagi_S']);


$polaczenie->close();?>

</body>
</html>

   
 
 