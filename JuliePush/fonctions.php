<?php
    // mailUtilisateur  =  $_SESSION['mail']
    function AfficheImageProfil ($mailUtilisateur)
    {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT photoUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$mailUtilisateur.'"');
            $sql->execute();
            $result = $sql->fetchAll();

            foreach ($result as $user) {
                echo '<img src="css/'.$user['photoUtilisateur'].'.png" >';
            }

          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }      
    }

    function AfficheNomPrenom ($mailUtilisateur)
    {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT nomUtilisateur, prenomUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$mailUtilisateur.'"');
            $sql->execute();
            $result = $sql->fetchAll();

            foreach ($result as $user) {
                echo "<h1>".$user['prenomUtilisateur']." ".$user['nomUtilisateur']."</h1>";
            }

          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
    }

?>