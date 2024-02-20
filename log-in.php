<?php

session_start();

require_once "connect.php";


$polaczenie =  new mysqli($host,$db_user,$db_password,$db_name);

 if ($polaczenie->connect_errno!=0)
	 {
		 echo "Error: ".$polaczenie->connect_errno;
	 }
	 else
	 {
		 $_POST['login'];
		 $_POST['haslo'];
		 
	 }




?>