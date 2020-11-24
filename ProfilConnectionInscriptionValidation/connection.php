<?php
    session_start();
    require_once('db.php'); 

    $cpt = 0;

    if (isset($_POST['mail']) and !empty($_POST['mail'])) // Si l'email n'est pas vide 
    {
        $cpt++;
    }

    if (isset($_POST['password']) and !empty($_POST['password'])) // Si le mdp n'est pas vide 
    {
        $cpt++;
    }

    if ($cpt == 2) // Du coup, si les deux ne sont pas vide
    {
        try {
            $sql = $conn->prepare('SELECT mailUtilisateur,	mdpUtilisateur FROM utilisateur WHERE mailUtilisateur = "'.$_POST['mail'].'"');
            $sql->execute();

            $result = $sql->fetchAll();


            if ($result) // On check qu'il y a bien un utilisateur avec cette adresse mail 
            {
                foreach ($result as $user) {
                    if (password_verify($_POST['password'], $user['mdpUtilisateur'])) // On check que le mdp renseigner et bien le meme que celui dans la base
                    {
                        // On le connecte
                        $_SESSION['mail'] = $_POST['mail'];
                        // La ligne de code ci dessous permet de rediriger vers un autre page, il suffit juste de metre le nom de la page après "location :" 
                        header('location: index.php');
                    }
                    else 
                    {
                        echo "Le mot de passe ne conrrespond pas.";
                    }
                }
            }
            else
            {
                echo "Vous n'avez pas encore de comtpe avec cette adresse mail.";
            }


          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Connection</title>
</head>
<body>
    <h1><p align="center">Connexion</p></h1>

    <form align="center" method="POST"> 
        <div class="form-group">
            <label for="mail">Adresse mail</label>
            <input type="email" class="form-control" name="mail" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" required>
        </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
    </form>  

    <!-- Redirige vers la page d'inscription -->
    <form action="inscription.php">
        <input type="submit" name="select" value="Inscription" />
    </form>



</body>
</html>