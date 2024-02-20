<?php
require_once "connect.php";
if(isset($_POST["query"]))
{
   
    $connect = new mysqli($host,$db_user,$db_password,$db_name);
    $data = array();
    //$condition = preg_replace('/[^A-Za-z0-9\-]/','',$_POST["query"]);
    $condition = $_POST["query"];
    //$condition[0] = strtoupper($condition[0]);
    $query = "SELECT k.ID_Koncentratora FROM koncentratory AS k LEFT JOIN wypozyczenie_akt as wa ON 
    k.ID_Koncentratora=wa.ID_Koncentratora 
    LEFT JOIN sprzedane AS sp ON sp.ID_Koncentratora=k.ID_Koncentratora WHERE wa.ID_Koncentratora IS NULL AND sp.ID_Koncentratora IS NULL AND k.is_ok = 1 AND k.ID_Koncentratora LIKE '%".$condition."%' LIMIT 10";
    $result = $connect->query($query);
    $replace_string = '<b>'.$condition.'</b>';
    foreach($result as $row)
    {
        $data[] = array(
            'u_id'      =>  str_ireplace($condition,$replace_string,$row["ID_Koncentratora"])
        );

    }
    echo json_encode($data);
}

?>