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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        html {
            display: grid;
            justify-items: center;
            align-items: center;
        }

        body {
            padding-top: 30px;
            padding-bottom: 30px;
            margin: 0;
            width: 60%;
            height: calc(100vh - 60px);
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        #header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #informationContainer {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 20px;
            width: calc(100% - 40px);
        }

        #modificationForm {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 20px;
            width: calc(100% - 40px);
            margin-bottom: 30px;
        }

        #mdpchange {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 20px;
            width: calc(100% - 40px);
        }

        #informationContainer div:first-child {
            height: 200px;
            margin-bottom: 20px;
        }

        #informationContainer div:first-child div {
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #informationContainer div:nth-child(2){
            display: grid;
            grid-template-columns: 50% 50%;
            grid-template-rows: 33% 33% 33%;
        }

        #informationContainer img{
            float: left;
            width: 200px;
            height: 200px;
            margin-right: 20px;
        }

        #modificationForm > div:nth-child(2){
            height: 200px;
            margin-bottom: 20px;
        }

        #modificationForm > div:nth-child(3){
            display: grid;
            grid-template-columns: 50% 50%;
            grid-template-rows: 33% 33% 33%;
            margin-bottom: 20px;
        }

        #modificationForm > div:nth-child(2) > input{
            float: left;
            margin: 0;
            width: 200px;
            height: 200px;
            margin-right: 20px;
        }

        #modificationForm > div:nth-child(2) > div:nth-child(2) {
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #modif {
            width: 200px;
        }

    </style>
</head>
<body>
    <div id="header">
        <a href="listeSalon.php">Vers la liste des salons</a>
        <!-- Bouton supprimer le compte -->
        <form method="post" onsubmit='return confirm("Etes-vous sûr ?")' id="suppAdmin"> 
            <input type="submit" name="btnSupprimer" class="button" value="Supprimer le compte"/> 
        </form> 
    </div>

    <div id="informationContainer">
        <div>
            <?php AfficheImageProfil(); ?>
            <div>
                <p>Prénom : <?php AffichePrenom(); ?></p>
                <p>Nom : <?php AfficheNom(); ?></p>
            </div>
        </div>
        <div>
            <p>Mail : <?php echo $_SESSION['mail']; ?></p>
            <p>Téléphone : <?php AfficheTelephone(); ?></p>
            <p>Adresse : <?php AfficheAdresse(); ?></p>
            <p>Code postal : <?php AfficheCodePostal(); ?></p>
            <p>Ville : <?php AfficheVille(); ?></p>
            <p>Pays : <?php AffichePays(); ?></p>
        </div>
    </div>
    
    <div id="formCont">
        <form id="modificationForm" method="POST">
            <h2>Modification des informations du compte</h2>
            <div>
                <input type="button" value="changer la photo de profil" name="profilePicture">
                <div>
                    <div>
                        <label for="firstname">Prénom : </label>
                        <input type="text" name="firstname" placeholder="<?php AffichePrenom(); ?>">
                    </div>
                    <div>
                        <label for="name">Nom : </label>
                        <input type="text" name="name" placeholder="<?php AfficheNom(); ?>">
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <label for="email">E-mail : </label>
                    <input type="email" name="email" placeholder="<?php echo $_SESSION['mail']; ?>">
                </div>
                <div>
                    <label for="phoneNumber">Téléphone : </label>
                    <input type="tel" name="phoneNumber" placeholder="<?php AfficheTelephone(); ?>">
                </div>
                <div>
                    <label for="adresse">Adresse : </label>
                    <input type="text" name="adresse" placeholder="<?php AfficheAdresse(); ?>">
                </div>
                <div>
                    <label for="postalCode">Code postal : </label>
                    <input type="number" name="postalCode" placeholder="<?php AfficheCodePostal(); ?>">
                </div>
                <div>
                    <label for="city">Ville : </label>
                    <input type="text" name="city" placeholder="<?php AfficheVille(); ?>">
                </div>
                <div>
                    <label for="country">Pays : </label>
                    <select name="country" <?php AffichePays(); ?>>
                    <?php AfficheOptionSelectPays(); ?>
                    </select>
                </div>
            </div>
            <button type="submit">Enregistrer</button>
            </form>
            <form method="post" id="mdpchange" >
            <h2>Modification du mot de passe</h2>
                <label for="ancienmdp">Ancien mot de passe :</label>
                <input type="text" name="ancienmdp" >
                <label for="newmdp">Nouveau mot de passe :</label>
                <input type="text" name="newmdp" >
                <label for="confimdp">Confirmation mot de passe :</label>
                <input type="text" name="confimdp" >
                <input type="submit" value="Valider">
            </form>
    </div>
   
    <button id="modif">Modifier les informations</button>
</body>
<script>

    var infoContainer = document.getElementById("informationContainer");
    var modifFrom = document.getElementById("modificationForm");
    var button = document.getElementById("modif");
    var mdp_change = document.getElementById("mdp");
    var passewordchangeur = document.getElementById("mdpchange");
    var formCont = document.getElementById("formCont");
    //var passeword = echo du passeword dans la bbd

    formCont.style.display = "none";

    passewordchangeur.addEventListener("submit",sendmdp);

    modifFrom.addEventListener("submit", sendChange);

    button.addEventListener("click",enterModifMode);

    //regarder iciiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    if(true){////!!!!!!!!!!! ici verifier en php si c'est bien le mec qui détient le compte

    }
    else {
        document.getElementById("suppAdmin").parentElement.removeChild(document.getElementById("suppAdmin"));
        button.parentElement.removeChild(button);
    }

    function enterModifMode(e){
        infoContainer.style.display = "none";
        formCont.style.display = "block";
        button.innerHTML = "Annuler modification";
        button.removeEventListener("click",enterModifMode);
        button.addEventListener("click",exitModifMode);
        //remplir le form des informations
    }

    function exitModifMode(e){
        formCont.style.display = "none";
        infoContainer.style.display = "block";
        button.innerHTML = "Modifier les informations";
        button.removeEventListener("click",exitModifMode);
        button.addEventListener("click",enterModifMode);
        //quitte le form des informations
    }

    function sendChange(e){
        //envoie des changements vers le serveur
        console.log("change");
        return false;
    }
    function sendmdp(e){
        //changement de mot de passe
    }

</script>
</html>