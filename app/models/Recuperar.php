<?php

//session_start();
class Recuperar
{
	public $_data,
			$_db;

	public function __construct()
	{
		$this->_db = DB::getInstance();

	}

	public function check($username = null)
	{		
		//$user = DB::getInstance()->get("usuarios", array('documento','=',$username));
		$user = $this->_db->get("usuarios", array('documento','=',$username));
		if ($user->count()) {
			$this->_data = $user->first();					

			return $this->sendMail($this->_data->correo);		
		}
		return false;
	}

	private function sendMail($correo)
	{		

		if (file_exists("../vendor/PHPMailer/PHPMailerAutoload.php"))
		{
			require "../vendor/PHPMailer/PHPMailerAutoload.php";
			$mail = new PHPMailer;

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'alonsoloaiza@gmail.com';                 // SMTP username
			$mail->Password = '(1017)hcn';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->From = 'no_responder@cta.org.co';
			$mail->FromName = 'Centro de ciencia y tecnología de antioquia - CTA';
			$mail->addAddress('vasquez.s.david@gmail.com', $this->_data->primerNombre." ".$this->_data->primerApellido);     // Add a recipient

			$mail->isHTML(true);  

			$correo = file_get_contents('../app/views/mail/mail.html', dirname(__FILE__));                                  // Set email format to HTML
			$correo = str_replace("**nombre**", $this->_data->primerNombre." ".$this->_data->primerApellido, $correo);

			$mail->Subject = 'Recuperación de contraseña';

			$mail->Body    = $correo;
			$mail->AltBody = 'Este es el mensaje para navegadores viejos';

			$mail->CharSet = 'UTF-8';

			if(!$mail->send()) {
			    // echo 'Message could not be sent.';
			    // echo 'Mailer Error: ' . $mail->ErrorInfo;
			    return false;
			} else {
			    // echo 'Message has been sent';
			    return true;
			}

		}
		#enviar correo phpMailer
		//return true;
	}

	private function clean()
	{
		$this->_data = null;
	}


}