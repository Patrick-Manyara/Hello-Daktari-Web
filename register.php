<?php
$page = 'home';
include_once 'header.php';
if(isset($_GET['type'])){
    if($_GET['type'] == 'sess'){
        $add = '&sess';
    }elseif($_GET['type'] == 'app'){
        $add = '&app';
    }elseif($_GET['type'] == 'special'){
        $add = '&special';
    }elseif($_GET['type'] == 'available'){
        $add = '&available';
    }else{
        $add = '';
    }
}
?>


<!--====== Why Choose Section Start ======-->
<section style="background:#FFF;" class="AppSection">
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-12 MaxHeight">
            <img src="assets/img/images/curve2.PNG" class="CurvedImg" />
        </div>
        <div class="col-lg-6 col-sm-12 col-12">
            <div class="DeeFlex MaxHeight">
                <div class="AppointmentCard Margins">
                    <div class="AppointmentCardInner">
                        <h3 class="AitchOneLight" style="margin: 1em;">
                            Welcome Back
                        </h3>
                        <p>Already have an account?<a href="login">Login</a>
                        </p>
                        <div class="row Margins">
                            <div id="progress">
                                <div id="progress-bar"></div>
                                <ul id="progress-num">
                                    <li class="step active">1</li>
                                    <li class="step">2</li>
                                    <li class="step">3</li>
                                </ul>
                            </div>
                            <div class="PersonalDetails">

                                <div class="PersonalForm">
                                    <form method="POST" action="<?= model_url ?>user&frontend<?= $add ?>">


                                        <div class="row" id="personal_form">
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group ModalFormInput">
                                                    <div class="form-group ModalFormInput">
                                                        <input required type="text" class="form-control AppointmentInput" name="user_name" placeholder="Full Name" aria-label="Full Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group ModalFormInput">
                                                    <div class="form-group ModalFormInput">
                                                        <input required type="text" class="form-control AppointmentInput" name="user_phone" placeholder="Phone Number" aria-label="Phone Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group ModalFormInput">
                                                    <div class="form-group ModalFormInput">
                                                        <input required type="email" class="form-control AppointmentInput" name="user_email" placeholder="Email Address" id="email" onBlur="checkAvailabilityEmailid()" aria-label="Email Address">
                                                        <span id="emailid-availability" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group ModalFormInput">
                                                    <div class="form-group ModalFormInput">
                                                        <input required type="password" class="form-control AppointmentInput" name="user_password" placeholder="Password" aria-label="Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group ModalFormInput">
                                                    <div class="form-group ModalFormInput">
                                                        <input required type="password" class="form-control AppointmentInput" name="confirm_password" placeholder="Confirm Password" aria-label="Confirm Password">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row" id="vehicle_form">

                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group ModalFormInput">
                                                    <div class="form-group ModalFormInput">
                                                        <input required type="number" class="form-control AppointmentInput" name="user_weight" placeholder="Weight(Kgs)" aria-label="Weight(Kgs)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group ModalFormInput">
                                                    <div class="form-group ModalFormInput">
                                                        <input required type="text" class="form-control AppointmentInput" name="user_height" placeholder="Height(Inches)" aria-label="Height(Inches)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group ModalFormInput">
                                                    <div class="form-group ModalFormInput">
                                                        <input type="text" class="form-control AppointmentInput" name="user_blood_group" placeholder="Blood group" aria-label="Blood group">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group ModalFormInput">
                                                    <div class="form-group ModalFormInput">
                                                        <input required type="text" onfocus="(this.type='date')" name="user_dob" class="form-control AppointmentInput" placeholder="Year" aria-label="Year">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row" id="final_form">
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <button type="submit" class="btn btn-primary">Submit Details</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="DeeEnd">
                                <button id="progress-prev" class="btn InputBtnClear2" disabled>Prev</button>
                                <button id="progress-next" class="btn InputBtn">Continue</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== Why Choose Section End ======-->


<script>
    $(document).ready(function() {
        const progressBar = document.getElementById("progress-bar");
        const progressNext = document.getElementById("progress-next");
        const progressPrev = document.getElementById("progress-prev");
        const steps = document.querySelectorAll(".step");
        let active = 1;



        progressNext.addEventListener("click", () => {
            active++;
            if (active > steps.length) {
                active = steps.length;
            }
            updateProgress();
        });

        progressPrev.addEventListener("click", () => {
            active--;
            if (active < 1) {
                active = 1;
            }
            updateProgress();
        });

        const updateProgress = () => {
            steps.forEach((step, i) => {
                if (i < active) {
                    step.classList.add("active");
                } else {
                    step.classList.remove("active");
                }
            });
            progressBar.style.width = ((active - 1) / (steps.length - 1)) * 100 + "%";
            if (active === 1) {
                progressPrev.disabled = true;
            } else if (active === steps.length) {
                progressNext.disabled = true;
            } else {
                progressPrev.disabled = false;
                progressNext.disabled = false;
            }
            console.log(active);
            if (active == 2) {
                $('#personal_form').css('display', 'none');
                $('#vehicle_form').css('display', 'flex');
                $('#final_form').css('display', 'none');
            }
            if (active == 1) {
                $('#personal_form').css('display', 'flex');
                $('#vehicle_form').css('display', 'none');
                $('#final_form').css('display', 'none');
            }
            if (active == 3) {
                $('#personal_form').css('display', 'none');
                $('#vehicle_form').css('display', 'none');
                $('#final_form').css('display', 'block');
            }
        };


    });
</script>

<script>
    function checkAvailabilityEmailid() {
        jQuery.ajax({
            url: "check_available.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function(data) {
                $("#emailid-availability").html(data);
            },
            error: function() {}
        });
    }
</script>

<style>
    #vehicle_form {
        display: none;
    }

    #final_form {
        display: none;
    }


    #progress {
        position: relative;
        margin-bottom: 30px;
        width: 100%;
    }

    #progress-bar {
        position: absolute;
        background: <?= $main_color ?>;
        height: 5px;
        width: 0%;
        top: 50%;
        left: 0;
    }

    #progress-num {
        margin: 0;
        padding: 0;
        list-style: none;
        display: flex;
        justify-content: space-between;
    }

    #progress-num::before {
        content: "";
        background-color: lightgray;
        position: absolute;
        top: 50%;
        left: 0;
        height: 5px;
        width: 100%;
        z-index: 1;
    }

    #progress-num .step {
        border: 3px solid lightgray;
        border-radius: 100%;
        width: 4em;
        height: 4em;
        line-height: 25px;
        text-align: center;
        background-color: #fff;
        font-size: 14px;
        position: relative;
        z-index: 1;
    }

    #progress-num .step.active {
        border-color: <?= $main_color ?>;
        background-color: <?= $main_color ?>;
        color: #fff;
    }

    .btn {
        background: lightgray;
        border: none;
        border-radius: 3px;
        padding: 6px 12px;
    }

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
</style>

<?php
include_once 'footer.php';
?>