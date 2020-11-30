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
            <div id="PageCommun">
                <div id="divInformationEntreprise">
                    <image id="logoEntreprise" src="'.$data[0]['imageStand'].'"></image>
                    <p id="nomEntreprise" contenteditable="false">'.$data[0]['nomStand'].'</p>
                    <p id="pictchStand">'.$data[0]['pitchStand'].' </p>
                    <p id="descriptionEntreprise" contenteditable="false">'.$data[0]['descriptionStand'].'</p>
                    <p id="adresseEntreprise" contenteditable="false">'.$data[0]['adresseStand'].' </p>
                    <p type="email"  id="emailEntreprise" contenteditable="false">'.$data2[0]['mailUtilisateur'].'</p>
                    <a  id="siteEntreprise" contenteditable="false">'.$data[0]['siteStand'].'</a>
                    <p  id="telEntreprise" contenteditable="false"  >'.$data2[0]['telUtilisateur'].'</p>
                    <div id="Brochure">
                        <h4>Brochure</h4>
                        <a href="'.$brochurelink.'" download="brochurePDF">
                            <image src="./File/Graphics/DownloadIcon.png"/>
                        </a>
                    </div>
                </div>
                <div id="divFileAttente">
                    <table>
                        <thead>
                            <tr id="BaseTable">
                                <th scope="col">Nom</th>
                                <th scope="col">Prenom</th>';
                                if($permission == 2){
                                    echo '<th scope="col">AdresseMail</th>';
                                }
                                echo'
                            </tr>
                        </thead>
                        <tbody class="ListeFileAttente" id="ListeFileAttente">
                        </tbody>
                    </table>
                    <button id="boutonAjoutFileAttente" onclick="addMeToWaitList()">
                        S\'ajouter a la file d\'attente de rendez-vous
                    </button>';
                    if($permission == 2){
                        echo '<button id="ButtonSupressUserInWaitingList" onclick="removeUserFromWaitingList()">Next</button>';
                    }
                    echo'
                </div>
            </div>
        ';
        echo'<script src="./StandCommun.js"></script>' ;// script commun 
        if($permission == 1){ // admin de salon
            echo'
            <form action="./acceptationStand.php" method="POST">
                <input style="display:none;" type="number" value="'.$data[0]['idStand'].'" name="idStand" id="IDSTANDACCEPTATION">
                <button type="submit" name="acceptationStand" value="1">Accepter le stand</button>
                <button type="submit" name="acceptationStand" value="0">Refuser le stand</button>
            </form>
            ';
            echo'<script src="./StandAdminSalon.js"></script>' ; // script propre au admin salon
        }
        else if ($permission == 2){ // admin stand 
            echo '<p id="debug"></p>';
            echo'
            <div id="PageAdminStand">
                <form id="divInformationEntreprise" enctype="multipart/form-data" action="modifStand.php" method="POST">
                    <div id="stand_image_container">
                        <label for="ALogoEntreprise_UploadBtn">
                            <img src="'.$data[0]['imageStand'].'" id="AlogoEntreprise" name="LogoEntreprise" alt="Image Avatar" title="Image du Stand">
                        </label>
                        <input type="file" name="LogoEntreprise_Upload" value="" id="ALogoEntreprise_UploadBtn" accept="image/png, image/jpeg, image/jpg" style="display: none;">
                    </div>
                    <input type="text" name="nomEntreprise" value="'.$data[0]['nomStand'].'"placeholder="NomEntreprise" id="AnomEntreprise" readonly>
                    <input type="text" name="pitchStand" value="'.$data[0]['pitchStand'].'" placeholher="PicthEntreprise" id="ApitchStand" readonly>
                    <input type="text" name="descriptionEntreprise" value="'.$data[0]['descriptionStand'].'" placeholder="description de l\'entreprise" id="AdescriptionEntreprise"  readonly>
                    <input type="text" name="adresseEntreprise" value="'.$data[0]['adresseStand'].'"placeholder="81 rue des moule" id="AadresseEntreprise" readonly>
                    <input type="email" name="emailEntreprise" value="'.$data2[0]['mailUtilisateur'].'" placeholder="truc@tucr.com" id="AemailEntreprise" readonly pattern="\^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$">
                    <input type="text" name="siteEntreprise" value="'.$data[0]['siteStand'].'" placeholder="https://www.w3schools.com/" id="AsiteEntreprise" readonly>
                    <input type="tel" name="telephoneEntreprise"  value="'.$data2[0]['telUtilisateur'].'" placeholder="+2486442727" id="AtelEntreprise" pattern="(^[+]|^[0])+[1-9]+[0-9]*$" readonly>
                    <title for="fileToUpload"> Brochure </title>
                    <div id="Brochure">
                        <h4>Brochure</h4>
                        <a href="'.$brochurelink.'" download="brochurePDF">
                            <image src="./File/Graphics/DownloadIcon.png"/>
                        </a>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                <input type="submit" name="btnModifStand" id="submitBtnChangeStand" value="Mettre à jour les informations du Stand">
                </form>
                <div id="AdivFileAttente">
                    <table>
                        <thead>
                            <tr id="BaseTable">
                                <th scope="col">Nom</th>
                                <th scope="col">Prenom</th>
                                <th scope="col">AdresseMail</th>
                            </tr>
                        </thead>
                        <tbody class="ListeFileAttente" id="AListeFileAttente">
                        </tbody>
                    </table>
                    <button id="AboutonAjoutFileAttente" onclick="addMeToWaitList()">
                        S\'ajouter a la file d\'attente de rendez-vous
                    </button>
                    <button id="AButtonSupressUserInWaitingList" onclick="removeUserFromWaitingList()">Next</button>
                </div>
                <form onsubmit="return confirm("Voulez-vous supprimer le stand actuel ?")" action="./deleteStand.php" method="POST">
                    <input style="display:none;" type="number" value="'.$data[0]['idStand'].'" name="idStand" id="IDSTANDSUPRESS">    
                    <input type="submit" value="Supprimer le stand">
                </form> 
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