<?php
    session_start();
    require_once('db.php'); 
    include('fonctions.php');

    $cpt = 0;

    // --------------------------- VERIFICATIONS --------------------------------
    // Les phrases d'erreurs peuvent etre remplacé et/ou modifier (Elles se situent dans les else)
    // ---------------------- Condition d'utilisation ---------------------------
    if (!empty($_POST['condition'])) 
    {   
        $cpt++;
    }

    // ----------------------------- Adresse mail --------------------------------
    if (!empty($_POST['email'])) 
    {
        if (preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',$_POST['email'])) // Test si l'adresse mail est valide
        {
            // Regard dans la bdd si l'adresse mail n'existe pas deja
            try {
                $sql = $conn->prepare('SELECT mailUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_POST['email'].'"');
                $sql->execute();

                $result = $sql->fetch(PDO::FETCH_ASSOC);
                if ($result == 0) // Si elle n'existe pas deja alors
                {
                    $cpt++;
                }
                else
                {
                    echo "Adresse mail déjà utilisé.";
                }
              } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
              }
        }
    }

    // ---------------------------- Mot de passe ----------------------------------
    if (!empty($_POST['passsword']) and !empty($_POST['conf_password']))
    {
        if ($_POST['passsword'] == $_POST['conf_password'])
        {
            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#',$_POST['passsword']))
            {
                $cpt++;
            }
        }
    }

   // ---------------------------------- Nom --------------------------------------
   if (!empty($_POST['nom'])) 
   {
        $cpt++;
   }

   // -------------------------------- Prenom -------------------------------------
   if (!empty($_POST['prenom'])) 
   {
        $cpt++;
   }

   // ------------------------------- REQUETES ------------------------------------
   if ($cpt == 5)
   {
        $mdpCrypte = password_hash($_POST['passsword'],PASSWORD_DEFAULT);
        $idPays = RecupIdPays($_POST['pays']);
        try {
            $sql = "INSERT INTO `Utilisateur`(`mailUtilisateur`, `mdpUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `adresseUtilisateur`, `codePostalUtilsateur`, `villeUtilisateur`, `idPaysUtilsateur`, `telUtilisateur`, `verificationUtilisateur`,`photoUtilisateur`) 
            VALUES ('".$_POST['email']."','".$mdpCrypte."','".$_POST['nom']."','".$_POST['prenom']."','".$_POST['adresse']."','".$_POST['code_postal']."','".$_POST['ville']."','".$idPays."','".$_POST['tel']."',0,".$_POST['image'].")";

            $conn->exec($sql);
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        // Variable de session
        $_SESSION['mail'] = $_POST['email'];
        $sql2 = $conn->prepare('SELECT idUtilisateur FROM utilisateur WHERE mailUtilisateur = "'.$_POST['mail'].'"');
        $sql2->execute();
        $result = $sql2->fetchAll();
        $_SESSION['idUtilisateur'] = $result[0]['idUtilisateur'];
        // La ligne de code ci dessous permet de rediriger vers un autre page, il suffit juste de metre le nom de la page après "location :" 
        header('location: validationMail.php');
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="./css/inscription.css" rel="stylesheet">
</head>
<body>
        <h1>Incription</h1>
        <form method="POST">
            <div class="form-group">
                <label for="email">Adresse mail :&nbsp;</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="passsword">Mot de passe : (10 caract mini, 1 maj, 1 nbr et un caract spécial)&nbsp;</label> 
                <input type="password" class="form-control" name="passsword" required>
            </div>
            <div class="form-group">
                <label for="conf_password">Confirmation du mot de passe :&nbsp;</label>
                <input type="password" class="form-control" name="conf_password" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom :&nbsp;</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :&nbsp;</label>
                <input type="text" class="form-control" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse :&nbsp;</label>
                <input type="text" class="form-control" name="adresse">
            </div>
            <div class="form-group">
                <label for="code_postal">Code postal :&nbsp;</label>
                <input type="text" class="form-control" name="code_postal" size="5">
            </div>
            <div class="form-group">
                <label for="ville">Ville :&nbsp;</label>
                <input type="text" class="form-control" name="ville">
            </div>
            <div class="form-group">
                <label for="pays">Pays :&nbsp;</label>
                <select name="pays" required>
                    <option value="">Sélectionner votre pays</option>
                    <?php AfficheOptionSelectPays(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tel">Numero telephone :&nbsp;</label>
                <input type="tel" class="form-control" name="tel"  size="13">
            </div>
            <p>Choisi ton image de profil :&nbsp;</p>
            <div id="radioContainer">
                <label>
                    <input type="radio" id="img1" name="image" value="1" checked>
                    <img src="./css/1.png">
                </label>
                <label>
                    <input type="radio" id="img2" name="image" value="2">
                    <img src="./css/2.png">
                </label>
                <label>
                    <input type="radio" id="img3" name="image" value="3">
                    <img src="./css/3.png">
                </label>
                <label>
                    <input type="radio" id="img4" name="image" value="4">
                    <img src="./css/4.png">
                </label>
                <label>
                    <input type="radio" id="img5" name="image" value="5">
                    <img src="./css/5.png">
                </label>
                <label>
                    <input type="radio" id="img6" name="image" value="6">
                    <img src="./css/6.png">
                </label>
                <label>
                    <input type="radio" id="img7" name="image" value="7">
                    <img src="./css/7.png">
                </label>
            </div> 
            <div class="form-group">
                <label for="condition">J'accepte <a href="conditions.php" target="_blank">les conditions d'utilisation et de confidentialité :</a></label>
                <input type="checkbox" class="form-control" name="condition" required>
            </div>
            <input type="submit" class="btn btn-primary" value="S'inscrire">
        </form>
    </body>
</html>

    
    

