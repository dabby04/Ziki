window.addEventListener('scroll', function () {
    var trending = document.getElementsByClassName('box')[0];
    var trendingOffset = trending.offsetTop;

    if (window.scrollY > trendingOffset) {
        trending.classList.add('fixed');
    } else {
        trending.classList.remove('fixed');
    }
});

$(document).ready( function(){ 


$("#user_button").on({
    mouseenter: function () {
        console.log("responsive");
      $(".profile-popup").css("display", "block");
    }, mouseleave: function () {
        console.log("responsive2");
        $(".profile-popup").css("display", "none");
       
      }
});

});


document.addEventListener('DOMContentLoaded', function () {
    // $('.picks.active').addClass('select');
    // Add click event listeners to the navigation links
    document.getElementById('home').addEventListener('click', function (event) {
        event.preventDefault();
        switchToPage('home');
      
    });

    document.getElementById('favourites').addEventListener('click', function (event) {
        event.preventDefault();
        switchToPage('favourites');
    });

    document.getElementById('top_comments').addEventListener('click', function (event) {
        event.preventDefault();
        switchToPage('top_comments');
    });
    switchToPage('home');
});

function switchToPage(pageId){
    // colour link white using a PHP script

    // Remove the 'active' class from all navigation items
    document.querySelectorAll('.picks').forEach(function (item) {
        item.classList.remove('active');
    });

    // Add the 'active' class to the selected navigation item
    document.getElementById(pageId).classList.add('active');

    // Update content based on the selected page
    var contentContainer = document.getElementById('contentBox');
    contentContainer.style.overflow="hidden";
    switch (pageId) {
        case 'home':
            //iframe is good for showing html pages with an html page
            contentContainer.innerHTML='<iframe src="hot_tea.html" style="width:100%; height:50vh" scrolling="no"></iframe>';
            break;
        case 'favourites':
            contentContainer.innerHTML='<iframe src="favourites.html" style="width:100%; height:50vh" scrolling="no"></iframe>';
            break;
        case 'top_comments':
            contentContainer.innerHTML='<iframe src="top-comments.html" style="width:100%; height:50vh" scrolling="no"></iframe>';
            break;
        default:
            break;
    }



}





