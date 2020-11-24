<!DOCTYPE html>
<html >
<head>
    <title>Liste des Salons</title>
    <style>
                #runnerGame {
            width: 1400px;
            height: 200px;
            border: black solid 2px;
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
            height: calc(100vh - 60px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #rechercheSalon > div:first-child{
            display: grid;
            grid-template-columns: 85% 15%;
            height: 30px;
            margin-bottom: 5px;
        }

        #rechercheSalon > div:nth-child(2){
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #rechercheSalon select {
            width: 20%;
            height: 24px;
            text-align: center;
        }

        #scrollList {
            padding : 12px;
            width: calc(100% - 24px);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            height: 576px;
            overflow-y: scroll;
            display: flex;
            flex-direction: column;
            justify-items: center;
            align-items: stretch;
        }

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

        #scrollList div {
            margin-bottom: 10px;
            border-radius: 10px;
            border: 2px solid rgba(0, 0, 0, 0.5);
            padding : 5px;
            transition: box-shadow 0.5s;
        }

        #scrollList div:hover {
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0, 0, 255, 0.3);
        }

        #scrollList div p:nth-child(2){
            height: 30px;
            font-size: 25px;
            margin: 0;
        }

        #scrollList div p:nth-child(3){
            height: 100px;
            margin: 0;
        }

        #scrollList img {
            float: left;
            margin-right: 10px;
            width: 130px;
            height: 130px;
            border-radius: 5px;
        }

        #buttonCont {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <a href='./listeStand.php'>Salon1</a>
    <form action="#" method="post" id="rechercheSalon"> <!-- recherche de salon -->
        <div>
            <input type="text" name="nomSalon" placeholder="chercher un salon">
            <input type="submit" value="Filtrer"> 
        </div>
        <div>
            <div>
                <label for="dateDebut">Commence le :</label>
                <input type="date" name="dateDebut" >
            </div>
            <div>
                <label for="dateFin">Termine le :</label>
                <input type="date" name="dateFin">
            </div>
            <select name="localisation" ><!-- Ce serait bien de remplir le select avec les villes possible des salons dans la bdd -->
                <option value="Bruxelles">Bruxelles </option><!-- juste les villes pour exemple -->
                <option value="Starsbourg">Strasbourg </option>
            </select>
            <select name="type" ><!-- Ce serait bien de remplir le select avec les type de salon possible de la bdd -->
                <option value="Technologie">Technologie</option><!-- juste les types pour exemple -->
                <option value="Emplois">Emplois </option>
            </select>
        </div>
    </form>

    <div id="scrollList">
        <!-- vide au debut -->
    </div>

    <form action="#" method="post" id="formulaireContact"><!-- formulaire de contacte pour cree un salon -->
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

    <div id="buttonCont">
        <button id="jeu">Mini-jeu</button>
        <button id="formulaireB">Formulaire de contact</button>
    </div>

    <canvas id="runnerGame"></canvas>
</body>
<script>

    var formulaire = document.getElementById("rechercheSalon");
    var liste = document.getElementById("scrollList");
    var formulaireContact = document.getElementById("formulaireContact");
    var buttonForm = document.getElementById("formulaireB");
   
    formulaireContact.style.display = "none";
    buttonForm.addEventListener("click",enterFormContact);
    formulaire.addEventListener("submit",filtrer);
    formulaireContact.addEventListener("submit",envoyerSalon);

    //au debut il faut remplir la liste avec tous les salon (ou trier)

    //exemple :
    creerSalon("ludus","c'est une ecole","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyvEVnVjIin1HPVmd4KfEvcHbqqE-Kf4xpRQ&usqp=CAU","Bruxelle","1");
    creerSalon("Siep","c'est un salon","https://www.fredzone.org/wp-content/uploads/2016/10/cursedimages-640x467.jpg","Paris","1");
    creerSalon("Truc","c'est indéfinis","https://telegram.im/img/cursedimages","New-York");
    creerSalon("ludus","c'est une ecole","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyvEVnVjIin1HPVmd4KfEvcHbqqE-Kf4xpRQ&usqp=CAU","Bruxelle","1");
    creerSalon("Siep","c'est un salon","https://www.fredzone.org/wp-content/uploads/2016/10/cursedimages-640x467.jpg","Paris","1");
    creerSalon("Truc","c'est indéfinis","https://telegram.im/img/cursedimages","New-York","1");
    creerSalon("ludus","c'est une ecole","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyvEVnVjIin1HPVmd4KfEvcHbqqE-Kf4xpRQ&usqp=CAU","Bruxelle","1");
    creerSalon("Siep","c'est un salon","https://www.fredzone.org/wp-content/uploads/2016/10/cursedimages-640x467.jpg","Paris","1");
    creerSalon("Truc","c'est indéfinis","https://telegram.im/img/cursedimages","New-York","1");

    function creerSalon(nom, pitch, img, ville, id){
        var container = document.createElement("div");
        var elem = document.createElement("img");
        elem.src = img;
        container.appendChild(elem);
        elem = document.createElement("p");
        elem.innerHTML = nom + " - " + ville;
        container.appendChild(elem);
        elem = document.createElement("p");
        elem.innerHTML = pitch;
        container.appendChild(elem);
        container.setAttribute("name",id);
        liste.appendChild(container);
        //container.addEventListener("click",allez sur la page salon avec l'id stocké dans le name du div);
    }

    function enterFormContact(e){
        formulaireContact.style.display = "block";
        formulaire.style.display = "none";
        liste.style.display = "none";
        buttonForm.innerHTML ="Annuler";
        buttonForm.removeEventListener("click",enterFormContact);
        buttonForm.addEventListener("click",exitFormContact);
        // on entre dans le form de contact
    }

    function exitFormContact(e) {
        formulaireContact.style.display = "none";
        formulaire.style.display = "block";
        liste.style.display = "block";
        buttonForm.innerHTML ="Formulaire de contact";
        buttonForm.removeEventListener("click",exitFormContact);
        buttonForm.addEventListener("click",enterFormContact);
        // on sort dans le form de contact
    }

    function filtrer(e){
        //demander au serveur les salon correspondant au filtre
    }

    function envoyerSalon(e){
        //envoyer au admin le formulaire ? (c'est pour créer un salon)
    }
    
    
    //game =========================================================================================================================================================
    //game =========================================================================================================================================================
    //game =========================================================================================================================================================

    var jeuB = document.getElementById("jeu");
    var runnerGame = document.getElementById("runnerGame");
    var ctx = runnerGame.getContext("2d");

    ctx.fillStyle = 'rgb(0,0,0)';
    ctx.fillRect(0,130,1400,20);

    runnerGame.style.display = "none";
    jeuB.addEventListener("click",StartGame);

    function StartGame() {
        runnerGame.style.display = "block";
        jeuB.innerHTML = "Quitter le jeu"
        jeuB.removeEventListener("click",StartGame);
        jeuB.addEventListener("click",ExitGame);
        setInterval(gameUpdate,1000/60);
    }


    function gameUpdate() {
    }

    function ExitGame() {
        runnerGame.style.display = "none";
        jeuB.innerHTML = "Mini-jeu"
        jeuB.removeEventListener("click",ExitGame);
        jeuB.addEventListener("click",StartGame);
    }


</script>
</html>
