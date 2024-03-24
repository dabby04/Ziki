window.onload= function(){ 
    const showCards = document.getElementById("cards");
    console.log("here");
    const discussions = ["Discussion 1", "Discussion 2", "Discussion 3", "Discussion 4"];
    showCards.innerHTML = discussions.map((e) => {
        return `<div class="card text-center">
                    <div class="card-header">
                    <img id="discussionPFP" class="icons" src="images/blank-profile-picture.png" alt ="disussion pfp">
                    Username 
                    <div class="dropdown">
                    <img id="discDropdown" class="icons" src="images/dropdown.png" alt="dropdown discussion" data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Flag</a></li>
                        <li><a class="dropdown-item" href="#">Save</a></li>
                        <li><a class="dropdown-item" href="#">Share</a></li>
                    </ul>
                    </div>
                    <img id="discFav" src="images/star.png" alt="favorite discussion">
                    
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">${e}</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom" onclick="openDiscussion('${e})">Comments</button>
                        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasBottomLabel">${e}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body small" id="discomments">
                                ...
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-body-secondary">
                        2 days ago
                    </div>
                </div>`;
    }).join("");
}

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