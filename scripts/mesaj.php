<!DOCTYPE html>

<html>
	<head>
		<title>Multumim!</title>
		<link rel="stylesheet" type="text/css" href="ceseseu.css">
		<style type="text/css">
			/* CSSeu  */

			body {
			    display: table;
			    position: absolute;
			    height: 100%;
			    width: 100%;
			}

			#container {
			    display: table-cell;
			    vertical-align: middle;
			}

			.box {
			    width: 300px;
			    padding: 5px;
			    margin: 7px auto;   
			    text-align: center;
			    background-color: rgb(39, 174, 96);
			    border-radius: 25px;
			    font-size: 1.5em;
			    padding: 15px;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div class="box">

<?php 
/*
- sa permiti doar upload-ul fisierelor de tip pdf
- sa salvezi numele, adresa de email si mesajul intr-o baza de date
- sa faci o pagina ce listeaza toate mesajele impreuna cu numele celui ce a trimis mesajul pe baza bazei de date de mai sus
*/


include("db_connect.php");

			######### VALIDARE DATE DIN POST #########
			
function validare ($data){
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

//var_dump ($_GET);

$nameErr = $emailErr = $msgErr = "";

if($_SERVER["REQUEST_METHOD"] == "GET"){
	
	if(empty($_GET['name']) && empty($_GET['email']) && empty($_GET['message'])){
		echo "Va rugam completati "."<a href='index.html'>"."formularul"."</a>"."</br>";
	}
	
	if(empty($_GET['name'])){
		$nameErr = "Nu ati introdus numele.";
	} else {
		$nume = validare($_GET['name']);
		if(!preg_match("/^[a-zA-Z ]*$/",$nume)){
    		$nameErr = "Sunt permise 'decat' litere si spatii!";
    	}
	}
	
	if(empty($_GET['email'])){
		$emailErr = "Nu ati introdus o adresa de email.";
	} else {
		$email = validare($_GET['email']);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$emailErr = "Formatul emailului introdus nu este corect.";
		}
	}
	
	if(empty($_GET['message'])){
		$msgErr = "Nu ati introdus un mesaj.";
	} else {
		$mesaj = trim($_GET["message"]);
	}
	
	/*if($_FILES['upload']['error'] === UPLOAD_ERR_OK){
		$tip = mime_content_type($_FILES['upload']['tmp_name']);
	
		if($tip !== "application/pdf"){
			$uploadErr = "Va rugam urcati un fisier de tip PDF.";
		}else{
			$uploaddir='uploads/';
			$uploadfile = $uploaddir . basename($_FILES['upload']['name']);
			move_uploaded_file($_FILES['upload']['tmp_name'],$uploadfile);
		}
	
	}else if($_FILES['upload']['error'] === UPLOAD_ERR_NO_FILE){
		$uploaddir='uploads/';
		$uploadfile = $uploaddir . basename($_FILES['upload']['name']);
		move_uploaded_file($_FILES['upload']['tmp_name'],$uploadfile);
	}else {
		$uploadErr = "Marimea fisierului depaseste 5MB.";
	}
	*/
	
	######## TRIMITERE INFO in DB, MAIL CU 'PHPMAILER' SI AFISARE MESAJ  ##########
	if(empty($nameErr) && empty($emailErr) && empty($msgErr)){
	
		### trimite info in DB###
		

		mysqli_query($db_connect,"INSERT INTO contact_db (Nume, Email, Mesaj)
											VALUES('$nume', '$email', '$mesaj')") 
				or die(mysqli_error($db_connect));
		mysqli_close($db_connect);
	
		### trimite mail  ###

		require 'PHPMailer-master/PHPMailerAutoload.php';
		$mail = new PHPMailer;
	  //$mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'mail.snoog.ro';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'victor@snoog.ro';                 // SMTP username
		$mail->Password = 'Ramonsita1!';                           // SMTP password
	  	//$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 25 ;                                    // TCP port to connect to
		$mail->setFrom($email, 'Mailer');
		$mail->addAddress('dragneavictor@gmail.com', 'Joe User');     // Add a recipient
		//$mail->addAttachment($uploadfile);         // Add attachments
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Mesaj de la '.$nume;
	    $mail->Body    = $mesaj;
		$mail->AltBody = $mesaj;
	
			if(!$mail->send()) {
				echo 'Mesajul NU a fost trimis!'.'</br>';
				echo 'Eroare PHPMailer: ' . $mail->ErrorInfo;
			} else {
				echo 'Multumim pentru mesaj, '.$nume.'!';
			}
	
		} else {
		echo $nameErr."</br>";
		echo $emailErr."</br>";
		echo $msgErr."</br>";
		//echo $uploadErr;
		echo '<form><input type="button" value="Back" onClick="history.back();return true;"></form>';
}
	
	
} else {
	echo "Va rugam completati "."<a href='index.html'>"."formularul"."</a>";
	}
  
?>

			</div>
		</div>
	</body>
</html>



