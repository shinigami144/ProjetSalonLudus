
//Allow the header to be correctly placed at the laoding of the page
$(document).ready(function(){
    $(this).scrollTop(0);
});



//Handling of the modal for connexions
let modal = $("#myModal");
let span = $(".close");

setInterval(CallBDD,150);
var popUpOnce = 0;
function CallBDD(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
            if(xhttp.responseText == 1 && popUpOnce==0){
                //console.log("ALLO");
                popUp();
                popUpOnce=1;
            }
        }
    };
    xhttp.open("GET", "./UserRequestPositionFileAttente.php?id="+sessionStorage.getItem("idUtilisateur"), true);
    xhttp.send();
}

function dePopUp(){
    modal.css("display","none");
}

function popUp(){
    modal.css("display","block");
    setTimeout(dePopUp,5000);
}

// When the user clicks on <span> (x), close the modal
span.on("click", function(){
  modal.css("display","none");  
});

// When the user clicks anywhere outside of the modal, close it
window.addEventListener("click", function(event) {
  if (event.target == modal) {
    modal.css("display","none");
  }
});

let iframe = document.getElementById("bodyPage");

//Handler for different page in iframe
$("#buttonSalon").click(function(){
    iframe.src ="./listeSalon.php";
    
});
                        
$("#buttonStands").click(function(){
    iframe.src = "pageSalon.php?id=";
    console.log(iframe);
    
});
                           
$("#buttonProfil").click(function(){
    iframe.src = "./pageProfil.php";
    console.log(iframe);
    
});
                           
$("#buttonDeconnexion").click(function(){
    console.log("deco");
//    
    
});
                        
