<?php

	/*
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new user(0, $_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["pays"], $_POST["ville"], $_POST["code_postal"], $_POST["date_naissance"]);
		}*/
		
	require("connect.php");	
	$conn = connectDB(); 

	$req = "select * from stand";
	if(isset($conn))
	{
		$table = $conn->prepare($req);
		$table->execute();
		
		echo "<table><tr><th>idStand<th>nomStand<th>imageStand<th>pitchStand
			<th>codePostalStand<th>villeStand<th>idPaysStand<th>descriptionStand
			<th>ouvertureStand<th>fermetureStand<th>ouvertStand<th>pitchStand
			<th>stockInfoStand<th>idSalon<th>acceptationStand
			";
		foreach($table as $row)
		{
			$stand = new stand($row["idStand"], $row["nomStand"]);
			$stand->show();
		}
		echo "</table>";
		
		echo'
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>File</title>
		</head>
		<body>
		<p>Vous êtes bien dans le main</p>
			
		<h4>Liste des stand</h4>';
		echo '<form method="get" action="addStand.php">
			<select name = "idStand" id="idStand">';
		$table->execute();	
			foreach($table as $row)
			{
				echo '<option value="'. $row["idStand"]. '">'. $row["nomStand"] . '</option>';
			}
			echo '</select>
			<br/><input type="submit" value="Regarder">
			</form>';
		echo "
		
		<h4>Ajouter un stand</h4>
		<form method = 'post' action ='/addStand.php'>
			nomStand <input name='nomStand' type= 'text' required>
			 descriptionStand <input name='descriptionStand' type= 'text' required>
			 adresseStand <input name='adresseStand' type= 'text'>
			<br> imageStand <input name='imageStand' type= 'text'>
			idPaysStand <input name='idPaysStand' type= 'text'>
			codePostalStand <input name='codePostalStand' type= 'text'>
		<br/><input type='submit' value='Ajouter'>
		</form>
		</body>
		</html>";
	}

?>
