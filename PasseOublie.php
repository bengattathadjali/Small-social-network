<?php 
  session_start();
?>
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

  <form action="TPasseOublie.php" method="POST">
  <p>
    <label for="username">E-mail</label>
    <input id="username" name="email" type="email"required>
  </p>

   
          <center>
                <select name="statut">
                  <option >Enseignant</option>
                  <option>Etudiant</option>
                  <option>Personnel</option>
                </select>
              <b><p style="color:red;  font-size: 20px;"><?php if (isset($_SESSION['Passe']))
                                                                        echo $_SESSION['Passe']; 
                                                                ?>
                                                                  
                                                                </p></b></center>

  
  <p>
    <input type="submit" value="Récuperer Mot de passe" id="submit">
  </p>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</form>
 

  

    <script  src="assets/js/ChangerMotDepasse.js"></script>




</body>

</html>


