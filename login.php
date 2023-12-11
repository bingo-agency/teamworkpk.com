<?php
include'includes/header.php';

if (isset($_SESSION['public_user'])) {
    $id = $_SESSION['public_user']['id'];
    $db->redirect('add_property');
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
                                    font-weight: 600;padding-top: 125px;padding-bottom: 25px;font-family: Gotham;color: #6f1c74;">Login</h1>
                            </div>
                            <?php
                            $error_msg = "";
                            if (isset($_POST['Submit'])) {
                                $email = $_POST['email'];
                                $password = $_POST['password'];

                                $query = "SELECT * FROM `public_users` WHERE email = '{$email}' AND password = '{$password}'";

                                $res = mysqli_query($con, $query) or die(mysqli_error($con));
                                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

                                if ($row) {
                                    $_SESSION['public_user'] = $row;
                                    header('location:account');
                                    exit();
                                } else {
                                    $db->error_front('Invalid Email/Password or Blocked user.');
                                }
                            }
                            ?>
                            <form action="#" method="POST" class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Email</label>
                                    <div class="col-sm-6"><input type="email" class="form-control" name="email" value="<?php
                                        if (isset($_POST['email'])) {
                                            echo $_POST['email'];
                                        }
                                        ?>" placeholder="Email"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Password</label>
                                    <div class="col-sm-6"><input type="password" class="form-control" name="password" placeholder="Password"></div>
                                </div>



                                <div class="form-group">
                                    <div class="col-lg-6 col-sm-offset-2">
                                        <input name="Submit" class="btn btn-primary col-lg-12" type="submit" value="Login" />
                                    </div>
                                </div>
                                <?php if (isset($_POST['email'])) { ?>
                                    <a href="forget_password?email=<?= $_POST['email'] ?>">Forgot Password?</a>
                                <?php } else { ?>
                                    <a href="forget_password">Forgot Password?</a>  
                                <?php }
                                ?>

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

<!--<div class="wavebk">
    <div class="container ">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-6 wave">
                <img src="img/mobile-sketch-image.png" class="img-responsive"/>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-6">
                <div class="main-content">
                    <div class="clearfix">
                        <div class="post-95 page type-page status-publish ">
                            <div class="rtcl ">
                                <div class="row" id="rtcl-user-login-wrapper">
                                    <div class="col-md-12 rtcl-login-form-wrap card-body"  style="padding-left:10%">
                                        <h2>Login</h2>
                                        <form id="rtcl-login-form" class="form-horizontal" method="post" novalidate="novalidate" >
                                            <div class="form-group">
                                                <label for="rtcl-user-login" class="control-label">
                                                    Username or E-mail
                                                    <strong class="rtcl-required">*</strong>
                                                </label>
                                                <input type="text" name="username" autocomplete="username" value="" id="rtcl-user-login" class="form-control" required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="rtcl-user-pass" class="control-label">
                                                    Password <strong class="rtcl-required">*</strong>
                                                </label>
                                                <input type="password" name="password" id="rtcl-user-pass" autocomplete="current-password" class="form-control" required="">
                                            </div>

                                            <div class="form-group d-flex align-items-center">
                                                <button type="submit" name="rtcl-login" class="btn btn-primary" value="login">
                                                    Login
                                                </button>
                                                <div class="form-check">
                                                    <input type="checkbox" name="rememberme" id="rtcl-rememberme" value="forever">
                                                    <label class="form-check-label" for="rtcl-rememberme"> Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <p class="rtcl-forgot-password">
                                                    <a href="#" style="color:blueviolet">Forgot Your Password</a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>-->
<!--<img class="wave" src="img/wave.png">
    <div class="container">
      <div class="img">
        <img src="img/bg.svg">
      </div>
      <div class="login-content">
        <form action="index.html">
          <img src="img/avatar.svg">
          <h2 class="title">Welcome</h2>
          <div class="input-div one">
            <div class="i">
              <i class="fas fa-user"></i>
            </div>
            <div class="div">
              <h5>Username</h5>
              <input type="text" class="input">
            </div>
          </div>
          <div class="input-div pass">
            <div class="i"> 
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">
              <h5>Password</h5>
              <input type="password" class="input">
            </div>
          </div>
          <a href="#">Forgot Password?</a>
          <input type="submit" class="btn" value="Login">
        </form>
      </div>
    </div>-->
<?php include'includes/footer.php'; ?>