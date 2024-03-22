
function openDiscussion(e)
{
    //using the name of the discussion, generate related content
    const displayComments = document.getElementById(e);
    const comments = ["Comment 1", "Comment 2", "Comment 3", "Comment 4"];
    displayComments.innerHTML= comments.map((e)=>{
        return `<p>${e}</p>`;
    }).join("");

}