<?php

session_start();

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
   <meta charset="utf-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="style/style do bazy.css" type="text/css"/>
   <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Lato" rel="stylesheet">
   <title>Baza - testuje</title>
   <script src="JS/autoload_HistU.js"></script>
</head>
 
<body>

  <div id="naglowek">
     <div class="napis">
        <h1>Wpisz ID urządzenia:</h1>
     </div>
     <div class="form">
            <form action="ZakWypo_K.php" method="post">
	                <br/><input type="text" onkeyup="load_dataID(this.value)" name="ID_konc" required class="wpisz"/> <br/>
                   <span id="search_result"></span>
                  <?php
                        if(isset($_SESSION['blad_konc']))
                        {
                          echo $_SESSION['blad_konc'];
                          unset($_SESSION['blad_konc']);
                        }
                        unset($_SESSION['blad_konc']);
                  ?>
	                <br></br>
	                <input type="submit" value="Pokaż historię" class="przycisk"/>
                  
	        </form>
     </div>
    </div>
<?php

if(isset($_SESSION['blad_konc']))
{
	echo $_SESSION['blad_konc'];
	unset($_SESSION['blad_konc']);
}
unset($_SESSION['blad_konc']);


?>


 
 
 </body>
 </html>