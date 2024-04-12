        var fav = 0;
        function addFav(user, post){
          if(fav==0)
          {
            $('#discFav').css({
              'background-color': 'Yellow'
            });
            fav =1;
            var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  alert("Post successfully added to favorites")
                }
              };
              xmlhttp.open("POST", "./ajax/addFavorite.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("user=" + user + "&fav=" + post);
          }
          else{
            $('#discFav').css({
              'background': 'none'
            });
            fav =0;
          }
    
        }
    
      var like = 0;
      var uplikes;
      function likePost(post,likes){
       console.log(likes);
      if(like==0)
      {
        uplikes=likes+1;
        $('#like').css({
          'background-color': 'red'
        });
        like =1;
        var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  alert("Post successfully added to liked")
                  $('#countLike').innerHTML(uplikes);
                }
              };
              xmlhttp.open("POST", "./ajax/likePost.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("likes=" + uplikes + "&post=" + post);
              
      }
      else{
        uplikes-=1;
        $('#like').css({
          'background': 'none'
        });
        like =0;

        var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  alert("Post successfully added to liked")
                }
              };
              xmlhttp.open("POST", "./ajax/likePost.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("likes=" + uplikes + "&post=" + post);
      }
    }
    
    var dislike = 0;
      var downlikes;
      function dislikePost(post,dislikes){
       console.log(dislikes);
      if(dislike==0)
      {
        downlikes=dislikes+1;
        $('#dislike').css({
          'background-color': 'red'
        });
        dislike =1;
        var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  alert("Post successfully disliked")
                }
              };
              xmlhttp.open("POST", "./ajax/dislikePost.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("dislikes=" + downlikes + "&post=" + post);
              
      }
      else{
        downlikes-=1;
        $('#dislike').css({
          'background': 'none'
        });
        dislike =0;

        var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  alert("Post successfully disliked")
                }
              };
              xmlhttp.open("POST", "./ajax/dislikePost.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("dislikes=" + downlikes + "&post=" + post);
      }
    }
    
    
function flagPost(post,creator){
  var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  alert("Post flagged")
                }
              };
              xmlhttp.open("POST", "./ajax/flagPost.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("creator=" + creator + "&post=" + post);
}

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
}


