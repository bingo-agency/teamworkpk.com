<div class="footer">
    <div class="pull-right">
        Database of <strong><?= $db->count_rows($con, 'internal_leads'); ?></strong> Total Leads.
    </div>
    <div>
        <strong>Copyright</strong> <a href="../">TeamWork</a> &copy; 2007-20<?= date('y') ?> - Built by <a href="https://bingo-agency.com/">Bingo-Agency</a>
    </div>
</div>
</div>
</div>
<!-- Mainly scripts -->

<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Data Tables -->
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="js/plugins/dataTables/dataTables.responsive.js"></script>
<script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>
<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>
<!--id card masking-->
<script src="js/plugins/jqueryMask/jquery.mask.min.js"></script>




<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/jquery.timeago.js"></script>
<script src="js/jquery.numeric.js"></script>
<!-- Steps -->
<script src="js/plugins/steps/jquery.steps.min.js"></script>

<script>

    $(document).ready(function () {
        setTimeout(function () {
            window.location.href = 'lock?id=<?= $id ?>';
        }, 500000);

        jQuery("time.timeago").timeago();


        $(".numeric").numeric();
        $("#wizard").steps();
//         $('.cnic').mask('00000-0000000-0');
    });
</script>
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function () {
        $('.dataTables-example').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            }
        });

        /* Init DataTables */
        var oTable = $('#editable').dataTable();

        /* Apply the jEditable handlers to the table */
        oTable.$('td').editable('../example_ajax.php', {
            "callback": function (sValue, y) {
                var aPos = oTable.fnGetPosition(this);
                oTable.fnUpdate(sValue, aPos[0], aPos[1]);
            },
            "submitdata": function (value, settings) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition(this)[2]
                };
            },
            "width": "90%",
            "height": "100%"
        });


    });

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData([
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row"]);

    }
</script>
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
<script type="text/javascript" src="js/editable.js"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script type="text/javascript" src="js/hassan.js"></script>
<!-- Tinycon -->
<script src="js/plugins/tinycon/tinycon.min.js"></script>
<!--<script type="text/javascript" src="js/chat.js"></script>-->
<!-- DROPZONE -->
<!-- BS custom file -->
<script src="js/plugins/bs-custom-file/bs-custom-file-input.min.js"></script>
<script src="js/plugins/dropzone/dropzone.js"></script>
<script>

    //my custom wizard.
    $(document).ready(function () {
        var category;
        var projectname;
        var category;
        var message;
        var clientId;
        $("#sendButtonRequest").click(function (e) {
            projectname = $("#projectname").val();
            message = $("#message").val();
            category = $("#category").val();
            clientId = $("#clientId").val();
            var uploaded_file = $('#uploaded_file').prop('files');
            var udid = $(".loadinggifpart").attr('id');
            if (projectname == "") {
                $('.errors').hide();
                $('.error-projectname').fadeIn('slow');
            }
            if (message == "") {
                $('.errors').hide();
                $('.error-message').fadeIn('slow');
            }
            if (projectname !== "" && category !== "" && message !== "") {
                console.log("The category comes as");
                console.log(category);
                $('.step3hw').fadeOut('fast', function () {
                    $('.step4hw').fadeIn('fast', function () {
                        console.log('looks cool so far!');
                        var fd = new FormData();
                        var files = $('#file')[0].files[0];
                        fd.append('file', files);
                        fd.append('projectname', projectname);
                        fd.append('category', category);
                        fd.append('message', message);
                        fd.append('udid', udid);
                        fd.append('clientId', clientId);
                        $.ajax({
                            enctype: 'multipart/form-data',
                            processData: false, // tell jQuery not to process the data
                            contentType: false,
                            type: 'post',
                            data: fd,
                            url: 'add_data.php',
                            success: function (data) {
                                console.log(data);
                                $('.loadinggifpart').fadeOut('fast', function () {
                                    $('.successalertend').fadeIn('fast', function () {
                                        console.log(projectname);
                                        console.log(category);
                                        console.log(message);
                                        console.log(files);
                                        console.log(udid);
                                    });
                                });
                            }
                        });
                    });
                });
            }

            e.preventDefault();
        });


        // TW Custom Wizard

        var type = '';
        var city = '';
        var location = '';
        var title = '';
        var description = '';
        var price = '';
        var land_area = '';


        $('.step1btn').click(function (e) {

            type = $(this).attr('id');
            console.log(type);
            $('.step1_tw').fadeOut('fast', function () {
                $('.step2_tw').fadeIn('fast');
            });
            e.preventDefault();
        });
        $('.step2btn').click(function (e) {
            city = $("#city").val();
            console.log(city);
            $('.step2_tw').fadeOut('fast', function () {
                $('.step3_tw').fadeIn('fast');
            });
            e.preventDefault();

        });
        $('.step3btn').click(function (e) {

            location = $('#location_input').val();
            console.log(location);
            $('.step3_tw').fadeOut('fast', function () {
                $('.one_step').fadeOut('fast', function () {
                    $('.second_step1_tw').fadeIn('fast', function () {
                        $('.onedone').fadeIn('slow');
                    });
                });
            });
            e.preventDefault();
        });

        $('.two_step_btn').click(function (e) {


            title = $('#property_title').val();
            description = $('#property_description').val();
            price = $('#price').val();
            land_area = $('#land_area').val();

            console.log(title);
            console.log(description);
            console.log(price);
            console.log(land_area);


            $('.second_step1_tw').fadeOut('fast', function () {
                $('.third_step1_tw').fadeIn('fast', function () {
                    $('.twodone').fadeIn('slow');
                });
            });

            e.preventDefault();
        });


    });
</script>
<script>
    $(document).ready(function () {
        $('.contact-box').each(function () {
            animationHover(this, 'pulse');
        });

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        Dropzone.options.dropzoneForm = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
        };

    });

</script>


</body>
</html>
