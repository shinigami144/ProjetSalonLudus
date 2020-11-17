<?php
    require_once("db.php");
    session_start();
    
    $cpt = 0;

    // --------------------------- VERIFICATIONS --------------------------------
    // Les phrases d'erreurs peuvent etre remplacé et/ou modifier (Elles se situent dans les else)
    // ---------------------- Condition d'utilisation ---------------------------
    if (!empty($_POST['condition'])) 
    {   
        $cpt++;
    }
    else 
    {
        echo "Vous devez accepter les conditions d'utilisation à fin de pouvoir crée votre compte.";
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
        else 
        {
            echo "Adresse mail invalide.";
        }    
    }
    else
    {
        echo "Adresse mail non renseigné.";
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
            else
            {
                echo "Mot de passe non valide veillez en entrer un nouveau. (Le mot de passe doit contenir au minimum une majuscule, une minuscule, un chiffre, un caractère spécial et doit etre composé de minimum 10 caractères).";
            }
        }
        else 
        {
            echo "Les deux mots de passe ne correspondent pas.";
        }
    }
    else
    {
        echo "Mot de passe non renseigné.";
    }

   // ---------------------------------- Nom --------------------------------------
   if (!empty($_POST['nom'])) 
   {
        $cpt++;
   }
   else
   {
       echo "Nom non renseigné.";
   }

   // -------------------------------- Prenom -------------------------------------
   if (!empty($_POST['prenom'])) 
   {
        $cpt++;
   }
   else
   {
       echo "Prenom non renseigné.";
   }

   // ------------------------------- REQUETES ------------------------------------
   if ($cpt == 5)
   {
        $mdpCrypte = password_hash($_POST['passsword'],PASSWORD_DEFAULT);

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `Utilisateur`(`mailUtilisateur`, `mdpUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `adresseUtilisateur`, `codePostalUtilsateur`, `villeUtilisateur`, `paysUtilsateur`, `telUtilisateur`, `verificationUtilisateur`) 
            VALUES ('".$_POST['email']."','".$mdpCrypte."','".$_POST['nom']."','".$_POST['prenom']."','".$_POST['adresse']."','".$_POST['code_postal']."','".$_POST['ville']."','".$_POST['pays']."','".$_POST['tel']."',0)";

            $conn->exec($sql);
          } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
          }
          
          


        // Variable de session
        $_SESSION['mail'] = $_POST['email'];
        // La ligne de code ci dessous permet de rediriger vers un autre page, il suffit juste de metre le nom de la page après "location :" 
        header('location: validationMail.php');
   }

?>

<!--  !!!!!!!!!  IL MANQUE LE CHOIX DES IMAGES DE PROFIL  !!!!!!!!!  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<p><h1 align="center"><strong>Inscription</strong><h1></p>

<p>
    <div class="contrainer" align="center">
        <form method="POST">
            <div class="form-group">
                <label for="email">Adresse mail</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="passsword">Mot de passe</label>
                <input type="password" class="form-control" name="passsword">
            </div>
            <div class="form-group">
                <label for="conf_password">Confirmation du mot de passe</label>
                <input type="password" class="form-control" name="conf_password">
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="nom">
            </div>
            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" name="prenom">
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" name="adresse">
            </div>
            <div class="form-group">
                <label for="code_postal">Code postal</label>
                <input type="text" class="form-control" name="code_postal" size="5">
            </div>
            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" name="ville">
            </div>
            <div class="form-group">
                <label for="pays">Pays</label>
                <input type="text" class="form-control" name="pays">
            </div>
            <div class="form-group">
                <label for="tel">Numero telephone</label>
                <input type="tel" class="form-control" name="tel"  size="13">
            </div>
            <div class="form-group">
                <label for="condition">J'accepte les conditions d'utilisation et de confidencialité</label>
                <input type="checkbox" class="form-control" name="condition">
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
</p>

</body>
</html>

    
    

