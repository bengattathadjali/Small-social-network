<?php
	require "vendor/autoload.php";
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	function sendmail($email_utilisateur,$nom_utilisateur,$token,$statut){
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
                $mailer->Password = 'Umab27fsei';
                $mailer->SMTPSecure = 'tls';
                $mailer->Port = 587;
                                
				$mailer->setFrom($mailer->Username,'Faculte des sciences exacates de l\'informatique');
                $mailer->addAddress($email_utilisateur,$nom_utilisateur);
                $mailer->isHTML(true);
                $mailer->Subject = 'Confirmation Email';
                $mailer->Body="
                              Bonjour, Mr/Mlle $nom_utilisateur Pour activer votre compte cliquez sur ce lien : <br><br>
                              <a href='http://localhost/fsei/Confirme.php?email_utilisateur=$email_utilisateur&token=$token&statut=$statut'>Cliquez Ici !</a>
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