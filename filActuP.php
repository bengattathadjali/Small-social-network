<?php
	session_start();
	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Fil D'actualité</title>
	<meta charset="utf-8">
</head>
<body>
	<form action="TraitFilActuP.php" method="POST">
		<center>
			<textarea rows="10" cols="15" name="contenu"></textarea><br>
		
		<input type="submit" name="Envoyer" value="publier">
		</center>
	</form>
</body>
</html>