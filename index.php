<?php
$page = 'home';
include_once 'header.php';

$cats       = get_all('doc_category');
$locations  = select_rows('SELECT doctor_location FROM doctor GROUP BY doctor_location');

?>
<!--====== Hero Slider Start ======-->
<section class="hero-slider hero-slider-two">
    <div class="hero-slider-active">
        <div class="single-hero-slider">
            <div class="hero-slider-bg bg-size-cover MyHero"></div>
            <div class="container">
                <div class="row ">
                    <div class="col-lg-6 col-md-9">
                        <div class="hero-content text-center">
                            <div style="display: block;">
                                <h1 class="title" data-animation="fadeInLeft" data-delay="0.6s">Find & Search Your Favourite Doctor</h1>
                                <svg style="display: block;margin: auto;" class="PaddedOnMobile" xmlns="http://www.w3.org/2000/svg" width="282" height="16" viewBox="0 0 282 16" fill="none">
                                    <path d="M1.99897 14.4076C50.6472 6.88599 174.454 -5.26499 280.496 6.30372" stroke="#FF594D" stroke-width="3" stroke-linecap="round" />
                                </svg>
                                <div class="HiddenOnMobile">
                                    <button id="consult" class="MainBtn" type="button" data-animation="fadeInUp" data-delay="0.7s">Consult A Doctor</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== Hero Slider End ======-->

<!--====== Why Choose Section Start ======-->
<section class="wcu-section-two" style="background:#FFF;">
    <div class="container-fluid">
        <div class="container" style="margin-top: 4em;">

            <div class="TakeLookArea">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="MarginTop MarginBottom">
                            <h2 class="AitchOne" style="text-align: center;">
                                Take a look of what we have prepared for you
                            </h2>
                            <svg style="display: block;margin: auto;" xmlns="http://www.w3.org/2000/svg" width="282" height="16" viewBox="0 0 282 16" fill="none">
                                <path d="M1.99897 14.4076C50.6472 6.88599 174.454 -5.26499 280.496 6.30372" stroke="#FF594D" stroke-width="3" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 ">
                            <a href="visit">
                                <div class="TakeLookCard">
                                    <div class="CardImgBlock">
                                        <img src="assets/img/images/doc1.png" class="CardImg" />
                                        <h3 class="AitchOneDark text-center">
                                            Home Visit
                                        </h3>
                                        <p class="PeeDark">
                                            Experience expert medical guidance through virtual consultations with our skilled doctors and specialists. Get professional advice, diagnosis, and treatment recommendations without leaving your home.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 ">
                            <a href="upload">
                                <div class="TakeLookCard">
                                    <div class="CardImgBlock">
                                        <img src="assets/img/images/doc2.png" class="CardImg" />
                                        <h3 class="AitchOneDark text-center">
                                            Medical Records
                                        </h3>
                                        <p class="PeeDark">
                                            Store your valuable medical records including previous prescriptions, laboratory and imaging reports among others. Access them anytime, anywhere for a smooth and consistent healthcare journey.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 ">
                            <a href="appointment">
                                <div class="TakeLookCard">
                                    <div class="CardImgBlock">
                                        <img src="assets/img/images/doc3.png" class="CardImg" />
                                        <h3 class="AitchOneDark text-center">
                                            Consultations
                                        </h3>
                                        <p class="PeeDark">
                                            Seamlessly schedule both virtual and physical appointments according to your convenience. Say goodbye to long waiting times with our efficient booking system designed to cater to your busy lifestyle.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 ">
                            <a href="tel:0758535448">
                                <div class="TakeLookCard">
                                    <div class="CardImgBlock">
                                        <img src="assets/img/images/doc4.png" class="CardImg" />
                                        <h3 class="AitchOneDark text-center">
                                            Call An Ambulance
                                        </h3>
                                        <p class="PeeDark">
                                            Enjoy the privilege of receiving an ambulance at your doorstep. Our dedicated team of professionals can reach out to an emergency vehicle and have them come to your home or any other location.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 ">
                            <a href="shop">
                                <div class="TakeLookCard">
                                    <div class="CardImgBlock">
                                        <img src="assets/img/images/doc2.png" class="CardImg" />
                                        <h3 class="AitchOneDark text-center">
                                            Pharmacy
                                        </h3>
                                        <p class="PeeDark">
                                            Browse and purchase prescribed medications and healthcare products through our integrated e-Pharmacy. With doorstep delivery and quality assurance, managing your health has never been more convenient.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 ">
                            <a href="forum">
                                <div class="TakeLookCard">
                                    <div class="CardImgBlock">
                                        <img src="assets/img/images/group.png" class="CardImg" />

                                        <h3 class="AitchOneDark text-center">Patient Forum</h3>
                                        <p class="PeeDark">
                                            Connect with fellow patients, share experiences, and seek advice from our community of users. Get support, information, and resources related to your health condition in a supportive and understanding environment.
                                        </p>

                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 ">
                            <a href="lab">
                                <div class="TakeLookCard">
                                    <div class="CardImgBlock">
                                        <img src="assets/img/images/laboratory.png" class="CardImg" />
                                        <h3 class="AitchOneDark text-center">Lab Services</h3>
                                        <p class="PeeDark">
                                            Access comprehensive lab services conveniently from our facility. From routine blood tests to specialized diagnostics, our state-of-the-art laboratory offers accurate and timely results to aid in your diagnosis and treatment.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 ">
                            <a href="#">
                                <div class="TakeLookCard">
                                    <div class="CardImgBlock">
                                        <img src="assets/img/images/smartphone.png" class="CardImg" />
                                        <h3 class="AitchOneDark text-center">Application</h3>
                                        <p class="PeeDark">
                                            Download our mobile application from the Play Store and access all these features on your smartphone or tablet. With our user-friendly interface, you can connect with doctors, participate in the patient forum, schedule lab services, and much more, all from the palm of your hand.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--====== Why Choose Section End ======-->

<section class="NumbersArea">
    <div class="container PaddedContainer">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="MarginTop MarginBottom">
                    <h2 class="AitchOne" style="text-align: center;">
                        Our results in numbers
                    </h2>
                    <svg style="display: block;margin: auto;" xmlns="http://www.w3.org/2000/svg" width="282" height="16" viewBox="0 0 282 16" fill="none">
                        <path d="M1.99897 14.4076C50.6472 6.88599 174.454 -5.26499 280.496 6.30372" stroke="#FF594D" stroke-width="3" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="MarginTop MarginBottom">
            <div class="row">
                <div class="col-lg-3 col-sm-12 col-12">
                    <div class="NumbersCard">
                        <div class="counter-item counter-white">
                            <div class="counter-wrap">
                                <span class="counter">99</span>
                                <span class="suffix">%</span>
                            </div>
                            <h6 class="AitchOneBlue">Customer Satisfaction</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-12 col-12">
                    <div class="NumbersCard">
                        <div class="counter-item counter-white">
                            <div class="counter-wrap">
                                <span class="counter">15</span>
                                <span class="suffix">k</span>
                            </div>
                            <h6 class="AitchOneBlue">Online Patients</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-12 col-12">
                    <div class="NumbersCard">
                        <div class="counter-item counter-white">
                            <div class="counter-wrap">
                                <span class="counter">12</span>
                                <span class="suffix">k</span>
                            </div>
                            <h6 class="AitchOneBlue">Recovered Patients</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-12 col-12">
                    <div class="NumbersCard">
                        <div class="counter-item counter-white">
                            <div class="counter-wrap">
                                <span class="counter">10</span>
                                <span class="suffix">k</span>
                            </div>
                            <h6 class="AitchOneBlue">Deliveries</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== Why Choose Section Start ======-->
<section class="wcu-section-two" style="background:#FFF;">
    <div class="container-fluid">
        <div class="container" style="margin-top: 4em;">
            <div class="row">
                <div class="col-lg-5 col-md-10">
                    <div class="section-heading mb-40">
                        <!-- <span class="tagline">Why Choose Our Medical</span> -->
                        <h2 class="AitchOne">Why choose us</h2>
                        <svg style="display: block;" xmlns="http://www.w3.org/2000/svg" width="282" height="16" viewBox="0 0 282 16" fill="none">
                            <path d="M1.99897 14.4076C50.6472 6.88599 174.454 -5.26499 280.496 6.30372" stroke="#FF594D" stroke-width="3" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="WhyList">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                    <g clip-path="url(#clip0_50_4647)">
                                        <path d="M14 1.18042L4.7 11.4077L2 9.36267H0.5L4.7 16.1804L15.5 1.18042H14Z" fill="#4C84C3" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_50_4647">
                                            <rect width="16" height="16" fill="white" transform="translate(0 0.68042)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Comprehensive Specialist Network: Gain access to an extensive array of qualified doctors and specialists, ensuring you find the perfect match for your healthcare requirements.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                    <g clip-path="url(#clip0_50_4647)">
                                        <path d="M14 1.18042L4.7 11.4077L2 9.36267H0.5L4.7 16.1804L15.5 1.18042H14Z" fill="#4C84C3" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_50_4647">
                                            <rect width="16" height="16" fill="white" transform="translate(0 0.68042)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Convenient Virtual Sessions: Experience hassle-free virtual consultations from the comfort of your home, saving you time and providing medical support on your terms.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                    <g clip-path="url(#clip0_50_4647)">
                                        <path d="M14 1.18042L4.7 11.4077L2 9.36267H0.5L4.7 16.1804L15.5 1.18042H14Z" fill="#4C84C3" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_50_4647">
                                            <rect width="16" height="16" fill="white" transform="translate(0 0.68042)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Secure Medical Record Management: Safely store and manage your medical records online, facilitating seamless sharing with healthcare providers while maintaining your privacy.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                    <g clip-path="url(#clip0_50_4647)">
                                        <path d="M14 1.18042L4.7 11.4077L2 9.36267H0.5L4.7 16.1804L15.5 1.18042H14Z" fill="#4C84C3" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_50_4647">
                                            <rect width="16" height="16" fill="white" transform="translate(0 0.68042)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Affordable Care Solutions: Receive top-notch medical services including prescriptions, home visits, and more, all at budget-friendly rates that prioritize your well-being.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                    <g clip-path="url(#clip0_50_4647)">
                                        <path d="M14 1.18042L4.7 11.4077L2 9.36267H0.5L4.7 16.1804L15.5 1.18042H14Z" fill="#4C84C3" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_50_4647">
                                            <rect width="16" height="16" fill="white" transform="translate(0 0.68042)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Holistic Healthcare Experience: Enjoy a holistic healthcare journey by seamlessly booking appointments, receiving prescriptions, and even arranging home visits – all within one user-friendly platform.
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 col-md-10">
                    <div class="ImageArea">
                        <div class="row">
                            <div class="col-6">
                                <div class="DeeFlex">
                                    <img src="assets/img/images/about3.png" alt="Image">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="DeeBlo">
                                    <img src="assets/img/images/about1.png" alt="Image">
                                    <img style="margin-top: 1em;" src="assets/img/images/about2.png" alt="Image">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</section>
<!--====== Why Choose Section End ======-->



<!--====== Testimonials Section Start ======-->
<section class="testimonial-section testimonial-shapes section-gap polygon-pattern" style="background-color: #f1f1f1;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-heading text-center heading-white mb-70">
                    <span class="tagline" style="color: #000;">Our Testimonials</span>
                    <h2 class="title" style="color: #000;">What Our Patients Say About Us</h2>
                </div>
            </div>
        </div>
        <div class="row testimonial-slider-two">
            <div class="col-lg-6">
                <div class="single-testimonial-slider">
                    <p class="content">
                        Hello Daktari has been a game-changer for me. Their virtual consultations saved me precious time, and their specialist recommendations were spot on. A truly reliable and convenient healthcare solution.
                    </p>

                    <div class="author-info-wrapper">
                        <div class="avatar">
                            <img src="assets/img/testimonial/ndungu.jpg" alt="Image">
                        </div>
                        <div class="author-info">
                            <h5 class="name">John Ndung'u</h5>
                            <span class="title">CEO Vesen Computing</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-testimonial-slider">
                    <p class="content">
                        As a mother of two, finding time for medical appointments was tough. Thanks to Hello Daktari, I can book appointments and even order medicines online. It's made managing my family's health a breeze.
                    </p>

                    <div class="author-info-wrapper">
                        <div class="avatar">
                            <img src="assets/img/testimonial/aggree.png" alt="Image">
                        </div>
                        <div class="author-info">
                            <h5 class="name">Agree Oh-Gendo</h5>
                            <span class="title">User</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-testimonial-slider">
                    <p class="content">
                        Being constantly on the move, Hello Daktari's virtual consultations have been a lifesaver. Wherever I am, I can connect with a doctor and receive prompt advice. It's like having a health companion on my journeys
                    </p>

                    <div class="author-info-wrapper">
                        <div class="avatar">
                            <img src="assets/img/testimonial/yvonne.jpg" alt="Image">
                        </div>
                        <div class="author-info">
                            <h5 class="name">Yvonne Katama</h5>
                            <span class="title">Graphic Designer</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-testimonial-slider">
                    <p class="content">
                        Living with a chronic illness is challenging, but Hello Daktari has lightened the load. I can easily manage my prescriptions and access medical records online. Their support has been invaluable.
                    </p>

                    <div class="author-info-wrapper">
                        <div class="avatar">
                            <img src="assets/img/testimonial/02.png" alt="Image">
                        </div>
                        <div class="author-info">
                            <h5 class="name">Danson Muchemi</h5>
                            <span class="title">CEO JamboPay</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial-slider-arrow"></div>
    </div>
    <div class="shape-images">
        <div class="image-one animate-float-bob-y" style="background-image: url(assets/img/images/about1.png);">
        </div>
        <div class="image-two animate-float-bob-y" style="background-image: url(assets/img/images/about2.png);">
        </div>
    </div>
</section>


<!--====== About Section Start ======-->
<section class="about-section section-gap-top">
    <div class="container">
        <div class="row align-items-end justify-content-center">
            <div class="col-xl-6 col-lg-6 col-sm-12">
                <img src="assets/img/images/mother.png" class="MissionImg" />
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                <div class="DeeStart">
                    <div class="DeeBlo">
                        <div class="section-heading mb-40">
                            <!-- <span class="tagline">Why Choose Our Medical</span> -->
                            <h2 class="AitchOne">Our mission & Vision</h2>
                            <svg style="display: block;" xmlns="http://www.w3.org/2000/svg" width="282" height="16" viewBox="0 0 282 16" fill="none">
                                <path d="M1.99897 14.4076C50.6472 6.88599 174.454 -5.26499 280.496 6.30372" stroke="#FF594D" stroke-width="3" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div>
                            <p>
                                At Hello Daktari, our mission is to revolutionize healthcare accessibility by providing a comprehensive online platform that connects individuals with top-tier medical professionals. We are committed to offering affordable, convenient, and personalized healthcare solutions that empower users to take charge of their well-being, regardless of their location or circumstances.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== About Section End ======-->


<div class="modal wow fadeInDown" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- <div class="ModalLogo">
                    <img src="assets/img/images/logo.png" class="MyLogo" />
                </div> -->
                <button type="button" class="close myClose" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div>
            <div class="modal-body">

                <div class="ModalImg DeeFlex">
                    <img src="assets/img/images/newsletter.png" />
                </div>

                <div class="ModalText">
                    <h2 class="MyHeader">
                        Sign up to our Newsletter
                    </h2>
                    <p class="BlackText">
                        
                    </p>
                </div>

                <div class="InputArea">
                    <div class="InputBox">
                        <div class="InputInput">
                            <input placeholder="Enter Your Email Address" type="email" />
                        </div>
                        <button class="InputBtn">
                            Subscribe
                        </button>
                    </div>

                </div>
            </div>
            <!-- <div class="modal-footer">

                <button type="button" class="btn btn-secondary myClose" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>



<div class="modal wow fadeInDown" tabindex="-1" role="dialog" id="myModal2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h3 class="GreenHeader MarginBottom">
                    Choose Below To Proceed
                </h3>
                <button type="button" class="close myClose2" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div>
            <div class="modal-body">

                <div class="ModalBodyInner">

                    <a href="available" class="MainBtn">
                        Consult Available Doctor
                    </a>

                    <a href="specialists" class="MainBtn">
                        Consult A Specialist
                    </a>

                </div>

            </div>
            <!-- <div class="modal-footer">

                <button type="button" class="btn btn-secondary myClose2" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        // $('#myModal').modal('show');

        $('.myClose').click(function() {
            $('#myModal').modal('hide');
        });


        $('#consult').click(function() {
            $('#myModal2').modal('show');
        });

        $('.myClose2').click(function() {
            $('#myModal2').modal('hide');
        });



    })
</script>

<style>
    .nice-select.open .list {
        width: auto !important;
    }

    .ModalBodyInner .MainBtn {
        margin: auto;
        margin-top: 1em;
    }
    
    .TakeLookCard{
        margin-bottom:20px;
    }
</style>


<?php
include_once 'footer.php';
?>