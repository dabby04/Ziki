document.addEventListener('DOMContentLoaded', function () {
    const view = document.getElementsByClassName("view")[0];
    view?.addEventListener("click",function(){
        window.location.href = "profile.php";
    });

    const logout=document.getElementsByClassName("logout")[0];
    logout.addEventListener("click",function(){
        window.location.href="php/logout.php"
    })
});