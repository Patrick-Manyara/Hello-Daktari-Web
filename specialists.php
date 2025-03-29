<?php
$page = 'home';
include_once 'header.php';
$categories     = get_dropdown_data(get_all('doc_category'), 'doc_category_name', 'doc_category_id');
//THIS QUERY FETCHES EVERYTHING THAT IS FROM THE DOC_CATEGORY TABLE, BRINGING BACK TABLE_NAME FOR THE VIEWER AND TABLE_ID FOR THE SYSTEM.
// cout($user);
?>


<!--====== Why Choose Section Start ======-->
<section style="background:#FFF;" class="AppSection">
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-12 MaxHeight">
            <img src="assets/img/images/curve1.PNG" class="CurvedImg" />
        </div>
        <div class="col-lg-6 col-sm-12 col-12">
            <div class="DeeFlex MaxHeight">
                <div class="AppointmentCard Margins">
                    <div class="AppointmentCardInner">
                        <?php
                        if (!isset($_SESSION['user_login'])) { ?>
                            <h4 class="mb-30">Login to have your address saved to your account</h4>
                            <form method='post' action="<?= model_url ?>user_login&page=<?= encrypt(base_url . 'specialists') ?>">
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

                        <?php } else {
                            $user         = get_by_id('user', $_SESSION['user_id']);
                        ?>

                            <h3 class="AitchOneLight" style="margin: 1em;">
                                Personal Details
                            </h3>
                            <form method="POST" enctype="multipart/form-data" action="<?= model_url ?>specialist">
                                <?php
                                if ($user['doctor_id'] != 'NULL') { ?>

                                    <div class="MyCard">
                                        <input type="radio" name="option" value="rebook" style="width: auto;height: auto;" id="rebook">
                                        <label style="margin-bottom: unset;margin-left:10px;" for="rebook">Rebook With The Same Doctor</label>
                                    </div>
                                    <div class="MyCard">
                                        <input type="radio" name="option" value="find" style="width: auto;height: auto;" id="find">
                                        <label style="margin-bottom: unset;margin-left:10px;" for="find">Find A New Doctor</label>
                                    </div>
                                    <input hidden name="doctor_id" value = "<?= $user['doctor_id'] ?>" />
                                <?php
                                }else{ ?>
                                    <input hidden name="option" value="find" />
                                <?php
                                    
                                }
                                ?>


                                <div id="findDiv">
                                    <div class="col-12">
                                        <?php
                                        input_select_array("Select A Specialist", "doc_category_id", $row, false, $categories);
                                        ?>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <h3 class="AitchOneLight" style="margin: 1em;">
                                        Type of visit
                                    </h3>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12 col-12" id="home">
                                        <div class="VisitCard">
                                            <i class="fa-solid fa-house"></i>
                                            <p>Home</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-12" id="online">
                                        <div class="VisitCard">
                                            <i class="fa-solid fa-video"></i>
                                            <p>Online</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-12" id="physical">
                                        <div class="VisitCard">
                                            <i class="fa-regular fa-hospital"></i>
                                            <p>Physical</p>
                                        </div>
                                    </div>
                                </div>

                                <input hidden name="session_visit" id="session_visit" value="" />

                                <div id="ChannelSection">


                                    <div class="col-12">
                                        <h3 class="AitchOneLight" style="margin: 1em;">
                                            Channel
                                        </h3>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12 col-12" id="audio">
                                            <div class="VisitCard2">
                                                <i class="fa-solid fa-headphones"></i>
                                                <p>Audio</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-12" id="video">
                                            <div class="VisitCard2">
                                                <i class="fa-solid fa-video"></i>
                                                <p>Video</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-12" id="message">
                                            <div class="VisitCard2">
                                                <i class="fa-regular fa-comment"></i>
                                                <p>Message</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input hidden id="session_channel" name="session_channel" value="" />
                                </div>


                                <div class="col-12">
                                    <button type="submit" class="TransBtn FullWidth Margins">
                                        Check Availability
                                    </button>
                                </div>

                            </form>

                        <?php }
                        ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<!--====== Why Choose Section End ======-->

<style>
    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        width: 100%;
        margin: 10px 0em;
        height: 3em;
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



    .MyCard:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const visitCards = document.querySelectorAll(".VisitCard");

        visitCards.forEach(card => {
            card.addEventListener("click", function() {
                const groupId = this.parentElement.id;
                const sessionInput = groupId === "home" || groupId === "online" || groupId === "physical" ? "session_visit" : "session_channel";
                console.log(groupId);

                if (groupId === "online") {
                    $('#ChannelSection').show();
                } else {
                    $('#ChannelSection').hide();
                }
                // Reset the previously clicked card
                visitCards.forEach(card => {
                    card.classList.remove("clicked");
                });

                // Set the new clicked card
                this.classList.add("clicked");

                // Update the session input value
                // document.getElementById(sessionInput).value = groupId;
                $('#session_visit').val(groupId);
            });
        });

        const visitCards2 = document.querySelectorAll(".VisitCard2");

        visitCards2.forEach(card2 => {
            card2.addEventListener("click", function() {
                const groupId = this.parentElement.id;
                const sessionInput = groupId === "home" || groupId === "online" || groupId === "physical" ? "session_visit" : "session_channel";
                console.log(groupId);
                // Reset the previously clicked card2
                visitCards2.forEach(card2 => {
                    card2.classList.remove("clicked");
                });

                // Set the new clicked card2
                this.classList.add("clicked");

                // Update the session input value
                document.getElementById(sessionInput).value = groupId;
                $('#session_channel').val(groupId);
            });
        });


        document.getElementById('rebook').addEventListener('change', function() {
            $('#rebookDiv').css("display", "block");
            $('#findDiv').css("display", "none");
        });

        document.getElementById('find').addEventListener('change', function() {
            $('#rebookDiv').css("display", "none");
            $('#findDiv').css("display", "block");
        });


    });

   
</script>

<?php
include_once 'footer.php';
?>