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
    $ID_nowy_k = $_SESSION['ID_nowe'];
    $Model_nowy_k = $_SESSION['Model_nowe'];
    $Kiedy_kupiony_nowy_k = $_SESSION['Kiedy_kupiony_nowe'];
    $Za_ile_nowy_k = $_SESSION['Za_ile_nowe'];
    $sql_zab_k = "SELECT koncentratory.ID_Koncentratora FROM koncentratory WHERE koncentratory.ID_Koncentratora = '$ID_nowy_k'";
    $sql_nowy_k = "INSERT INTO koncentratory (ID_Koncentratora, Model, Kiedy_kupiony,Za_ile) VALUES ('$ID_nowy_k', '$Model_nowy_k',
    '$Kiedy_kupiony_nowy_k', '$Za_ile_nowy_k')";
    $rezultat_k = $polaczenie->query($sql_zab_k);
    $wiersz_k = $rezultat_k->fetch_assoc();
    $ile_wierszy_k = $rezultat_k->num_rows;
    if($ile_wierszy_k>0)
    {
        $_SESSION['blad_k'] = '<span style="color:red"> Take urządzenie jest już w bazie!</span>';
        header('Location: Dodaj_K.php');
        exit();
        
    }  
    ?>
   <?php if($polaczenie->query($sql_nowy_k) == TRUE) :?>
        <div id="container_W">
				<div class="napis_koncowy_W">
					<h1>Dodano nowe urządzenie</h1>
					<div class="napis_K"><?=$ID_nowy_k?></div><div class="napis_K"><?=$Model_nowy_k?></div>
                    <div class="napis_K"><?=$Kiedy_kupiony_nowy_k?></div>
					<div class="napis_K"><?=$Za_ile_nowy_k?></div>
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
 unset($_SESSION['ID_nowe']);
 unset($_SESSION['Model_nowe']);
 unset($_SESSION['Kiedy_kupiony_nowe']);
 unset($_SESSION['Za_ile_nowe']);


$polaczenie->close();?>

</body>
</html>

   
 
 