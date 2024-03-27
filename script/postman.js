window.onload = function () {
    const displayReported = document.getElementById("reported");
    //const comments = ["Discussion 1", "Discussion 2", "Discussion 3", "Discussion 4"];
    //displayComments.innerHTML= comments.map((e)=>{
    displayReported.innerHTML = topics.map((e) => {
      return `
      <fieldset>
      <legend>@${e.username}</legend>
      <p>${e.title}</p>
      <button class="remove">Remove</button>
  </fieldset>
                      </div>`;
    }).join("");
  }