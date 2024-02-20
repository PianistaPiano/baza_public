<?php
session_start();
require_once 'vendor/autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$data = date('d.m.Y',strtotime($_SESSION['Data_od']));
$Imie = $_SESSION['Imie'];
$Nazwisko = $_SESSION['Nazwisko'];
$Person = "$Nazwisko $Imie";
$tel = $_SESSION['nr_tel'];
$Seria_dowodu = $_SESSION['Seria_dowodu'];
$Numer_dowodu = $_SESSION['Numer_dowodu'];
$Pesel = $_SESSION['Pesel'];
$Adres = $_SESSION['Adres'];
$Model = $_SESSION['Model'];
$ID = $_SESSION['id_konc'];
$Licznik_od = $_SESSION['Licznik'];
$Tlen = $_SESSION['tlen'];
$Data_do = date('d.m.Y',strtotime($_SESSION['Data_do']));
$klasa = $_SESSION['klasa'];
//===================================== 



//  umowa nie podlega udostępnieniu

//====================================
$data = date('Y.m.d',strtotime($data));                                                                                             
$path_1 = 'C:\Users';
$path_2 = '\\'.$data." ".$Person." Umowa koncentrator";
$path_3 = '.doc';
$Main_Path = $path_1.$path_2.$path_3;
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
try
{
    $objWriter->save($Main_Path);
    header("Location: index.php");
}
catch (Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>

