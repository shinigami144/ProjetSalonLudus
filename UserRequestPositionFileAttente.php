<?php
require_once("./db.php");
$sql = "SELECT positionFdA FROM utilisateur WHERE idUtilisateur=?";
$req = $conn->prepare($sql);
$req->execute([$_GET["id"]]);
$value = $req->fetchAll();
if($value[0]["positionFdA"] == -1){
    echo '1';
}
else{
    echo '0';
}

?>