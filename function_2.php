<?php
	require "vendor/autoload.php";
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	function sendmail($email_utilisateur,$mdp){
		$dev = true;
        $mailer = new PHPMailer ($dev);
        $mailer->SMTPDebug = 2;
        $mailer->isSMTP();
            if($dev){
                $mailer->SMTPOptions = [
                        'ssl'=> [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                                ]
                                        ];
                    	}
                $mailer->Host = 'smtp.gmail.com';
                $mailer->SMTPAuth =true;
                $mailer->Username = 'fsei27000@gmail.com';
                $mailer->Password = '***********';
                $mailer->SMTPSecure = 'tls';
                $mailer->Port = 587;
                                
				$mailer->setFrom($mailer->Username,'Faculte des sciences exacates de l\'informatique');
                $mailer->addAddress($email_utilisateur,"");
                $mailer->isHTML(true);
                $mailer->Subject = 'Nouveau Mot de Passe';
                $mailer->Body="
                              Bonjour, Voici votre nouveau mot de passe: $mdp
                                        ";
                                
                if($mailer->send()){
                        $mailer->ClearAllRecipients();
                        echo "hola";
                                    }
                else{
                        echo "echec";
                        }
	}
	


?>
