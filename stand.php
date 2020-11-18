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
<script>
    // ------------------------------------------------------------------------------- recuperation des different element du document -----------------------------------------------------------------------
    // variable user
    var userPermission;

    // ------------------------------------------------------------------------------- recuperation des different element du document -----------------------------------------------------------------------
	</script>
	<?php
	// partie divInformationEntreprise
		$req = "select * from stand";
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
			$req = "select * from stand where idStand = " . $_GET["idStand"];
		}
		if(isset($conn))
		{
			$table = $conn->query($req);	
			foreach($table as $row)
			{
				echo '<script>let divEntreprise = document.getElementById("divInformationEntreprise");</script>';
				
				if($row["imageStand"])
				{
					echo'<script>
					let logo = document.createElement("img");
					logo.src = "'. $row["imageStand"] . '" ;
					logo.id = "imageEntreprise";
					divEntreprise.appendChild(logo);
					</script>';
				}
				
				if($row["nomStand"])
				{
					echo'<script>
					let nom = document.createElement("h2");
					nom.innerHTML = "'.$row["nomStand"].'";
					nom.id = "nomEntreprise";
					divEntreprise.appendChild(nom);
					</script>';
				}
				
				if($row["descriptionStand"])
				{
					echo'<script>
					let description = document.createElement("p");
					description.innerHTML = "'.$row["descriptionStand"].'";
					description.id = "descriptionEntreprise";
					divEntreprise.appendChild(description);
					</script>';
				}
				
				if($row["adresseStand"])
				{
					echo'<script>
					let adresse = document.createElement("address");
					adresse.innerHTML = "'.$row["adresseStand"].'";
					adresse.id = "adresseEntreprise";
					divEntreprise.appendChild(adresse);
					</script>';
				}
				
				/*if($row["telephoneStand"])
				{
					echo'<script>
					let adresse = document.createElement("address");
					adresse.innerHTML = "'.$row["adresseStand"].'";
					adresse.id = "adresseEntreprise";
					divEntreprise.appendChild(adresse);
					</script>';
				}*/
				
				/*if($row["adresseStand"])
				{
					echo'<script>
					let adresse = document.createElement("p");
					adresse.innerHTML = "'.$row["emailStand"].'";
					adresse.id = "adresseEntreprise";
					divEntreprise.appendChild(adresse);
					</script>';
				}*/
				
				/*if($row["adresseStand"])
				{
					echo'<script>
					let site = document.createElement("p");
					site.innerHTML = "'.$row["emailStand"].'";
					site.id = "siteEntreprise";
					divEntreprise.appendChild(site);
					</script>';
				}*/
				
				
			}
		}
	?>
	
	<script>
    //initialisation des different onclickListener
    
	var logoEntreprise = document.getElementById("logoEntreprise");
	var nomEntreprise = document.getElementById("nomEntreprise");
	var descriptionEntreprise = document.getElementById("descriptionEntreprise");
	var adresseEntreprise  = document.getElementById("adresseEntreprise");
	//var emailEntreprise = document.getElementById("emailEntreprise");
	var siteEntreprise = document.getElementById("siteEntreprise");
	var telEntreprise = document.getElementById("telEntreprise");
	
    logoEntreprise.addEventListener("dblclick",ChangeContentEditable);
    nomEntreprise.addEventListener("dblclick",ChangeContentEditable);
    descriptionEntreprise.addEventListener("dblclick",ChangeContentEditable);
    adresseEntreprise.addEventListener("dblclick",ChangeContentEditable);
    //emailEntreprise.addEventListener("dblclick",ChangeContentEditable);
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