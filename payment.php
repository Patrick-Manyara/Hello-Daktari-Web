<?php
$page = 'home';
include_once 'header.php';

if (!isset($_SESSION["user_id"])) {
    $url = base_url . 'login';
    header("Location: $url");
}
$user         = get_by_id('user', $_SESSION['user_id']);
if (isset($_GET['from'])) {
    if ($_GET['from'] == 'session') {
        $action = 'payment';
        $pid    = 1;
    }
    if ($_GET['from'] == 'lab') {
        $action = 'lab_payment';
        $pid    = 2;
    }
}


unset($_SESSION['doctor_location']);
unset($_SESSION['doc_category_id']);


if (isset($_GET['did'])){
    $redirect_url = 'https://hellodaktari.org/success.php?did='. $_GET['did'];
}else{
    $redirect_url = 'https://hellodaktari.org/success.php';
}
?>

<head>
    <script type="text/javascript" defer src="https://checkoutjpv2.jambopay.com/sdk"></script>
    <link rel="stylesheet" href="https://checkout.jambopay.com/jambopay-styles-checkout.min.css" />
</head>

<!--====== Page Title Start ======-->
<section class="page-title-area page-title-bg" style="background-image: url(assets/img/section-bg/page-title.jpg);">
    <div class="container">
        <h1 class="page-title">&nbsp;</h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home</a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li>Checkout</li>
        </ul>
    </div>
</section>
<!--====== Page Title End ======-->

<!--====== Contact Info Section Start ======-->
<section class="section-gap contact-top-wrappper">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-sm-12 col-12">
                
                <div class="ShippingArea">
                    <form method="POST" id="myForm">
                        <?php
                        if (isset($_GET['did'])) { ?>
                            <input hidden name="doctor_id" value="<?= $_GET['did'] ?>" />
                        <?php
                        }
                        ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-field form-group">
                                    <label for="user_name">Your Full Name</label>
                                    <input type="text" name="user_name" placeholder="Michael M. Smith" id="user_name" value="<?= $user['user_name'] ?>" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <?php
                            if ($pid == 2) { ?>
                                <input hidden name="lab_id" value="<?= security('id', 'GET') ?>" />
                            <?php
                            }
                            ?>


                            <input class="form-control MyInput" hidden name="user_id" value="<?= $_SESSION['user_id'] ?>" />

                            <div class="col-lg-12">
                                <div class="input-field form-group">
                                    <label for="user_email">Email Address</label>
                                    <input type="email" name="user_email" placeholder="abc@gmail.com" value="<?= $user['user_email'] ?>" id="user_email" required data-error="Please enter your email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="input-field form-group">
                                    <label for="user_phone">Phone Number</label>
                                    <input type="text" placeholder="+012 (345) 678 99" name="user_phone" value="<?= $user['user_phone'] ?>" id="user_phone">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-30">
                                    <textarea style="width: 100%;margin: 1em 0em;" rows="5" placeholder="Additional information"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--<button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>-->


                        <div class="col-12">
                            <button type="submit" id="BtnBook" class="MainBtn">
                                Finish
                            </button>
                            <div class="spin" style="display:none" id="spin"></div>
                        </div>

                    </form>

                </div>
            </div>

            <div class="col-lg-5 col-sm-12 col-12">

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

    .Remove {
        color: #E14B4B;
    }
</style>

<script>
    $(document).ready(function() {
        
       document.getElementById('myForm').addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevent form from submitting
            $('#BtnBook').hide();
            $('#spin').show();

            var amount = '1';
            var email = '<?= $_SESSION['user_email'] ?>';
            var rand = '<?= generateRandomString() ?>';
            var phone = '<?= $_SESSION['user_phone'] ?>';

            $.ajax({
                url: 'get_token.php',
                type: 'POST',
                data: {
                    orderid: rand,
                    amount: amount,
                },
                success: function(response) {
                    console.log(response)
                    var tokenData = JSON.parse(response);
                    var _token = tokenData.access_token;
                    console.log("Token generated: " + _token);

                    const params = {
                        amount: 1,
                        orderId: rand,
                        callBackUrl: 'https://hellodaktari.org/model/update/callback.php',
                        accountTo: "1089657",
                        token: _token,
                        description: "Hello Daktari",
                        walletEnabled: false,
                        mobileEnabled: true,
                        cardEnabled: true,
                        serviceType: "MERCHANTPAYMENT", // MERCHANTPAYMENT OR TOPUP
                        enableIframe: false,
                    };

                    const theme = {
                        primary: "#000000",
                        accent: "#333333"
                    };

                    function my_callback(data) {
                        console.log(data);
                        if (data.status === 'SUCCESS') {
                            window.location.href = '<?= $redirect_url ?>';

                        } else {
                            window.location.href = 'https://hellodaktari.org/cancel.php';
                        }
                    }

                    jambopayCheckout(params, my_callback, theme);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Failed to generate token: " + errorThrown);
                }
            });
            $('#BtnBook').show();
            $('#spin').hide();

        })
    });
</script>

<?php
include_once 'footer.php';
?>