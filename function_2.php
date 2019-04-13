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
                $mailer->Username = 'insfp27red@gmail.com';
                $mailer->Password = 'Rezaq123';
                $mailer->SMTPSecure = 'tls';
                $mailer->Port = 587;
                                
				$mailer->setFrom($mailer->Username,'INSFP');
                $mailer->addAddress($email_utilisateur,"");
                $mailer->isHTML(true);
                $mailer->Subject = 'Nouveau Mot de Passe';
                $mailer->Body="
                République Algérienne Démocratique et Populaire
                Ministère de la Formation et l’Enseignement Professionnels
                Institut National Spécialisé de la Formation Professionnelle
                MOSTAGANEM
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