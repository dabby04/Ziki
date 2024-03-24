document.addEventListener('DOMContentLoaded', function () {
    const view = document.getElementsByClassName("view")[0];
    view.addEventListener("click",function(){
        window.location.href = "profile.php";
    });

    const edit=document.getElementsByClassName("edit")[0];
    edit.addEventListener("click",function(){
        window.location.href="editprofile.html"
    })
});