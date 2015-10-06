<?php
	require_once "Mail.php";
	header('Content-type: application/json');
	$status = array(
		'type'=>'success',
		'message'=>'Obrigado por nos contatar. Assim que possível entraremos em contato'
	);

    $name = @trim(stripslashes($_POST['name'])); 
    $email = @trim(stripslashes($_POST['email']));
    $telefone = @trim(stripslashes($_POST['telefone']));
    $empresa = @trim(stripslashes($_POST['empresa']));
    $subject = @trim(stripslashes($_POST['subject'])); 
    $message = @trim(stripslashes($_POST['message'])); 

    $email_from = $email;
    $email_to = 'contatoreacaojr@gmail.com';//replace with your email

    $body = 'Nome: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Telefone: ' . $telefone . "\n\n" . 'Empresa: ' . $empresa . "\n\n" . 'Assunto: ' . $subject . "\n\n" . 'Mensagem: ' . $message;

    $host = "ssl://smtp.sistemas.ufsc.br";
    $username = "reacaojr";
    $password = "";
        
    $headers = array ('From' => $email_from,
    		'To' => $email_to,
    		'Subject' => 'Email enviado referente a contato efetuado no site Reação Júnior');
    $smtp = Mail::factory('smtp',
    		array ('host' => $host,
    				'auth' => true,
    				'port' => '587',
    				'username' => $username,
    				'password' => $password));
    
    $mail = $smtp->send($email_to, $headers, $body);
    
    if (PEAR::isError($mail)) {    	
    	$status = array(
    			'type'=>'success',
    			'message'=>$mail->getMessage()
    	);    	
    }
    echo json_encode($status);
    
    die;
    
