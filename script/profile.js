function makeAPost (){

    postPopup = document.getElementById('postPopup')
     postPopup.style.display = "flex";
 
 }
 
 function closePostPopup () {
 
    postPopup = document.getElementById('postPopup')
    postPopup.style.display = "none";
     
 }
 
 function submitPost () {
     location.reload();
 
 }
 
 function toggle(){
   
 }

 $(document).ready(function(){ 

 $('.text-option').on({
    mouseenter: function(){
        $(this).css('background-color', 'white');
        
    },
    mouseleave: function(){
        $(this).css('background-color', 'transparent');
    }
 });



});