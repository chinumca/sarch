<?php 
	require_once "Mail.php";

/* Define Veriables */
  
	$name = test_input($_POST["name"]);
	$subject = test_input($_POST["subject"]);
	$email = test_input($_POST["email"]);
	$msg = test_input($_POST["message"]);
	
/* Filter Remove extra spacing */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


/* When Submit is called */
if($_SERVER["REQUEST_METHOD"] == "POST"){
/* filter Name Empty  and characters */
	if(empty($name)){
		$name = 0;
		$errname = "</br>* Error: Your Name should not be empty";
	}else{
		$name = 1;
		$errname = "";	
	}

/* filter subject Empty  and characters */
	
	if(empty($subject)){
		$subject = 0;
		$errsubject = "</br>* Error: Subject should not be empty";
	}else{	
		$subject = 1;
		$errsubject = "";	
	}
	
/* filter email Empty  and characters */
	if(empty($email)){
		$email = 0;
		$erremail = "</br>* Error: Your Email should not be empty";
		
	}else{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = 0;
			$erremail = "</br>* Error: Your Email valid email address";
		}else{
			$email = 1;
			$erremail = "";
		}
	}
/* filter message Empty  and characters */
	if(empty($msg)){
		$msg = 0;
		$errmsg = "</br>* Error: message should not empty";
		
	}else{
		$msg = 1;
		$errmsg = "";
	}
	
	if($name + $subject + $email + $msg > 3){
		
	$name = test_input($_POST["name"]);
	$subject = test_input($_POST["subject"]);
	$email = test_input($_POST["email"]);
	$msg = test_input($_POST["message"]);
	$succmsg = "Your message has been successfully delivered!</br></br> Feel Free to check out our social media";
	$subject = "From: ".$email ."(" .$name ." " .$subject .")";
	

	$from = 'sarchmailbase@gmail.com'; //change this to your email address
	$to = 'chinu50patil@gmail.com'; // change to address
	$subject = 'Insert subject here'; // subject of mail
	$body = "Hello world! this is the content of the email"; //content of mail
	
	$headers = array(
		'From' => $from,
		'To' => $email,
		'Subject' => $subject
	);
	
	$smtp = Mail::factory('smtp', array(
			'host' => 'ssl://smtp.gmail.com',
			'port' => '465',
			'auth' => true,
			'username' => 'sarchmailbase@gmail.com', //your gmail account
			'password' => 'sarchmailbase11@@' // your password
		));
	
	// Send the mail
	$mail = $smtp->send($to, $headers, $body);
	
	//check mail sent or not
	if (PEAR::isError($mail)) {
		echo '<p>'.$mail->getMessage().'</p>';
	} else {
		echo '<p>Message successfully sent!</p>';
	}

	


	// $mail->isSMTP();
	// $mail->Host = 'smtp.gmail.com';
	// $mail->SMTPAuth = true;
	// $mail->Username = 'chinu50patil@gmail.com';
	// $mail->Password = '';
	// $mail->SMTPSecure = 'ssl';
	// $mail->Port = 465;
	// $mail->From = 'chinu50patil@gmail.com';
	// $mail->FromName = 'from: Sachin';
		
	// if(!$mail->send()){
	// 	$name = "User";
	// 	$subject = "";
	// 	$msg = "It Appears Your Email was unsuccessful, This could be due to incomplete Field(s).";
	
	// 	echo "Dear";
	// 	echo " ";
	// 	echo $name;
	// 	echo "</br>";
	// 	echo $msg;
	// 	echo "</br>";
	// 	echo '<b style="color:red;font-size:14px;">';
	// 	echo $errname;
	// 	echo $errsubject;
	// 	echo $erremail;
	// 	echo $errmsg;
	// 	echo "</b>";
	// 	echo "</br>";
	// }else {
	// 	echo "Dear";
	// 	echo " ";
	// 	echo $name;
	// 	echo "</br>";
	// 	echo $succmsg;
	// 	echo "</br>";
	// }
	

	}else{
		
		$name = "User";
		$subject = "";
		$msg = "It Appears Your Email was unsuccessful, This could be due to incomplete Field(s).";
	
		echo "Dear";
		echo " ";
		echo $name;
		echo "</br>";
		echo $msg;
		echo "</br>";
		echo '<b style="color:red;font-size:14px;">';
		echo $errname;
		echo $errsubject;
		echo $erremail;
		echo $errmsg;
		echo "</b>";
		echo "</br>";
	}
}
?>