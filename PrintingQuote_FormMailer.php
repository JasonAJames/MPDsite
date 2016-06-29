<?php 
// Business Card Printing Quote Form Mailer
if(isset($_POST['submit'])){
    $to = "printing@jasonajames.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $customer_name = $_POST['customer_name'];
	$contact_email = $_POST['contact_email'];
    $billing_address = $_POST['billing_address'];
	$shipping_address = $_POST['shipping_address'];
	$project_name = $_POST['project_name'];
	$print_quantity = $_POST['print_quantity'];
	$print_type = $_POST['print_type'];
	
	
    $subject = "Printing Quote Form Submission";
    $message = $customer_name . " Printing Quote:" . "\n\nCustomer Name: " . $customer_name . "\n
	Customer Email: " . $contact_email . "\n
	Product of Interest: " . $print_type . "\n
	Quantity: " $print_quantity . $_POST['message'];

    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);
     echo "Mail Sent. Thank you " . $customer_name . ",\n we will contact you shortly.";
   // header('Location: PrintFileUpload.html');
    }
?>