<!--====== Back to Top Start ======-->
<a class="back-to-top" href="#">
    <i class="fas fa-angle-up"></i>
</a>
<!--====== Back to Top End ======-->

<!--====== Start Template Footer ======-->
<footer class="template-footer template-footer-white have-cta-boxes-two">

    <div class="footer-inner" style="background-color: #f1f1f1;">
        <div class="container">
            <div class="footer-widgets">
                <div class="row">
                    <div class="col-lg-3 col-md-8">
                        <div class="widget text-widget">
                            <div class="footer-logo">
                                <img src="assets/img/images/logo.png" class="MyLogo" alt="Medibo">
                            </div>
                           
                            <ul class="contact-list" > 
                                <li>
                                    <a href="https://goo.gl/maps/inpkL6wUZqMR3opX7"><i class="fas fa-map-marker-alt"></i>55 Main Road, Nairobi</a>
                                </li>
                                <li>
                                    <a href="mailto:support@gmail.com"><i class="fas fa-envelope"></i>support@hellodaktari.com</a>
                                </li>
                                <li>
                                    <a href="tel:01267899"><i class="fas fa-phone"></i>+254 745 678 99</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row justify-content-center">
                            <div class="col-xl-10 col-sm-6">
                                <div class="d-flex justify-content-lg-center">
                                    <div class="widget nav-widget">
                                        <h4 class="widget-title">Explore</h4>
                                        <ul class="nav-links">
                                            <li><a href="index">Home</a></li>
                                            <li><a href="about">About Us</a></li>
                                            <li><a href="shop">Shop</a></li>
                                            <li><a href="contact">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-10">
                        <div class="widget newsletters-widget">
                            <h4 class="widget-title">Book an appointment</h4>
                            <p>
                                Get started with Hello Daktari today.
                            </p>
                            <a href="appointment" class="TransBtn" style="color:white;">
                                Book Now
                            </a>


                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <p>© <?= get_current_year() ?> <a href="#">Hello Daktari</a>.Powered by Vesen Computing</p>
            </div>
        </div>
    </div>
</footer>
<!--====== End Template Footer ======-->

<!--====== Jquery ======-->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<!--====== Bootstrap ======-->
<script src="assets/js/bootstrap.min.js"></script>
<!--====== Slick slider ======-->
<script src="assets/js/slick.min.js"></script>
<!--====== Isotope ======-->
<script src="assets/js/isotope.pkgd.min.js"></script>
<!--====== Images loaded ======-->
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<!--====== In-view ======-->
<script src="assets/js/jquery.inview.min.js"></script>
<!--====== Nice Select ======-->
<script src="assets/js/jquery.nice-select.min.js"></script>
<!--====== Magnific Popup ======-->
<script src="assets/js/magnific-popup.min.js"></script>
<!--====== WOW Js ======-->
<script src="assets/js/wow.min.js"></script>
<!--====== Main JS ======-->
<script src="assets/js/main.js"></script>

<style>
    .DeeFlex {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .DeeJus {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .DeeBlo {
        display: block;
    }

    .DeeStart {
        height: 25em;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .JusStart {
        display: flex;
        justify-content: start;
        align-items: center;
    }

    .MyLogo {
        width: 120px;
    }

    .modal {
        z-index: 10500;
    }

    .SearchArea {}

    .MyDivider {
        background: #D1D1D8;
        width: 90%;
        display: block;
        margin: auto;
        height: 1px;
        flex-shrink: 0;
    }

    .MySelect {
        width: 100%;
        height: 42px;
        border-radius: 6px;
        border: 1px solid #4C84C3;
    }

    .MainBtn {
        border-radius: 10px;
        background: #FF594D;
        display: flex;
        height: 42px;
        padding: 16px 37px;
        justify-content: center;
        align-items: center;
        color: white;
        width: fit-content;
    }

    .MainBtn:hover {
        color: white !important;
    }

    .TransBtn2 {
        border-radius: 10px;
        background: transparent;
        display: flex;
        height: 42px;
        padding: 16px 37px;
        justify-content: center;
        align-items: center;
        color: black;
        border: 1px solid #000;
        width: fit-content;
        cursor: pointer;
        margin: 0em 1em;
    }

    .TransBtn2:hover {
        color: black !important;
    }

    .WhiteBtn {
        border-radius: 10px;
        background: #fff;
        display: flex;
        height: 42px;
        padding: 16px 37px;
        justify-content: center;
        align-items: center;
        color: black;
    }

    .TransBtn {
        border-radius: 33px;
        border: 1px solid #FF594D;
        color: #FF594D !important;
        padding: 10px !important;
    }

    .TransBtn i {
        color: #FF594D;
    }

    .AitchOne {
        color: #4C84C3;
        font-size: 32px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }

    .AitchOneWhite {
        color: #fff;
        font-size: 32px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }

    .AitchOneLight {
        color: #4C84C3;
        font-size: 16px;
        font-style: normal;
        font-weight: 700;
        line-height: 25px;
    }

    .Margins {
        margin: 1.5em 0em;
    }


    .MyHero {
        background: url("assets/img/images/shape.png");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        height: 100%;
    }

    .MyHero2 {
        background: url("assets/img/images/rec.png");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        height: 100%;
    }

    .InputArea {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .InputBox {
        display: flex;
        width: 578px;
        padding: 11px 20px;
        background: #fff;
        justify-content: center;
        align-items: center;
    }

    .InputInput {}

    .InputInput input {
        border: none;
        margin-right: 2em;
        width: 100%;
    }


    .InputBtn {
        border-radius: 6px;
        background: <?= $sec_color ?>;
        border: none;
        padding: 10px;
        color: white !important;
    }


    .MyHeader {
        text-align: center;
    }

    .BlackText {
        font-size: 0.8em;
        margin: 0.8em 0em;
    }

    .InputBtnClear {
        background: white;
        border-radius: 10px;
        border: 2px solid <?= $sec_color ?>;
        padding: 10px;
        color: <?= $sec_color ?> !important;
    }

    .InputBtnClear2 {
        background: transparent;
        border: none;
        color: #F97066 !important;
    }

    .ModalLogo {}

    .ModalLogo img {
        width: 150px;
    }

    .ModalImg {}

    .ModalImg img {
        width: 20em;
        object-fit: cover;
    }

    .modal-dialog {
        max-width: 50% !important;
        margin: 1.75rem auto;
    }

    .ModalFormInput {
        margin: 5px 0em;
    }



    .QuoteContainer {
        border-radius: 16px;
        background: #FFF;
        box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.02), 0px 6px 14px 0px rgba(0, 0, 0, 0.10);
        margin-top: -10em;
        z-index: 10;
        position: relative;
        height: 7em;
    }


    .MarginTop {
        margin-top: 1em;
    }

    .MarginBottom {
        margin-bottom: 1em;
    }

    .QuoteHeader {
        margin-top: 2em;
        color: #fff;
    }

    .QuoteCard {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
        margin: 1em;
        border-radius: 1em;
    }

    .QuoteImg {
        margin-top: 1em;
    }

    .QuoteTitle {
        text-align: center;
    }

    .WhyList {}

    .WhyList ul {}

    .WhyList ul li {
        color: #4D4D4D;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        margin-top: 1em;
    }

    .TakeLookCard {
        border-radius: 16px;
        background: #F4FEFF;
        transition: background 0.3s ease;
    }

    .TakeLookCard:hover {
        background: linear-gradient(180deg, #FF594D 0%, #4C84C3 100%);
    }

    .CardImg {
        display: block;
        margin: auto;
        width: 6em;
        height: 6em;
    }

    .AitchOneDark {
        color: #172048;
        font-size: 1em;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        margin-top: 2em;
        transition: color 0.3s ease;
    }

    .PeeDark {
        color: #172048;
        margin-top: 1em;
        font-size: 0.8em;
        font-style: normal;
        font-weight: 400;
        padding: 1em;
        text-align: center;
        transition: color 0.3s ease;
    }

    .TakeLookCard:hover .AitchOneDark,
    .TakeLookCard:hover .PeeDark {
        color: white;
    }

    .CardImgBlock {

        padding-top: 3em;
        padding-bottom: 3em;
    }

    .NumbersArea {
        background: #E8F5FA;
    }

    .PaddedContainer {
        padding: 2em;
    }

    .NumbersCard {
        text-align: center;
        background: white;
        border-radius: 1em;
        padding: 1em;
    }

    .AitchOneBlue {
        color: #5099EC;
    }

    .AitchOneBlack {
        color: #000;
        font-size: 20px;
        font-style: normal;
        font-weight: 700;
        line-height: 20px;
        letter-spacing: 0.1px;
    }

    .counter {
        color: #5099EC;
    }

    .suffix {
        color: #FF594D70;
    }

    .MissionImg {
        width: 100%;
        height: 25em;
        padding: 1em;
        object-fit: cover;
    }

    .HiddenOnLaptop {
        display: none !important;
    }

    .HiddenOnMobile {
        display: flex !important;
        justify-content: center;
    }

    .RecArea {
        background: url("assets/img/images/hands.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: 20em;
    }

    .BlockArea {
        background: url("assets/img/images/block.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: 30em;
    }

    .MaxHeight {
        height: 100%;
    }

    .AppointmentCard {
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.06);
        background: #FFF;
        box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.02), 0px 10px 20px 0px rgba(0, 0, 0, 0.10);
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .AppointmentCardInner {
        padding: 1em;
        width: 100%;
    }

    .AppointmentInput {
        height: 50px;
        padding: 10px 20px;
        gap: 10px;
    }

    .FullWidth {
        width: 100%;
        text-align: center;
    }

    .CurvedImg {
        width: 100%;
    }

    .AppSection {
        margin-top: 10em;
    }

    .VisitCard {
        border-radius: 8px;
        background: #F4F5F7;
        display: flex;
        height: 54px;
        padding: 1em;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        margin: 1em 0em;
    }

    .VisitCard.clicked {
        background: #007fff;
        color: white;
    }

    .VisitCard i {
        color: #FF594D;
    }
    
    .VisitCard2 {
        border-radius: 8px;
        background: #F4F5F7;
        display: flex;
        height: 54px;
        padding: 1em;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        margin: 1em 0em;
    }

    .VisitCard2.clicked {
        background: #007fff;
        color: white;
    }

    .VisitCard2 i {
        color: #FF594D;
    }



    .QuotesCard2 {
        border-radius: 8px;
        border: 1px solid #CFCECE;
        background: #FFF;
        width: 95%;
    }

    .QuotesInner2 {
        display: block;
        padding: 2em;
        width: 100%;
    }

    .QuotesInner2 h2 {
        color: #666;
        font-size: 31px;
        font-weight: 700;
        letter-spacing: 0.321px;
    }

    .InsuranceHeaderTop {
        background-color: <?= $main_color ?>;
        height: 4em;
    }

    .InsurancerTop {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        height: 100%;
    }

    .InsurancerTop h3 {
        width: 5em;
        font-weight: 700;
        font-size: 1.2em;
    }


    .InsuranceHeaderBottom {
        height: 4em;
        background-color: #F4F2F2;
    }

    .InsurancerBottom {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        height: 100%;
    }

    .InsurancerBottom h3 {
        width: 5em;
        font-weight: 700;
        font-size: 1em;
    }

    .OrderBox {
        width: 95%;
        padding: 32px;
        align-items: flex-start;
        border-radius: 6px;
        border: 1px solid #D1D1D8;
        background: #FFF;
    }

    .Item1 {}

    .Value1 {}

    .ProductImg {
        height: 15em;
        object-fit: cover;
        width: 100%;
    }


    /* new  */
    .header-widget-group {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .header-widget-group .header-widget:first-child {
        margin-left: 0px;
    }

    .header-widget {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        border: none;
        outline: none;
        background: none;
    }

    .header-widget i {
        width: 40px;
        height: 40px;
        font-size: 15px;
        line-height: 40px;
        text-align: center;
        display: inline-block;
        border-radius: 50%;
        color: #555555;
        background: #f5f5f5;
        transition: all linear .3s;
        -webkit-transition: all linear .3s;
        -moz-transition: all linear .3s;
        -ms-transition: all linear .3s;
        -o-transition: all linear .3s;
    }

    .header-widget:hover i {
        color: white;
        background: <?= $main_color ?>;
    }

    .cart-list {
        /*height: 100%;*/
        padding: 0px 15px;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item {
        padding: 15px 0px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        border-bottom: 1px solid #e8e8e8;
    }

    .cart-media {
        position: relative;
        margin-right: 25px;
    }

    .cart-media a img {
        width: 100px;
        border-radius: 8px;
        vertical-align: middle;
        height: 4em;
        object-fit: cover;
    }

    .cart-info-group {
        width: 100%;
    }

    .cart-info {
        margin-bottom: 13px;
    }

    .cart-info h6 {
        font-weight: 400;
        text-transform: capitalize;
    }

    .cart-info p {
        font-size: 14px;
    }

    .cart-action-group {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .cart-footer {
        text-align: center;
        -webkit-box-shadow: 0px -3px 7px 0px rgba(0, 0, 0, 0.08);
        box-shadow: 0px -3px 7px 0px rgba(0, 0, 0, 0.08);
    }

    .coupon-btn {
        font-weight: 500;
        margin-bottom: 20px;
        color: <?= $main_color ?>;
    }

    .cart-checkout-btn {
        padding: 10px 0px;
        border-radius: 8px;
        background: <?= $main_color ?>;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        transition: all linear .3s;
        -webkit-transition: all linear .3s;
        -moz-transition: all linear .3s;
        -ms-transition: all linear .3s;
        -o-transition: all linear .3s;
    }

    .checkout-label {
        width: 100%;
        height: 30px;
        font-size: 15px;
        line-height: 30px;
        letter-spacing: 0.3px;
        text-align: center;
        text-transform: capitalize;
        color: white;
    }

    .checkout-price {
        padding: 0px 25px;
        letter-spacing: 0.3px;
        color: white;
        border-left: 1px solid #e8e8e8;
    }

    .cart-header {
        padding: 18px 25px;
        text-align: center;
        position: relative;
        border-bottom: 1px solid #e8e8e8;
    }

    .cart-total {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .cart-total i {
        font-size: 20px;
        margin-right: 8px;
        color: <?= $main_color ?>;
    }

    .cart-total span {
        font-weight: 500;
        color: <?= $main_color ?>;
        text-transform: capitalize;
    }

    .CartImgMain {
        height: 8em;
        object-fit: cover;
        width: 100%;
    }

    .primary-menu li {
        text-transform: capitalize;
    }

    .MainImgShop {
        height: 25em;
        object-fit: cover;
        width: 100%;
    }

    @media screen and (max-width: 600px) {

        html,
        body {
            width: 100%;
            overflow-x: hidden !important;
        }

        .modal-dialog {
            max-width: 90% !important;
            margin: 1.75rem auto;
        }

        .DeeJus {
            display: block;
            margin: auto;
            padding: 1em;
        }

        .AppSection {
            margin-top: 1em;
        }

        .MyHero {
            background: url("assets/img/images/shape2.png");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
        }

        .MyHero2 {
            background: url("assets/img/images/rec2.png");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
        }

        .MyLogo {
            width: 80px;
        }

        .HiddenOnLaptop {
            display: block !important;
        }

        .HiddenOnMobile {
            display: none !important;
        }

        .template-header .header-left,
        .template-header .header-center,
        .template-header .header-right {
            width: auto !important;
        }

        .hero-slider-two .single-hero-slider {
            padding-top: 150px;
            padding-bottom: 280px;
        }

        .QuoteContainer {
            margin-top: 0em;
            height: auto;
        }


        .ImageArea {
            margin: 2em 0em;
        }

        .TakeLookCard {
            margin: 1em 0em;
        }

        .NumbersCard {
            margin: 1em 0em;
        }
        
        .contact-list li{
            color:black;
        }
    }
</style>
</body>

</html>