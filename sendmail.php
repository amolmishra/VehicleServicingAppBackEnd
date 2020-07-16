<?php
require('include/PHPMailer.php');
require('include/SMTP.php');
require('include/DB_Function.php');
$db = new DB_Functions();
$mail = new PHPMailer\PHPMailer\PHPMailer();
//json response array
$response = array("error" => false);

if (isset($_POST['email']) && isset($_POST['registered_car_id']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['centerid']) && isset($_POST['pickup']) && isset($_POST['charges'])) {

	$lat = $db->getCenterLat($_POST['centerid']);
	$lon = $db->getCenterLong($_POST['centerid']);
	$subject = "Booking Confirmation for Vehicle Servicing";

	$content = "<p>Dear ".$_POST['name'].",
			<br/>
    This is to inform you that your booking has been confirmed successfully.
			<br/>
    Following are the details:
			<br/>
			<br/>
    Car:       ".$_POST['registered_car_id']."
			<br/>
    Date:      ".$_POST['date']."
			<br/>
    Time:      ".$_POST['time']."
			<br/>
	Center:    ".$_POST['centerdetails']."
			<br/>
	Pickup:    ".$_POST['pickup']."
			<br/>
	Charges:   ".$_POST['charges']."
			<br/>
			<br/>
			<br/>
Please feel free to contact us in case of any queries.
			<br/>
			<br/>
Please follow this link to get to the service center: http://maps.google.com/maps?q=".$lat.",".$lon."

			<br/>
			<br/>
			<br/>
Thanks,
			<br/>
Manisa Das,
			<br/>
Vehicle Service
			<br/>
Pune
		</p>";




	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = TRUE;
	$mail->SMTPSecure = "tls";
	$mail->Port     = 587;  
	$mail->Username = "lisl.12amol@gmail.com";
	$mail->Password = "H5JLdVyzZyrTe4";
	$mail->Host     = "smtp.gmail.com";
	$mail->Mailer   = "smtp";
	$mail->SetFrom("manisa@vehicleService.com", "Vehicle Service Application");
	$mail->AddReplyTo("manisa@vehicleService.com", "Vehicle Service Application");
	$mail->AddAddress($_POST['email']);
	$mail->Subject = $subject;
	$mail->WordWrap   = 80;
	$mail->MsgHTML($content);
	$mail->IsHTML(true);

	if(!$mail->Send()) {
		$response["error"] = false;
        $response["error-msg"] = "Confirmation mail was not sent!";
        echo json_encode($response);
    }else {
		$response["error"] = false;
        $response["message"] = "Mail Sent...";
        echo json_encode($response);
    }

} else {
	$response["error"] = false;
    $response["error-msg"] = "Confirmation mail was not sent!";
    echo json_encode($response);
}
?>