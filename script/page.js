
$('#logout').click(function() {
    $.post('session.php', {username: 'yourUsername'}, function(data) {
        // This is the response from your PHP page
        console.log(data);
    });
});
