<?php
include("db.php");	

	echo "non visible";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$ouvertStand = 1;
	$stockInfoStand = 2;
	$idSalon = 1;
	$acceptationStand = 1;
	$ouvertureStand = 1;
	$fermetureStand = 2;
	$nomStand = $_POST["nomStand"];
	$descriptionStand = $_POST["descriptionStand"];
	$adresseStand = $_POST["adresseStand"];
	$imageStand = $_POST["imageStand"];
	$codePostalStand = $_POST["codePostalStand"];
	
	//CREATION DU STAND
	$req = "INSERT INTO stand(ouvertStand, stockInfoStand, idSalon, acceptationStand, 
	nomStand, descriptionStand, adresseStand, ouvertureStand, fermetureStand, 
	imageStand, codePostalStand)
	VALUES(".$ouvertStand.",".$stockInfoStand.",".$idSalon.", ".$acceptationStand.",
	'".$nomStand."','".$descriptionStand."','".$adresseStand."','".$ouvertureStand."','".$fermetureStand."','".$imageStand."',
	'".$codePostalStand."')";
	
	echo $req;
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
	
    //$req->execute([$_POST['nomEntreprise'],$_POST['descriptionEntreprise'],$_POST['idStand']]);
    header("Location: http://salonvirtuel/stand.php?idStand=".$id);
}
?>