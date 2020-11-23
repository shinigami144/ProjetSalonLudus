<?php
require("connect.php");	
$conn = connectDB(); 
if(isset($conn) && ($_POST != NULL)){
    $sql = "UPDATE stand SET nomStand=?,descriptionStand=?,adresseStand=? WHERE idStand=?";
    $req = $conn->prepare($sql);
    echo $_POST["nomEntreprise"];
    echo $_POST['idStand'];
    echo $_POST['descriptionEntreprise'];
    echo $_POST['adresseEntreprise'];
    echo $_POST['emailEntreprise']; // manque email
    echo $_POST['siteEntreprise']; // manque site
    echo $_POST['telephoneEntreprise']; // manque tel 
    echo $_POST["LogoEntreprise_Upload"];
    echo $_POST["fileToUpload"];
    var_dump($req);
    try {
		$req->execute([$_POST["nomEntreprise"],$_POST['descriptionEntreprise'],$_POST['adresseEntreprise'],$_POST['idStand']]);
	}
	catch(PDOException $e)
	{
		echo "<script> Connection failed: " . $e->getMessage() . "</script>";
	}
    //$req->execute([$_POST['nomEntreprise'],$_POST['descriptionEntreprise'],$_POST['idStand']]);
    header("Location: http://localhost/projetGD/ProjetSalonLudus/stand.php?idStand=".$_POST['idStand']);
}
?>