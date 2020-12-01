<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stand n°1</title>
    <link rel="stylesheet" href="css/customizedstandstyle.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="lib/bootstrap.js" charset="utf-8"></script>
    <script src="lib/bootstrap.bundle.js" charset="utf-8"></script>
    <style>
        a{
            display: block;
        }
    </style>
</head>
<?php
	require("db.php");
    session_start();
    $sql4 = "SELECT * FROM adminstand WHERE idUtilisateur=? AND idStand=?";
    $req4 = $conn->prepare($sql4);
    $req4->execute([$_SESSION['idUtilisateur'],$_GET['idStand']]);
    $data4 = $req4->fetchAll();
    $sql = "SELECT * FROM stand WHERE idStand=?";
    $sql2 = "SELECT * FROM utilisateur,adminstand WHERE adminstand.idStand=? AND utilisateur.idUtilisateur = adminstand.idUtilisateur";
    $sql3 = "SELECT * FROM fichier WHERE idStand=?";
    $req2 = $conn->prepare($sql2);
    $req3 = $conn->prepare($sql3);
    $req = $conn->prepare($sql);
    $req->execute([$_GET['idStand']]);
    $req2->execute([$_GET['idStand']]);
    $req3->execute([$_GET['idStand']]);
    $data = $req->fetchAll();
    $data2 = $req2->fetchAll();
    $data3 = $req3->fetchAll();
    if(empty($data4)){
        $permission = 0;
    }
    else{
        $permission = 2;
    }
    //if() //  admin de salon a voir avec page salons
    if(empty($data3)){
        $brochurelink= null;
    }
    else{
        $brochurelink = $data3[0]['lienFIchier'];
    }
    echo '<script>
    sessionStorage.setItem("permission","'.$permission.'");
    sessionStorage.setItem("idUtilisateur","'.$_SESSION['idUtilisateur'].'");
    </script>'; // mise en place de l'id dans la session en JS
    if(isset($conn)){
        echo '
            <div id="PageCommun" class="container">
            <input style="display:none;" type="number" value="'.$data[0]['idStand'].'" name="idStand" id="ID">
                <div id="divInformationEntreprise" class="container">
                    <div class="rows">
                      <div class="col-md-12">
                        <h1 class="text-center text-uppercase"> La Ludus Académie </h1>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="card">
                            <image class="card-img-top" id="logoEntreprise" src="'.$data[0]['imageStand'].'"></image>
                            <div class="card-body">
                              <div class="card-title">
                                <p class="font-weight-bold" id="nomEntreprise" contenteditable="false">'.$data[0]['nomStand'].'</p>
                              </div>
                              <p class="card-text font_general" id="pictchStand">'.$data[0]['pitchStand'].' </p>
                              <p class="card-text font_general" id="adresseEntreprise" contenteditable="false">'.$data[0]['adresseStand'].' </p>
                              <p class="card-text font_general" type="email"  id="emailEntreprise" contenteditable="false">'.$data2[0]['mailUtilisateur'].'</p>
                              <a class="btn btn-link font_ui" id="siteEntreprise" contenteditable="false" href="'.$data[0]['siteStand'].'">'.$data[0]['siteStand'].'</a>
                              <p class="card-text font_general" id="telEntreprise" contenteditable="false">'.$data2[0]['telUtilisateur'].'</p>
                              <div id="divFileAttente">
                                  <table class="table">
                                      <thead>
                                          <tr id="BaseTable">
                                              <th scope="col" class="font_general">Nom</th>
                                              <th scope="col" class="font_general">Prenom</th>';
                                              if($permission == 2){
                                                  echo '<th scope="col" class="font_general">AdresseMail</th>';
                                              }
                                              echo'
                                          </tr>
                                      </thead>
                                      <tbody class="ListeFileAttente font_general" id="ListeFileAttente">
                                      </tbody>
                                  </table>
                                  <button class="btn btn-info btn-lg" id="boutonAjoutFileAttente" onclick="addMeToWaitList()">
                                      <span class="font_ui">S\'ajouter a la file d\'attente de rendez-vous</span>
                                  </button><br/><br/>';
                                  if($permission == 2){
                                      echo '<button class="btn btn-primary btn-lg float-left font_ui" id="ButtonCallUser" onclick="CallUser()">Call</button>';
                                      echo '<button class="btn btn-warning btn-lg float-right font_ui" id="ButtonSupressUserInWaitingList" onclick="removeUserFromWaitingList()">Next</button><br/>';
                                  }
                                  echo'
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title">
                              <p class="font-weight-bold" contenteditable="false">Description</p>
                            </div>
                              <p id="descriptionEntreprise" contenteditable="false">'.$data[0]['descriptionStand'].'</p>
                              <div id="Brochure">
                                <a href="./DataFile/Exemple_MainActivity.pdf" download="brochure_stand" id="download_brochure_stand" class="badge badge-light">
                                  <label for="download_brochure_stand" class="font_general lead">Télécharger la Brochure</label>
                                  <img src="css/DownloadIcon.png" width=24 height=24 /> <!-- POUR TELECHARGER LA BROCHURE (client) -->
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        ';
        echo'<script src="./StandCommun.js"></script>' ;// script commun
        if($permission == 1){ // admin de salon
            echo'
            <form action="./acceptationStand.php" method="POST">
                <input style="display:none;" type="number" value="'.$data[0]['idStand'].'" name="idStand" id="IDSTANDACCEPTATION">
                <button class="btn btn-lg btn-success" type="submit" name="acceptationStand" value="1">Accepter le stand</button>
                <button class="btn btn-lg btn-danger" type="submit" name="acceptationStand" value="0">Refuser le stand</button>
            </form>
            ';
            echo'<script src="./StandAdminSalon.js"></script>' ; // script propre au admin salon
        }
        else if ($permission == 2){ // admin stand
            echo '<p id="debug"></p>';
            echo'
            <div id="PageAdminStand" class="container">
                <form id="divInformationEntreprise" class="container" enctype="multipart/form-data" action="modifStand.php" method="POST">
                  <div class="form-row">
                    <div class="col-md-5">
                      <div id="stand_image_container" class="card card-inverse card-primary">
                        <label for="ALogoEntreprise_UploadBtn">
                          <img src="'.$data[0]['imageStand'].'" id="AlogoEntreprise" class="img-fluid" name="LogoEntreprise" alt="Image Avatar" title="Image du Stand">
                        </label>
                        <input type="file" name="LogoEntreprise_Upload" value="" id="ALogoEntreprise_UploadBtn" accept="image/png, image/jpeg, image/jpg" style="display: none;">
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-row h-100">
                        <div class="form-group col-md-6">
                          <input type="text" class="form-control font_ui" name="nomEntreprise" value="'.$data[0]['nomStand'].'"placeholder="NomEntreprise" id="AnomEntreprise" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <input type="text" class="form-control font_ui" name="pitchStand" value="'.$data[0]['pitchStand'].'" placeholher="PicthEntreprise" id="ApitchStand" readonly>
                        </div>
                        <div class="form-group col-md-12">
                          <input class="form-control font_ui" width="500" height="500" name="descriptionEntreprise" value="'.$data[0]['descriptionStand'].'" placeholder="description de l\'entreprise" id="AdescriptionEntreprise"  readonly>
                        </div>
                        <div class="form-group col-md-4">
                          <input type="text" class="form-control font_ui" name="adresseEntreprise" value="'.$data[0]['adresseStand'].'"placeholder="81 rue des moule" id="AadresseEntreprise" readonly>
                        </div>
                        <div class="form-group col-md-4">
                          <input type="email" class="form-control font_ui" name="emailEntreprise" value="'.$data2[0]['mailUtilisateur'].'" placeholder="truc@tucr.com" id="AemailEntreprise" readonly pattern="\^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$">
                        </div>
                        <div class="form-group col-md-4">
                          <input type="text" class="form-control font_ui" name="siteEntreprise" value="'.$data[0]['siteStand'].'" placeholder="https://www.w3schools.com/" id="AsiteEntreprise" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <input type="tel"class="form-control font_ui" name="telephoneEntreprise"  value="'.$data2[0]['telUtilisateur'].'" placeholder="+2486442727" id="AtelEntreprise" pattern="(^[+]|^[0])+[1-9]+[0-9]*$" readonly>
                        </div>
                        <div class="form-group  col-md-6">
                          <input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input font_ui">
                          <label class="custom-file-label font_ui" for="fileToUpload">Envoyer une Brochure</label>
                        </div>
                        <div id="Brochure" class="form-group col-md-12">
                          <title for="fileToUpload"> Brochure </title>
                          <h4>Télécharger la Brochure</h4>
                            <a href="'.$brochurelink.'" download="brochurePDF" class="badge badge-light">
                              <image src="./File/Graphics/DownloadIcon.png" width=24 height=24 />
                            </a>
                        </div>
                      </div>
                      </div></div>
                      <input type="submit" name="btnModifStand" id="submitBtnChangeStand" class="btn btn-success btn-lg" value="Mettre à jour les informations du Stand">
                  </form>
                <div id="AdivFileAttente">
                    <table class="table">
                        <thead>
                            <tr id="BaseTable">
                                <th scope="col" class="font_general">Nom</th>
                                <th scope="col" class="font_general">Prenom</th>
                                <th scope="col" class="font_general">AdresseMail</th>
                            </tr>
                        </thead>
                        <tbody class="ListeFileAttente font_general" id="AListeFileAttente">
                        </tbody>
                    </table>
                    <button class="btn btn-info btn-lg" id="AboutonAjoutFileAttente" onclick="addMeToWaitList()">
                        <span class="font_ui">S\'ajouter a la file d\'attente de rendez-vous</span>
                    </button><br/><br/>
                    <button class="btn btn-primary btn-lg float-left font_ui" id="AButtonCallUser" onclick="CallUser()">Call</button>
                    <button class="btn btn-warning btn-lg float-right font_ui" id="AButtonSupressUserInWaitingList" onclick="removeUserFromWaitingList()">Next</button><br/><br/><br/><br/>
                </div>
                <form onsubmit="return confirm("Voulez-vous supprimer le stand actuel ?")" action="./deleteStand.php" method="POST">
                    <input style="display:none;" type="number" value="'.$data[0]['idStand'].'" name="idStand" id="IDSTANDSUPRESS">
                    <input class="btn btn-danger btn-lg" type="submit" value="Supprimer le stand">
                </form>
            </div
            ';
            echo'<div>
                    <button class="btn btn-danger btn-lg font_ui" id="ButtonChangeModeMOdification" onclick="ChangeMode()">Passer en mode edition</button>
                </div>';
            //echo'<button id="ButtonChangeModeMOdification" onclick="removeUserFromWaitingList()">Next</button>'; // button pour visualiser la page modifiable et devisualiser la page modifiable
            echo'<script src="./StandAdminStand.js"></script>'; // script propre au AdminStand via link
        }

    }

?>


</html>
