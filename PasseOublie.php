
<!DOCTYPE html>
<html lang="fr" >

<head>
  <meta charset="UTF-8">
  <title>Mot De Passe Oublié</title>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  
      <link rel="stylesheet" href="assets/css/ChangerMotDepasse.css">
      
  
</head>

<body>

  <form action="PasseOublie.php" method="POST">
  <p>
    <label for="username">E-mail</label>
    <input id="username" name="mail" type="text">
  </p>

   <p>
    <label>Matricule</label>
    <input   name="Matricule" type="password">
  </p>
          <center>
                <select name="statut">
                  <option >Enseignant</option>
                  <option>Etudiant</option>
                  <option>Personnel</option>
                </select>
            </center>
  

  
  <p>
    <input type="submit" value="Récuperer Mot de passe" id="submit">
  </p>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</form>
 

  

    <script  src="assets/js/ChangerMotDepasse.js"></script>




</body>

</html>


