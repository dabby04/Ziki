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
    console.log("hello");

    $('.rectangle').css('background-image', 'url(images/Tech.jpg)');
 }