<?php 
	session_start();
	if(!isset($_SESSION['email']))
		header('Location:inscription.php');
    require_once 'db.php';

    $matricule_enseignant = $_SESSION['matricule_enseignant'];
    $matricule_personnel=NULL;
    date_default_timezone_set('Africa/Algiers');
	$datePublication = date("Y-m-d : H:i:s");
	
    $contenu = htmlspecialchars($_POST['contenu']);
    $promo = $_POST['promo'];
    $allowed =  array('pdf','png' ,'jpg','pptx','xlsx','rtf');
    // if(!isset($_FILES['fichier']) || $_FILES['fichier']['error'] == UPLOAD_ERR_NO_FILE)

	if(empty($_FILES['fichier']['name'])) { 
		$name = "";
		$type = "";
		$data_file = NULL;
		
            foreach($_POST['promo'] as $check) {
								$stmt = $bdd->prepare("INSERT INTO publication (datePublication, contenu,matricule_enseignant, id_promo, name_file, mime_file, data_file) VALUES
								                                  (:datePublication, :contenu,:matricule_enseignant, :id_promo, :name_file, :mime_file, :data_file)");
								$stmt->bindParam(':datePublication', $datePublication);
								$stmt->bindParam(':contenu', $contenu);
								$stmt->bindParam(':matricule_enseignant', $matricule_enseignant);
								$stmt->bindParam(':id_promo', $check);
								$stmt->bindParam(':name_file', $name);
								$stmt->bindParam(':mime_file', $type);
								$stmt->bindParam(':data_file', $data_file);

								$stmt->execute();
								$_SESSION['champs']="";
								
								header('Location:filActuEns.php');
								
								}
        }
        else{
        			$name = $_FILES['fichier']['name'];
					$type = $_FILES['fichier']['type'];
					$data_file = file_get_contents($_FILES['fichier']['tmp_name']);
					$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

					if(!in_array($ext,$allowed) ){
						 $_SESSION['champs']='Le format du fichier n\'est pas accépté';
						 header('Location:filActuEns.php');
						}
			 else{
	     		foreach($_POST['promo'] as $check) {
	     			
									$stmt = $bdd->prepare("INSERT INTO publication (datePublication, contenu,matricule_enseignant, id_promo, name_file, mime_file, data_file) VALUES (:datePublication, :contenu,:matricule_enseignant, :id_promo, :name_file, :mime_file, :data_file)");
									$stmt->bindParam(':datePublication', $datePublication);
									$stmt->bindParam(':contenu', $contenu);
									$stmt->bindParam(':matricule_enseignant', $matricule_enseignant);
									$stmt->bindParam(':id_promo', $check);
									$stmt->bindParam(':name_file', $name);
									$stmt->bindParam(':mime_file', $type);
									$stmt->bindParam(':data_file', $data_file);
									
									$stmt->execute();
									$_SESSION['champs']="";
									header('Location:filActuEns.php');
									
									}
	             
		}
	
}




?>