<?php
require("db.php");
include('fonctions.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$idSalon = $_POST["idSalon"];
	$nomStand = $_POST["nomStand"];
	$pitchStand = $_POST["pitchStand"];
	$descriptionStand = $_POST["descriptionStand"];
	$siteStand = $_POST["siteStand"];
	$adresseStand = $_POST["adresseStand"];
	$codePostalStand = $_POST["codePostalStand"];
	$villeStand = $_POST["villeStand"];
	$imageStand = $_POST["imageStand"];
	$ouvertureStand = $_POST["ouvertureStand"];
	$fermetureStand = $_POST["fermetureStand"];

	$pays = $_POST['pays'];
	$idPaysStand = RecupIdPays($pays);

	$acceptationStand = 0;
	$ouvertStand = 1;
	$stockInfoStand = 0;

	// Aymeric et Manon 
	$descriptionStand = str_replace("'"," ",$descriptionStand);
	$pitchStand = str_replace("'"," ",$pitchStand);
	$nomStand = str_replace("'"," ",$nomStand);
	$adresseStand = str_replace("'"," ",$adresseStand);
	// FIN Aymeric et Manon 


	// echo( "
	// ID SALON".$idSalon. 
	// "<br/>"."NOM STAND -> ".$nomStand. 
	// "<br/>"."PITCH -> ".$pitchStand. 
	// "<br/>"."DESC -> ".$descriptionStand. 
	// "<br/>"."SITE -> ".$siteStand. 
	// "<br/>"."ADRESSE -> ".$adresseStand. 
	// "<br/>"."CP -> ".$codePostalStand. 
	// "<br/>"."VILLE -> ".$villeStand. 
	// "<br/>"."ID -> ".$idPaysStand
	// );
	
	//CREATION DU STAND
	$req = "INSERT INTO stand(
		ouvertStand, 
		stockInfoStand, 
		idSalon, 
		acceptationStand,
		nomStand, 
		descriptionStand, 
		adresseStand, 
		ouvertureStand, 
		fermetureStand,
		imageStand, 
		codePostalStand, 
		pitchStand, 
		siteStand,
		villeStand, 
		idPaysStand)
	VALUES(
		".$ouvertStand.",
		".$stockInfoStand.",
		".$idSalon.",
		".$acceptationStand.",
		'".$nomStand."',
		'".$descriptionStand."',
		'".$adresseStand."',
		'".$ouvertureStand."',
		'".$fermetureStand."',
		'".$imageStand."',
		".$codePostalStand.",
		'".$pitchStand."',
		'".$siteStand."',
		'".$villeStand."',
		".$idPaysStand.")";
	
	try
	{
		$stmt = $conn->prepare($req);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

	if(isset($conn))
	{
		if ($stmt->execute()) 
		{
		  echo "New record created successfully";
		}
		else
		{
			echo $e->getMessage();
		}
	}
	else
	{
		echo "Can't connect to DB";
	}

	//RECUPERATION DU l'ID DU NV STAND
	$req = "select * from stand";
	if(isset($conn))
	{
		$table = $conn->prepare($req);
		$table->execute();
	
		$id = 0;
		foreach($table as $row)
		{
			if($row["idStand"] > $id)
				$id = $row["idStand"];
		}
		echo $id;
	}

	$idUtilisateur = $_POST["idUtilisateur"];
	$droit = 1;
	$link = "./stand.php?idStand=".$id;

	$req = "INSERT INTO adminstand(
		idUtilisateur,
		idStand,
		droitAStand,
		lienAStand) 
		VALUES(
		".$idUtilisateur.",
		".$id.",
		".$droit.",
		'".$link."')";

	echo($req);

	try
	{
		$stmt = $conn->prepare($req);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

	if(isset($conn))
	{
		if ($stmt->execute() === TRUE) 
		{
		  echo "New record created successfully";
		}
		else
		{
			echo $e->getMessage();
		}
	}
	else
	{
		echo "Can't connect to DB";
	}

    header("Location: ./stand.php?idStand=".$id);
}
?>