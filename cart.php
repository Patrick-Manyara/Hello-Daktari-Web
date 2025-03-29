<?php
$page = 'home';
include_once 'header.php';
if ($cart_count <= 0) {
    $error['empty_checkout'] = 143;
    error_checker(base_url . 'shop');
}
?>

<!--====== Page Title Start ======-->
<section class="page-title-area page-title-bg" style="background-image: url(assets/img/section-bg/page-title.jpg);">
    <div class="container">
        <h1 class="page-title">&nbsp;</h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home</a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li>Cart</li>
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
                        <b> Cart </b> > Shipping > Payment
                    </p>
                </div>
                <div class="ShippingArea">
                    <?php
                    $i = 1;
                    foreach ($_SESSION['cart'] as $cart) {
                    ?>
                        <div class="SingleShipping">
                            <div class="Margins">
                                <div class="row">
                                    <div class="col-lg-2 col-sm-12 col-12">
                                        <img class="CartImgMain" src="<?= file_url . $cart['product_image'] ?>" />
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-12">
                                        <p class="CartTitle"><?= $cart['product_name'] ?></p>
                                        <p class="CartSub">Unit Price: <span class="MySpan">Ksh. 250</span></p>
                                    </div>
                                    <div class="col-lg-2 col-sm-12 col-12">
                                        <p><?= $cart['cart_quantity'] ?> x</p>
                                    </div>
                                    <div class="col-lg-2 col-sm-12 col-12">
                                        <p>Ksh. <?= $cart['cart_price'] ?></p>
                                    </div>
                                    <div class="col-lg-2 col-sm-12 col-12">
                                        <a href="<?= cart_url ?>remove&id=<?= $cart['product_id'] ?>">
                                            <i style="color: <?= $sec_color ?>;" class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $i++;
                    }
                    ?>

                </div>
            </div>

            <div class="col-lg-5 col-sm-12 col-12">
                <?= order_box('address') ?>
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

    .CartImgMain {}

    .CartTitle {}

    .CartSub {}
</style>

<?php
include_once 'footer.php';
?>