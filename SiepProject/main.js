var nbFile = 5;
var timer = setInterval(myTimer, 1000);

$(document).ready(function(){
    $(this).scrollTop(0);
});

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


// When the user scrolls the page, execute myFunction
window.onscroll = function() {stickyHeader()};

// Get the navbar
var navbar = $("#stickySection");

// Get the offset position of the navbar
var sticky = navbar.offset().top;
// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function stickyHeader() {
    console.log(sticky);
  if (screenY>= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

