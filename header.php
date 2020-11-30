<?php
  if(!isset($_COOKIE["PHPSESSID"]))
  {
    session_start();
  }
  include('fonctions.php'); 
  $sql = "SELECT idStandFdA FROM utilisateur WHERE mailUtilisateur=?";
  $req = $conn->prepare($sql);
  $value = $req->execute([$_SESSION['mail']]);
?>

<div id="profilePic" class="card" >
  <?php AfficheImageProfil(); ?>
  <?php AfficheNomPrenom(); ?>     
  <p><button onclick=MoveToStand()>Retour a la file d'attente</button></p>
</div>
<script>

  function MoveToStand(){
    var idFile = <?php echo $value; ?>;
    window.location.replace("#stand.php?id="+idFile);
  }


</script>

