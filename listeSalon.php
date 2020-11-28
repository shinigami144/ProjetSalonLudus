<?php 
    session_start();
    include('fonctions.php');

    $dataSalon = AfficheSalon();
    // ---------------------------------------------- GESTION DU FILTRE ----------------------------------------------
    // --------------------------------------------- 4 parametres choisi ---------------------------------------------
    if (!empty($_POST['localisation']) and $_POST['localisation'] != "tout" and !empty($_POST['dateFin']) and !empty($_POST['dateDebut']) and !empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonVilleDateDebutDateFinNom($_POST['localisation'],$_POST['dateDebut'],$_POST['dateFin'],$_POST['nomSalon']);
    }
    // --------------------------------------------- 3 parametres choisi ---------------------------------------------
    // Si le gars à choisi de trier par ville, par dateDebut et par dateFin
    if (!empty($_POST['localisation']) and $_POST['localisation'] != "tout" and !empty($_POST['dateFin']) and !empty($_POST['dateDebut']) and empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonVilleDateDebutDateFin($_POST['localisation'],$_POST['dateDebut'],$_POST['dateFin']);
    }
    // Si le gars à choisi de trier par ville, par dateDebut et par nom
    else if (!empty($_POST['localisation']) and $_POST['localisation'] != "tout" and empty($_POST['dateFin']) and !empty($_POST['dateDebut']) and !empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonVilleDateDebutNom($_POST['localisation'],$_POST['dateDebut'],$_POST['nom']);
    }
    // Si le gars à choisi de trier par ville, par dateFin et par nom
    else if (!empty($_POST['localisation']) and $_POST['localisation'] != "tout" and !empty($_POST['dateFin']) and empty($_POST['dateDebut']) and !empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonVilleDateFinNom($_POST['localisation'],$_POST['dateFin'],$_POST['nom']);
    }
    // Si le gars à choisi de trier par dateDebut, par dateFin et par nom
    else if (!empty($_POST['localisation']) and $_POST['localisation'] = "tout" and !empty($_POST['dateFin']) and !empty($_POST['dateDebut']) and !empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonDateDebutDateFinNom($_POST['dateDebut'],$_POST['dateFin'],$_POST['nom']);
    }
    // --------------------------------------------- 2 parametres choisi ---------------------------------------------
    // Si le gars à choisi de trier par ville et par dateDebut
    else if (!empty($_POST['localisation']) and $_POST['localisation'] != "tout" and empty($_POST['dateFin']) and !empty($_POST['dateDebut']) and empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonVilleEtDateDebut($_POST['localisation'],$_POST['dateDebut']);
    }

    // Si le gars à choisi de trier par ville et par dateFin
    else if (!empty($_POST['localisation']) and $_POST['localisation'] != "tout" and !empty($_POST['dateFin']) and empty($_POST['dateDebut']) and empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonVilleEtDateFin($_POST['localisation'],$_POST['dateFin']);
    }

    // Si le gars à choisi de trier par ville et par nom
    else if (!empty($_POST['localisation']) and $_POST['localisation'] != "tout" and empty($_POST['dateFin']) and empty($_POST['dateDebut']) and !empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonVilleEtNom($_POST['localisation'],$_POST['nomSalon']);
    }

    // Si le gars à choisi de trier par dateDebut et par dateFin
    else if (!empty($_POST['localisation']) and $_POST['localisation'] = "tout" and !empty($_POST['dateFin']) and !empty($_POST['dateDebut']) and empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonDateDebutDateFin($_POST['dateDebut'],$_POST['dateFin']);
    }

    // Si le gars à choisi de trier par dateDebut et par nom
    else if (!empty($_POST['localisation']) and $_POST['localisation'] = "tout" and empty($_POST['dateFin']) and !empty($_POST['dateDebut']) and !empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonDateDebutNom($_POST['dateDebut'],$_POST['nomSalon']);
    }

    // Si le gars à choisi de trier par dateFin et par nom
    else if (!empty($_POST['localisation']) and $_POST['localisation'] = "tout" and !empty($_POST['dateFin']) and empty($_POST['dateDebut']) and !empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonDateFinNom($_POST['dateFin'],$_POST['nomSalon']);
    }

    // --------------------------------------------- 1 parametre choisi ----------------------------------------------
    // Si le gars à juste choisi une date de début
    else if (!empty($_POST['localisation']) and $_POST['localisation'] = "tout" and empty($_POST['dateFin']) and !empty($_POST['dateDebut']) and empty($_POST['nomSalon']))
    {
        $dataSalon = FiltreSalonDateDebut($_POST['dateDebut']);
    }
    // Si le gars à juste choisi une date de fin
    else if ($_POST['localisation'] = "tout" and !empty($_POST['dateFin']) and empty($_POST['dateDebut']) and empty($_POST['nomSalon']))
    {
        $dataSalon = FiltreSalonDateFin($_POST['dateFin']);
    }
    // Si le gars à juste choisi un nom de salon
    else if ($_POST['localisation'] = "tout" and empty($_POST['dateFin']) and empty($_POST['dateDebut']) and !empty($_POST['nomSalon']))
    {
        $dataSalon = FiltreSalonNom($_POST['nomSalon']);
    }
    // Si le gars à juste choisi de trier par ville 
    // CETTE CONDITION NE MARCHE PAS CA ME SAOULE 
    else if (!empty($_POST['localisation']) and $_POST['localisation'] != "tout" and empty($_POST['dateFin']) and empty($_POST['dateDebut']) and empty($_POST['nomSalon'])) 
    {   
        $dataSalon = FiltreSalonVille($_POST['localisation']);
    }
    // --------------------------------------------- GESTION DU FILTRE FIN ---------------------------------------------

    // ----------------------------------------  DEMANDE DE CREATION DE SALON ------------------------------------------
    // ----------------------------------------- Creation du salon dans la bdd  ----------------------------------------

    if (!empty($_POST['titre']) and !empty($_POST['dateDebutContact']) and !empty($_POST['dateFinContact']) and !empty($_POST['horaireOuverture']) and !empty($_POST['horaireFermeture']) and !empty($_POST['localisationContact']) and !empty($_POST['description']))
    {
        creeSalon($_POST['titre'],$_POST['dateDebutContact'],$_POST['dateFinContact'],$_POST['horaireOuverture'],$_POST['horaireFermeture'],$_POST['localisationContact'],$_POST['description']);
    }
    // Pas oublier info est pas obligatoire mais bien l'ajouter dans le mail si le gars ecrit des trucs 
    // ------------------------------------------ Gestion de l'envoie de mail  -----------------------------------------

    if (!empty($_POST['titre']) and !empty($_POST['dateDebutContact']) and !empty($_POST['dateFinContact']) and !empty($_POST['horaireOuverture']) and !empty($_POST['horaireFermeture']) and !empty($_POST['localisationContact']) and !empty($_POST['description']))
    {
        if (!empty($_POST['information']))
        {
            sendMailDemandeCreationSalon($_POST['titre'],$_POST['dateDebutContact'],$_POST['dateFinContact'],$_POST['horaireOuverture'],$_POST['horaireFermeture'],$_POST['localisationContact'],$_POST['description'],$_POST['information']);
        }
        else 
        {
            sendMailDemandeCreationSalon($_POST['titre'],$_POST['dateDebutContact'],$_POST['dateFinContact'],$_POST['horaireOuverture'],$_POST['horaireFermeture'],$_POST['localisationContact'],$_POST['description'],'');
        }
        
    }

    // --------------------------------------- DEMANDE DE CREATION DE SALON FIN ----------------------------------------


    // /!\ ATTENTION /!\ Il va falloir mettre en place le fait d'afficher uniquement les salon valider par l'admin 

?>

<!DOCTYPE html>
<html >
<head>
    <title>Liste des Salons</title>
    <link href="./css/listeSalon.css" rel="stylesheet"> 
</head>
<body>
    <a href='./listeSalon.php'>reset page</a>
    <form method="post" id="rechercheSalon"> <!-- recherche de salon -->
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
            <select name="localisation" >
                <option value="tout">Tout</option>
                <?php AfficheVillesDesSalons(); ?>
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
        <label for="dateDebutContact">Date de debut</label>
        <input type="date" name="dateDebutContact" >
        <br>
        <label for="dateFinContact">Date de fin</label>
        <input type="date" name="dateFinContact" >
        <br>
        <label for="horaireOuverture">Horaire d'ouverture</label>
        <input type="time" name="horaireOuverture">
        <br>
        <label for="horaireFermeture">Horaire de fermeture</label>
        <input type="time" name="horaireFermeture">
        <br>
        <label for="localisationContact">Localisation</label>
        <input type="text" name="localisationContact">
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

    var tabSalon = <?php echo $dataSalon; ?>;

    for(var i = 0; i < tabSalon.length; i++)
    {
        //en gros on peux pas mettre de num on doit utiliser les nomw dans la table 
        creerSalon(tabSalon[i].nomSalon,tabSalon[i].pitchSalon,tabSalon[i].imageSalon,tabSalon[i].villeSalon,tabSalon[i].idSalon);
    }

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
