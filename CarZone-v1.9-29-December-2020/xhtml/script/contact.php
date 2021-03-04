<?php
/*
	Variable 
	$dzName : Contact Person Name
	$dzEmail : Contact Person Email
	$dzMessage : Contact Person Message
	$dzRes : response holder
	$dzOtherField : Form other aditional fields
	$dzMailSubject : Mail Subject.
	$dzMailMessage : Mail Body
	$dzMailHeader : Mail Header
	$dzEmailReceiver : Contact receiver email address
	$dzEmailFrom : Mail Form title
	$dzEmailHeader : Mail headers
*/

$dzEmailTo = "receiver@gmail.com";   // Receiver Email Address "reciever@gmail.com" 
$dzEmailFrom   = "CarZone Contact";

function pr($value)
{
	echo "<pre>";
	print_r($value);
	echo "</pre>";
}

#### Contact Form Script ####
if(!empty($_POST) && $_POST['dzToDo'] == 'Contact')
{
	$dzName = trim(strip_tags($_POST['dzName']));
	$dzEmail = trim(strip_tags($_POST['dzEmail']));
	$dzMessage = strip_tags($_POST['dzMessage']);	
	$dzRes = "";
	if (!filter_var($dzEmail, FILTER_VALIDATE_EMAIL)) 
	{
		$dzRes['status'] = 0;
		$dzRes['msg'] = 'Wrong Email Format.';
		echo json_encode($dzRes);
		exit;
	}
	$dzMailSubject = 'CarZone|Contact Form: A Person want to contact';
	$dzMailMessage	= 	"
						A persone want to contact you: <br><br>
						Name: $dzName<br/>
						Email: $dzEmail<br/>
						Message: $dzMessage<br/>
						";
	$dzEmailHeader  	= "MIME-Version: 1.0\r\n";
	$dzEmailHeader 		.= "Content-type: text/html; charset=iso-8859-1\r\n";
	$dzEmailHeader 		.= "From:$dzEmailFrom <$dzEmail>";
	$dzEmailHeader 		.= "Reply-To: $dzEmail\r\n"."X-Mailer: PHP/".phpversion();
	if(mail($dzEmailTo, $dzMailSubject, $dzMailMessage, $dzEmailHeader))
	{
		$dzRes['status'] = 1;
		$dzRes['msg'] = 'We have revieved your message successfuly. Thanks for Contact.';
	}
	else
	{
		$dzRes['status'] = 0;
		$dzRes['msg'] = 'Some problem in sending mail, please try again later.';
	}
	echo json_encode($dzRes);
	exit;
}	
#### Contact Form Script End ####


#### Appoinment Form Script ####
if(!empty($_POST) && $_POST['dzToDo'] == 'Appoinment')
{
	$dzName = trim(strip_tags($_POST['dzName']));
	$dzEmail = trim(strip_tags($_POST['dzEmail']));
	$dzMessage = strip_tags($_POST['dzMessage']);	
	$dzRes = "";
	if(!filter_var($dzEmail, FILTER_VALIDATE_EMAIL)) 
	{
		$dzRes['status'] = 0;
		$dzRes['msg'] = 'Wrong Email Format.';
		echo json_encode($dzRes);
		exit;
	}
	
		
	
	$dzMailSubject = 'CarZone|Contact Form: A Person want to contact';
	$dzMailMessage	= 	"
						A persone want to contact you: <br><br>
						Name: $dzName<br/>
						Email: $dzEmail<br/>
						Message: $dzMessage<br/>
						";
	$dzOtherField = "";
	if(!empty($_POST['dzOther']))
	{
		$dzOther = $_POST['dzOther'];
		$message = "";
		foreach($dzOther as $key => $value)
		{
			$fieldName = ucfirst(str_replace('_',' ',$key));
			$fieldValue = ucfirst(str_replace('_',' ',$value));
			$dzOtherField .= $fieldName." : ".$fieldValue."<br>";
		}
	}
	$dzMailMessage .= $dzOtherField; 
	
	$dzEmailHeader  	= "MIME-Version: 1.0\r\n";
	$dzEmailHeader 		.= "Content-type: text/html; charset=iso-8859-1\r\n";
	$dzEmailHeader 		.= "From:$dzEmailFrom <$dzEmail>";
	$dzEmailHeader 		.= "Reply-To: $dzEmail\r\n"."X-Mailer: PHP/".phpversion();
	if(mail($dzEmailTo, $dzMailSubject, $dzMailMessage, $dzEmailHeader))
	{
		$dzRes['status'] = 1;
		$dzRes['msg'] = 'We have revieved your message successfuly. Thanks for Contact.';
	}
	else
	{
		$dzRes['status'] = 0;
		$dzRes['msg'] = 'Some problem in sending mail, please try again later.';
	}
	echo json_encode($dzRes);
	exit;
}	
#### Appoinment Form Script End ####

?>