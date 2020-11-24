<?php 
    session_start();
    include('fonctions.php');

    // Active la fonction supprimer un utilisateur 
    if(array_key_exists('btnSupprimer', $_POST)) { 
        SupprimerUnUtilisateur($_SESSION['mail']);
    } 

    // J'ai fait des fonctions séparé pour update chaque champ, ca vous permettra de pouvoir mettre plus facilement en place la fonctionalité de double cliquer sur l'info pour la changer
    // !! Toutes les fonctions utilisé son dans le fichier fonctions.php !!
    // /!\ Pour votre la photo de profil il faut voir si on laisse l'utilisateur importer la sienne ou si on l'oblige a choisir parmis celle dispo 
    //(sachant qu'on avait parler en réunion de peut etre faire un systhème ou l'on peut recuperer des images de profil via les stand et/ou salon pour gamifier tout ca donc a vous de voir)

    // Modifie l'adresse mail et remet a 0 la validation de l'email
    if (!empty($_POST['email'])) 
    {   
        UpdateEmail($_POST['email']);
    }

    if (!empty($_POST['name'])) 
    {   
        UpdateName($_POST['name']);
    }

    if (!empty($_POST['firstname'])) 
    {   
        UpdateFirstname($_POST['firstname']);
    }

    if (!empty($_POST['adresse'])) 
    {   
        UpdateAdresse($_POST['adresse']);
    }

    if (!empty($_POST['postalCode'])) 
    {   
        UpdatePostalCode($_POST['postalCode']);
    }

    if (!empty($_POST['city'])) 
    {   
        UpdateCity($_POST['city']);
    }

    if (!empty($_POST['country'])) 
    {   
        UpdateCountry($_POST['country']);
    }

    /*if (!empty($_POST['email']) || !empty($_POST['name']) || !empty($_POST['firstname']) || !empty($_POST['adresse']) || !empty($_POST['postalCode']) || !empty($_POST['city']) || !empty($_POST['country'])) 
    {   
        header('location: pageProfil.php');
    }*/

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Document</title>
    <style>

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <!-- Bouton supprimer le compte -->
    <form method="post"> 
        <input type="submit" name="btnSupprimer" class="button" value="Supprimer le compte" /> 
    </form> 

    <a href="PageListSalon.html">Vers la liste des salons</a>
    
    <div id="informationContainer">
        <?php AfficheImageProfil(); ?>
        <p>Mail : <?php echo $_SESSION['mail']; ?></p>
        <p>Nom : <?php AfficheNom(); ?></p>
        <p>Prenom : <?php AffichePrenom(); ?></p>
        <p>Adresse : <?php AfficheAdresse(); ?></p>
        <p>Code postal : <?php AfficheCodePostal(); ?></p>
        <p>Ville : <?php AfficheVille(); ?></p>
        <p>Pays : <?php AffichePays(); ?></p>
        <p>Telephone : <?php AfficheTelephone(); ?></p>
    </div>

    <form id="modificationForm" method="POST">
        <input type="button" value="changer la photo de profil" name="profilePicture">
        <label for="email">E-mail : </label>
        <input type="email" name="email" placeholder="<?php echo $_SESSION['mail']; ?>">
        <label for="name">Nom : </label>
        <input type="text" name="name" placeholder="<?php AfficheNom(); ?>">
        <label for="firstname">Prenom : </label>
        <input type="text" name="firstname" placeholder="<?php AffichePrenom(); ?>">
        <label for="adresse">Adresse : </label>
        <input type="text" name="adresse" placeholder="<?php AfficheAdresse(); ?>">
        <label for="postalCode">Code postal : </label>
        <input type="number" name="postalCode" placeholder="<?php AfficheCodePostal(); ?>">
        <label for="city">Ville : </label>
        <input type="text" name="city" placeholder="<?php AfficheVille(); ?>">
        <label for="country">Pays : </label>
        <select name="country" <?php AffichePays(); ?>>
            <?php AfficheOptionSelectPays(); ?>
        </select>
        <label for="phoneNumber">Téléphone : </label>
        <input type="tel" name="phoneNumber" placeholder="<?php AfficheTelephone(); ?>">
        <input type="button" value="changer de mont de passe" id="mdp">
        <button type="submit">Enregistrer</button>
    </form>
    <button type="submit" id="modif">modification</button>
</body>
<script>

    var infoContainer = document.getElementById("informationContainer");
    var modifFrom = document.getElementById("modificationForm");
    var button = document.getElementById("modif");
    var mdp_change = document.getElementById("mdp");

    modifFrom.style.display = "none";
    modifFrom.addEventListener("submit", sendChange);

    mdp_change.addEventListener("click",changerMdp);
    button.addEventListener("click",enterModifMode);

  /*  for(var i = 0; i < infoContainer.children.length; i++){
        infoContainer.children[i].addEventListener("dblclick", enterModifMode);
    }  boucle for pour modifier les individuelement les enfants */

    function enterModifMode(e){
        infoContainer.style.display = "none";
        modifFrom.style.display = "block";
        button.innerHTML = "cancel";
        button.removeEventListener("click",enterModifMode);
        button.addEventListener("click",exitModifMode);
        //remplir le form des informations
    }

    function exitModifMode(e){
        modifFrom.style.display = "none";
        infoContainer.style.display = "block";
        button.innerHTML = "modification";
        button.removeEventListener("click",exitModifMode);
        button.addEventListener("click",enterModifMode);
        //quitte le form des informations
    }

    function sendChange(e){
        //envoie des changements vers le serveur
        console.log("change");
        return false;
    }

    function changerMdp(e){

        //changer de mot de passe
        var ancienmdp = prompt("entre votre ancien mdp");
        if ((ancienmdp == null )||  (ancienmdp == ""))  {
            return;
        }
        // verification du mot de passe  si bon suite sinon return (a faire)

        while (true) {

        var newmdp =prompt("entre le nouveau mot de passe");
        if ((newmdp == null )|| (newmdp == "") ) {
            return;
        }
        if (newmdp == ancienmdp) {
            alert("le nouveau mot de passe ne peux pas etre egale à l'ancien mot de passe");
            
        } else if (newmdp == prompt("comfirmer le mot de passe") ) {
            //changement dans le serveur/bdd
            return;   
        }else{
            alert("erreur comfirmation incorrect");
            }
        }

    }

</script>
</html>