<?php
class stand
{
		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 
	private $idStand;
	private $nomStand;
	private $imageStand;
	private $pitchStand;
	private $adresseStand;
	private $codePostalStand;
	private $villeStand;
	private $idPaysStand;
	private $descriptionStand;
	private $ouvertureStand;
	private $fermetureStand;
	private $ouvertStand;
	private $stockInfoStand;
	private $idSalon;
	private $acceptationStand;
	public function __construct($idStand= null, $nomStand= null, $imageStand = null, $pitchStand = null, 
	$adresseStand = null, $codePostalStand = null, $villeStand = null, $idPaysStand = null,
	$descriptionStand = null, $ouvertureStand = null, $fermetureStand = null, $ouvertStand = null,
	$stockInfoStand = null, $idSalon = null, $acceptationStand = null)
	{
		$this->idStand = $idStand;
		$this->nomStand = $nomStand;
		$this->imageStand = $imageStand;
		$this->pitchStand = $pitchStand;
		
		$this->adresseStand = $adresseStand;
		$this->codePostalStand = $codePostalStand;
		$this->villeStand = $villeStand;
		$this->idPaysStand = $idPaysStand;
		
		$this->descriptionStand = $descriptionStand;
		$this->ouvertureStand = $ouvertureStand;
		$this->fermetureStand = $fermetureStand;
		$this->ouvertStand = $ouvertStand;
		
		$this->stockInfoStand = $stockInfoStand;
		$this->idSalon = $idSalon;
		$this->acceptationStand = $acceptationStand;
	}
	
	public function show()
	{
		echo "<tr> <td>". $this->idStand . " <td>" . $this->nomStand . " <td>" . $this->imageStand . "<td>" . $this->pitchStand . " <td>" . 
		$this->codePostalStand . "<td> " . $this->villeStand . "<td> " . $this->idPaysStand  . "<td> " . $this->descriptionStand . 
		$this->ouvertureStand . "<td> " . $this->fermetureStand . "<td> " . $this->ouvertStand  . "<td> " . $this->pitchStand . 
		$this->stockInfoStand . "<td> " . $this->idSalon . "<td> " . $this->acceptationStand . "</tr>";
	}
	
	public function addStandByParams($connexion)
	{
		var_dump($this);

		$idStand = $this->idStand;
		$nomStand = $this->nomStand;
		$imageStand = $this->imageStand;
		$pitchStand = $this->pitchStand;
		$codePostalStand = $this->codePostalStand;
		$villeStand = $this->villeStand;
		$idPaysStand = $this->idPaysStand;
		$descriptionStand = $this->descriptionStand;
		$ouvertureStand = $this->ouvertureStand;
		$fermetureStand = $this->fermetureStand;
		$ouvertStand = $this->ouvertStand;
		$pitchStand = $this->pitchStand;
		$stockInfoStand = $this->stockInfoStand;
		$idSalon = $this->idSalon;
		$acceptationStand = $this->acceptationStand;
		$req = "INSERT INTO utilisateur(idStand, nomStand, imageStand, pitchStand, 
		codePostalStand, villeStand, idPaysStand, descriptionStand,
		ouvertureStand, fermetureStand, ouvertStand, pitchStand,
		stockInfoStand, idSalon, acceptationStand)
		VALUES('".$idStand."','".$nomStand."','".$imageStand."','".$pitchStand."',
		'".$codePostalStand."','".$villeStand."','".$idPaysStand."', '".$descriptionStand."',
		'".$ouvertureStand."','".$fermetureStand."','".$ouvertStand."', '".$pitchStand."',
		'".$stockInfoStand."','".$idSalon."','".$acceptationStand."')";

		try
		{
			$stmt = $connexion->prepare($req);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
		if(isset($connexion))
		{
			if ($stmt->execute() === TRUE) {
			  echo "New record created successfully";
			} 
		}
	}
}
function connectDB()
{
	define("SERVERNAME", "127.0.0.1");
	define("username", "root");
	define("password", "");
	define("db", "salonvirtuel");
	try {
		$conn = new PDO("mysql:host=". SERVERNAME .";dbname=".db, username, password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "<script> console.log('Connected successfully') </script>";
	}
	catch(PDOException $e)
	{
		echo "<script> Connection failed: " . $e->getMessage() . "</script>";
	}
	
	return $conn;
}



?>