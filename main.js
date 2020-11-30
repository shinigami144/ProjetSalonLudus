var nbFile = 650;
var timer = setInterval(myTimer, 1000);


//Allow the header to be correctly placed at the laoding of the page
$(document).ready(function(){
    $(this).scrollTop(0);
});



//Handling of the modal for connexions
let modal = $("#myModal");
let span = $(".close");

function myTimer() {
    if( nbFile == 1){
        clearInterval(timer);
        $("#decrementation").html(nbFile);
        modal.css("display","block");
    }
    nbFile--;
    $("#decrementation").html(nbFile);
    
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
    
    //if()
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
                        
