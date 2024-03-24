
    document.addEventListener('DOMContentLoaded', function () {
        const logo = document.querySelector('.logo');
        const main = document.querySelector('.main');

        logo.addEventListener('mouseenter', function () {
            main.style.marginLeft = '300px';
        });

        logo.addEventListener('mouseleave', function () {
            main.style.marginLeft = '100px';
        });
    });

