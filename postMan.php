<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziki Admin</title>
    <style>
        <?php include "css/reset.css"; ?>
    </style>
    <style>
        <?php include "css/admin.css"; ?>
    </style>
</head>
<body>
    <div class="wrapper">
        <?php include "sidebarAdmin.php" ?>
    </div>
    <div class="main">
        <div class="box">
            <h3>Reported Posts</h3>
            <div class="reported">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchReportedPosts() {
            $.ajax({
                url: 'ajax/postmanAjax.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    updateReportedPosts(data);
                },
                error: function (xhr, status, error) {
                    console.error('Failed to fetch reported posts: ' + error);
                }
            });
        }

        function updateReportedPosts(posts) {
            const displayReported = $('.reported');
            displayReported.empty();
            $.each(posts, function (index, post) {
                var fieldset = $('<fieldset></fieldset>');
                var legend = $('<legend></legend>').text('@' + post.username);
                var paragraph = $('<p></p>').text(post.title);
                var button = $('<button class="remove" onclick="removePost(' + post.id+","+ post.userId + ')">Remove</button>');
                fieldset.append(legend, paragraph, button);
                displayReported.append(fieldset);
            });
        }

        function removePost(postId,userId) {
            console.log(postId);
            console.log(userId);
            $.ajax({
                url: 'ajax/postmanAjax.php',
                type: 'POST',
                data: { postId: postId,userId:userId },
                success: function (response) {
                    fetchReportedPosts(); // Refresh the list of reported posts
                },
                error: function (xhr, status, error) {
                    console.error('Failed to remove post: ' + error);
                }
            });
        }

        $(document).ready(function () {
            // Fetch reported posts initially
            fetchReportedPosts();

            // Fetch reported posts every 60 seconds
            setInterval(fetchReportedPosts, 60000);
        });
    </script>
</body>
</html>
