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
                  document.getElementById("countLike").innerHTML=uplikes;
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
                  document.getElementById("countLike").innerHTML=uplikes;
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
                  console.log(downlikes);
                  document.getElementById("countDislike").innerHTML=downlikes;
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
                  document.getElementById("countDislike").innerHTML=downlikes;
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

function discussion(topic)
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
xmlhttp.open("GET", "./ajax/specificDiscussionAjax.php?discTopic="+topic,true);
xmlhttp.send();
}

function generate(content)
{
var topics = content;
//console.log(topics);
var cards = document.getElementById("discomments");
cards.innerHTML = topics;
}

function addComment(creator, post)
{
    let comment = prompt("What do you have to say?")
    if((comment != null) || (comment!="") )
    {
    var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            discussion(topic);
        }
      };
      xmlhttp.open("POST", "./ajax/addComment.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("creator=" + creator + "&post=" + post+"&comment="+comment);
    }

}

var commentLike = 0;
      var commlikes;
      function likeComment(post,likes){
       console.log(likes);
      if(commentLike==0)
      {
        commlikes=likes+1;
        $('#commlike').css({
          'background-color': 'red'
        });
        commentLike =1;
        var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  alert("Post successfully added to liked")
                  document.getElementById("commcountLike").innerHTML=commlikes;
                }
              };
              xmlhttp.open("POST", "./ajax/likeComment.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("likes=" + commlikes + "&post=" + post);
              
      }
      else{
        commlikes-=1;
        $('#commlike').css({
          'background': 'none'
        });
        commentLike =0;

        var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  alert("Post successfully added to liked")
                  document.getElementById("commcountLike").innerHTML=commlikes;
                }
              };
              xmlhttp.open("POST", "./ajax/likeComment.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("likes=" + commlikes + "&post=" + post);
      }
    }
    
    var commentDislike = 0;
      var commdownlikes;
      function dislikeComment(post,dislikes){
       //console.log(dislikes);
      if(commentDislike==0)
      {
        commdownlikes=dislikes+1;
        $('#commdislike').css({
          'background-color': 'red'
        });
        commentDislike =1;
        var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  alert("Post successfully disliked")
                  console.log(commdownlikes);
                  document.getElementById("commcountDislike").innerHTML=commdownlikes;
                }
              };
              xmlhttp.open("POST", "./ajax/dislikeComment.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("dislikes=" + commdownlikes + "&post=" + post);
              
      }
      else{
        commdownlikes-=1;
        $('#commdislike').css({
          'background': 'none'
        });
        commentDislike =0;

        var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  alert("Post successfully disliked")
                  document.getElementById("commcountDislike").innerHTML=commdownlikes;
                }
              };
              xmlhttp.open("POST", "./ajax/dislikeComment.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("dislikes=" + commdownlikes + "&post=" + post);
      }
    }
