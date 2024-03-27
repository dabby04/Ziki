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


 $(document).ready(function(){ 

 $('.text-option').on({
    mouseenter: function(){
        $(this).css('background-color', 'white');
        
    },
    mouseleave: function(){
        $(this).css('background-color', 'transparent');
    },
    onclick: function(){
        $(this).css('background-color', 'white');

    }
 

 });

 $('.text-option').click(function() {
    // Remove the white background color from all buttons
    $('.text-option').css('background-color', 'transparent');
    
    // Set the background color of the clicked button to white
    $(this).css('background-color', 'white');
});


});

function toggle(url) {
    $('.text-option').removeClass('active'); // Remove 'active' class from all options
    $(event.target).closest('.text-option').addClass('active'); // Add 'active' class to the clicked option

    // Load content using AJAX
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#post-container').html(response); // Replace the content of the container with the response
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to the console
        }
    });

    return false; // Prevent the default behavior of the anchor tag
}
