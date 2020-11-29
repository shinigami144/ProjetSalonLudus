<?php 
    session_start();
    include('fonctions.php');
    $idSalon = $_GET['id'];
    echo EstAdmin($idSalon);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php AfficheNomSalon($idSalon); ?></title>
    <style>

        /* width */
        ::-webkit-scrollbar {
            width: 5px;
        }
        
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }
        
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        html {
            display: grid;
            justify-items: center;
            align-items: center;
        }

        body {
            padding-top: 30px;
            padding-bottom: 30px;
            margin: 0;
            width: 60%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #information {
            margin-top: 30px;
            padding : 12px;
            width: calc(100% - 24px);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        #information > div {
            width: 100%;
            height: 200px;
            text-align: center;
            display: flex;
            align-items: center;
        }

        #information > div > div {
            width: calc(100% - 200px);
        }

        #information > div img {
            float: right;
            width: 200px;
            height: 200px;
        }

        #information > div h1 {
            text-decoration: underline;
        }

        #information > article {
            width: calc(100% - 60px);
            padding-left: 30px;
            padding-right: 30px;
        }
        a {
            text-align: right;
            font-size: 20px;
        }

        #stand {
            margin-top: 30px;
            margin-bottom: 30px;
            padding : 12px;
            width: calc(100% - 24px);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        #stand h2 {
            text-align: center;
        }

        #filtreStand {
            margin-left: 20%;
            width: 60%;
            display: flex;
            flex-direction: column;
        }

        #filtreStand > div:first-child{
            display: grid;
            grid-template-columns: 85% 15%;
            height: 30px;
            margin-bottom: 5px;
        }

        #scrollList {
            margin-top: 30px;
            padding : 5px;
            width: calc(100% - 10px);
            height: 500px;
            overflow-y: scroll;
            display: flex;
            flex-direction: column;
            justify-items: center;
            align-items: stretch;
        }

        #scrollList > div {
            margin-bottom: 10px;
            border-radius: 10px;
            border: 2px solid rgba(0, 0, 0, 0.5);
            padding : 5px;
            display: grid;
            grid-template-columns: 130px auto 130px;
            transition: box-shadow 0.5s;
        }

        #scrollList > div:hover {
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0, 0, 255, 0.3);
        }

        #scrollList > div div:nth-child(2) p:first-child{
            text-align: center;
            height: 30px;
            font-size: 25px;
            margin: 0;
        }

        #scrollList > div div:nth-child(2) p:nth-child(2){
            width: calc(100% - 20px);
            height: 80px;
            margin: 0;
            padding: 10px;
        }

        #scrollList img {
            float: left;
            width: 130px;
            height: 130px;
            border-radius: 5px;
        }

        .grey {
            background-color: lightgray;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="adminDiv"><!-- uniquement pour admin salon -->
    <form method="GET" id="suppSalon" onsubmit='return confirm("Etes-vous sûr ?")'>
        <input type="submit" value="Supprimer le Salon">
    </form>

        <button id="modSalon">Modifier le salon</button>
        <form id="modifierSalon"><!-- formulaire pour modifier un salon -->
            <h2>modification du Salon</h2>
            <label for="titre">Nom du salon</label>
            <input type="text" name="titre" >
            <br>
            <label for="dateDebut">Date de debut</label>
            <input type="date" name="dateDebut" >
            <br>
            <label for="dateFin">Date de fin</label>
            <input type="date" name="dateFin" >
            <br>
            <label for="horaireOuverture">Horaire d'ouverture</label>
            <input type="time" name="horaireOuverture">
            <br>
            <label for="horaireFermeture">Horaire de fermeture</label>
            <input type="time" name="horaireFermeture">
            <br>
            <label for="localisation">Localisation</label>
            <input type="text" name="localisation">
               <!-- ce serait cool d'avoir un google maps ou quoi -->
            <br>
            <label for="description">Description :</label>
            <br>
            <textarea name="description" cols="30" rows="10"></textarea>
            <br>
            <label for="information">Information supplémentaire :</label>
            <br>
            <textarea name="information" cols="30" rows="10"></textarea>
            <br>
            <input type="submit" value="envoyer">  
        </form>
    </div>
    <!--partie salon-->
    <div id="information"><!-- information (à completer en php)-->
        <div>
            <div>
                <h1><?php AfficheNomSalon($idSalon); ?></h1>
                <p>Organisé par : <?php AfficheNomPrenomCreateurSalon($idSalon); ?></p>
            </div>     
            <img src="<?php AfficheImageSalon($idSalon); ?>">       
        </div>
        <article>
            <h2>Information :</h2>
            <p>du <?php AfficheDateDebutSalon($idSalon); ?> au <?php AfficheDateFinSalon($idSalon); ?></p>
            <p>de <?php AfficheOuvertureSalon($idSalon); ?> à <?php AfficheFermetureSalon($idSalon); ?></p>
            <p><?php AfficheLocalisationSalon($idSalon); ?></p>
            <p><?php AfficheDescriptionSalon($idSalon); ?></p>
        </article>
    </div>
    <!--partie stand-->
    <div id="stand">
        <h2>Liste des stands</h2>
        <form method="post" id="filtreStand">
                <div>
                    <input type="text" name="nomStand" placeholder="chercher un Stand">
                    <input type="submit" value="Filtrer"> 
                </div>
                <div>
                    <label for="ouvert">Uniquement les stands ouverts</label>
                    <input type="checkbox" name="ouvert" checked>
                </div>
        </form>
        <div id="scrollList"> <!-- là ou il y aura la liste de stand -->
        <!-- vide au debut -->
        </div>
    </div>
    <a href="#">Je crée mon stand</a> <!--lien vers la page de creation de stand-->
</body>
<script>

    var adminDiv = document.getElementById("adminDiv");
    var modifierSalon = document.getElementById("modifierSalon");
    var stand = document.getElementById("stand");
    var information = document.getElementById("information");
    var filtreStand = document.getElementById("filtreStand");
    var suppSalon = document.getElementById("suppSalon");
    var modSalon = document.getElementById("modSalon");

    modifierSalon.style.display = "none";
    modifierSalon.addEventListener("submit", sendModif);
    filtreStand.addEventListener("submit", filtrer);
    suppSalon.addEventListener("submit", supprimerSalon);
    modSalon.addEventListener("click", afficherAdmin);

    var isAdmin = true;//iciiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii pour enlever la div admin ou pas
    if(isAdmin){

    }
    else {
        adminDiv.parentElement.removeChild(adminDiv);
    }

    function sendModif(){

    }

    function filtrer(){
        
    }

    function supprimerSalon(){
        
    }

    function afficherAdmin(){
        modifierSalon.style.display = "block";
        modSalon.innerHTML = "Annuler modification";
        modSalon.removeEventListener("click", afficherAdmin);
        modSalon.addEventListener("click", desafficherAdmin);
    }

    function desafficherAdmin(){
        modifierSalon.style.display = "none";
        modSalon.innerHTML = "Modifier le salon";
        modSalon.removeEventListener("click", desafficherAdmin);
        modSalon.addEventListener("click", afficherAdmin);
    }

    function creerStand(nom, pitch, img ,heureOuverture, heureFermeture, ouvert, id){
            var container = document.createElement("div");
            var elem = document.createElement("img");
            var div1 = document.createElement("div");
            var div2 = document.createElement("div");
            elem.src = img;
            container.appendChild(elem);
            elem = document.createElement("p");
            elem.innerHTML = nom;
            div1.appendChild(elem);
            elem = document.createElement("p");
            elem.innerHTML = pitch;
            div1.appendChild(elem);
            elem = document.createElement("h4");
            elem.innerHTML = "Horaire";
            div2.appendChild(elem);
            elem = document.createElement("p");
            elem.innerHTML = heureOuverture;
            div2.appendChild(elem);
            elem = document.createElement("p");
            elem.innerHTML = heureFermeture ;
            div2.appendChild(elem);
            container.appendChild(div1);
            container.appendChild(div2);
            container.setAttribute("name",id);
            if(ouvert == "0"){
                container.setAttribute("class","grey");
            }
            liste.appendChild(container);
            //container.addEventListener("click",allez sur la page stand avec l'id stocké dans le name du div);
    }

</script>
</html>