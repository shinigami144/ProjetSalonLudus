var nbFile = 9;
var timer = setInterval(myTimer, 1000);

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
