<?php
class SendEMail {
	public $serverSMTP;
	public $port;
	public $secure;
	public $userName;
	public $password;
	
	/**
	 * Constructor
	 */
	function __construct() {
		$this->serverSMTP = Yii::app ()->params ['SwifMailer'] ['serverSMTP'];
		$this->port = Yii::app ()->params ['SwifMailer'] ['port'];
		$this->secure = Yii::app ()->params ['SwifMailer'] ['secure'];
		$this->userName = Yii::app ()->params ['SwifMailer'] ['userName'];
		$this->password = Yii::app ()->params ['SwifMailer'] ['password'];
	}
	
	/**
	 * Enviamos e-mail para que el usuario recupere su contraseña
	 *
	 * @param array $data        	
	 */
	public function sendMailPass($title, $to, $toName, $template) {
		$content = $template;
		
		// Plain text content
		$plainTextContent = "";
		
		// Get mailer
		$SM = Yii::app ()->swiftmailer;
		
		// New transport
		$Transport = Swift_SmtpTransport::newInstance ( $this->serverSMTP, $this->port, $this->secure )->setUsername ( $this->userName )->setPassword ( $this->password );
		
		// Mailer
		$Mailer = $SM->mailer ( $Transport );
		
		// New message
		$Message = $SM->newMessage ( $title )->setFrom ( array (
				Yii::app ()->params ['contactEmail'] => Yii::app ()->params ['contactName'] 
		) )->setTo ( array (
				$to => $toName 
		) )->addPart ( $content, 'text/html' )->setBody ( $plainTextContent );
		
		// Send mail
		$result = $Mailer->send ( $Message );
	}
	
	
	
	
	
	
	/**
	 * Enviamos e-mail para soporte
	 *
	 * @param array $data
	 */
	public function sendMailSoporte($title, $to, $toName, $template) {
		$content = $template;
	
		// Plain text content
		$plainTextContent = "";
	
		// Get mailer
		$SM = Yii::app ()->swiftmailer;
	
		// New transport
		$Transport = Swift_SmtpTransport::newInstance ( $this->serverSMTP, $this->port, $this->secure )->setUsername ( $this->userName )->setPassword ( $this->password );
	
		// Mailer
		$Mailer = $SM->mailer ( $Transport );
	
		// New message
		$Message = $SM->newMessage ( $title )->setFrom ( array (
				Yii::app ()->params ['contactEmail'] => Yii::app ()->params ['contactName']
		) )->setTo ( array (
				$to => $toName
		) )->addPart ( $content, 'text/html' )->setBody ( $plainTextContent );
	
		// Send mail
		$result = $Mailer->send ( $Message );
	}
}