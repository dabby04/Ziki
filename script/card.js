document.addEventListener("DOMContentLoaded", function() {
    //Check the class name of card to see if it is active or not
    var active=document.getElementsByClassName("active");
    if(active){
        var card=document.getElementsByClassName("statcard")
        card[0].style.margin_top="20em !important";
    }
});