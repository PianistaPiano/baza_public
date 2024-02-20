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
    $ID_Kon_S = $_SESSION['ID_Kon_S'];
    $Data_S = $_SESSION['Data_S'];
    $Za_ile_S = $_SESSION['Za_ile_S'];
    $Uwagi_S = $_SESSION['Uwagi_S'];
    $sql_check = "SELECT ID_Koncentratora FROM sprzedane WHERE ID_Koncentratora = '$ID_Kon_S'";
    $result_check = $polaczenie->query($sql_check);
    $ile_check = $result_check->num_rows;
    $sql_nowy_S = "INSERT INTO sprzedane (ID_Koncentratora, Data, Za_ile,Uwagi) VALUES ('$ID_Kon_S', '$Data_S',
    '$Za_ile_S', '$Uwagi_S')";
    $sql_zab_S = "SELECT * FROM koncentratory WHERE koncentratory.ID_Koncentratora = '$ID_Kon_S'";
    $rezultat_S = $polaczenie->query($sql_zab_S);
    $wiersz_S = $rezultat_S->fetch_assoc();
    $ile_wierszy_S = $rezultat_S->num_rows;
    if($ile_check > 0)
    {
        $_SESSION['blad_Sp'] = '<span style="color:red"> Takie urządzenie jest już sprzedane!</span>';
        header('Location: Dodaj_Sprzedane.php');
        exit();
    }
    if($ile_wierszy_S=0)
    {
        $_SESSION['blad_Sp'] = '<span style="color:red"> Takie urządzenie nie jest w bazie!</span>';
        header('Location: Dodaj_Sprzedane.php');
        exit();
        
    }  
    ?>
   <?php if($polaczenie->query($sql_nowy_S) == TRUE) :?>
        <div id="container_W">
				<div class="napis_koncowy_W">
					<h1>Dodano nową sprzedaż</h1>
					<div class="napis_K"><?=$ID_Kon_S?></div><div class="napis_K"><?=$Data_S?></div>
                    <div class="napis_K"><?=$Za_ile_S?></div>
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
 unset($_SESSION['ID_Kon_S']);
 unset($_SESSION['Data_S']);
 unset($_SESSION['Za_ile_S']);
 unset($_SESSION['Uwagi_S']);

$polaczenie->close();?>

</body>
</html>

   
 
 