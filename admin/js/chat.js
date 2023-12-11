$(document).ready(function () {

    done();
    $(".messages").animate({scrollTop: '10000px'}, 5000);


    $("#post").submit(function () {
        $.post('discussion_post.php', $('#post').serialize(), function (data) {
            $(".messages").animate({scrollTop: '10000px'}, 5000);
            $("#post")[0].reset();
            $(".send").reset();
        });
        return false;
    });
});