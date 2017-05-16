<?php 
include("db_connect.php");


$query = "SELECT * FROM contact_db";

$result =  mysqli_query($db_connect,$query) or die("Selectia din tabel a esuat");


var_dump ($result);
?>


<!-- CREATE TABLE IF NOT EXISTS `contact_db` (
 `ID` smallint(6) NOT NULL AUTO_INCREMENT,
 `Nume` varchar(50) NOT NULL,
 `Email` varchar(50) NOT NULL,
 `Mesaj` text NOT NULL,
 `Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY `ID` (`ID`)
 )ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 | -->