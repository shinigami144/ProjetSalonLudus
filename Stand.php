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
?>
<body>
    <div id="divInformationEntreprise">
        <image id="logoEntreprise" src="https://fakeimg.pl/300/"></image>
        <p id="nomEntreprise" contenteditable="false">Nom</p>
        <p id="descriptionEntreprise" contenteditable="false">description</p>
        <address id="adresseEntreprise" onclick="ChangeContentEditable(this)" contenteditable="false"> Rue des Coquelico 87 </address>
        <p type="email"  id="emailEntreprise" contenteditable="false">Email</p>
        <a  id="siteEntreprise" contenteditable="false"></a>
        <p  id="telEntreprise" contenteditable="false"  >tel</p>
    </div>
    <div id="divFileAttente">
        <p id="descriptionFileAttente" contenteditable="false">Annotation pour la file d'attente</p>
        <div id="listeFileAttente">
            <p><span id="textWaiting"></span>
			<span id="nbrWaiting">0</span> </p>
        </div>
        <button id="boutonAjoutFileAttente" onclick="addMeToWaitList()">
            S'ajouter a la file d'attente de rendez-vous
        </button>
    </div>
    
</body>
<?php
	$idStand = 
	$req = "select * from stand";
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$req = "select * from stand where idStand = " . $_GET["idStand"];
	}
	var_dump($req);
	if(isset($conn))
	{
		$table = $conn->query($req);
		foreach($table as $row)
		{
			var_dump($row);
		}
	}
?>
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


    // ------------------------------------------------------------------------------- recuperation des different element du document -----------------------------------------------------------------------

    //initialisation des different onclickListener
    
    logoEntreprise.addEventListener("dblclick",ChangeContentEditable);
    nomEntreprise.addEventListener("dblclick",ChangeContentEditable);
    descriptionEntreprise.addEventListener("dblclick",ChangeContentEditable);
    adresseEntreprise.addEventListener("dblclick",ChangeContentEditable);
    emailEntreprise.addEventListener("dblclick",ChangeContentEditable);
    siteEntreprise.addEventListener("dblclick",ChangeContentEditable);
    telEntreprise.addEventListener("dblclick",ChangeContentEditable);
	
	//RECUPERER LES VALUES DE LA BDD
	let nbrWaiting = 2;
	let isInWaitList = false;
	updateWaitList();
	setInterval(function(){ removeFromWaitList() }, 1500);
    // initialisation des onchangeListener

    function ChangeContentEditable(){
        var element = document.getElementById(event.currentTarget.id);
        element.setAttribute('contenteditable','true')
        element.focus();
        console.log("OK ?");
        // mettre le focus sur l'element 
    }

	function updateWaitList()
	{
		let divWaiting = document.getElementById('nbrWaiting');
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
	}

	function addMeToWaitList()
	{
		if(isInWaitList) return;
		isInWaitList = true;
		addToWaitList();
		
	}
	
	function addToWaitList()
	{
		nbrWaiting++;
		updateWaitList();
	}
	
	function removeFromWaitList()
	{
		nbrWaiting--;
		updateWaitList();
	}

</script>


</html>