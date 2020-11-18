<?php
require_once('db.php');
session_start();
?>
<html>
    <head>
    <title>Siep Project</title>  
    <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
</head>
<body>
    <nav class="nav">
    <div id="nav1"><a href="#">Salons</a></div>
    <div id="nav2"><a href="#">Stands</a></div>
    <div id="nav3"><a href="#">Profil</a></div>
    </nav>
    <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
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
    <div>
    <?php include 'header.php';?>    
    </div>
    <h1>SAAAAAAAAAAAAAAAAAAAAAALLLLLLLLLLLLOOOOOOOOOOOOOOOOOOOOOOOOOOON</h1>
    
    <iframe 
            src="backPage.php"
            style="width:100%; height:100%;">
    </iframe>    
    
     
    
    <script src="./main.js"> </script>         
    

</body>
</html>