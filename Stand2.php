<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stand n°2</title>
    <style>
        #submitBtnChangeStand{
            display: none;
        }

    </style>
</head>
<body>
    <form id="divInformationEntreprise">
        <input type="image" id="logoEntreprise" src="https://fakeimg.pl/300/" readonly>
        <input type="text" placeholder="NomEntreprise" id="nomEntreprise" readonly>
        <input type="text" placeholder="description de l'entreprise" id="descriptionEntreprise"  readonly>
        <input type="text" placeholder="67 rue des etiennedereine" id="adresseEntreprise" readonly>
        <input type="email" placeholder="test@test.com" id="emailEntreprise" readonly pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" >
        <input type="text"  placeholder="https://www.w3schools.com/" id="siteEntreprise" readonly>
        <input type="tel"  placeholder="+33525252" id="telEntreprise" pattern="(^[+]|^[0])+[1-9]+[0-9]*$" readonly>
        <title for="fileToUpload"> Brochure </title>
        <div id="Brochure">
            <h4>Brochre</h4>
            <a href="./DataFile/Exemple_MainActivity.pdf" download="brochurePDF">
                <image src="./Graphics/DownloadIcon.png"/>
            </a>
        </div>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" name="btnModifStand" id="submitBtnChangeStand" value="Mettre à jour les informations du Stand">
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
    <button id="BoutonAccepterStand">Stand Accepter</button>
    <button id="ButtonRefuserStand" onclick="refuserStand()">Stand Refuser</button>
</body>
<script>
    // ------------------------------------------------------------------------------- recuperation des different element du document -----------------------------------------------------------------------
    // variable user
    var userPermission;

    // partie divInformationEntreprise

    var logoEntreprise = document.getElementById("logoEntreprise");
    var nomEntreprise = document.getElementById("nomEntreprise");
    var descriptionEntreprise = document.getElementById("descriptionEntreprise");
    var adresseEntreprise  = document.getElementById("adresseEntreprise");
    var emailEntreprise = document.getElementById("emailEntreprise");
    var siteEntreprise = document.getElementById("siteEntreprise");
    var telEntreprise = document.getElementById("telEntreprise");
    var submitBtnModifStand = document.querySelector('#submitBtnChangeStand'); // Button Submit


    // ------------------------------------------------------------------------------- recuperation des different element du document -----------------------------------------------------------------------

    //initialisation des different onclickListener

    logoEntreprise.addEventListener("dblclick",ChangeContentEditable);
    nomEntreprise.addEventListener("dblclick",ChangeContentEditable);
    descriptionEntreprise.addEventListener("dblclick",ChangeContentEditable);
    adresseEntreprise.addEventListener("dblclick",ChangeContentEditable);
    emailEntreprise.addEventListener("dblclick",ChangeContentEditable);
    siteEntreprise.addEventListener("dblclick",ChangeContentEditable);
    telEntreprise.addEventListener("dblclick",ChangeContentEditable);

    // Appuie sur le bouton submit du form
    submitBtnModifStand.addEventListener('click', ModifStand);

    // initialisation des onchangeListener

    logoEntreprise.addEventListener("change",SaveChangeButtonDisplay);
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
    /*
  	function updateWaitList()
  	{
  		//let divWaiting = document.getElementById('nbrWaiting');
  		let divTextWaiting = document.getElementById('textWaiting');
  		if(nbrWaiting < 0)
  			nbrWaiting = 0;
  		if(isInWaitList)
  		{
  			if(nbrWaiting > 1)
  			{
  				divTextWaiting.innerHTML = "Nombre de personne avant vous dans la liste d'attente :";
  				divWaiting.innerHTML = nbrWaiting - 1;
  			}
  			else
  			{
  				divTextWaiting.innerHTML = "C'est à vous!";
  				divWaiting.innerHTML = "";
  			}
  		}
  		else
  		{
  			divTextWaiting.innerHTML = "Nombre de personne en liste d'attente : ";
  			divWaiting.innerHTML = nbrWaiting;
  		}
  	}*/

    var tempPositionfortest = 1;

    function addMeToWaitList()
    {
        var lsiteAttente = document.getElementById("listeFileAttente");
        var userText = document.createElement("p");
        userText.id = "userID"; //  modifier quand lier a bdd
        userText.appendChild(document.createTextNode("userNom" + tempPositionfortest)); // modifier pour changer userNom avec user name from bdd
        lsiteAttente.appendChild(userText);
        tempPositionfortest++;
  		//if(isInWaitList) return;
  		//isInWaitList = true;
  		//addToWaitList();
  	}
      /*
  	function addToWaitList()
  	{
  		nbrWaiting++;
  		updateWaitList();
  	}
    */

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

  	function removeFromWaitList()
  	{
  		nbrWaiting--;
  		updateWaitList();
  	}

</script>


</html>
