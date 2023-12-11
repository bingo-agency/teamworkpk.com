<?php
ob_start();
include 'includes/dataBase.php';
session_start();

if (isset($_SESSION['user'])) {
    $db->redirect('dashboard');
}
?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Register - Clients - KonnectInfoTech</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/intlTelInput.css">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <style>
            /* HIDE RADIO */
            .hiddenradio [type=radio] { 
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }
            .hiddenradio [type=radio] + div {
                cursor: pointer;
            }
            .hiddenradio [type=radio]:checked + div {
                outline: 2px solid #336699;
            }
        </style>

    </head>

    <?php
    if (isset($_GET['email'])) {
        $gottenEmail = $_GET['email'];
    }
    ?>

    <body class="gray-bg"style="background-color: #e6f1f8;">

        <div class="middle-box text-center    animated fadeInDown" >
            <div style="margin-top:50px;">
                <div>

                    <span class="logo-name">
                        <center>    <img src="images/kitLogo.png" class="img-responsive"/></center>
                    </span>

                </div>
                <h3>Get Access to Our Team!</h3>
                <!--<p>Create account to see it in action.</p>-->
                <?php
                if (isset($_POST['submit'])) {

                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];
//                    $company_name = $_POST['company_name'];
                    $contact_name = $_POST['name'];
//                    $website = $_POST['website'];
//                    $country = $_POST['country'];
                    $telephone = $_POST['phone'];
                    $role = 'client';
                    $image = 'images/avatardefault.png';

                    $db->check_email($con, $email);


                    $dup = mysqli_query($con, "SELECT `email` FROM `users` WHERE `email` = '" . $email . "'");
                    if (mysqli_num_rows($dup) > 0) {
                        $db->error("This email address already exists, Try to <a href='login'>Login</a> to your account.");
                    } else {
                        if (empty($email) || empty($password) || empty($confirm_password) || empty($contact_name) || empty($telephone)) {
                            $db->error("All fields are required!");
                        } elseif (strlen($password) < 5) {
                            $db->error("Your password should be at least 6 characters long.");
                        } elseif (mysqli_real_escape_string($con, $password) != mysqli_real_escape_string($con, $confirm_password)) {
                            $db->error("Your passwords do not match.");
                        } else {
                            $query = mysqli_query($con, "INSERT INTO `users` SET `email` = '" . $email . "', `password` = '" . $password . "', `contact_name` = '" . $contact_name . "',  `telephone` = '" . $telephone . "', `role` = '" . $role . "', `image` = '" . $image . "'");
                            if (!$query) {
//                                echo "INSERT INTO `users` SET `email` = '" . $email . "', `password` = '" . $password . "', `contact_name` = '" . $contact_name . "', `telephone` = '" . $telephone . "', `role` = '" . $role . "', `image` = '" . $image . "'";
                                $db->error("Your request can't be completed at the moment, please contact the admin support.");
                            } else {
                                $db->redirect('login?email=' . $email);
                            }
                        }
                    }
                }
                ?>
                <form class="m-t" role="form" action="#" method="POST">
                    <!--                    <div class="hiddenradio">
                                            <label>
                                                <input type="radio" name="test" value="small" checked>
                                                <div style="height:150px;width:150px;background-color: #336699;color:#fff;position:relative"><p style="margin: 0;position: absolute;top: 50%;left: 15%;-ms-transform: translateY(-50%);transform: translateY(-50%);">New Client</p></div>
                                                                                                                                                                          <img src="http://placehold.it/150x150/336699/fff&text=Not a Client">
                                            </label>
                    
                                            <label>
                                                <input type="radio" name="test" value="big">
                                                <div style="height:150px;width:150px;background-color: #2c3e50;color:#fff;position:relative">
                                                    <p style="margin: 0;position: absolute;top: 50%;left: 15%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Existing Client</p></div>
                                                                                 <img src="http://placehold.it/150x150/2c3e50/fff&text=Already a Client">
                                            </label>
                                        </div>-->
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Complete Name" required="" name="name" value="<?php
                        if (isset($_POST['name'])) {
                            echo $_POST['name'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" required="" name="email" value="<?php
                        if (!empty($gottenEmail)) {
                            echo $gottenEmail;
                        } else if (isset($_POST['email'])) {
                            echo $_POST['email'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" required="" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" required="" name="confirm_password">
                    </div>
                    <hr />
                    <!--                    <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Company Name" required="" name="company_name" value="<?php
                    if (isset($_POST['company_name'])) {
                        echo $_POST['company_name'];
                    }
                    ?>">
                                        </div>-->
                    <!--                    <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Website" required="" name="website" value="<?php
                    if (isset($_POST['company_name'])) {
                        echo $_POST['company_name'];
                    } else {
                        echo 'http://';
                    }
                    ?>">
                                        </div>-->
                    <!--                    
                                        <div class="form-group">
                                            <select class="form-control m-b" name="country">
                    <?php if (isset($_POST['country'])) { ?>
                                                            <option value="<?= $_POST['country'] ?>"><?= $_POST['country'] ?></option>        
                    <?php }
                    ?>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Aland Islands">Aland Islands</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antarctica">Antarctica</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Bouvet Island">Bouvet Island</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote d'ivoire (Ivory Coast)">Cote d'ivoire (Ivory Coast)</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Curacao">Curacao</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Territories">French Southern Territories</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadaloupe">Guadaloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guernsey">Guernsey</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jersey">Jersey</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Kosovo">Kosovo</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Laos">Laos</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macao">Macao</option>
                                                <option value="Macedonia">Macedonia</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesia">Micronesia</option>
                                                <option value="Moldava">Moldava</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar (Burma)">Myanmar (Burma)</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="North Korea">North Korea</option>
                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestine">Palestine</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Phillipines">Phillipines</option>
                                                <option value="Pitcairn">Pitcairn</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Reunion">Reunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Saint Barthelemy">Saint Barthelemy</option>
                                                <option value="Saint Helena">Saint Helena</option>
                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia">Saint Lucia</option>
                                                <option value="Saint Martin">Saint Martin</option>
                                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Sint Maarten">Sint Maarten</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                                <option value="South Korea">South Korea</option>
                                                <option value="South Sudan">South Sudan</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syria">Syria</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania">Tanzania</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor-Leste (East Timor)">Timor-Leste (East Timor)</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States" selected="true" >United States</option>
                                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                <option value="Uruguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Vatican City">Vatican City</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                <option value="Virgin Islands, US">Virgin Islands, US</option>
                                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                <option value="Western Sahara">Western Sahara</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                    -->
                    <div class="form-group">
                        <input type="tel" class="form-control" id="mobile-number" placeholder="Phone" required="" name="phone" value="<?php
                        if (isset($_POST['phone'])) {
                            echo $_POST['phone'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox" required><i></i> I agree to the <a href="#">Terms of Service </a> and <a href="#">Privacy Policy</a> </label></div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary block full-width m-b" value="Register">

                    <p class="text-muted text-center"><small>Already have an account?</small></p>
                    <a class="btn btn-sm btn-white btn-block" href="login">Login</a>
                </form>
                <p class="m-t"> <small>Project 100 ® &copy; 20<?= date('y') ?></small> </p>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
//                $('.hiddenradio').click(function () {
//                    console.log($('[type=radio]:checked').val());
//                });

            });
        </script>
        <script src="js/intlTelInput.js"></script>
        <script>
            $("#mobile-number").intlTelInput();
        </script>
    </body>

</html>
