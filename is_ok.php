<?php
session_start();
if(isset($_POST['is_ok']))
{
    $is_ok = $_POST['is_ok'];
    $O2_PSI = $_POST['O2_PSI'];
    $id_konc = $_SESSION['id_konc'];
    require_once "connect.php";
    $polaczenie =  @new mysqli($host,$db_user,$db_password,$db_name);
    if($is_ok)
    {
        $sql = "UPDATE koncentratory SET is_ok = 1, O2_PSI = '$O2_PSI' WHERE ID_Koncentratora = '$id_konc'";
    }
    else
    {
        $sql = "UPDATE koncentratory SET is_ok = 0, O2_PSI = '$O2_PSI' WHERE ID_Koncentratora = '$id_konc'";
    }
    $r = $polaczenie->query($sql);
    if($r)
    {
        $_SESSION['success'] = "Zapisano zmianę";
        header("Location: Historia_K.php");
    }
    else
    {
        $_SESSION['success'] = "Nie zapisano zmiany";
        header("Location: Historia_K.php");
    }
}
elseif(!isset($_POST['is_ok']))
{
    $is_ok = 0;
    $id_konc = $_SESSION['id_konc'];
    $O2_PSI = $_POST['O2_PSI'];
    require_once "connect.php";
    $polaczenie =  @new mysqli($host,$db_user,$db_password,$db_name);
    $sql = "UPDATE koncentratory SET is_ok = $is_ok, O2_PSI = '$O2_PSI' WHERE ID_Koncentratora = '$id_konc'";
    $r = $polaczenie->query($sql);
    if($r)
    {
        $_SESSION['success'] = "Zapisano zmianę";
        header("Location: Historia_K.php");
    }
    else
    {
        $_SESSION['success'] = "Nie zapisano zmiany";
        header("Location: Historia_K.php");
    }
}
?>