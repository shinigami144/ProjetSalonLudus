<?php
    session_start();

    $code = rand(1000,9999);
    
    
    if (mail($_SESSION['mail'], "Validation de votre adresse mail", "Voici votre code : ".$code)) // Envoi du message
    {
        echo "Votre message a bien été envoyé à ".$_SESSION['mail'];
    }
    else // Non envoyé
    {
        echo "Votre message n'a pas pu être envoyé à ".$_SESSION['mail'];
    }

    if (!empty($_POST['code']))
    {
        if ($_POST['code'] == $code)
        {
            echo "Votre adresse mail a bien été validé.";
            header('location: index.php');
        }
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