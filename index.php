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
		$table = $conn->query($req);
		
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
			<p>
				Vous êtes bien dans le main
				
				<h4>Liste des stand</h4>';
			echo '<form method="get" action="stand.php">
				<select name = "idStand" 	id="idStand">
				foreach($table as $row)
				{
					<option value="'. $row["idStand"]. '">'. $row["nomStand"] . '</option>
				}
				</select>
				<br/><input type="submit" value="Regarder">
				</form>';
		echo '
			</p>
		</body>
		</html>';
	}
			

?>