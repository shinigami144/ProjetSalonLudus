<?php
    session_start();
    include('fonctions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Création d'un stand</title>
    <link href="./creationStand.css" rel="stylesheet">
</head>
<body>
    <h4>Ajouter un stand</h4>
    <form action="./addStand.php" method="POST">
        <!-- Remplacer la valeur mise par défaut par la valeur en POST de l'id du salon -->
        <?php
            $idSalon = $_SESSION['idSalon'];
            $idUtilisateur = $_SESSION['idUtilisateur'];
            echo("<input style='display:none;' name='idSalon' type='text' value='".$idSalon."'>");
            echo("<input style='display:none;' name='idUtilisateur' type='text' value='".$idUtilisateur."'>");
        ?>

        <label for="nomStand"> Nom : </label><br/>
        <input name='nomStand' placeholder="Nom de l'entreprise" type= 'text' required>
        <br/>

        <label for="pitchStand"> Pitch :</label><br/>
        <input type="text" name="pitchStand" placeholder="Domaine d'activité">
        <br/>

        <label for="descriptionStand"> Description : </label><br/>
        <input name='descriptionStand' placeholder="Description des activités de l'entreprise" type= 'text' required>
        <br/>

        <label for="siteStand"> Site :</label><br/>
        <input type="text" name="siteStand" placeholder="Site de l'entreprise">
        <br/>

        <label for="ouvertureStand"> Heure d'ouverture :</label><br/>
        <input name='ouvertureStand' placeholder="Heure d'ouverture du stand" type= 'time'>
        <br/>

        <label for="fermetureStand"> Heure de fermeture :</label><br/>
        <input name='fermetureStand' placeholder="Heure de fermeture du stand" type= 'time'>
        <br/>

        <label for="codePostalStand"> Code postal :</label><br/>
        <input name='codePostalStand' placeholder="Code postal de l'entreprise" type= 'text'>
        <br/>

        <label for="adresseStand"> Adresse : </label><br/>
        <input name='adresseStand' placeholder="Adresse de l'entreprise" type= 'text'>
        <br/>

        <label for="villeStand"> Ville : </label><br/>
        <input name='villeStand' placeholder="Ville de l'entreprise" type= 'text'>
        <br/>

        <label for="pays"> Pays :&nbsp;</label><br/>
        <select name="pays" required>
            <option value="">Sélectionner votre pays</option>
            <?php AfficheOptionSelectPays(); ?>
        </select>
        <br/>

        <label for="imageStand"> Image : </label><br/>
        <input type="text" placeholder="Lien image stand" name="imageStand" required>
        <br/>


        <br/>
        <input type='submit' value='Créer le stand'>
    </form>
    
</body>
</html>