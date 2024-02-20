<?php
require_once "connect.php";
if(isset($_POST["query"]))
{
   
    $connect = new mysqli($host,$db_user,$db_password,$db_name);
    $data = array();
    //$condition = preg_replace('/[^A-Za-z0-9\-]/','',$_POST["query"]);
    $condition = $_POST["query"];
    $condition[0] = strtoupper($condition[0]);
    $query = "SELECT Nazwisko FROM klienci WHERE Nazwisko LIKE '%".$condition."%' LIMIT 10";
    $result = $connect->query($query);
    $replace_string = '<b>'.$condition.'</b>';
    foreach($result as $row)
    {
        $data[] = array(
            'Nazwisko'      =>  str_ireplace($condition,$replace_string,$row["Nazwisko"])
        );

    }
    echo json_encode($data);
}

?>