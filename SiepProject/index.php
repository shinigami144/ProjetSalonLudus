<?php
require_once('db.php');
session_start();
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
            <a href="#" class="w3-bar-item w3-button w3-col l3">Salon</a>
            <a href="#" class="w3-bar-item w3-button w3-col l3">Stands</a>
            <a href="#" class="w3-bar-item w3-button w3-col l3">Profil</a>
            <a href="deco.php" class="w3-bar-item w3-button w3-col l3">Deconnexion</a>
        </div>
        <div>
        <?php include 'header.php';?>    
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
                  $sql = $conn->prepare('SELECT idStandRDV FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
                  $sql->execute();
                  $result = $sql->fetchAll();
                  foreach ($result as $idstand) {
                      $idstandrdv = $idstand['idStandRDV'];
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
              <a href="'.$lienrdv.'"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLCY8jUzmtJbvlLiQ9dASd2XsdK-_NwSDmtw&usqp=CAU" />clickez ici pour rejoindre le meeting</a>
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
                    src="backPage.php"
                    style="width:82%;height:100%;">
            </iframe>    
        </div>
    </div>
     
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="./main.js"> </script>         
    

</body>
</html>