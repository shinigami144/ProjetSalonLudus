<?php
  session_start();
  include('fonctions.php'); 
  $attente = 1;
  $position = 9;
?>

<div id="profilePic" class="card" >
  <?php AfficheImageProfil($_SESSION['mail']); ?>
  <?php AfficheNomPrenom($_SESSION['mail']); ?>
 
  <p>File d'attente en cours</p>
       <div id="decrementation"></div>
     
  <p><button>Retour a la file d'attente</button></p>
</div>

