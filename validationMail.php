<?php
    session_start();

    require_once('db.php'); 

    if(array_key_exists('btnCode', $_POST)) { 
        sendMail(); 
    } 

    function sendMail()
    {
        $code = rand(1000,9999);
        if (mail($_SESSION['mail'], "Validation de votre adresse mail", "Voici votre code : ".$code)) // Envoi du message
        {
            echo "Le code a bien été envoyé à ".$_SESSION['mail'];
            $_SESSION['code'] = $code;
        }
        else // Non envoyé
        {
            echo "Le code n'a pas pu être envoyé à ".$_SESSION['mail'];
        }
    }

    // check si le code est bon 
    if (!empty($_POST['code']) and $_POST['code'] == $_SESSION['code'])
    {
        unset($_SESSION["code"]);

        try {
            $sql = "UPDATE `utilisateur` SET `verificationUtilisateur` = '1' WHERE `utilisateur`.`mailUtilisateur` = '".$_SESSION['mail']."' ;";
    
            $conn->exec($sql);
            echo "Modifier avec succee.";
        } 
        catch(PDOException $e) 
        {
            echo $sql . "<br>" . $e->getMessage();
        }
        
        header('location: index.php');
    }
    else 
    {
        echo "Le code ne correspond pas.";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation email</title>
</head>
<body>
    <form method="post"> 
        <input type="submit" name="btnCode" class="button" value="Envoyer le code" /> 
    </form> 

    <form method="POST">
        <div>
            <label for="code">Entrez le code de validation reçu par mail : </label>
            <input name="code" required>
        </div>
        <div>
            <input type="submit" value="Valider">
        </div>
    </form>

</body>
</html> 