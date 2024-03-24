 <?php
    
    $topic = $_POST['discTopic'];
        
    $phpArray = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
    $jsArray = json_encode($phpArray);
        
    include 'pageheader.php';
?>

    <!--   -->
    <div id="discomments">
        <?php echo `<h2>$topic</h2>`?>
         <!-- <Button onclick=openDiscussion(discomments)>  -->
    </div>
    <script>
        var comments = <?php echo $jsArray; ?>;
        window.onload= function()
            {
                var topic = "<?php echo $topic; ?>";
                console.log(topic)
                //let discTitle = e;
                //using the name of the discussion, generate related content
                const displayComments = document.getElementById("discomments");
                //const comments = ["Comment 1", "Comment 2", "Comment 3", "Comment 4"];
                displayComments.innerHTML= comments.map((e)=>{
                    return `<div id="individualComment">
                      <img src="images/blank-profile-picture.png" alt="blank pfp" id="commentPFP">
                      ${e}
                      </div><br/>`;
                }).join("");
            }
    </script>
