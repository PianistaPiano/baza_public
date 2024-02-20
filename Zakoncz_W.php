<?php

session_start();

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
   <meta charset="utf-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
   integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
   <link rel="stylesheet" href="style/style_do_bazy_3.css" type="text/css"/>
   <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Lato" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="JS/autoload_ZakWypo.js"></script>
   <title>Baza - testuje</title>
</head>
 
<body>
  <div id="naglowek">
     <div class="napis">
        <h1>Wpisz ID koncentratora i datę zakończenia wypożyczenia</h1>
        </br>
        <div class="Dokument" style="text-align: center">
		<a href='index.php'>Powrót do strony głównej</a>
</div>
     </div>
     <div class="form">
            <form action="Upewnij_Zakoncz_W.php" method="post">
                  <div class="wpisz_Z_W"> ID Urządzenia</div>
	                <br/><input type="text" name="ID_konc_Z" onkeyup="load_dataID(this.value)" value="<?php if(isset($_SESSION['ID_konc_Z']))
                   {
                      echo $_SESSION['ID_konc_Z'];
                      unset($_SESSION['ID_konc_Z']);
                   }
                   ?>"required class="wpisz"/> <br/>
                   <span id="search_result"></span>  
                  <?php
                        if(isset($_SESSION['ile_ZAB']))
                        {
                          echo $_SESSION['ile_ZAB'];
                          unset($_SESSION['ile_ZAB']);
                        }
                        unset($_SESSION['ile_ZAB']);
                   ?>
                  </br>
                  <div class="wpisz_Z_W"> Data zakończenia(Rok-Miesiąc-Dzień)</div>
                  <br/><input type="text" name="Data_zak" value="<?php if(isset($_SESSION['Data_zak']))
                  {
                     echo $_SESSION['Data_zak'];
                     unset($_SESSION['Data_zak']);
                  } 
                  ?>" required class="wpisz"/> <br/>
                   <div class="wpisz_Z_W"> Uwagi</div>
                  <br/><input type="text" name="Uwagi_zak" value="<?php if(isset($_SESSION['Uwagi_zak']))
                  {
                     echo $_SESSION['Uwagi_zak'];
                     unset($_SESSION['Uwagi_zak']);
                  } 
                  ?>" required class="wpisz"/> <br/>

                  <div class="wpisz_Z_W"> Aktualny_przebieg </div> 
                  <br/><input type="text" name="Aktualny_przebieg" value="<?php if(isset($_SESSION['Aktualny_przebieg']))
                  {
                     echo $_SESSION['Aktualny_przebieg'];
                     unset($_SESSION['Aktualny_przebieg']);
                  } 
                  ?>" required class="wpisz"/> <br/>
                  <?php
                       /* if(isset($_SESSION['blad_konc']))
                        {
                          echo $_SESSION['blad_konc'];
                          unset($_SESSION['blad_konc']);
                        }
                        unset($_SESSION['blad_konc']);*/
                  ?>
	                <br></br>
	                <input type="submit" value="Zakończ wypożyczenie" class="przycisk"/>
                  
	        </form>
     </div>
    </div>


 
 
 </body>
 </html>