<?php

require_once "connect.php";

$conn = new mysqli($host,$db_user,$db_password,$db_name);

// ==== Dla wpisania DeVilbiss ====
// $all_konc = 'SELECT ID_Koncentratora,Model FROM koncentratory WHERE Model = "515AKS" OR Model="525KS" OR Model="515KS" OR Model="1025KS"';
// $result = $conn->query($all_konc);
// while ($w = $result->fetch_assoc())
// {
//     $nazwa = "Devilbiss";
//     $model = $w['Model'];
//     $final = $nazwa." ".$model;
//     $ID = $w['ID_Koncentratora'];
//     $sql = "UPDATE koncentratory SET Model = '$final' WHERE ID_Koncentratora = '$ID'";
//     $res = $conn->query($sql);
// }

// $conn->close();

// ==== Dla wpisania klas ==== 
$all_konc = 'SELECT ID_Koncentratora,Model FROM koncentratory WHERE Model = "Devilbiss 515AKS" OR Model="Devilbiss 525KS" OR Model="Devilbiss 515KS" OR Model="Devilbiss 1025KS"';
$result = $conn->query($all_konc);
while ($w = $result->fetch_assoc())
{
    $klasa = "koncentrator tlenu";
    $ID = $w['ID_Koncentratora'];
    $sql = "UPDATE koncentratory SET klasa = '$klasa' WHERE ID_Koncentratora = '$ID'";
    $res = $conn->query($sql);
}

$conn->close();
?>