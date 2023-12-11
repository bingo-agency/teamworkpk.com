<?php
include'includes/header.php';

if (isset($_SESSION['public_user'])) {
    $id = $_SESSION['public_user']['id'];
    $db->redirect('index');
}
?>

<style>
    body{
        overflow-x: hidden;
    }
    .tw-roundedCircle{
        min-height: 300px;
        position: absolute;
        /*        background: #C04848;   fallback for old browsers 
                background: -webkit-linear-gradient(to right, #480048, #C04848);   Chrome 10-25, Safari 5.1-6 
                background: linear-gradient(to right, #480048, #C04848);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        min-width: 300px;
        /*border-radius: 50%;*/
        /*border: 5px solid #5e1863;*/
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }

</style>
<div class="tw-roundedCircle " style="z-index: 1;top:3.5%;
     opacity: 0.7;right:0;background-image: url(img/banner/banner6.png)">

</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content" style="


                     color: inherit;
                     /*                     background: #6f1c74;   fallback for old browsers 
                                          background: -webkit-linear-gradient(to right, #480048, #fff);   Chrome 10-25, Safari 5.1-6 
                                          background: linear-gradient(to right, #480048, #fff);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                     background-size: cover;">
                    <div class="row">
                        <div class="col-lg-6 hidethislogin" style="

                             min-height: 120vh;

                             z-index: 2;
                             border-radius: 10px 0px 0px 10px;



                             background: #C04848;  /* fallback for old browsers */
                             /*background: -webkit-linear-gradient(to bottom, #480048, #C04848);   Chrome 10-25, Safari 5.1-6 */
                             /*background: linear-gradient(to right, #480048, #C04848);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                             background: linear-gradient(to bottom, #480048, #0e2e506b);



                             /*background: #1ab394b3;*/  
                             /* fallback for old browsers */
                             /*background: -webkit-linear-gradient(to right, #480048, #C04848);   Chrome 10-25, Safari 5.1-6 */
                             /*background: linear-gradient(to right, #480048, #C04848);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

                             ">
                            <div class="" style='padding:10px'>

                                <center><img src="img/logoGreen.png" /></center>
                                <div class="" style='padding-top:100px;'>
                                    <h1 style="font-family: Gotham;color:#fff;font-weight: 500">Welcome to the App,<br /> TeamWork</h1>
                                    <p style="font-family: Gotham;color:#fff;font-weight: 500">Login to see in Action</p>
                                </div>
                                <div class="" style='padding-top:10px;'>
                                    <!--                                    <a href="view_all_leads" class="btn btn-lg btn-primary btn-outline">View All Leads</a>-->
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 right-mobile">
                            <div class="center-block">
                                <h1 style="
                                    font-weight: 600;padding-top: 125px;padding-bottom: 25px;font-family: Gotham;color: #6f1c74;">Recover<br />Password</h1>
                            </div>
                            <?php
                            if (isset($_GET['email'])) {
                                $gottenEmail = $_GET['email'];
                            } else {
                                $gottenEmail = "";
                            }
                            ?>
                            <?php
                            $error_msg = "";


                            if (isset($_POST['Submit'])) {
                                $email = $_POST['email'];
                                $md5 = md5($email);
                                $db->getEachByEmail($con, 'name', 'public_users', $email);
                                $personname = $db->getEachByEmail($con, 'name', 'public_users', $email);

                                $dup = mysqli_query($con, "SELECT `email` FROM `public_users` WHERE `email` = '" . $email . "'");
                                if (mysqli_num_rows($dup) < 1) {
                                    $db->error("This email address does not exist<br /> Try to <strong><a href='register'>Register</a></strong> for a new account.");
                                } else {
                                    if (empty($email)) {
                                        $db->error("Email is required!");
                                    } else {

                                        $to = $email;
                                        $from = 'info@teamworkpk.com';
                                        $fromName = 'Team Work';

                                        $subject = "Password Recovery";

                                        function emailContent($personname, $email, $md5) {
                                            return '<h1>Recover Your Password</h1> 
                                        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                                            <tr> 
                                                <th>Name:</th><td>' . $personname . '</td> 
                                            </tr> 
                                            <tr style="background-color: #e0e0e0;"> 
                                                <th>Email:</th><td>' . $email . '</td> 
                                            </tr> 
                                            <tr> 
                                                <th>Recover Link:</th><td><a href="http://teamworkpk.com/generate_new_password?id=' . $md5 . ' ">Recover Password</a></td> 
                                            </tr> 
                                        </table> ';
                                        }

                                        $htmlContent = emailContent($personname, $email, $md5);




                                        $headers = "MIME-Version: 1.0" . "\r\n";
                                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


                                        $headers .= 'From: ' . $fromName . '<' . $from . '>' . "\r\n";
                                        $headers .= 'Cc: hassan@bingo-agency.com' . "\r\n";

                                        if (mail($to, $subject, $htmlContent, $headers)) {
                                            $updateForgotten = mysqli_query($con, "UPDATE `public_users` SET `forgotten` = '" . $md5 . "' WHERE `email` = '" . $email . "'");
                                            $db->success("A link has been sent to your email.");
                                        } else {
                                            $db->error("Email sending failed.");
                                        }

//                                        mail('hassan@bingo-agency.com', 'Subject Line Here', 'Body of Message Here', 'From: info@teamworkpk.com');
//                                        require 'includes/class/class.phpmailer.php';
//                                        $mail = new PHPMailer(true);
//                                        $mail->SMTPKeepAlive = true;
//                                        $mail->Mailer = 'smtp';
//                                        $mail->SMTPOptions = array(
//                                            'ssl' => array(
//                                                'verify_peer' => false,
//                                                'verify_peer_name' => false,
//                                                'allow_self_signed' => true
//                                            )
//                                        );
//                                        $div = '<div><center><img src="https://teamworkpk.com/img/teamWrk.png" width:200></center><p>Hello, ' . $db->getEachByEmail($con, 'name', 'public_users', $email) . '</p><br /><p><a href="https://teamworkpk.com/generate_new_password?id=' . $md5 . '">Generate a new password</a></p></div>';
//                                        $mail->IsSMTP();        //Sets Mailer to send message using SMTP
//                                        $mail->Host = 'smtp.gmail.com';
//                                        $mail->Port = '587';
//                                        $mail->SMTPSecure = 'tls';
//                                        $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
//                                        $mail->Username = 'hassanrbaiga@gmail.com';     //Sets SMTP username
//                                        $mail->Password = 'wantsomeone';     //Sets SMTP password
//                                        $mail->From = 'info@teamworkpk.com';   //Sets the From email address for the message
//                                        $mail->FromName = 'teamworkpk.com';   //Sets the From name of the message
////                                        $mail->AddAddress($email, $personname);  //Adds a "To" address
//                                        $mail->AddAddress('connect@bingo-agency.com', 'Hassan');  //Adds a "To" address
////                                        $mail->AddAddress('info@teamworkpk.com', 'Asif Khan');  //Adds a "To" address
//                                        $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
//                                        $mail->IsHTML(true);       //Sets message type to HTML				
////                                        // $mail->AddAttachment($file_name);         //Adds an attachment from a path on the filesystem
//                                        $mail->Subject = 'Team Work';   //Sets the Subject of the message
//                                        $mail->Body = $div;    //An HTML or plain text message body
//                                        if ($mail->Send()) {        //Send an Email. Return true on success or false on error
//                                            $db->success("A link has been sent to your email.");
//                                        } else {
//                                            echo $message = 'Sorry! Try Again';
//                                        }
                                    }
                                }
                            }
                            ?>
                            <form action="#" method="POST" class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Email</label>
                                    <div class="col-sm-6"><input type="email" class="form-control" name="email" value="<?php
                                        if (isset($_POST['email'])) {
                                            echo $_POST['email'];
                                        } else {
                                            echo $gottenEmail;
                                        }
                                        ?>" placeholder="Email"></div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-6 col-sm-offset-2">
                                        <input name="Submit" class="btn btn-primary col-lg-12" type="submit" value="Recover Password" />
                                    </div>
                                </div>
                            </form>
                            <hr />
                            New user? Click to <a href="register">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw-roundedCircle bottom-circle" style="left: -10%;bottom:15%;min-height:250px;width:300px;background-image: url(img/banner/banner4.png)"></div>
    </div>
</div>
<?php include'includes/footer.php'; ?>