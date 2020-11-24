<?php
require("db.php");	
if(isset($conn) && ($_POST != NULL)){
    $sql = "UPDATE stand SET nomStand=?,descriptionStand=?,adresseStand=?,imageStand=?,pitchStand=?,siteStand=? WHERE idStand=?"; // ajouter site stand 
    $sql2 = "UPDATE fichier SET nomFichier=?,lienFIchier=? WHERE idStand=?";
    $req = $conn->prepare($sql);
    //echo $_POST["nomEntreprise"];
    //echo $_POST['idStand'];
    //echo $_POST['descriptionEntreprise'];
    //echo $_POST['adresseEntreprise'];
    //echo $_POST['siteEntreprise']; // manque site
    $pathnameLogo = pathinfo($_FILES["LogoEntreprise_Upload"]["name"]);
    $pathnameBrochure = pathinfo($_FILES['fileToUpload']["name"]);
    //var_dump($pathnameBrochure);
    $pathLogo = "./File/Logo/Stand".$_POST['idStand'].".".$pathnameLogo['extension'];
    $pathBrochure ="./File/Brochure/Stand".$_POST['idStand'].".".$pathnameBrochure['extension'];

    //var_dump($_FILES);
    //var_dump($_POST);
    try{
        move_uploaded_file($_FILES["LogoEntreprise_Upload"]["tmp_name"],$pathLogo);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$pathBrochure);
        
    }
    catch(PDOException $e){
        echo "<script> Connection failed: " . $e->getMessage() . "</script>";
    }
    //var_dump($req);
    try {
        $req->execute([$_POST["nomEntreprise"],$_POST['descriptionEntreprise'],$_POST['adresseEntreprise'],$pathLogo,$_POST['pitchStand'],$_POST['siteEntreprise'],$_POST['idStand']]);
        $req2 = $conn->prepare($sql2);
        $req2->execute([$_FILES['fileToUpload']["name"],$pathBrochure,$_POST['idStand']]);
	}
	catch(PDOException $e)
	{
		echo "<script> Connection failed: " . $e->getMessage() . "</script>";
	}
    //$req->execute([$_POST['nomEntreprise'],$_POST['descriptionEntreprise'],$_POST['idStand']]);
    header("Location: ./stand.php?idStand=".$_POST['idStand']);
}
?>