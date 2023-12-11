<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
include'../admin/includes/dataBase.php';
?>
<?php
                            if (isset($_GET['email'])) {
                                $gottenEmail = $_GET['email'];
                            } else {
                                $gottenEmail = "";
                            }
                            


                            
                            // $error_msg = "";
                            // $arr="";

                            if (isset($_GET['email'])) {
                                $email = $_GET['email'];
                                $md5 = md5($email);
                                $db->getEachByEmail($con, 'name', 'public_users', $email);
                                $personname = $db->getEachByEmail($con, 'name', 'public_users', $email);

                                $dup = mysqli_query($con, "SELECT `email` FROM `public_users` WHERE `email` = '" . $email . "'");
                                if (mysqli_num_rows($dup) < 1) {
                                    $error_msg="This email address does not exist<br /> Try to <strong><a href='register'>Register</a></strong> for a new account.";
                                } else {
                                    if (empty($email)) {
                                        $error_msg="Email is required!";
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
                                            $error_msg="A link has been sent to your email.";
                                        } else {
                                            $error_msg="Email sending failed.";
                                        }
                                    }
                                }
                                $arr[]=array('email' => $email);
                            }
                            $response ['Message'] = $error_msg;
                            $response ['forget password'] = $arr;
                            print json_encode($response);
                        ?>