<!DOCTYPE html>
<html >
<head>
    <link rel="stylesheet" href="./CSS/listeSalon.css">
    <title>Liste des Salons</title>
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
    creerSalon("ludus","c'est une ecole","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyvEVnVjIin1HPVmd4KfEvcHbqqE-Kf4xpRQ&usqp=CAU","Bruxelle");
    creerSalon("Siep","c'est un salon","https://www.fredzone.org/wp-content/uploads/2016/10/cursedimages-640x467.jpg","Paris");
    creerSalon("Truc","c'est indéfinis","https://telegram.im/img/cursedimages","New-York");
    creerSalon("ludus","c'est une ecole","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyvEVnVjIin1HPVmd4KfEvcHbqqE-Kf4xpRQ&usqp=CAU","Bruxelle");
    creerSalon("Siep","c'est un salon","https://www.fredzone.org/wp-content/uploads/2016/10/cursedimages-640x467.jpg","Paris");
    creerSalon("Truc","c'est indéfinis","https://telegram.im/img/cursedimages","New-York");
    creerSalon("ludus","c'est une ecole","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyvEVnVjIin1HPVmd4KfEvcHbqqE-Kf4xpRQ&usqp=CAU","Bruxelle");
    creerSalon("Siep","c'est un salon","https://www.fredzone.org/wp-content/uploads/2016/10/cursedimages-640x467.jpg","Paris");
    creerSalon("Truc","c'est indéfinis","https://telegram.im/img/cursedimages","New-York");

    function creerSalon(nom, pitch, img, ville){
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
        liste.appendChild(container);
        //container.addEventListener("click",allez sur la page sallon avec l'id du div);
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