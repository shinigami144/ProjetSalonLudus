
var logoEntreprise = document.getElementById("ALogoEntreprise_UploadBtn");
//console.log( document.getElementById("ALogoEntreprise_UploadBtn"));
var picthEntreprise = document.getElementById("ApitchStand");
var nomEntreprise = document.getElementById("AnomEntreprise");
var descriptionEntreprise = document.getElementById("AdescriptionEntreprise");
var adresseEntreprise  = document.getElementById("AadresseEntreprise");
var emailEntreprise = document.getElementById("AemailEntreprise");
var siteEntreprise = document.getElementById("AsiteEntreprise");
var telEntreprise = document.getElementById("AtelEntreprise");


nomEntreprise.addEventListener("dblclick",ChangeContentEditable);
descriptionEntreprise.addEventListener("dblclick",ChangeContentEditable);
adresseEntreprise.addEventListener("dblclick",ChangeContentEditable);
//emailEntreprise.addEventListener("dblclick",ChangeContentEditable);
siteEntreprise.addEventListener("dblclick",ChangeContentEditable);
//telEntreprise.addEventListener("dblclick",ChangeContentEditable);
picthEntreprise.addEventListener("dblclick",ChangeContentEditable);

var divAdminStand = document.getElementById("PageAdminStand");
divAdminStand.style.display = "none"; // force au chargement pour que l'on ne le vois pas ( si je le met dans le CSS il ne se modifie jamais DAVID)
var buttonSubmitChange = document.getElementById("submitBtnChangeStand");
buttonSubmitChange.style.display = "none";

// Appuie sur le bouton submit du form
var submitBtnModifStand = document.getElementById('submitBtnChangeStand'); // Button Submit

// initialisation des onchangeListener
//console.log(logoEntreprise);
logoEntreprise.addEventListener("change",VerifFileLogo);
nomEntreprise.addEventListener("change",ChangeNomEntreprise);
descriptionEntreprise.addEventListener("change",ChangeDescriptionEntreprise);
adresseEntreprise.addEventListener("change",ChangeAdresseEntreprise);
//emailEntreprise.addEventListener("change",ChangeEmailEntreprise);
siteEntreprise.addEventListener("change",ChangeSiteEntreprise);
//telEntreprise.addEventListener("change",ChangeTelEntreprise);
picthEntreprise.addEventListener("change",ChangePitchStand);

function debug(){
    console.log(event.target.id);
}

function ChangePitchStand(){
    var visiteurChamp = document.getElementById("pictchStand");
    visiteurChamp.textContent = picthEntreprise.value;
    console.log(visiteurChamp);
    SaveChangeButtonDisplay();
}

function ChangeNomEntreprise(){
    var visiteurChamp = document.getElementById("nomEntreprise");
    visiteurChamp.textContent = nomEntreprise.value;
    console.log(visiteurChamp);
    SaveChangeButtonDisplay();
}

function ChangeDescriptionEntreprise(){
    var visiteurChamp = document.getElementById("descriptionEntreprise");
    visiteurChamp.textContent = descriptionEntreprise.value;
    SaveChangeButtonDisplay();
}

function ChangeAdresseEntreprise(){
    var visiteurChamp = document.getElementById("adresseEntreprise");
    visiteurChamp.textContent = adresseEntreprise.value;
    SaveChangeButtonDisplay();
}

function ChangeEmailEntreprise(){
    var visiteurChamp = document.getElementById("emailEntreprise");
    visiteurChamp.textContent = emailEntreprise.value;
    SaveChangeButtonDisplay();
}

function ChangeSiteEntreprise(){
    var visiteurChamp = document.getElementById("siteEntreprise");
    visiteurChamp.textContent = siteEntreprise.value;
    SaveChangeButtonDisplay();
}

function ChangeTelEntreprise(){
    var visiteurChamp = document.getElementById("telEntreprise");
    visiteurChamp.textContent = telEntreprise.value;
    SaveChangeButtonDisplay();
}


function SaveChangeButtonDisplay(){
    
    buttonSubmitChange.style.display = "block";

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
            document.getElementById("AlogoEntreprise").src = event.target.result;
        });
        reader.readAsDataURL(file);

    }
    SaveChangeButtonDisplay();
}


function removeUserFromWaitingList(){
    var lsiteAttente = document.getElementById("listeFileAttente");
    console.log(lsiteAttente.children[0]);
    if(lsiteAttente.children[0]){
        lsiteAttente.children[0].remove(lsiteAttente.children[0]);
    }
}

function ChangeMode(){
    var divVisiteur = document.getElementById("PageCommun");
    var divAdminStand = document.getElementById("PageAdminStand");
    var button = document.getElementById("ButtonChangeModeMOdification");
    if(divVisiteur.style.display == "none"){
        divVisiteur.style.display = "block";
        divAdminStand.style.display="none";
        button.textContent = "Passer en mode édition";
        
    }
    else{
        divVisiteur.style.display = "none";
        divAdminStand.style.display="block";
        button.textContent = "voir le preview";
    }
    
}