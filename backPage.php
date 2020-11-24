<?php
    if(array_key_exists('btnPasser', $_POST)) { 
        header('location: pageProfil.php');
    } 
?>

<div><p>Hello World depuis le backpage</p></div>

<!-- Manon qui rajoute pour faire le lien vers pageProfil-->
<form method="post"> 
    <input type="submit" name="btnPasser" class="button" value="PAGE PROFIL" /> 
</form>