<?php
session_start();
require_once 'vendor/autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$data = date('d.m.Y',strtotime("2021-04-02"));
$Imie = "Mateusz";
$Nazwisko = "Moroń";
$Person = "$Nazwisko $Imie";
$tel = "520260321";
$Seria_dowodu = "ABC";
$Numer_dowodu = "85265";
$Pesel = "98765433355";
$Adres = "40-133 Katowice ul. Kwiatowa 17a";
$Model = "515KS";
$ID = "H7860KS";
$Licznik_od = "5201";
$Tlen = "94%/4L";
$Data_do = date('d.m.Y',strtotime("2021-05-01"));
//===================================== 
$text = "Zawarta w dniu $data w Katowicach, pomiędzy firmą: ";
$section = $phpWord->addSection(array('marginLeft'=>1300, 'marginRight'=>1300, 'marginTop'=> 400, 'marginBottom'=> 200));
$section->addImage('Calosc.jpg', array('width'=>470, 'height'=>84,'align'=> 'center'));
$section->addTextBreak(0);
$section->addText('UMOWA WYPOŻYCZENIA',array('name'=>'Arial Narrow', 'size'=>14,'bold'=>true),array('align'=>'center','spaceAfter'=>100,'spaceBefore'=>100));
$section->addTextBreak(0);
$textrun = $section->addTextRun(['spaceBefore'=>0,'spaceAfter'=>0]);

$textrun->addText('Zawarta w dniu ',array('name'=>'Times New Roman'));
$textrun->addText($data,array('name'=>'Times New Roman','bold'=>true));
$textrun->addText(' w Katowicach, pomiędzy firmą: ',array('name'=>'Times New Roman'));

$textrun->addText('                                                                                               ');
$textrun->addText(' LIDAR Mateusz Moroń ',array('name'=>'Times New Roman','bold'=>true));
$textrun->addText('z siedzibą w Katowicach przy ulicy Marzanny 48 zwaną dalej ',array('name'=>'Times New Roman'));
$textrun->addText(' WYPOŻYCZALNIĄ, ',array('name'=>'Times New Roman','bold'=>true));
$textrun->addText(' a Panem/Panią ',array('name'=>'Times New Roman'));
$textrun->addText($Person,array('name'=>'Times New Roman','bold'=>true));
$textrun->addText("  (tel.  ",array('name'=>'Times New Roman','bold'=>true));
$textrun->addText($tel,array('name'=>'Times New Roman','bold'=>true));
$textrun->addText(")  ",array('name'=>'Times New Roman','bold'=>true));
$textrun->addText(" legitymującym/ą  się D.O. seria  ",array('name'=>'Times New Roman'));
$textrun->addText($Seria_dowodu,array('name'=>'Times New Roman','bold'=>true));
$textrun->addText(" numer ",array('name'=>'Times New Roman'));
$textrun->addText($Numer_dowodu,array('name'=>'Times New Roman','bold'=>true));
$textrun->addText(" nr pesel ",array('name'=>'Times New Roman'));
$textrun->addText($Pesel,array('name'=>'Times New Roman','bold'=>true));
$textrun->addText("  zamieszkałym/ą:   ",array('name'=>'Times New Roman'));
$textrun->addText($Adres,array('name'=>'Times New Roman','bold'=>true));
$textrun->addText("  zwanym dalej ",array('name'=>'Times New Roman'));
$textrun->addText(" BIORĄCYM do używania.",array('name'=>'Times New Roman','bold'=>true));
$section->addText("§1",array('name'=>'Times New Roman'),array('align'=>'center','spaceBefore'=>0,'spaceAfter'=>0));
$textrun2 = $section->addTextRun(array('align'=>'both','spaceBefore'=>0,'spaceAfter'=>0));
$textrun2->addText("Wypożyczalnia oddaje Biorącemu do używania koncentrator tlenu"
,array('name'=>'Times New Roman'));
$textrun2->addText(" Devilbiss "
,array('name'=>'Times New Roman','bold'=>true));
$textrun2->addText($Model,array('name'=>'Times New Roman','bold'=>true));
$textrun2->addText(" nr ",array('name'=>'Times New Roman'));
$textrun2->addText($ID,array('name'=>'Times New Roman','bold'=>true));
$textrun2->addText(", stan licznika: ",array('name'=>'Times New Roman'));
$textrun2->addText($Licznik_od,array('name'=>'Times New Roman','bold'=>true));
$textrun2->addText("h ",array('name'=>'Times New Roman','bold'=>true));
$textrun2->addText(" w pełni sprawny technicznie.",array('name'=>'Times New Roman'));
$textrun2->addText("(",array('name'=>'Times New Roman'));
$textrun2->addText($Tlen,array('name'=>'Times New Roman','bold'=>true));
$textrun2->addText(")",array('name'=>'Times New Roman'),['spaceBefore'=>0,'spaceAfter'=>0]);
$section->addText("§2",array('name'=>'Times New Roman'),array('align'=>'center','spaceBefore'=>0,'spaceAfter'=>0));
$textrun3 = $section->addTextRun(array('align'=>'both','spaceAfter'=>0,'spaceBefore'=>0));
$textrun3->addText("Podpisanie umowy przez Biorącego do używania oznacza,
 że potwierdza on odbiór rzeczy, o których mowa w §1 niniejszej umowy oraz,
  że zapoznał się  z  ich stanem faktycznym i nie wnosi żadnych zastrzeżeń",array('name'=>'Times New Roman'));
$section->addText("§3",array('name'=>'Times New Roman'),array('align'=>'center','spaceAfter'=>0,'spaceBefore'=>0));
$textrun3 = $section->addTextRun(array('align'=>'both','spaceBefore'=>0,'spaceAfter'=>0));
$textrun3->addText("Umowa została zawarta na okres ",array('name'=>'Times New Roman'));
$textrun3->addText("od ",array('name'=>'Times New Roman','bold'=>true));
$textrun3->addText($data,array('name'=>'Times New Roman','bold'=>true));
$textrun3->addText(" do dnia  ",array('name'=>'Times New Roman','bold'=>true));
$textrun3->addText($Data_do,array('name'=>'Times New Roman','bold'=>true));
$textrun3->addText(" z możliwością przedłużenia ",array('name'=>'Times New Roman'));
$section->addText("§4",array('name'=>'Times New Roman'),array('align'=>'center','spaceAfter'=>0,'spaceBefore'=>0));
$textrun4 = $section->addTextRun(array('align'=>'both','spaceBefore'=>0,'spaceAfter'=>0));
$textrun4->addText("Biorący do używania zobowiązuje się do użytkowania sprzętu zgodnie 
z jego przeznaczeniem i jednocześnie ponosi pełną odpowiedzialność za  zdarzenia wynikłe z
jego nieodpowiedniego korzystania.",array('name'=>'Times New Roman'));
$section->addText("1. Koncentrator nie może pracować w pomieszczeniach  wilgotnych takich
 jak np. łazienka, czy kuchnia lub zawilgocony pokój – wilgoć powoduje uszkodzenie sit wytrącających tlen."
 ,array('name'=>'Times New Roman'),array('spaceAfter'=>0,'spaceBefore'=>0));
$section->addText("2. Koncentrator musi pracować w pomieszczeniach przewietrzanych.",array('name'=>'Times New Roman'),array('spaceBefore'=>0,'spaceAfter'=>0));
$section->addText("§5",array('name'=>'Times New Roman'),array('align'=>'center','spaceBefore'=>0,'spaceAfter'=>0));
$textrun5 = $section->addTextRun(array('align'=>'both','spaceBefore'=>0,'spaceAfter'=>0));
$textrun5->addText("Za uszkodzenia wynikłe z nieodpowiedniego korzystania z wypożyczonego  sprzętu winę ponosi Biorący do używania, on także pokrywa wszystkie koszty związane z naprawą przedmiotowego sprzętu. 
Wypożyczalnia zastrzega sobie możliwość odmowy przyjęcia sprzętu w momencie gdy uszkodzenia jego będą tak znaczne, 
że jego naprawa stanie się nieopłacalna. 
W takim przypadku Biorący do używania zobowiązuje się do zapłaty całej wartości wypożyczonego  sprzętu, 
według rachunków przedstawionych przez Wypożyczalnię.",['name'=>'Times New Roman'],['align'=>'both']);
$section->addText("§6",array('name'=>'Times New Roman'),array('align'=>'center','spaceBefore'=>0,'spaceAfter'=>0));
$textrun6 = $section->addTextRun(array('align'=>'both','spaceBefore'=>0,'spaceAfter'=>0));
$textrun6->addText("Opłaty za wypożyczenie sprzętu liczone są za pełny miesiąc.
 Umowa wypożyczenia może być zawarta tylko na pełne miesiące,
 przyjmując jeden miesiąc jako najmniejszy możliwy czas wypożyczenia sprzętu.",['name'=>'Times New Roman'],['align'=>'both']);
$section->addText("§7",array('name'=>'Times New Roman'),array('align'=>'center','spaceBefore'=>0,'spaceAfter'=>0));
$textrun7 = $section->addTextRun(array('align'=>'both','spaceBefore'=>0,'spaceAfter'=>150));
$textrun7->addText("Opłaty za wypożyczany sprzęt pobierane są z góry w cyklach miesięcznych za cały okres wypożyczenia. 
Przy pierwszej płatności za wypożyczenie do faktury doliczone są ewentualne koszty dostawy i odbioru wypożyczonego sprzętu. 
Umowa wypożyczenia może zostać automatycznie przedłużona na następny okres (wielokrotność miesiąca) 
poprzez telefoniczne skontaktowanie się z Wypożyczalnią oraz dokonanie przez Biorącego do używania, 
wpłaty na nasze konto odpowiedniej wielokrotności ustalonej opłaty za jeden miesiąc na trzy dni przed 
zakończeniem poprzednio opłaconego okresu. Przedłużenie umowy zostanie potwierdzone wystawieniem faktury na następny okres, 
która zostanie przesłana pocztą.",['name'=>'Times New Roman'],['align'=>'both']);
$section->addText("Mateusz Moroń nr konta bankowego: 64 1140 2004 0000 3602 7554 8369",array('name'=>'Times New Roman','bold'=>true),
array('align'=>'center','spaceBefore'=>0,'spaceAfter'=>0));
$section->addText("§8",array('name'=>'Times New Roman'),array('align'=>'center','spaceBefore'=>70,'spaceAfter'=>0));
$textrun8 = $section->addTextRun(array('align'=>'both','spaceBefore'=>0,'spaceAfter'=>0));
$textrun8->addText("Po zakończeniu użyczenia Biorący do używania obowiązany jest zwrócić Wypożyczalni rzeczy w stanie nie pogorszonym, 
jednakże Biorący do używania nie ponosi odpowiedzialności za zużycie rzeczy będące następstwem prawidłowego używania. 
Jeżeli biorący do używania powierzył rzecz innej osobie, obowiązek, o którym mowa w ust. 4 ciąży także na tej osobie.",['name'=>'Times New Roman'],['align'=>'both']);
$section->addText("§9",array('name'=>'Times New Roman'),array('align'=>'center','spaceBefore'=>0,'spaceAfter'=>0));
$textrun9 = $section->addTextRun(array('align'=>'both','spaceBefore'=>0,'spaceAfter'=>0));
$textrun9->addText("Do innych nie uregulowanych przepisów niniejszej umowy zastosowanie znajdują przepisy Kodeksu Cywilnego. ",
['name'=>'Times New Roman'],['align'=>'both']);
$section->addText("§10",array('name'=>'Times New Roman'),array('align'=>'center','spaceBefore'=>0,'spaceAfter'=>0));
$textrun10 = $section->addTextRun(array('align'=>'both','spaceBefore'=>0,'spaceAfter'=>0));
$textrun10->addText("Wszystkie spory wynikłe w drodze zawartej umowy rozstrzygane będą przez Sąd Rejonowy w Katowicach. ",
['name'=>'Times New Roman'],['align'=>'both']);
$section->addText("§11",array('name'=>'Times New Roman'),array('align'=>'center','spaceBefore'=>0,'spaceAfter'=>0));
$textrun11 = $section->addTextRun(array('align'=>'both','spaceBefore'=>0,'spaceAfter'=>500));
$textrun11->addText("Umowę oraz załączniki sporządzono w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze stron. ",
['name'=>'Times New Roman'],['align'=>'both']);
$section->addText("................................................                                                                                           ..............................................",array('name'=>'Times New Roman'),array('align'=>'left','spaceBefore'=>500,'spaceAfter'=>0));
$section->addText("          Wypożyczalnia                                                                                                            BIORĄCY do używania",array('name'=>'Times New Roman'),array('align'=>'left','spaceBefore'=>0,'spaceAfter'=>0));
$data = date('Y.m.d',strtotime("2021-04-02"));                                                                                             
$path_1 = 'G:\#Mateusz\#Lidar\#UMOWY\2021 LIDAR Mateusz Moroń';
$path_2 = '\\'.$data." ".$Person." Umowa koncentrator";
$path_3 = '.doc';
$Main_Path = $path_1.$path_2.$path_3;
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save($Main_Path);
?>