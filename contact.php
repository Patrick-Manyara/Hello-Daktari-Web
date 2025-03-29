<?php
$page = 'home';
include_once 'header.php';

?>



<!--====== Page Title Start ======-->
<section class="page-title-area page-title-bg" style="background-image: url(assets/img/section-bg/page-title.jpg);">
    <div class="container">
        <h1 class="page-title">Contact Us</h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home</a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li>Contact Us</li>
        </ul>
    </div>
</section>
<!--====== Page Title End ======-->

<!--====== Contact Info Section Start ======-->
<section class="section-gap contact-top-wrappper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="contact-info-wrapper">
                    <div class="single-contact-info">
                        <div class="single-contact-info">
                            <h3 class="info-title">
                                <i class="fal fa-map-marker-alt"></i> Address
                            </h3>
                            <p>
                                7895 Piermont Dr NE Albuquerque, <br>
                                NM 198866, See Our Stores
                            </p>
                        </div>
                        <div class="single-contact-info">
                            <h3 class="info-title">
                                <i class="fal fa-coffee"></i> Get In Touch
                            </h3>
                            <ul>
                                <li>
                                    <span>Phone Number</span><a href="tel:+012020200">+012 (345) 6789</a>
                                </li>
                                <li>
                                    <span>Email Address</span><a href="mailto:support@gmail.com">support@gmail.com</a>
                                </li>
                                <li>
                                    <span>Hotline</span><a href="tel:+12345678">12345678</a>
                                </li>
                            </ul>
                        </div>
                        <div class="single-contact-info">
                            <h3 class="info-title">
                                <i class="fal fa-comments"></i> Follow Us
                            </h3>
                            <p>
                                Sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore
                            </p>
                            <p class="social-icon">
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-twitter-square"></i></a>
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                <a href="#"><i class="fab fa-youtube-square"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="working-hour-chart">
                    <h2 class="chart-title">Working Hour</h2>
                    <ul>
                        <li>
                            <span><i class="far fa-angle-right"></i>Monday</span>
                            <span>9:00-19:00</span>
                        </li>
                        <li>
                            <span><i class="far fa-angle-right"></i>Tuesday</span>
                            <span>9:00-19:00</span>
                        </li>
                        <li>
                            <span><i class="far fa-angle-right"></i>Wednesday</span>
                            <span>9:00-19:00</span>
                        </li>
                        <li>
                            <span><i class="far fa-angle-right"></i>Thursday</span>
                            <span>9:00-19:00</span>
                        </li>
                        <li>
                            <span><i class="far fa-angle-right"></i>Friday</span>
                            <span>9:00-19:00</span>
                        </li>
                        <li>
                            <span><i class="far fa-angle-right"></i>Saturday</span>
                            <span>9:00-19:00</span>
                        </li>
                        <li>
                            <span><i class="far fa-angle-right"></i>Sunday</span>
                            <span>9:00-19:00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== Contact Info Section End ======-->

<!--====== Contact Form Start ======-->
<section class="contact-form-area">
    

    <div class="section-gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="section-heading mb-60 text-center">
                        <span class="tagline">We're Ready To Help You</span>
                        <h2 class="title">Leave a Message</h2>
                    </div>
                    <form id="contactForm" action="assets/php/form-process.php" name="contactForm" method="post" class="contact-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-field form-group">
                                    <label for="name">Your Full Name</label>
                                    <input type="text" name="name" placeholder="Michael M. Smith" id="name" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" placeholder="support@gmail.com" id="email" required data-error="Please enter your email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-group">
                                    <label for="number">Phone Number</label>
                                    <input type="text" placeholder="+012 (345) 678 99" id="number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-group">
                                    <label for="website">Website</label>
                                    <input type="url" placeholder="www.seeva.com" id="website">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-field form-group">
                                    <label for="message">Write Message</label>
                                    <textarea id="message" name="message" placeholder="Write Message...." required data-error="Please enter your name"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-center">
                                    <button type="submit" class="template-btn">Send Us Message <i class="far fa-plus"></i></button>
                                    <div id="msgSubmit" class="hidden"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== Contact Form End ======-->
<?php
include_once 'footer.php';
?>