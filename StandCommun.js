// ------------------------------------------------------------------------------- recuperation des different element du document -----------------------------------------------------------------------
    // variable user
    var userPermission;

    // partie divInformationEntreprise

    var tempPositionfortest = 1;

    function addMeToWaitList()
    {
        var lsiteAttente = document.getElementById("listeFileAttente");
        var userText = document.createElement("p");
        userText.id = "userID"; //  modifier quand lier a bdd
        userText.appendChild(document.createTextNode("userNom" + tempPositionfortest)); // modifier pour changer userNom avec user name from bdd
        lsiteAttente.appendChild(userText);
        tempPositionfortest++;
  		
  	}