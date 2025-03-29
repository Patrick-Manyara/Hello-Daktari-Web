<?php
$page = 'home';
include_once 'header.php';
$categories     = get_dropdown_data(get_all('doc_category'), 'doc_category_name', 'doc_category_id');
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

$timeRangeOptions = [];
for ($i = 8; $i <= 20; $i += 2) {
    $startTime = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00";
    $endTime = ($i + 2) . ":00";
    $label = "$startTime - $endTime";
    $timeRangeOptions[] = $label;
}
?>


<!--====== Why Choose Section Start ======-->
<section style="background:#FFF;" class="AppSection">

    <?php
    if (!isset($_SESSION['user_login'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-12 MaxHeight">
                <img src="assets/img/images/curve1.PNG" class="CurvedImg" />
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
                <div class="DeeFlex MaxHeight">
                    <div class="AppointmentCard Margins">
                        <div class="AppointmentCardInner">
                            <h4 class="mb-30">Login to have your address saved to your account</h4>
                            <form method='post' action="<?= model_url ?>user_login&page=<?= encrypt(base_url . 'visit') ?>">
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
                                            <p>Dont have an account?<a href="register?type=special">Sign Up</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
        $user         = get_by_id('user', $_SESSION['user_id']);
    ?>

        <form method="POST" enctype="multipart/form-data" action="<?= model_url ?>visit">
            <div class="row Margins">
                <div class="col-lg-6 col-sm-12 col-12 MaxHeight">
                    <p class="VisitTitle">
                        Please provide information on the urgency of your medical concern
                    </p>
                    <div class="MyCard">
                        <input type="radio" name="urgency" value="urgent" style="width: auto;height: auto;" id="urgent">
                        <label style="margin-bottom: unset;margin-left:10px;" for="urgent">Urgent. Would like to see available doctor immediately.</label>
                    </div>
                    <div class="MyCard">
                        <input type="radio" name="urgency" value="scheduled" style="width: auto;height: auto;" id="scheduled">
                        <label style="margin-bottom: unset;margin-left:10px;" for="scheduled">Scheduled. Select a date and time to see a doctor</label>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-12 MaxHeight">

                    <p class="VisitTitle">
                        Share if you're looking for a doctor or medical professional for yourself
                    </p>
                    <div class="MyCard">
                        <input type="radio" name="search" value="assign" style="width: auto;height: auto;" id="assign">
                        <label style="margin-bottom: unset;margin-left:10px;" for="assign">I'd like the system to assign me a doctor</label>
                    </div>
                    <div class="MyCard">
                        <input type="radio" name="search" value="myself" style="width: auto;height: auto;" id="myself">
                        <label style="margin-bottom: unset;margin-left:10px;" for="myself">I'd like to search for a doctor myself</label>
                    </div>

                </div>
                <div class="col-lg-6 col-sm-12 col-12 MaxHeight">

                    <p class="VisitTitle">
                        Let us know your current location to better assist you.
                    </p>
                    <div class="AddressArea">

                        <?php
                        if (!empty($addresses)) {
                            foreach ($addresses as $add) { ?>
                                <div class="SingleAddress">
                                    <div class="row">
                                        <div class="col-lg-8 col-sm-12 col-12">
                                            <div class="form-check JusStart">
                                                <input class="form-check-input" type="radio" <?= $checked ?> value="<?= $add['address_id'] ?>" required name="address_id" id="radio<?= $add['address_id'] ?>">
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
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-12">
                                            <div class="AddressEdit">
                                                <button type="button" id="edit<?= $add['address_id'] ?>" class="btn btn-info AddressEditBtn">Edit </button>
                                                <p>|</p>

                                                <form method="POST" action="<?= model_url ?>address&method=remove">
                                                    <input hidden name="address_id" value="<?= $add['address_id'] ?>" />
                                                    <button type="submit" class="btn btn-danger AddressEditBtn">Remove </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="MyDivider"></div>

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

                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-12 MaxHeight">
                    <p class="VisitTitle">
                        Describe the specific symptoms for accurate assistance (optional).
                    </p>
                    <div class="AddressArea">
                        <?= textarea_input('Enter Details Here', 'details', $row, false); ?>
                        
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <?= input_hybrid('Select a Date', 'date', $row, false, 'date'); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <?= input_select('Pick a time slot', 'time', $row, false, $timeRangeOptions); ?>
                            </div>    
                        </div>

                    </div>
                </div>

                <input hidden name="session_visit" id="session_visit" value="home" />


                <div class="col-12">
                    <button type="submit" class="TransBtn FullWidth Margins">
                        Check Availability
                    </button>
                </div>

            </div>
        </form>
    <?php
    }
    ?>

</section>
<!--====== Why Choose Section End ======-->

<div class="modal wow fadeInDown" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">


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

        </div>
    </div>
</div>

<!-- Include WOW.js library -->
<!-- Include WOW.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<!-- Initialize WOW.js -->
<script>
    new WOW({
        offset: 100 // Adjust this value as needed
    }).init();

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

    .AddressArea {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        width: 100%;
        border-radius: 25px;
        padding: 10px;
    }

    .SingleAddress {
        margin: 2em 0em;
    }

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


    input[type="file"] {
        display: none;
    }


    .content {
        margin-top: 20px;
    }

    #rebookDiv,
    #findDiv,
    #ChannelSection {
        display: none;
    }


    .MyCard {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        width: 100%;
        display: flex;
        padding: 20px 10px;
        border-radius: 25px;
        margin: 10px 0px;
        align-items: center;
        margin-right: 20px;
    }
    
    .VisitTitle{
            color: #4C84C3;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    margin-top: 50px;
}
    }


    .MyCard:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
</style>



<?php include_once 'footer.php'; ?>