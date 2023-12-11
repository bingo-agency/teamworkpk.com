<?php include'includes/header.php'; ?>
<section class="contact-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-box1">
                    <div class="contact-img">
                        <img src="img/AM1506.jpeg" alt="contact" height="502" width="607">
                    </div>
                    <div class="contact-content">
                        <h3 class="contact-title">Office Information</h3>
                        <div class="contact-list">
                            <ul>
                                <li>TeamWork Est.</li>
                                <li>Team Work Real Estate, Srinagar</li>
                                <li>Highway, NA-5, near metro station, G-14</li>
                                <li>Islamabad, Islamabad Capital Territory</li>
                                <li>Pakistan</li>
                            </ul>
                        </div>
                        <div class="phone-box">
                            <div class="item-lebel">Emergency Call :</div>
                            <div class="phone-number"><a href="tel:(+92) 345 8514492">(+92) 345 8514492</a></div>
                            <div class="phone-number"><a href="tel:(+92) 51 5402683">(+92) 51 5402683</a></div>
                            <div class="item-icon"><i class="fas fa-phone-alt"></i></div>
                        </div>
                        <div class="social-box">
                            <div class="item-lebel">Social Share :</div>
                            <ul class="item-social">
                                <li><a href="https://www.facebook.com/teamworkestate"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://wa.me/03458514492?text=Hello, I'm interested in property Exchange."><i class="fab fa-whatsapp"></i></a></li>
                            </ul>
                            <div class="item-icon"><i class="fas fa-share-alt"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-box2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13287.741361769005!2d72.9428815!3d33.6329185!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8d762fd8faaffc21!2sTeam%20Work%20Property%20Exchange!5e0!3m2!1sen!2s!4v1649957383722!5m2!1sen!2s" width="600" height="550" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <div class="contact-content">
                        <h3 class="contact-title">Quick Contact</h3>
                        <p>To get quick, easy access to our properties, simply call us at <a href="tel:(+92) 345 8514492">(+92) 345 8514492</a>. A contact form is on our website if you prefer to reach out to us that way. You can also schedule a showing online by filling out the form below!
                        </p>
                        <?php
                        if (isset($_POST['submit'])) {
                            $name = mysqli_real_escape_string($con, $_POST['name']);
                            $phone = mysqli_real_escape_string($con, $_POST['phone']);
                            $comment = mysqli_real_escape_string($con, $_POST['comment']);
                        }
                        ?>
                        <form class="contact-box rt-contact-form">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Name *</label>
                                    <input type="text" class="form-control" name="name" placeholder="First Name*" data-error="First Name is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Phone *</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Phone*" data-error="Phone is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Message *</label>
                                    <textarea name="comment" id="message" class="form-text"  placeholder="Message" cols="30" rows="5" data-error="Message Name is required" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <button type="submit" name="submit" class="item-btn">Send message</button>
                                </div>
                            </div>
                            <div class="form-response"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include'includes/footer.php'; ?>