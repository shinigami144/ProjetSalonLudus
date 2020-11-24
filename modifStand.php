<?php
require("connect.php");	
$conn = connectDB(); 
if(isset($conn) && ($_POST != NULL)){
    $sql = "UPDATE stand SET nomStand=?,descriptionStand=?,adresseStand=?,imageStand=? WHERE idStand=?"; // ajouter site stand 
    $sql2 = "UPDATE fichier SET nomFichier=?,lienFIchier=? WHERE idStand=?";
    $req = $conn->prepare($sql);
    //echo $_POST["nomEntreprise"];
    //echo $_POST['idStand'];
    //echo $_POST['descriptionEntreprise'];
    //echo $_POST['adresseEntreprise'];
    //echo $_POST['siteEntreprise']; // manque site
    $pathLogo = "./File/Logo/Stand".$_POST['idStand'];
    $pathBrochure ="./File/Brochure/Stand".$_POST['idStand'];
    var_dump($_FILES);
    var_dump($_POST);
    try{
        if(file_exists($pathLogo)){
            echo "pathlogo existe donc pas save";
        }
        else{
            $etat1 = move_uploaded_file($_FILES["LogoEntreprise_Upload"]["tmp_name"],$pathLogo);
        }   
        if(file_exists($pathBrochure)){
            echo "brochure existe";
        }
        else{
            $etat2 = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$pathBrochure);
        }
        //echo "Try : verif filetoUpload ; ".$_POST["fileToUpload"];
        echo $etat1;
        echo $etat2;
    }
    catch(PDOException $e){
        echo "<script> Connection failed: " . $e->getMessage() . "</script>";
    }
    var_dump($req);
    try {
        $req->execute([$_POST["nomEntreprise"],$_POST['descriptionEntreprise'],$_POST['adresseEntreprise'],$pathLogo,$_POST['idStand']]);
        $req2 = $conn->prepare($sql2);
        $req2->execute([$_FILES['fileToUpload']["name"],$pathBrochure,$_POST['idStand']]);
	}
	catch(PDOException $e)
	{
		echo "<script> Connection failed: " . $e->getMessage() . "</script>";
	}
    //$req->execute([$_POST['nomEntreprise'],$_POST['descriptionEntreprise'],$_POST['idStand']]);
    //header("Location: http://localhost/projetGD/ProjetSalonLudus/stand.php?idStand=".$_POST['idStand']);
}
?>