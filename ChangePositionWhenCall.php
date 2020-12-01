<?php
    require("db.php");
    $sql2="UPDATE utilisateur SET positionFdA=?  WHERE mailUtilisateur=?";
    $req2 = $conn->prepare($sql2);
    $req2->execute([-1,$_GET['mail']]);
?>