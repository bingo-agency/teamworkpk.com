function callback() {
    setTimeout(function () {
//        $("#effect").removeClass("newClass");
        $(".msg").fadeOut("slow");
    }, 1500);
}


$('#send').click(function () {
    var emailFirst = $('#emailFirst').val();
    var messageFirst = $('#messageFirst').val();
    if ($('#emailFirst').val() === "") {
        $('.msg').fadeOut(0);
        $('.allRequiredemail').fadeIn('slow');
    } else {
        if ($('#messageFirst').val() === "") {
            $('.msg').fadeOut(0);
            $('.allRequiredmessage').fadeIn('slow');
        } else {
            $('.msg').fadeOut(0);
            $('#formFirst').fadeOut('slow');
            $('.sent').fadeIn('slow');
            $.ajax({
                type: "POST",
                url: "ajax/send_index.php?email=" + emailFirst + "&message=" + messageFirst,
                success: function (html) {
                }
            });
        }
    }
});

$('#sendSecond').click(function () {
    var model = $('#model').val();
    var qty = $('#qty').val();
    var condition = $('#condition').val();
    var warranty = $('#warranty').val();
    var budget = $('#budget').val();
//    var nameemailform = $('#nameemailform').val();
//    var emailemailform = $('#emailemailform').val();
    if (model === "" || qty === "" || budget === "") {
        $('.msg').fadeOut(0);
        $('.allRequired').fadeIn('slow');
    } else {
        $('.msg').fadeOut(0);
        $('#formSecond').fadeOut(0);
//                    $('.sentSecond').fadeIn('slow');

        $('#formEmail').fadeIn('slow');
        $('#sendEmailemailform').click(function () {
            var nameemailform = $('#nameemailform').val();
            var emailemailform = $('#emailemailform').val();
            if (nameemailform === "" || emailemailform === "") {
                $('.msg').fadeOut(0);
                $('.allRequired').fadeIn('slow');
            } else {
//                alert(nameemailform+' + and +  ' + emailemailform);
                $('.msg').fadeOut(0);
                $('#formEmail').fadeOut('slow');
                $('.sentSecond').fadeIn('slow');
                $.ajax({
                    type: "POST",
                    url: "ajax/send_index_form.php?name=" + nameemailform + "&email=" + emailemailform + "&model=" + model + "&qty=" + qty + "&condition=" + condition + "&warranty=" + warranty + "&budget=" + budget,
                    success: function (html) {
                    }
                });
            }
        });

    }





});