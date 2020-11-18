<?php
<<<<<<< HEAD

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
		echo '<form method="get" action="stand.php">
			<select name = "idStand" id="idStand">';
		$table->execute();	
			foreach($table as $row)
			{
				echo '<option value="'. $row["idStand"]. '">'. $row["nomStand"] . '</option>';
			}
			echo '</select>
			<br/><input type="submit" value="Regarder">
			</form>';
		echo '
		</body>
		</html>';
	}
			
=======
$servername = "localhost";
$username = "root";
$password = "";
>>>>>>> eec8a09648a8f6d98cff061c7f5b053e97292059

try {
  $conn = new PDO("mysql:host=$servername;dbname=salonvirtuel", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  //echo "Connection failed: " . $e->getMessage();
}

$sql ="SELECT * FROM stand;";
$req = $conn->prepare($sql);
$req->execute();
$data =$req->fetchAll();
foreach ($data as $users){
    echo '<form action="Stand.php" method="GET">';
    echo '<p>'.$users['nomStand'].'</p>';
    echo '<input type="submit" name=idStand id=idStand value='.$users['idStand'].'>';
    echo '</form>';
}
?>
