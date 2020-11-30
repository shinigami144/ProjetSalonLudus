<?php
  
  include('fonctions.php'); 
  $attente = 1;
  $position = 2;
?>

<div class="w3-container">
    <div id="profilePic" class="w3-card-4 w3-display-topright w3-white w3-center">
        <img src="css/1.png" style="height:200px;width:200px;">
      <?php AfficheImageProfil($_SESSION['mail']); ?>
        <div>
            <?php AfficheNomPrenom($_SESSION['mail']); ?>
        </div>
        <div class="w3-medium">
            <p>File d'attente en cours</p>
            <div id="decrementation"></div>
        </div>
      <p><button class="w3-button w3-block w3-dark-grey">Retour a la file d'attente</button></p>
    </div>
</div>


