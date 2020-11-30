<?php
    if($_GET["perm"]!=null){
        require("db.php");
        $sql="SELECT nomUtilisateur,prenomUtilisateur,mailUtilisateur FROM utilisateur WHERE idStandFdA=? ORDER BY positionFdA ASC LIMIT 10";
        $req = $conn->prepare($sql);
        $req->execute([$_GET['idStand']]);
        $value = $req->fetchAll();
        if($_GET["perm"] == 2){
            foreach($value as $user){
                echo '<tr>';
                echo'<td>'.$user['nomUtilisateur'].'</td>';
                echo'<td>'.$user['prenomUtilisateur'].'</td>';
                echo'<td>'.$user['mailUtilisateur'].'</td>';
                echo '</tr>';
            }
        }
        else{
            foreach($value as $user){
                echo '<tr>';
                echo'<td>'.$user['nomUtilisateur'].'</td>';
                echo'<td>'.$user['prenomUtilisateur'].'</td>';
                echo '</tr>';
            }
        }
    }
    
?>