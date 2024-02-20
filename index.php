<!DOCTYPE HTML>
<html lang="pl">
<head>
   <meta charset="utf-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
   <title>Baza - testuje</title>
   <link rel="stylesheet" href="style/style do bazy.css" type="text/css"/>
   <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Lato" rel="stylesheet">
</head>
 
<body>

    <div id="container">
        <div class="rectangle">
            <div id="logo"><img src="zdj/logo.png"/></div>
            <div style="clear: both;"></div>
        </div>
        <div class="square">
            <div class="tile1"><h1>Co chcesz zrobić?</h1></div>
            <div class="tile2"> 
                <a href="Dodaj_Kl.php" class="tilelink"><h1>Dodaj klienta</h1></a>
            </div> 
            <div class="tile2">
                <a href="Dodaj_W.php" class="tilelink"><h1>Dodaj wypożyczenie</h1></a>
            </div>
            <div class="tile2">
                <a href="Zakoncz_W.php" class="tilelink"><h1>Zakończ wypożyczenie</h1></a>
            </div>
            <div class="tile2"> 
                <a href="Aktualne_Wypo.php" class="tilelink"><h1>Aktualne wypożyczenia</h1></a>
            </div>
            <div class="tile2">
                <a href="HistoriaID_K.php" class="tilelink"><h1>Historia urządzenia</h1></a>
            </div>
            <div class="tile2">
                <a href="Dodaj_K.php" class="tilelink"><h1>Dodaj urządzenie</h1></a>
            </div>
            <div class="tile2"> 
                <a href="Historia_Nazwisko.php" class="tilelink"><h1>Szukaj po nazwisku</h1></a>
            </div>
            <div class="tile2">
                <a href="Dodaj_S.php" class="tilelink"><h1>Dodaj serwis</h1></a>
            </div>
            <div class="tile2"> 
                <a href="Dodaj_Sprzedane.php" class="tilelink"><h1>Dodaj do sprzedanych</h1></a>
            </div>
            <div class="tile2"> 
                <a href="Dodaj_Uwage.php" class="tilelink"><h1>Dodaj Uwagę</h1></a>
            </div>
            <div class="tile2"> 
                <a href="Usun_Uwage.php" class="tilelink"><h1>Usuń Uwagę</h1></a>
            </div>
            <div class="tile2"> 
                <a href="Dostepne_Koncentratory.php" class="tilelink"><h1>Dostępne Urządzenia</h1></a>
            </div>
            <div class="tile2"> 
                <a href="chart.php" class="tilelink"><h1>Wykresy</h1></a>
            </div>
            <div class="tile2"> 
                <a href="Dodaj_Klase.php" class="tilelink"><h1>Dodaj klasę</h1></a>
            </div>
            <div class="tile2"> 
                <a href="Zak_WypoID_K.php" class="tilelink"><h1>Zakończone Wypożyczenie</h1></a>
            </div>
        </div>  

    </div>
    <?php
    session_start();
      if(isset($_SESSION['id_konc']))
      { 
          unset($_SESSION['id_konc']);
      }
      if(isset($_SESSION['Imie']))
      {
          unset($_SESSION['Imie']);
      }
      if(isset($_SESSION['Nazwisko']))
      {
          unset($_SESSION['Nazwisko']);
      }
      if(isset($_SESSION['Data_od']))
      { 
          unset($_SESSION['Data_od']);
      }
      if(isset($_SESSION['Pesel']))
      {
          unset($_SESSION['Pesel']);
      }
      if(isset($_SESSION['Uwagi']))
      { 
          unset($_SESSION['Uwagi']);
      }
      if(isset($_SESSION['nr_tel']))
	  {	
         unset($_SESSION['nr_tel']);
      }
      if(isset($_SESSION['Adres']))
	  {
         unset($_SESSION['Adres']); 
      }
      if(isset($_SESSION['Seria_dowodu']))
      {		
		unset($_SESSION['Seria_dowodu']);
      }
      if(isset($_SESSION['Numer_dowodu']))
      {
        unset($_SESSION['Numer_dowodu']);
      }
      if(isset($_SESSION['Data_do']))
      {		
		unset($_SESSION['Data_do']);
      }
     if(isset($_SESSION['Model']))
	 {			
		unset($_SESSION['Model']);
     }
     if(isset($_SESSION['Licznik']))
	 {
	    unset($_SESSION['Licznik']);
     } 
     if(isset($_SESSION['tlen']))
	 {
        unset($_SESSION['tlen']);
     }
     if(isset($_SESSION['klasa']))
     {
        unset($_SESSION['klasa']);
     }
     if(isset($_SESSION['Okres_wypo']))
     {
        unset($_SESSION['Okres_wypo']);
     }
     if(isset($_SESSION['Cena']))
     {
        unset($_SESSION['Cena']);
     }
      ?>
 </body>
 </html>