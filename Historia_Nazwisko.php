<?php

session_start();

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
   <meta charset="utf-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Lato" rel="stylesheet">
   <link rel="stylesheet" href="style/style do bazy.css" type="text/css"/>
   <script src="JS/autoload_Nazw.js"></script>
   <title>Baza - testuje</title>
</head>
 
<body>

  <div id="naglowek">
     <div class="napis">
        <h1>Wpisz Nazwisko klienta:</h1>
     </div>
     <div class="form">
            <form action="HistoriaK_Nazwisko.php" method="post">
	                <br/><input type="text" name="Nazwisko" onkeyup = "load_dataID(this.value)" required class="wpisz"/> <br/>
                   <span id="search_result"></span>
                  <?php
                        if(isset($_SESSION['blad_klient']))
                        {
                          echo $_SESSION['blad_klient'];
                          unset($_SESSION['blad_klient']);
                        }
                        unset($_SESSION['blad_klient']);
                  ?>
	                <br></br>
	                <input type="submit" value="Pokaż historię" class="przycisk"/>
                  
	        </form>
     </div>
    </div>
<?php

if(isset($_SESSION['blad_klient']))
{
	echo $_SESSION['blad_klient'];
	unset($_SESSION['blad_klient']);
}
unset($_SESSION['blad_klient']);


?>


 
 
 </body>
 </html>