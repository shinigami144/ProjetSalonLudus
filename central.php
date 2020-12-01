<?php
require_once('db.php');
session_start();
include('fonctions.php'); 
$sql = "SELECT idStandFdA FROM utilisateur WHERE mailUtilisateur=?";
$req = $conn->prepare($sql);
$req->execute([$_SESSION['mail']]);
$data = $req->fetchAll();
if($data[0]['idStandFdA'] == null){
    echo '<script>
        var idFile=null;
        sessionStorage.setItem("idUtilisateur","'.$_SESSION['idUtilisateur'].'");
    </script>';
}
else{
    echo '<script>
        var idFile='.$data[0]["idStandFdA"].';
        sessionStorage.setItem("idUtilisateur","'.$_SESSION['idUtilisateur'].'");
    </script>';
}
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
            <!--<a id="buttonStands" href="#" class="w3-bar-item w3-button w3-col l3">Stands</a>-->
            <a id="buttonProfil" href="#" class="w3-bar-item w3-button w3-col l3">Profil</a>
            <a id="buttonDeconnexion" href="deco.php" class="w3-bar-item w3-button w3-col l3">Deconnexion</a>
        </div>
        <div>        
            <div id="profilePic" class="card" >
                <?php AfficheImageProfil(); ?>
                <?php AfficheNomPrenom(); ?>     
                <p><button onclick=MoveToStand()>Retour a la file d'attente</button></p> 
            </div>
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
              </div>
              <div class="w3-col l11">
                <span>Vous avez été invité Regarder vos mails</span>
              </div>
            </div>
        </div>
    </div>
    
    
    
    
    
    
<!--    IFRAME-->
    <div id="loadPage" class="container" style="margin:auto; margin-top:150px">
        <div class="w3-margin">
            <iframe
                    id="bodyPage"
                    src="./listeSalon.php"
                    style="width:82%;height:100%;">
            </iframe>    
        </div>
    </div>
     
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="./main.js"> </script>         
    <script>
        function MoveToStand(){
            if(idFile !=null){
                document.getElementById('bodyPage').src = "./stand.php?idStand="+idFile;
                console.log(document.getElementById('bodyPage').src);
            }
        }
    </script>

</body>
</html>