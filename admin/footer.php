<div class="footer">
    <div class="pull-right">
        10 of <strong>250</strong> Requests.
    </div>
    <div>
        <strong>Copyright</strong> <u>Project100</u> &copy; 2003-2019
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


<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/jquery.timeago.js"></script>
<script src="js/jquery.numeric.js"></script>
<!-- Steps -->
<script src="js/plugins/steps/jquery.steps.min.js"></script>
<!-- Start of  Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/2373049.js"></script>
<!-- End of  Embed Code -->
<script>
    $(document).ready(function () {
        setTimeout(function () {
            window.location.href = 'lock?id=<?= $id ?>';
        }, 500000);

        jQuery("time.timeago").timeago();

    });
    $(document).ready(function () {
        $(".numeric").numeric();
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
<script>

    //my custom wizard.
    $(document).ready(function () {
        var category;
        var projectname;
        var subject;
        var message;
        $("#newRequest").click(function () {
            $('.step1hw').fadeOut('fast', function () {
                $("#stepradio1").hide('fast', function () {
                    $("#stepradio_1").show('fast');
                });
                $('.step2hw').fadeIn('fast');
            });
        });
//        $(".category").click(function () {
//            alert($(".category").attr('id'));
//            $('.step2hw').fadeOut('fast', function () {
//                $("#stepradio2").hide('fast', function () {
//                    $("#stepradio_2").show('fast');
//                });
//                $('.step3hw').fadeIn('fast');
//            });
//        });
        $("#flyerdesign").click(function () {
            category = "Flyer Design";
            $('.step2hw').fadeOut('fast', function () {
                $("#stepradio2").hide('fast', function () {
                    $("#stepradio_2").show('fast');
                });
                $('.step3hw').fadeIn('fast', function () {
                    $("#categoryShow").val(category);
                    console.log(category);
                });
            });
        });
        $("#businesscards").click(function () {
            category = "Business Cards";
            $('.step2hw').fadeOut('fast', function () {
                $("#stepradio2").hide('fast', function () {
                    $("#stepradio_2").show('fast');
                });
                $('.step3hw').fadeIn('fast', function () {
                    $("#categoryShow").val(category);
                    console.log(category);
                });
            });
        });
//        $("#businesscards").click(function () {
//            category = "Business Cards";
//            $('.step2hw').fadeOut('fast', function () {
//                $("#stepradio2").hide('fast', function () {
//                    $("#stepradio_2").show('fast');
//                });
//                $('.step3hw').fadeIn('fast', function () {
//                    $("#categoryShow").val(category);
//                    console.log(category);
//                });
//            });
//        });
        $("#flyers").click(function () {
            category = "Flyers";
            $('.step2hw').fadeOut('fast', function () {
                $("#stepradio2").hide('fast', function () {
                    $("#stepradio_2").show('fast');
                });
                $('.step3hw').fadeIn('fast', function () {
                    $("#categoryShow").val(category);
                    console.log(category);
                });
            });
        });
//        $("#businesscards").click(function () {
//            category = "Business Cards";
//            $('.step2hw').fadeOut('fast', function () {
//                $("#stepradio2").hide('fast', function () {
//                    $("#stepradio_2").show('fast');
//                });
//                $('.step3hw').fadeIn('fast', function () {
//                    $("#categoryShow").val(category);
//                    console.log(category);
//                });
//            });
//        });
        $("#orderprints").click(function () {
            category = "Order Prints";
            $('.step2hw').fadeOut('fast', function () {
                $("#stepradio2").hide('fast', function () {
                    $("#stepradio_2").show('fast');
                });
                $('.step3hw').fadeIn('fast', function () {
                    $("#categoryShow").val(category);
                    console.log(category);
                });
            });
        });
        $("#socialmedia").click(function () {
            category = "Social Media";
            $('.step2hw').fadeOut('fast', function () {
                $("#stepradio2").hide('fast', function () {
                    $("#stepradio_2").show('fast');
                });
                $('.step3hw').fadeIn('fast', function () {
                    $("#categoryShow").val(category);
                    console.log(category);
                });
            });
        });
        $("#advertising").click(function () {
            category = "Advertising";
            $('.step2hw').fadeOut('fast', function () {
                $("#stepradio2").hide('fast', function () {
                    $("#stepradio_2").show('fast');
                });
                $('.step3hw').fadeIn('fast', function () {
                    $("#categoryShow").val(category);
                    console.log(category);
                });
            });
        });
        $("#copywriting").click(function () {
            category = "Copy Writing";
            $('.step2hw').fadeOut('fast', function () {
                $("#stepradio2").hide('fast', function () {
                    $("#stepradio_2").show('fast');
                });
                $('.step3hw').fadeIn('fast', function () {
                    $("#categoryShow").val(category);
                    console.log(category);
                });
            });
        });
        $("#makechanges").click(function () {
            category = "Make Changes";
            $('.step2hw').fadeOut('fast', function () {
                $("#stepradio2").hide('fast', function () {
                    $("#stepradio_2").show('fast');
                });
                $('.step3hw').fadeIn('fast', function () {
                    $("#categoryShow").val(category);
                    console.log(category);
                });
            });
        });
        $("#fixissues").click(function () {
            category = "Fix Issues";
            $('.step2hw').fadeOut('fast', function () {
                $("#stepradio2").hide('fast', function () {
                    $("#stepradio_2").show('fast');
                });
                $('.step3hw').fadeIn('fast', function () {
                    $("#categoryShow").val(category);
                    console.log(category);
                });
            });
        });
        $("#hosting").click(function () {
            category = "Hosting";
            $('.step2hw').fadeOut('fast', function () {
                $("#stepradio2").hide('fast', function () {
                    $("#stepradio_2").show('fast');
                });
                $('.step3hw').fadeIn('fast', function () {
                    $("#categoryShow").val(category);
                    console.log(category);
                });
            });
        });
        $("#sendButtonRequest").click(function (e) {
            projectname = $("#projectname").val();
            message = $("#message").val();
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
            if (projectname !== "" && subject !== "" && message !== "") {
                $('.step3hw').fadeOut('fast', function () {
                    $("#stepradio3").hide('fast', function () {
                        $("#stepradio_3").show('fast');
                    });
                    $('.step4hw').fadeIn('fast', function () {
                        $("#stepradio4").hide('fast', function () {
                            $("#stepradio_4").show('slow', function () {
                                var fd = new FormData();
                                var files = $('#file')[0].files[0];
                                fd.append('file', files);
                                fd.append('projectname', projectname);
                                fd.append('category', category);
                                fd.append('message', message);
                                fd.append('udid', udid);
                                $.ajax({
                                    enctype: 'multipart/form-data',
                                    processData: false, // tell jQuery not to process the data
                                    contentType: false,
                                    type: 'post',
                                    data: fd,
                                    url: 'add_data.php',
                                    success: function (data) {
                                        console.log(data);
//                                        alert(data);
                                        $('.loadinggifpart').fadeOut('slow', function () {
                                            $('.successalertend').fadeIn('slow', function () {
                                                console.log(projectname);
                                                console.log(subject);
                                                console.log(message);
                                                console.log(myFile);
                                                console.log(udid);
                                            });
                                        });
                                    }
                                });

                            });
                        });
                    });
                });
            }

            e.preventDefault();
        });
        $("#allRequests").click(function () {
            $('.step1hw').fadeOut('fast', function () {
                $("#stepradio1").hide('fast', function () {
                    $("#stepradio_1").show('fast');
                });
                $('.step1ar').fadeIn('fast');
            });
        });
        $("#heroplan").click(function () {
            $('.step1hw').fadeOut('fast', function () {
                $("#stepradio1").hide('fast', function () {
                    $("#stepradio_1").show('fast');
                });
                $('.step1hp').fadeIn('fast');
            });
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
    });

</script>


</body>
</html>
