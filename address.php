<?php
$page = 'home';
include_once 'header.php';


if (isset($_SESSION['user_login'])) {
    $col = 'user_id';
    $value = $_SESSION['user_id'];
} else {
    $col = 'device_id';
    $value = $_COOKIE['device'];
}

$addresses = get_all_addresses($col, $value);

if (sizeof($addresses) == 1) {
    $checked = 'checked';
} else {
    $checked = '';
}

if(isset($_GET['visit'])){
    $red = 'doctor';
}else{
    $red = model_url . 'order';
}

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
                        <b>Address</b> > Shipping > Payment
                    </p>
                </div>
                <?php
                if (!isset($_SESSION['user_login'])) { ?>
                    <h4 class="mb-30">Login to have your address saved to your account</h4>
                    <form method='post' action="<?= model_url ?>user_login&page=<?= encrypt(base_url . 'address') ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-field form-group">
                                        <label for="user_email">Your Name</label>
                                        <input type="email" name="user_email" placeholder="abc@gmail.com" id="user_email" required data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-field form-group">
                                        <label for="user_password">Your Password</label>
                                        <input type="password" name="user_password" placeholder="1234" id="user_password" required data-error="Please enter your password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-center">
                                    <button type="submit" class="template-btn">Login <i class="far fa-plus"></i></button>
                                    <div id="msgSubmit" class="hidden"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-center">
                                    <p>Dont have an account?<a href="register?type=sess">Sign Up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>

                <?php } else {
                    $user         = get_by_id('user', $_SESSION['user_id']);
                ?>
                    <form method="POST" action="<?= $red ?>">
                         
                        <input hidden name="user_id" value="<?= $_SESSION['user_id'] ?>" >
                        

                        <div class="AddressArea">
                            <?php
                            if (!empty($addresses)) {
                                foreach ($addresses as $add) { ?>
                                    <div class="SingleAddress">
                                        <div class="row">
                                            <div class="col-lg-8 col-sm-12 col-12">
                                                <div class="form-check JusStart">
                                                    <input class="form-check-input" type="radio" <?= $checked ?> value="<?= $add['address_id'] ?>" required  name="address_id" id="radio<?= $add['address_id'] ?>">
                                                    <label class="form-check-label AitchOneBlack" for="radio<?= $add['address_id'] ?>">
                                                        <?= $add['address_name'] ?>
                                                    </label>
                                                    <div class="AddressLabel">
                                                        <?= $add['address_label'] ?>
                                                    </div>
                                                </div>
                                                <div class="AddressLocation">
                                                    <p>
                                                        <?= $add['address_location'] ?>
                                                    </p>
                                                    <!-- <p>
                                                <b>Contact - </b> 
                                            </p> -->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12 col-12">
                                                <div class="AddressEdit">


                                                    <button type="button" id="edit<?= $add['address_id'] ?>" class="AddressEditBtn">Edit </button>


                                                    <p>|</p>

                                                    <form method="POST" action="<?= model_url ?>address&method=remove">
                                                        <input hidden name="address_id" value="<?= $add['address_id'] ?>" />
                                                        <button type="submit" class="AddressEditBtn">Remove </button>
                                                    </form>



                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal wow fadeInDown" tabindex="-1" role="dialog" id="myModal<?= $add['address_id'] ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <button type="button" class="close myClose" id="myClose<?= $add['address_id'] ?>" data-dismiss="modal" aria-label="Close">
                                                        X
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="<?= model_url ?>address">
                                                        <div class="form-group">
                                                            <input class="ModalInput form-control" value="<?= $add['address_name'] ?>" name="address_name" />
                                                        </div>

                                                        <div class="form-group">
                                                            <input class="ModalInput form-control" value="<?= $add['address_label'] ?>" name="address_label" />
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <input class="ModalInput form-control" value="<?= $add['address_phone'] ?>" name="address_phone" />
                                                        </div>

                                                        <div class="form-group">
                                                            <textarea style="width: 100%;margin: 1em 0em;" placeholder="<?= $add['address_location'] ?>" value="<?= $add['address_location'] ?>" name="address_location" rows="5" placeholder="Additional information"></textarea>
                                                        </div>
                                                        <input hidden name="address_id" value="<?= $add['address_id'] ?>" />
                                                        <?= submit() ?>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <div class="MyDivider"></div>

                            <div class="DeeFlex Margins" id="AddNew">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 5V19" stroke="#4C84C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5 12H19" stroke="#4C84C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Add New Address
                            </div>
                            
                            <button class="btn btn-primary" type="submit">Select Address</button>
                        </div>
                        
                       

                    </form>
                <?php }
                ?>
            </div>

            
        </div>
    </div>
</section>
<!--====== Contact Info Section End ======-->

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
                <form method="POST" action="<?= model_url ?>address&method=add">
                    <div class="form-group">
                        <input class="ModalInput form-control" placeholder="Area eg. Karen" name="address_name" />
                    </div>

                    <div class="form-group">
                        <input class="ModalInput form-control" placeholder="Label eg. Home, Office etc." name="address_label" />
                    </div>
                    
                    <div class="form-group">
                        <input class="ModalInput form-control" placeholder="Number to call when we arrive" name="address_phone" />
                    </div>

                    <div class="form-group">
                        <textarea style="width: 100%;margin: 1em 0em;" placeholder="Location Details eg. Building name, floor, etc." name="address_location" rows="5" placeholder="Additional information"></textarea>
                    </div>

                    <?= submit() ?>
                </form>
            </div>
            <!-- <div class="modal-footer">

                <button type="button" class="btn btn-secondary myClose" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#AddNew').click(function() {
            $('#myModal').modal('show');
        });


        $('.myClose').click(function() {
            $('#myModal').modal('hide');
        });

        <?php
        foreach ($addresses as $item) { ?>
            $('#edit<?= $item['address_id'] ?>').click(function() {
                $('#myModal<?= $item['address_id'] ?>').modal('show');
            });


            $('#myClose<?= $item['address_id'] ?>').click(function() {
                $('#myModal<?= $item['address_id'] ?>').modal('hide');
            });
        <?php
        }
        ?>


    })
</script>

<style>
    .form-check-input {
        height: 1em;
        position: inherit;
        width: auto;
        margin: 0em 1em;
    }

    .AddressArea {}

    .SingleAddress {
        margin: 2em 0em;
    }

    .form-check-label {}

    .AddressLabel {
        border-radius: 4px;
        border: 1px solid #4C84C3;
        margin: 0em 1em;
        font-size: 0.8em;
        padding: 2px;
    }

    .AddressLocation {
        margin: 1em 2em;
    }

    .AddressLocation p {
        color: #17183B;
        font-size: 14px;
        font-style: normal;
        font-weight: 700;
        line-height: 20px;
        letter-spacing: 0.1px;
    }

    .AddressEdit {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .AddressEditBtn {}
</style>

<?php
include_once 'footer.php';
?>