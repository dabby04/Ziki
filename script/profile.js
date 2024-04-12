
$(document).ready(function() { 
   


document.getElementById('viewLiked').addEventListener('click', function() {
    console.log("Responsive");
    // Get the element with id 'liked-posts'
    var likedPostsSection = document.getElementById('liked-posts');
    var postSection = document.getElementById('main-posts');
    var commentedSection = document.getElementById('commented-posts');

    console.log(likedPostsSection.style.display);
    // Toggle the display style between 'none' and 'block'
    if (likedPostsSection.style.display = 'none') {
        likedPostsSection.style.display = 'block';
        postSection.style.display= 'none';
        commentedSection.style.display='none';
    } else {
        likedPostsSection.style.display = 'none';
    }

    this.style.backgroundColor = 'white';
});
    
document.getElementById('viewMain').addEventListener('click', function() {
    console.log("Responsive");
    // Get the element with id 'liked-posts'
    var likedPostsSection = document.getElementById('liked-posts');
    var postSection = document.getElementById('main-posts');
    var commentedSection = document.getElementById('commented-posts');

    console.log(likedPostsSection.style.display);
    // Toggle the display style between 'none' and 'block'
    if (postSection.style.display = 'none') {
        postSection.style.display = 'block';
        commentedSection.style.display = 'none';
        likedPostsSection.style.display= 'none';
    } else {
        postSection.style.display = 'none';
    }

    this.style.backgroundColor = 'white';
});

document.getElementById('viewComments').addEventListener('click', function() {
    console.log("Responsive");
    // Get the element with id 'liked-posts'
    var likedPostsSection = document.getElementById('liked-posts');
    var postSection = document.getElementById('main-posts');
    var commentedSection = document.getElementById('commented-posts');

    console.log(likedPostsSection.style.display);
    // Toggle the display style between 'none' and 'block'
    if (commentedSection.style.display = 'none') {
        commentedSection.style.display = 'block';
        likedPostsSection.style.display= 'none';
        postSection.style.display= 'none';
    } else {
        commentedSection.style.display = 'none';
    }

    this.style.backgroundColor = 'white';
});
    
    $('.text-option').on({
        mouseenter: function(){
            $(this).css('background-color', 'white');
        },
        click: function(){
            $(this).css('background-color', 'white');
        },
        mouseleave: function(){
            $(this).css('background-color', 'transparent');
        },
    });
    
    $('.text-option').click(function() {
        $('.text-option').css('background-color', 'transparent');
        $(this).css('background-color', 'white');
    });


});

function makeAPost () {
    postPopup = document.getElementById('postPopup');
    postPopup.style.display = "flex";
}

function closePostPopup () {
    postPopup = document.getElementById('postPopup');
    postPopup.style.display = "none";
}

function submitPost () {
    location.reload();
}


     

