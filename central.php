<?php
require_once('db.php');
session_start();

include('fonctions.php'); 
$sql = "SELECT idStandFdA FROM utilisateur WHERE mailUtilisateur=?";
$req = $conn->prepare($sql);
$value = $req->execute([$_SESSION['mail']]);
echo '<script>
    var idFile = '.$value.'
</script>';
?>

<html>
    <head>
    <title>Siep Project</title>  

<!--        import CSS W3-->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        
<!--        import jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

         
</head>
    
    
<body>
    <div id="stickySection" class="container sticky">
        <div class="w3-navbar w3-dark-grey w3-row">
            <a id="buttonSalon" href="#" class="w3-bar-item w3-button w3-col l3">Acceuil</a>
            <a id="buttonStands" href="#" class="w3-bar-item w3-button w3-col l3">Stands</a>
            <a id="buttonProfil" href="#" class="w3-bar-item w3-button w3-col l3">Profil</a>
            <a id="buttonDeconnexion" href="deco.php" class="w3-bar-item w3-button w3-col l3">Deconnexion</a>
        </div>
        <div>
        <div id="profilePic" class="card" >
        <?php AfficheImageProfil(); ?>
        <?php AfficheNomPrenom(); ?>     
        <p><button onclick=MoveToStand()>Retour a la file d'attente</button></p> 
        </div>
        <div class="w3-center w3-animate-opacity w3-blue-grey w3-jumbo">
            Salon
        </div>
    </div>
    
    <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
          <div class="w3-display-container w3-row">
              <div class="w3-col l1">
                   <span class="close w3-display-topright">&times;</span>
              </div>
              <div class="w3-col l11">
                <span>C'est votre tour.</span> 
                  <br>
      
              <?php
              try {
                  $sql = $conn->prepare('SELECT idStandFdA FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
                  $sql->execute();
                  $result = $sql->fetchAll();
                  foreach ($result as $idstand) {
                      $idstandrdv = $idstand['idStandFdA'];
                  }
              }catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
              }if(isset($idstandrdv)){
                  $sql = $conn->prepare('SELECT lienAStand FROM adminstand WHERE idStand = "'.$idstandrdv.'"');
              $sql->execute();
              $result = $sql->fetchAll();
              foreach ($result as $lienstand) {
                  $lienrdv = $lienstand['lienAStand'];
              }
              echo'
              <a><img src="https://cdn.vox-cdn.com/thumbor/xGx425irVzHq-r8-_vTZrWo-79A=/0x0:1320x880/920x613/filters:focal(555x335:765x545):format(webp)/cdn.vox-cdn.com/uploads/chorus_image/image/55270365/newskypelogo.1497525155.jpg" style="width:25%;"/>
            Vous allez etre appelé</a>
              ';
              }
              ?>
              </div>
              
            </div>
        </div>
    </div>
    
    
    
    
    
    
<!--    IFRAME-->
    <div id="loadPage" class="container" style="margin:auto; margin-top:150px">
        <div class="w3-margin">
            <iframe
                    id="bodyPage"
                    src="listeSalon.php"
                    style="width:82%;height:100%;">
            </iframe>    
        </div>
    </div>
     
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="./main.js"> </script>         
    <script>
        function MoveToStand(){
            document.getElementById('bodyPage').src = "./stand.php?idStand="+idFile;
        }
    </script>

</body>
</html>