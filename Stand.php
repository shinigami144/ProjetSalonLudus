<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stand n°1</title>
    <style>
        a{
            display: block;
        }
    </style>
</head>
<?php
	require("connect.php");	
    $conn = connectDB();
    $sql = "SELECT * FROM stand WHERE idStand=?";
    $req = $conn->prepare($sql);
    $req->execute([$_GET['idStand']]);
    $data = $req->fetchAll();
    //var_dump($data);
    
    $permission = 2;
    if(isset($conn)){
        echo '
            <div id="PageCommun">
                <div id="divInformationEntreprise">
                    <image id="logoEntreprise" src="https://fakeimg.pl/300/"></image>
                    <p id="nomEntreprise" contenteditable="false">'.$data[0]['nomStand'].'</p>
                    <p id="descriptionEntreprise" contenteditable="false">'.$data[0]['descriptionStand'].'</p>
                    <address id="adresseEntreprise" contenteditable="false">'.$data[0]['adresseStand'].' </address>
                    <p type="email"  id="emailEntreprise" contenteditable="false">Email</p>
                    <a  id="siteEntreprise" contenteditable="false">SITE</a>
                    <p  id="telEntreprise" contenteditable="false"  >tel</p>
                    <div id="Brochure">
                        <h4>Brochure</h4>
                        <a href="./DataFile/Exemple_MainActivity.pdf" download="brochurePDF">
                            <image src="./Graphics/DownloadIcon.png"/>
                        </a>
                    </div>
                </div>
                <div id="divFileAttente">
                    <p id="descriptionFileAttente" contenteditable="false">Annotation pour la file d\'attente</p>
                    <div id="listeFileAttente">
                    <p><span id="textWaiting"></span>
			        <span id="nbrWaiting">0</span> </p>
                </div>
                <button id="boutonAjoutFileAttente" onclick="addMeToWaitList()">
                    S\'ajouter a la file d\'attente de rendez-vous
                </button>
                </div>
            </div>
        ';
        echo'<script src="./StandCommun.js"></script>' ;// script commun 
        if($permission == 1){ // admin de salon
            echo'
                <button id="BoutonAccepterStand"  onclick="accepterStand()">Stand Accepter</button>
                <button id="ButtonRefuserStand" onclick="refuserStand()">Stand Refuser</button>
            ';
            echo'<script src="./StandAdminSalon.js"></script>' ; // script propre au admin salon
        }
        else if ($permission == 2){ // admin stand 
            echo'<style>
                #IDSTAND{
                    display:none;
                }
                </style>
            '; // CSS via adminStand
            echo'
            <div id="PageAdminStand">
                <form id="divInformationEntreprise" action="modifStand.php" method="POST">
                    <input type="number" value="2" name="idStand" id="IDSTAND">
                    <div id="stand_image_container">
                        <label for="LogoEntreprise_UploadBtn"> <!-- Le FOR doit être égal à l\'id de l\'input type file ci-dessous -->
                            <img src="https://fakeimg.pl/300/" id="logoEntreprise" name="LogoEntreprise" alt="Image Avatar" title="Image du Stand">
                        </label>
                        <input type="file" name="LogoEntreprise_Upload" value="" id="ALogoEntreprise_UploadBtn" accept="image/png, image/jpeg, image/jpg" style="display: none;">
                    </div>
                    <input type="text" name="nomEntreprise" value="'.$data[0]['nomStand'].'"placeholder="NomEntreprise" id="AnomEntreprise" readonly>
                    <input type="text" name="descriptionEntreprise" value="'.$data[0]['descriptionStand'].'" placeholder="description de l\'entreprise" id="AdescriptionEntreprise"  readonly>
                    <input type="text" name="adresseEntreprise" value="'.$data[0]['adresseStand'].'"placeholder="81 rue des moule" id="AadresseEntreprise" readonly>
                    <input type="email" name="emailEntreprise" placeholder="truc@tucr.com" id="AemailEntreprise" readonly pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$">
                    <input type="text" name="siteEntreprise" placeholder="https://www.w3schools.com/" id="AsiteEntreprise" readonly>
                    <input type="tel" name="telephoneEntreprise" placeholder="+2486442727" id="AtelEntreprise" pattern="(^[+]|^[0])+[1-9]+[0-9]*$" readonly>
                    <title for="fileToUpload"> Brochure </title>
                    <div id="Brochure">
                        <h4>Brochure</h4>
                        <a href="./DataFile/Exemple_MainActivity.pdf" download="brochurePDF">
                            <image src="./Graphics/DownloadIcon.png"/>
                        </a>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                <input type="submit" name="btnModifStand" id="submitBtnChangeStand" value="Mettre à jour les informations du Stand">
                </form>
                <div id="AdivFileAttente">
                    <input id="AdescriptionFileAttente" readonly>
                    <div id="AlisteFileAttente">
                    </div>
                    <button id="AboutonAjoutFileAttente" onclick="addMeToWaitList()">
                        S\'ajouter a la file d\'attente de rendez-vous
                    </button>
                    <button id="AButtonSupressUserInWaitingList" onclick="removeUserFromWaitingList()">Next</button>
                </div> 
            </div   
            ';
            echo'<div>
                    <button id="ButtonChangeModeMOdification" onclick="ChangeMode()">Passer en mode edition</button>
                </div>';
            //echo'<button id="ButtonChangeModeMOdification" onclick="removeUserFromWaitingList()">Next</button>'; // button pour visualiser la page modifiable et devisualiser la page modifiable
            echo'<script src="./StandAdminStand.js"></script>'; // script propre au AdminStand via link
        }

    }
    


?>


</html>