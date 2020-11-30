<?php
    require("db.php");
    $sql2="UPDATE utilisateur SET idStandFdA=?,positionFdA=?  WHERE mailUtilisateur=?";
    $req2 = $conn->prepare($sql2);
    $req2->execute([null,null,$_GET['mail']]);
?>