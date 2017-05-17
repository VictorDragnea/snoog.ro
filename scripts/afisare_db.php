<?php 
include("db_connect.php");


$query = "SELECT ID, Nume, Email, Mesaj FROM `contact_db`";

$result =  mysqli_query($db_connect,$query) or die("Selectia din tabel a esuat");

if(mysqli_num_rows($result) > 0) {
	echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Mesaj</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>". $row["ID"]."</td><td>"." | ". $row["Nume"]."</td><td>"." | ". $row["Email"]."</td><td>". " | ".$row["Mesaj"]."</td></tr>";
		}
		echo "</table>";
}else{
	echo "0 results";
}

mysqli_close($db_connect);

?>


<!-- CREATE TABLE IF NOT EXISTS `contact_db` (
 `ID` smallint(6) NOT NULL AUTO_INCREMENT,
 `Nume` varchar(50) NOT NULL,
 `Email` varchar(50) NOT NULL,
 `Mesaj` text NOT NULL,
 `Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY `ID` (`ID`)
 )ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 | -->