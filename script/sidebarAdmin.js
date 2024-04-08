document.addEventListener('DOMContentLoaded', function() {
    const currentUrl = window.location.href;

    const navLinks = document.querySelectorAll('.navlinks');

    navLinks.forEach(function(navLink) {
        // Check if the href matches the current URL
        if (navLink.href === currentUrl) {
            navLink.classList.add('active');
        }
    });
});
