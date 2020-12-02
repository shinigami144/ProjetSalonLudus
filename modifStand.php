<?php
require("db.php");	
if(isset($conn) && ($_POST != NULL)){
    $sql = "UPDATE stand SET nomStand=?,descriptionStand=?,adresseStand=?,imageStand=?,pitchStand=?,siteStand=? WHERE idStand=?"; // ajouter site stand 
    $req = $conn->prepare($sql);
    echo $_POST["nomEntreprise"];
    echo $_POST['idStand'];
    echo $_POST['descriptionEntreprise'];
    echo $_POST['adresseEntreprise'];
    echo $_POST['siteEntreprise']; // manque site
    if($_FILES["LogoEntreprise_Upload"]["name"] != ""){
        $pathnameLogo = pathinfo($_FILES["LogoEntreprise_Upload"]["name"]);
        $pathLogo = "./File/Logo/Stand".$_POST['idStand'].".".$pathnameLogo['extension'];
    }
    else{
        $sqlLogo = "SELECT imageStand FROM stand WHERE idStand=?"; 
        $reqLOGO = $conn->prepare($sqlLogo);
        $reqLOGO->execute([$_POST['idStand']]);
        $v = $reqLOGO->fetchAll();
        if($v[0]['imageStand'] == null){
            $pathLogo = null;
        }
        else{
            $pathLogo = $v[0]['imageStand'];
        }
    }
    $sqlFile = "SELECT * FROM fichier WHERE idStand=?"; 
    $reqFile = $conn->prepare($sqlFile);
    $reqFile->execute([$_POST['idStand']]);
    $f= $reqFile->fetchAll();
    if(empty($f)){
        $sql2 = "INSERT fichier SET nomFichier=?,lienFIchier=?,idStand=?";
    }
    else{
        $sql2 = "UPDATE fichier SET nomFichier=?,lienFIchier=? WHERE idStand=?";
    }
    if($_FILES["fileToUpload"]["name"] != ""){
        $pathnameBrochure = pathinfo($_FILES['fileToUpload']["name"]);
        $pathBrochure ="./File/Brochure/Stand".$_POST['idStand'].".".$pathnameBrochure['extension'];
    }
    else{
        if(empty($f)){
            $pathBrochure = null;
        }
        else{
            $pathBrochure = $f[0]['lienFIchier'];
        }
    }
    try{
        move_uploaded_file($_FILES["LogoEntreprise_Upload"]["tmp_name"],$pathLogo);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$pathBrochure);
        
    }
    catch(PDOException $e){
        echo "<script> Connection failed: " . $e->getMessage() . "</script>";
    }

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