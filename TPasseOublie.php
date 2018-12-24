<?php 

        if(!isset($_POST['email']))
            header('Location:PasseOublie.php');

        session_start();
        require_once 'db.php';
        require_once 'function_2.php';

        $email=htmlspecialchars($_POST['email']);
        $statut = $_POST['statut'];
        $mdp = 'AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn0123456789';
		$mdp = str_shuffle($mdp);
        $mdp= substr($mdp,0,8);
        
            if($statut === "Etudiant"){
                $rq = $bdd->prepare('SELECT email FROM etudiant WHERE email =:email ');
										$rq ->execute(array(
											'email'=>$email
										));
										
										if($rq->rowCount()===1){
                                            sendmail($email,$mdp);
										    $mdp = md5($mdp);
		   								    $sql  = "UPDATE etudiant SET motDePasse=:motDePasse WHERE email=:email";
											$stmt = $bdd->prepare($sql);
											$stmt->bindValue(":motDePasse",$mdp,PDO::PARAM_STR);
											$stmt->bindValue(":email",$email,PDO::PARAM_STR);
											
											    if($stmt->execute()){
                                                    header('Location:PasseOublie.php');
                                                    $_SESSION['Passe']="Consultez votre Email";
                                                }
										    
                                        }
                                        else{
                                           header('Location:PasseOublie.php');
                                           $_SESSION['Passe']="Erreur";
                                        }
            }
            if($statut === "Enseignant"){
                $rq = $bdd->prepare('SELECT email FROM enseignant WHERE email =:email ');
										$rq ->execute(array(
											'email'=>$email
										));
										
										if($rq->rowCount()===1){
                                            sendmail($email,$mdp);
										    $mdp = md5($mdp);
		   								    $sql  = "UPDATE enseignant SET motDePasse=:motDePasse WHERE email=:email";
											$stmt = $bdd->prepare($sql);
											$stmt->bindValue(":motDePasse",$mdp,PDO::PARAM_STR);
											$stmt->bindValue(":email",$email,PDO::PARAM_STR);
											
											    if($stmt->execute()){
                                                    header('Location:PasseOublie.php');
                                                    $_SESSION['Passe']="Consultez votre Email";
                                                }
                                        }
                                        else{
                                            header('Location:PasseOublie.php');
                                            $_SESSION['Passe']="Erreur";
                                        }
            }
            if($statut === "Personnel"){
                $rq = $bdd->prepare('SELECT email FROM personnel WHERE email =:email ');
										$rq ->execute(array(
											'email'=>$email
										));
										
										if($rq->rowCount()===1){
										    sendmail($email,$mdp);
										    $mdp = md5($mdp);
		   								    $sql  = "UPDATE personnel SET motDePasse=:motDePasse WHERE email=:email";
											$stmt = $bdd->prepare($sql);
											$stmt->bindValue(":motDePasse",$mdp,PDO::PARAM_STR);
											$stmt->bindValue(":email",$email,PDO::PARAM_STR);
											
											    if($stmt->execute()){
                                                    header('Location:PasseOublie.php');
                                                    $_SESSION['Passe']="Consultez votre Email";
                                                }
                                        }
                                        else{
                                            header('Location:PasseOublie.php');
                                           $_SESSION['Passe']="Erreur";
                                        }
            }



?>