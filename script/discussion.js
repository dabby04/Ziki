
        
        var fav = 0;
        //$(document).on('click', '#discFav', function() {
        function addFav(user, post){
          if(fav==0)
          {
            $(this).css({
              'background-color': 'Yellow'
            });
            fav =1;
            // var xmlhttp = new XMLHttpRequest();
            //   xmlhttp.onreadystatechange = function() {
            //     if (this.readyState == 4 && this.status == 200) {
            //       alert("Post successfully added to favorites")
            //     }
            //   };
            //   xmlhttp.open("POST", "./php/addFavorite.php?user="+user+"&fav="+post, true);
            //   xmlhttp.send();
          }
          else{
            $(this).css({
              'background': 'none'
            });
            fav =0;
          }
    
        }//);
    
    
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
    


function discussion(type,value)
{
  
  var content = "";
  const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if(this.readyState==4 && this.status == 200)
      {
        content = this.responseText;
        generate(content);
      }
    }
    xmlhttp.open("GET", "./ajax/discussionAjax.php?"+type+"="+value,true);
  xmlhttp.send();
}

function generate(content)
{
  var topics = content;
  console.log(topics);
  var cards = document.getElementById("cards");
  cards.innerHTML = topics;
  // .map((e) => {
  //             return `<div class="card text-center">
  //                               <div class="card-header">
  //                                 <img id="discussionPFP" class="icons" src="images/blank-profile-picture.png" alt ="disussion pfp">
  //                                 ${e.creator} 
  //                                 <div class="dropdown">
  //                                 <img id="discDropdown" class="icons" src="images/dropdown.png" alt="dropdown discussion" data-bs-toggle="dropdown" aria-expanded="false">
  //                                 <ul class="dropdown-menu">
  //                                   <li><a class="dropdown-item" href="#">Flag</a></li>
  //                                   <li><a class="dropdown-item" href="#">Save</a></li>
  //                                   <li><a class="dropdown-item" href="#">Share</a></li>
  //                                 </ul>
  //                                 </div>
  //                                 <img id="discFav" src="images/star.png" alt="favorite discussion">
                                 
  //                               </div>
  //                                 <div class="card-body">
  //                                     <h5 class="card-title">${e.title}</h5>
  //                                     <p class="card-text">${e.content}</p>
  //                                     <form action="specificDiscussion.php" method="GET">
  //                                               <button type="submit" class="btn btn-primary" name="discTopic" value=${e.id}>View Discussion</button>
  //                                                </form>
  //                                 </div>
  //                                 <div class="card-footer text-body-secondary">
  //                                     ${e.created_at}
  //                                 </div>
  //                             </div>`;
  //           }).join("");

}