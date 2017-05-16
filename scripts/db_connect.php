<?php 

$db_host = "localhost";
$db_user = "ttynofki_victor";
$db_password = "Ramonsita1!";
$db_name = "ttynofki_Baza_de_Date";

$db_connect = mysqli_connect($db_host,$db_user,$db_password,$db_name) or die();

if(mysqli_connect_error()){
	echo "Conexiune esuata la DB: ".mysqli_connect_error();
}

?>