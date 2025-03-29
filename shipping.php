<?php
$page = 'home';
include_once 'header.php';

?>

<!--====== Page Title Start ======-->
<section class="page-title-area page-title-bg" style="background-image: url(assets/img/section-bg/page-title.jpg);">
    <div class="container">
        <h1 class="page-title">&nbsp;</h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home</a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li>Specialists</li>
        </ul>
    </div>
</section>
<!--====== Page Title End ======-->

<!--====== Contact Info Section Start ======-->
<section class="section-gap contact-top-wrappper">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-sm-12 col-12">
                <div class="TitleArea">
                    <p>
                        Address > <b> Shipping </b> > Payment
                    </p>
                </div>
                <form method="POST" action="<?= model_url ?>order">

                    <input hidden name="orders_id" value="<?= $_GET['oid'] ?>">
                    <div class="ShippingArea">
                        <div class="SingleShipping">
                            <div class="DeeJus Margins">
                                <div>
                                    <div class="form-check JusStart">
                                        <input class="form-check-input" checked type="radio" name="type" required value="free" id="free">
                                        <label class="form-check-label AitchOneBlack" for="free">
                                            Free - <span class="MySpan">Regular Shipment.</span>
                                        </label>

                                    </div>
                                </div>
                                <div>
                                    01 Feb, 2023
                                </div>
                            </div>
                        </div>

                        <div class="SingleShipping">
                            <div class="DeeJus Margins">
                                <div>
                                    <div class="form-check JusStart">
                                        <input class="form-check-input" type="radio" name="type" value="scheduled" id="schedule">
                                        <label class="form-check-label AitchOneBlack" for="schedule">
                                            Schedule - <span class="MySpan">Choose a date that works for you.</span>
                                        </label>

                                    </div>
                                </div>
                                <div>
                                    <input class="form-control TransInput" type="date" name="schedule_date" />
                                </div>
                            </div>
                        </div>


                    </div>
                    <button class="btn btn-primary" type="submit">Select Shipping Method</button>
                </form>
            </div>

            <div class="col-lg-5 col-sm-12 col-12">
                <?= order_box() ?>
            </div>
        </div>
    </div>
</section>
<!--====== Contact Info Section End ======-->

<style>
    .form-check-input {
        height: 1em;
        position: inherit;
        width: auto;
        margin: 0em 1em;
    }

    .ShippingArea {}

    .SingleShipping {
        margin: 2em 0em;
        border-radius: 2px;
        border-bottom: 1px solid #D1D1D8;
    }

    .TransInput {
        border: none;
    }

    .MySpan {
        font-size: 0.8em;
        font-style: normal;
        font-weight: 200;
    }
</style>

<?php
include_once 'footer.php';
?>