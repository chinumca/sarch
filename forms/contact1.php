<?php 

/* Define Veriables */
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];
  
	$name = test_input($_POST["name"]);
	$srn = test_input($_POST["subject"]);
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
		$errname = "* Name Field has not been filled in";
	}else{
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$name = 0;
			$errname = "* Name Field contains elements other than plain text";
		}else{
			$name = 1;
			$errname = "";
		}	
	}

/* filter Surname Empty  and characters */
	if(empty($srn)){
		$srn = 0;
		$errsrn = "";
	}else{
		if (!preg_match("/^[a-zA-Z ]*$/",$srn)) {
			$srn = 0;
			$errsrn = "</br>* Surname Field contains elements other than plain text";
		}else{
			$srn = 1;
			$errsrn = "";
		}
	}
	
/* filter email Empty  and characters */
	if(empty($email)){
		$email = 0;
		$erremail = "</br>* Your Email Field has not been filled in";
		
	}else{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = 0;
			$erremail = "</br>* Email Field Does not contain @ symbol and or suffixis";
		}else{
			$email = 1;
			$erremail = "";
		}
	}
/* filter message Empty  and characters */
	if(empty($msg)){
		$msg = 0;
		$errmsg = "</br>* Error: message not displayed what are you trying to tell us?";
		
	}else{
		$msg = 1;
		$errmsg = "";
	}
	
	if($name + $srn + $email + $msg > 3){
		
	$name = test_input($_POST["name"]);
	$srn = test_input($_POST["surname"]);
	$email = test_input($_POST["email"]);
	$msg = test_input($_POST["message"]);
	$succmsg = "Your message has been successfully delivered!</br></br> Feel Free to check out our social media </br></br>or</br></br> select an option at the navigation to take you to our website.";
	$to = "chinu50patil@gmail.com";
	$subject = "From: ".$email ."(" .$name ." " .$srn .")";
	$header = $headers = "From: $email\
";
	
	
	mail($to,$subject,$msg,$headers);
		
		echo "Dear";
		echo " ";
		echo $name;
		echo " ";
		echo $srn;
		echo "</br>";
		echo "</br>";
		echo "</br>";
		echo $succmsg;
		echo "</br>";
		echo "</br>";

	}else{
		
		$name = "User";
		$srn = "";
		$email = "From: Mr Laptop.co.za";
		$msg = "It Appears Your Email was unsuccessful, This could be due to incomplete Field(s).";
	
		echo "Dear";
		echo " ";
		echo $name;
		echo " ";
		echo $srn;
		echo "</br>";
		echo "</br>";
		echo $msg;
		echo "</br>";
		echo "</br>";
		echo '<b style="color:red;font-size:14px;">';
		echo $errname;
		echo $errsrn;
		echo $erremail;
		echo $errmsg;
		echo "</b>";
		echo "</br>";
		echo "</br>";
		echo '<a href="contact.html" style="color:#fff;font-size:15px;">Back to form</a>';
	
	}
}
?>