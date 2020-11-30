// ------------------------------------------------------------------------------- recuperation des different element du document -----------------------------------------------------------------------


    setInterval(Request,150);

    function addMeToWaitList()
    {
        var idUser = sessionStorage.getItem("idUtilisateur");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xhttp.responseText);
            }
        };
        xhttp.open("GET", "./addFileAttente.php?idStand="+document.getElementById("ID").value+"&idUser="+idUser, true);
        xhttp.send();
       
    }



    function PrintFileAttente(valueRequest){
        tableau = document.getElementsByClassName("ListeFileAttente");
        //console.log(tableau);
        for(var i = 0;i< tableau.length;i++){
            tableau[i].innerHTML = valueRequest;
        }
        
    }
    
    function Request(){
        var permission = sessionStorage.getItem("permission");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                PrintFileAttente(xhttp.responseText);
                // Typical action to be performed when the document is ready:
                 // et si tu mettai directement ça ( tu peux ordonner via la requete SQL);
            }
        };
        xhttp.open("GET", "./fileAttenteData.php?perm="+permission+"&idStand="+document.getElementById("ID").value, true);
        xhttp.send();
    }