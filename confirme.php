<?php
       
       if(isset($_GET['email_utilisateur'])){
            require_once('db.php');
           
            $email_utilisateur = htmlspecialchars($_GET['email_utilisateur']);
            $token = htmlspecialchars($_GET['token']);
            $statut = htmlspecialchars($_GET['statut']);
            $EmailConfirm =0;
                if($statut === 'Etudiant'){
                    $rq = $bdd->query("SELECT * FROM etudiant WHERE 
                    email='".$email_utilisateur."' AND token='".$token."' AND  EmailConfirm='".$EmailConfirm."' ");
                    
                        if($rq->rowCount()!= 0){
                                $EmailConfirm =1;
                                $token ="";
                                $sql= "UPDATE etudiant SET 
                                    EmailConfirm ='".$EmailConfirm."', token = '".$token."' WHERE email = '".$email_utilisateur."' ";
                                $rq = $bdd->prepare($sql);
                                
                                if($rq->execute()){
                                    echo "Inscription réussite";
                                     header('Location:Connexion.php');
                                }
                                else{
                                    echo "Inscription non réussite";
                                }
                            }
                        }
                        if($statut === 'Enseignant'){
                            $rq = $bdd->query("SELECT * FROM enseignant WHERE 
                            email='".$email_utilisateur."' AND token='".$token."' AND  EmailConfirm='".$EmailConfirm."' ");
                            
                                if($rq->rowCount()!= 0){
                                        $EmailConfirm =1;
                                        $token ="";
                                        $sql= "UPDATE enseignant SET 
                                            EmailConfirm ='".$EmailConfirm."', token = '".$token."' WHERE email = '".$email_utilisateur."' ";
                                        $rq = $bdd->prepare($sql);
                                        
                                        if($rq->execute()){
                                            echo "Inscription réussite";
                                             header('Location:Connexion.php');
                                        }
                                        else{
                                            echo "Inscription non réussite";
                                        }
                                    }
                                }
                        if($statut === 'Personnel'){
                                    $rq = $bdd->query("SELECT * FROM personnel WHERE 
                                    email='".$email_utilisateur."' AND token='".$token."' AND  EmailConfirm='".$EmailConfirm."' ");
                                    
                                        if($rq->rowCount()!= 0){
                                                $EmailConfirm =1;
                                                $token ="";
                                                $sql= "UPDATE personnel SET 
                                                    EmailConfirm ='".$EmailConfirm."', token = '".$token."' WHERE email = '".$email_utilisateur."' ";
                                                $rq = $bdd->prepare($sql);
                                                
                                                if($rq->execute()){
                                                    
                                                    header('Location:success.php');
                                                }
                                                else{
                                                    echo "Inscription non réussite";
                                                }
                                            }
                                        }
            }
            else{
                header('Location:inscription.php');
            }
            
?>
