<?php
// code sql pour mettre a jour les file.
if($_GET["idStand"]!=null){

    // verifcation pas dans une file.
    require("db.php");
    $sql3 = "SELECT idStandFdA FROM utilisateur WHERE idUtilisateur=?";
    $req3 = $conn->prepare($sql3);
    $req3->execute([$_GET['idUser']]);
    $result = $req3->fetchAll();
    if($result[0]['idStandFdA'] == null){
        $sql="SELECT MAX(positionFdA) FROM utilisateur WHERE idStandFdA=?";
        $req = $conn->prepare($sql);
        $req->execute([$_GET['idStand']]);
        $value = $req->fetchAll();
        $maPositionFile = $value[0]['MAX(positionFdA)']+1;
        $sql2="UPDATE utilisateur SET idStandFdA=?,positionFdA=?  WHERE idUtilisateur=?";
        $req2 = $conn->prepare($sql2);
        $req2->execute([$_GET['idStand'], $maPositionFile,$_GET['idUser']]);
        echo 'AjoutOK';
    }
    else{
        echo 'AjoutNonOK';
    }
}
    
?>