<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require dirname(__FILE__) . '/phpmailer/autoload.php';





class mailphp
{



   public function send_report($message)

       {


                   $mail = new PHPMailer(true);



		     try {
		    //Server settings
		    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'mail.smtp2go.com';                     // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'ryancalo53';                       // SMTP username
		    $mail->Password = 'codemasterryancalo';                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 8465;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('electricPH@gmail.com', 'Wifi Vendo');
		    $mail->addAddress('ryan@wiredsystems.com','Ryan Calo');               // Name is optional

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Wifi Vendo Report';
		    $mail->Body    = $message;
		    $mail->AltBody = 'Wifi Vendo Report';

		    $mail->send();
		    echo 'Message has been sent';

			} catch (Exception $e) {
			    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}









       }







 }






?>