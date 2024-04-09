function populate(type,value){
    //window.onload = function () {
        var xhttp = new XMLHttpRequest();
        var topics;
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          //console.log(type + value)
                topics = JSON.parse(xhttp.responseText);
              console.log(topics);
            }
        };
          // Specify the HTTP method (GET or POST) and the PHP file to call
        xhttp.open("GET", "ajax/discussionAjax.php?"+type+"="+value,true);
          console.log("here");
          // Send the request
        xhttp.send();
        console.log("done");
  
          console.log(topics+"yeahhh");
          //using the name of the discussion, generate related content
          const displayComments = document.getElementById("cards");
          displayComments.innerHTML = topics.map((e) => {
            return `<div class="card text-center">
                              <div class="card-header">
                                <img id="discussionPFP" class="icons" src="images/blank-profile-picture.png" alt ="disussion pfp">
                                ${e.creator} 
                                <div class="dropdown">
                                <img id="discDropdown" class="icons" src="images/dropdown.png" alt="dropdown discussion" data-bs-toggle="dropdown" aria-expanded="false">
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">Flag</a></li>
                                  <li><a class="dropdown-item" href="#">Save</a></li>
                                  <li><a class="dropdown-item" href="#">Share</a></li>
                                </ul>
                                </div>
                                <img class="discFav" src="images/star.png" alt="favorite discussion" onClick={addFavorite}>
                               
                              </div>
                                <div class="card-body">
                                    <h5 class="card-title">${e.title}</h5>
                                    <p class="card-text">${e.content}</p>
                                    <form action="specificDiscussion.php" method="GET">
                                              <button type="submit" class="btn btn-primary" name="discTopic" value=${e.id}>View Discussion</button>
                                               </form>
                                </div>
                                <div class="card-footer text-body-secondary">
                                    ${e.created_at}
    
                                    <div class= "footIcons">
                                      ${e.likes}
                                      <img src="images/like-icon-on-transparent-background-free-png.png" alt= "like" id="dislike">
                                      </div>
                                      <div class= "footicons">
                                       ${e.dislikes}
                                      <img src="images/like-icon-on-transparent-background-free-png.png" alt= "like" id="like">
                                    </div>
                                </div>
                            </div>`;
          }).join("");
        
        var fav = 0;
        $(document).on('click', '.discFav', function() {
          
          if(fav==0)
          {
            $(this).css({
              'background-color': 'Yellow'
            });
            fav =1;
          }
          else{
            $(this).css({
              'background': 'none'
            });
            fav =0;
          }
    
        });
    
    
        var like = 0;
        $(document).on('click', '#like', function() {
      if(like==0)
      {
        $(this).css({
          'background-color': 'red'
        });
        like =1;
      }
      else{
        $(this).css({
          'background': 'none'
        });
        like =0;
      }
    });
    
    var dislike = 0;
    $(document).on('click', '#dislike', function() {
      // Add your code here for the #dislike click event
      if(dislike==0)
      {
        $(this).css({
          'background-color': 'red'
        });
        dislike =1;
      }
      else{
        $(this).css({
          'background': 'none'
        });
        dislike =0;
      }
    });
    
    
        
    }
        function addFavorite(id) {
          // Create an XMLHttpRequest object
          var xhttp = new XMLHttpRequest();
  
          // Specify the HTTP method (GET or POST) and the PHP file to call
          xhttp.open("GET", "ajax/discussionAjax.php?function=addFavorites("+id+")", true);
  
          // Send the request
          xhttp.send();
        //}
      }

      function generate(topics)
      {
        const displayComments = document.getElementById("cards");
        
        displayComments.innerHTML = topics.map((e) => {
          return `<div class="card text-center">
                            <div class="card-header">
                              <img id="discussionPFP" class="icons" src="images/blank-profile-picture.png" alt ="disussion pfp">
                              ${e.creator} 
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
                                  <h5 class="card-title">${e.title}</h5>
                                  <p class="card-text">${e.content}</p>
                                  <form action="specificDiscussion.php" method="GET">
                                            <button type="submit" class="btn btn-primary" name="discTopic" value=${e.id}>View Discussion</button>
                                             </form>
                              </div>
                              <div class="card-footer text-body-secondary">
                                  ${e.created_at}
                              </div>
                          </div>`;
        }).join("");
      }