<?php
    session_start();
    include('fonctions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Création d'un stand</title>
</head>
<body>
    <h4>Ajouter un stand</h4>
    <form action="./addStand.php" method="POST">
        <!-- Remplacer la valeur mise par défaut par la valeur en POST de l'id du salon -->
        <?php 
            $idSalon = $_SESSION['idSalon'];
            echo("<input style='display:none;' name='idSalon' type='text' value='".$idSalon."'>"); 
        ?>

        <label for="nomStand"> Nom : </label>
        <input name='nomStand' placeholder="Nom de l'entreprise" type= 'text' required>
        <br/>

        <label for="pitchStand"> Pitch :</label>
        <input type="text" name="pitchStand" placeholder="Domaine d'activité">
        <br/>

        <label for="descriptionStand"> Description : </label>
        <input name='descriptionStand' placeholder="Description des activités de l'entreprise" type= 'text' required>
        <br/>

        <label for="siteStand"> Site :</label>
        <input type="text" name="siteStand" placeholder="Site de l'entreprise">
        <br/>

        <label for="ouvertureStand"> Heure d'ouverture :</label>
        <input name='ouvertureStand' placeholder="Heure d'ouverture du stand" type= 'time'>
        <br/>

        <label for="fermetureStand"> Heure de fermeture :</label>
        <input name='fermetureStand' placeholder="Heure de fermeture du stand" type= 'time'>
        <br/>

        <label for="codePostalStand"> Code postal :</label>
        <input name='codePostalStand' placeholder="Code postal de l'entreprise" type= 'text'>
        <br/>

        <label for="adresseStand"> Adresse : </label>
        <input name='adresseStand' placeholder="Adresse de l'entreprise" type= 'text'>
        <br/>

        <label for="villeStand"> Ville : </label>
        <input name='villeStand' placeholder="Ville de l'entreprise" type= 'text'>
        <br/>

        <label for="codePostalStand"> Code postal :</label>
        <input name='codePostalStand' placeholder="Code postal de l'entreprise" type= 'text'>
        <br/>

        <label for="pays"> Pays :&nbsp;</label>
        <select name="pays" required>
            <option value="">Sélectionner votre pays</option>
            <?php AfficheOptionSelectPays(); ?>
        </select>
        <br/>

        <label for="imageStand"> Image : </label>
        <input type="text" placeholder="Lien image stand" name="imageStand">
        <br/>


        <br/>
        <input type='submit' value='Créer le stand'>
    </form>
    
</body>
</html>