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
    $ID_konc_L = $_SESSION['ID_konc_L'];
    $Data_L = $_SESSION['Data_L'];
    $Licznik_L = $_SESSION['Licznik_L'];
    $Uwagi_L = $_SESSION['Uwagi_L'];
    $sql_nowy_kl = "INSERT INTO licznik_od (ID_Koncentratora, Data_od, licznik,Uwagi) VALUES ('$ID_konc_L', '$Data_L',
    '$Licznik_L', '$Uwagi_L')";
    $sql_zab_L = "SELECT * FROM koncentratory WHERE koncentratory.ID_Koncentratora = '$ID_konc_L'";
    $rezultat_L = $polaczenie->query($sql_zab_L);
    $ile_wierszy_L = $rezultat_L->num_rows;
    if($ile_wierszy_L==0)
    {
        $_SESSION['blad_L'] = '<span style="color:red"> Takiego koncentratora nie ma w bazie!</span>';
        header('Location: Dodaj_L.php');
        
    }  
    ?>
   <?php if($polaczenie->query($sql_nowy_kl) == TRUE) :?>
        <div id="container_W">
				<div class="napis_koncowy_W">
					<h1>Dodano nowy licznik</h1>
					<div class="napis_K"><?=$ID_konc_L?></div><div class="napis_K"><?=$Data_L?></div>
                    <div class="napis_K"><?=$Licznik_L?></div>
					<div class="napis_K"><?=$Uwagi_L?></div>
				</div>
					<img width="200" height="200" src="zdj/fajka.png" />
				<div class="powrot_glowna_W">
					<a href='index.php'>Powrót do strony głównej</a>
				</div>
			</div>	
		<?php else : ?>
			Error:.<br>.<?=$polaczenie->error?>
		<?php endif ; ?>

<?php $polaczenie->close();?>

</body>
</html>

   
 
 