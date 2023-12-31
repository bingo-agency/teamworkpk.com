$(document).ready(function () {
    var options = {
        target: '#output', // target element(s) to be updated with server response 
        beforeSubmit: beforeSubmit, // pre-submit callback 
        success: afterSuccess, // post-submit callback 
        resetForm: true        // reset the form after successful submit 
    };

    $('#MyUploadForm').submit(function () {
        $(this).ajaxSubmit(options);
        // always return false to prevent standard browser submit and page navigation 
        return false;
    });




});

function update_accounthead(id) {
    var id = id;
    var account_head_name = $('#new_account_head_name').val();
    console.log(account_head_name);
    $.post("procez.php",
            {
                id: id,
                account_head_name: account_head_name
            },
            function (data, status) {
                console.log(data + status);
//                $('.returnedRef').html(data);
//                $('.js-copytextarea').text(data);
                location.reload();

            });
}

function del_account_head(id){
    var id=id;
    var action = 'delete';
    $.post("procez.php",
            {
                id: id,
                action: action
            },
            function (data, status) {
                console.log(data + status);
                $('#tr_'+id).hide('slow');

            });
    
}

function afterSuccess()
{
    $('#submit-btn').show(); //hide submit button
    $('#loading-img').hide(); //hide submit button

}

//function to check file size before uploading.
function beforeSubmit() {
    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {

        if (!$('#imageInput').val()) //check empty input filed
        {
            $("#output").html("Seriously?");
            return false
        }

        var fsize = $('#imageInput')[0].files[0].size; //get file size
        var ftype = $('#imageInput')[0].files[0].type; // get file type


        //allow only valid image file types 
        switch (ftype)
        {
            case 'image/png':
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
                break;
            default:
                $("#output").html("<b>" + ftype + "</b> Unsupported file type!");
                return false
        }

        //Allowed file size is less than 1 MB (1048576)
        if (fsize > 1048576)
        {
            $("#output").html("<b>" + bytesToSize(fsize) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
            return false
        }

        $('#submit-btn').hide(); //hide submit button
        $('#loading-img').show(); //hide submit button
        $("#output").html("");
    } else
    {
        //Output error to older browsers that do not support HTML5 File API
        $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
        return false;
    }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0)
        return '0 Bytes';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

//$(document).ready(function () {
//toggle `popup` / `inline` mode
$.fn.editable.defaults.mode = 'inline';


//make status editable

//});