function openDiscussion(e)
{
    

    //let discTitle = e;
    //using the name of the discussion, generate related content
    const displayComments = document.getElementById("discomments");
    const comments = ["Comment 1", "Comment 2", "Comment 3", "Comment 4"];
    displayComments.innerHTML= comments.map((e)=>{
        return `<div id="individualComment">
            <img src="images/blank-profile-picture.png" alt="blank pfp" id="commentPFP">
            ${e}
            </div><br/>`;
    }).join("");
}