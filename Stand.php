<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=salonvirtuel", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  //echo "Connection failed: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="standstyle.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="lib/bootstrap.js" charset="utf-8"></script>
    <script src="lib/bootstrap.bundle.js" charset="utf-8"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  -->
    <title>Stand n°1</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-palette-green-gradient fixed-top font_navlogoimage">
      <div class="container">
        <a class="navbar-brand" href="#">&ltNOM DU STAND&gt</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle Navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">&ltACCEUIL&gt
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Stand1.html">&ltNOM STAND 1&gt
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Stand2.html">&ltNOM STAND 2&gt
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <header>
      <div id="headerCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#headerCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#headerCarousel" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- PREMIERE SLIDE, BREVES INFORMATIONS SUR L'ENTREPRISE (Nom, Descritpion Stand [...?]) -->
          <div class="carousel-item active bg-palette-blue-gradient">
            <div class="carousel-caption d-none d-sm-block">

              <h3 class="display-4 font_general">NOM DE L'ENTREPRISE</h3>
              <p class="lead font_general">BREF DESCRIPTION DU STAND</p>
            </div>
          </div>
          <!-- DEUXIEME SLIDE, DESCRIPTION DETAILLE ENTREPRISE / STAND + ? -->
          <div class="carousel-item bg-palette-orange-gradient">
            <div class="carousel-caption d-none d-sm-block">
              <h3 class="display-4 font_general">DESCRIPTION DE L'ENTREPRISE</h3>
              <p class="lead font_general">INFORMATIONS COMPLÉMENTAIRES</p>
            </div>
          </div>
          <a class="carousel-control-prev" href="#headerCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only font_ui">PRECEDENT</span>
          </a>
          <a class="carousel-control-next" href="#headerCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="false"></span>
            <span class="sr-only font_ui">SUIVANT</span>
          </a>
        </div>
      </div>
    </header>
<!-- <img src="https://fakeimg.pl/300/" id="logoEntreprise" name="LogoEntreprise" alt="Image Avatar" title="Image du Stand"> -->

    <form id="divInformationEntreprise" class="container">
        <div class="form-row">
          <div class="col-md-5">
            <div class="card card-inverse card-primary">
              <img src="http://placehold.it/800x500/4" class="img-fluid" alt="Responsive Image">
            </div>
          </div>
          <div class="col-md-7">
            <div class="form-row h-100">
              <div class="form-group col-md-6">
                <label class="font_general lead" for="nomEntreprise">Nom</label>
                <input type="text" class="form-control font_ui" placeholder="Nom Entreprise" style="text-align: center; vertical-align: middle;" id="nomEntreprise" readonly>
              </div>
              <div class="form-group col-md-6">
                <label class="font_general lead" for="descriptionEntreprise">Description</label>
                <input type="text" class="form-control font_ui" placeholder="Description Entreprise" style="text-align: center; vertical-align: middle;" id="descriptionEntreprise"  readonly>
              </div>
              <div class="form-group col-md-12">
                <label class="font_general lead" for="adresseEntreprise">Adresse</label>
                <input type="text" class="form-control font_ui" placeholder="1234 Main St" style="text-align: center; vertical-align: middle;" id="adresseEntreprise" readonly>
              </div>
              <div class="form-group col-md-4">
                <label class="font_general lead" for="emailEntreprise">Email</label>
                <input type="email" class="form-control font_ui" placeholder="adr@ser.dom" style="text-align: center; vertical-align: middle;" id="emailEntreprise" readonly pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" >
              </div>
              <div class="form-group col-md-4">
                <label class="font_general lead" for="siteEntreprise">Website</label>
                <input type="text" class="form-control font_ui" placeholder="https://www.w3schools.com/" style="text-align: center; vertical-align: middle;" id="siteEntreprise" readonly>
              </div>
              <div class="form-group col-md-4">
                <label class="font_general lead" for="telEntreprise">Téléphone</label>
                <input type="tel" class="form-control font_ui" placeholder="+2486442727" style="text-align: center; vertical-align: middle;" id="telEntreprise" pattern="(^[+]|^[0])+[1-9]+[0-9]*$" readonly>
              </div>
              <div class="form-group col-md-6">
                <input type="file" id="LogoEntreprise_UploadBtn" class="custom-file-input font_ui" name="LogoEntreprise_Upload" accept="image/png, image/jpeg, image/jpg">
                <label class="custom-file-label font_ui" for="LogoEntreprise_UploadBtn">Envoyer un Logo</label> <!--Le FOR doit être égal à l'id de l'input type file ci-dessous-->
              </div>
              <div class="form-group col-md-6">
                <input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input font_ui"> <!-- UPDATE LA BROCHURE DU STAND (admin) -->
                <label class="custom-file-label font_ui" for="fileToUpload">Envoyer une Brochure</label>
              </div>
              <div class="form-group col-md-4" id="Brochure">
                <a href="./DataFile/Exemple_MainActivity.pdf" download="brochure_stand" id="download_brochure_stand" class="badge badge-light">
                  <label for="download_brochure_stand" class="font_general lead">Télécharger la Brochure</label>
                  <img src="./Graphics/DownloadIcon.png" width=24 height=24 /> <!-- POUR TELECHARGER LA BROCHURE (client) -->
                </a>
              </div>
              <div class="form-group col-md-6">
                <input type="submit" name="btnModifStand" id="submitBtnChangeStand" class="btn btn-primary btn-lg btn-block" value="Mettre à jour les informations du Stand">
              </div>
            </div>
          </div>
        </div>


    </form>

    <div id="divFileAttente">
        <input id="descriptionFileAttente" readonly>
        <div id="listeFileAttente">
            <p><span id="textWaiting"></span>
            <span id="nbrWaiting">0</span></p>
        </div>
        <button id="boutonAjoutFileAttente" onclick="addMeToWaitList()">
            S'ajouter a la file d'attente de rendez-vous
        </button>
        <button id="ButtonSupressUserInWaitingList" onclick="removeUserFromWaitingList()">Next</button>
    </div>
    <button id="BoutonAccepterStand" class="btn btn-primary btn-lg">Stand Accepter</button>
    <button id="ButtonRefuserStand" onclick="refuserStand()" class="btn btn-primary btn-lg">Stand Refuser</button>
</body>
<script>
    // ------------------------------------------------------------------------------- recuperation des different element du document -----------------------------------------------------------------------
    // variable user
    var userPermission;

    // partie divInformationEntreprise

    var logoEntreprise = document.getElementById("LogoEntreprise_UploadBtn");
    var nomEntreprise = document.getElementById("nomEntreprise");
    var descriptionEntreprise = document.getElementById("descriptionEntreprise");
    var adresseEntreprise  = document.getElementById("adresseEntreprise");
    var emailEntreprise = document.getElementById("emailEntreprise");
    var siteEntreprise = document.getElementById("siteEntreprise");
    var telEntreprise = document.getElementById("telEntreprise");
    var submitBtnModifStand = document.querySelector('#submitBtnChangeStand'); // Button Submit


    // ------------------------------------------------------------------------------- recuperation des different element du document -----------------------------------------------------------------------

    //initialisation des different onclickListener

    nomEntreprise.addEventListener("dblclick",ChangeContentEditable);
    descriptionEntreprise.addEventListener("dblclick",ChangeContentEditable);
    adresseEntreprise.addEventListener("dblclick",ChangeContentEditable);
    emailEntreprise.addEventListener("dblclick",ChangeContentEditable);
    siteEntreprise.addEventListener("dblclick",ChangeContentEditable);
    telEntreprise.addEventListener("dblclick",ChangeContentEditable);

    // Appuie sur le bouton submit du form
    submitBtnModifStand.addEventListener('click', ModifStand);

    // initialisation des onchangeListener
    logoEntreprise.addEventListener("change",VerifFileLogo);
    nomEntreprise.addEventListener("change",SaveChangeButtonDisplay);
    descriptionEntreprise.addEventListener("change",SaveChangeButtonDisplay);
    adresseEntreprise.addEventListener("change",SaveChangeButtonDisplay);
    emailEntreprise.addEventListener("change",SaveChangeButtonDisplay);
    siteEntreprise.addEventListener("change",SaveChangeButtonDisplay);
    telEntreprise.addEventListener("change",SaveChangeButtonDisplay);

    function SaveChangeButtonDisplay(){
        var button = document.getElementById("submitBtnChangeStand");
        button.style.display = "block";
    }



  	//RECUPERER LES VALUES DE LA BDD

    // initialisation des onchangeListener

    function ChangeContentEditable(){
        var element = document.getElementById(event.currentTarget.id);
        console.log(element.readOnly);
        element.readOnly = false;
        element.focus();
        console.log(element.readOnly);
    }

    function ModifStand(){
      console.log("Votre stand a été modifié !");
    }

    function VerifFileLogo(){
        file = event.target.files[0];
        if (!file) {
            console.log("no file");
        }
        else if (!file.type.match('image.*')) {
            console.log("not a image");
        }
        else {
            const reader = new FileReader();
            reader.addEventListener('load', event => {
                document.getElementById("logoEntreprise").src = event.target.result;
            });
            reader.readAsDataURL(file);

        }
        SaveChangeButtonDisplay();
    }

    var tempPositionfortest = 1;

    function addMeToWaitList()
    {
        var lsiteAttente = document.getElementById("listeFileAttente");
        var userText = document.createElement("p");
        userText.id = "userID"; //  modifier quand lier a bdd
        userText.appendChild(document.createTextNode("userNom" + tempPositionfortest)); // modifier pour changer userNom avec user name from bdd
        lsiteAttente.appendChild(userText);
        tempPositionfortest++;

  	}

    function accepterStand(){
        console.log("envoi du mail pour prevenir que le stand est visible")
    }

    function refuserStand(){
        var person  = prompt("Please enter reasons of the reject:", "reject for");
        if (person != null && person != "") {
            console.log("sendmail")
        }

    }

    function removeUserFromWaitingList(){
        var lsiteAttente = document.getElementById("listeFileAttente");
        console.log(lsiteAttente.children[0]);
        if(lsiteAttente.children[0]){
            lsiteAttente.children[0].remove(lsiteAttente.children[0]);
        }
    }


</script>


</html>
