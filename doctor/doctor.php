<?php
$page        = 'doctor';

require_once '../path.php';
require_once 'header.php';

$current_year   = date("Y");
// cout($_SESSION);
?>
<div class="content-wrapper"><!-- Begin Page Content -->


    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Add doctors </h3>
                </div>
                <div class="mt-4">
                    <form enctype="multipart/form-data" action="<?= model_url ?>doctor" method="POST">
                        <div class="row clearfix">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ">
                                    <label for="name">Name</label>
                                    <input type="text" required id="name" value='' class="form-control" name="name" placeholder="" autocomplete="on">
                                </div>

                                <div class="form-group">
                                    <label for='email'>Email</label>
                                    <div class="input-group">
                                        <input autocomplete="on" type="text" class="form-control" name="email" id="email" placeholder="Email" value="" onBlur="checkAvailabilityEmailid()" required>
                                    </div>
                                    <span id="emailid-availability" style="font-size:12px;"></span>
                                </div>



                                <div class="form-group">
                                    <label for='phone_number'>Phone Number</label>
                                    <div class="input-group">
                                        <input autocomplete="on" type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" value="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category">Category : </label>
                                    <select id="category" multiple="multiple" data-placeholder="Select a category" class="select2 form-control" name="category_id[]">

                                        <option value="1xm8GTDWZsq">Personal Development And Coaching</option>
                                        <option value="3NJjfcrM1FW">Addiction And Drug</option>
                                        <option value="5SmYyjWBAoG">Trauma</option>
                                        <option value="9m5YMA3BHjL">Depression</option>
                                        <option value="FeQ1iTZlrhU">Loss And Grief</option>
                                        <option value="g0Uy2VmD9ql">Love, Relationship And Marriage</option>
                                        <option value="K5HNOvLMlZ8">Adolescent And Teens</option>
                                        <option value="kK048vFbiEH">Special Needs</option>
                                        <option value="lIvUxPYsZTw">Workplace/ Organisational</option>
                                        <option value="MNGK5P6SZAr">General doctor</option>
                                        <option value="O6haqZFJrIP">Gender Based Counselling</option>
                                        <option value="OrIVZ1TsN43">Children And Development</option>
                                        <option value="zuEysB6krMi">Anxiety</option>
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label for="location">Location</label>
                                    <input type="text" required id="location" value='' class="form-control" name="location" placeholder="" autocomplete="on">
                                </div>
                                <div class="form-group">
                                    <label>Qualifications</label>
                                    <textarea class="form-control" style="min-width: 100%; max-width: 100%;" name="qualifications" id="qualifications" rows="5" required></textarea>
                                </div>
                                <div class="form-group ">
                                    <label for="specialty">Area of speciality</label>
                                    <input type="text" required id="specialty" value='' class="form-control" name="specialty" placeholder="" autocomplete="on">
                                </div>
                                <div class="form-group ">
                                    <label for="license_number">Registration/ license number</label>
                                    <input type="text" required id="license_number" value='' class="form-control" name="license_number" placeholder="" autocomplete="on">
                                </div>
                                <div class="form-group">
                                    <label>Statement quote</label>
                                    <textarea class="form-control" style="min-width: 100%; max-width: 100%;" name="statement_quote" id="statement_quote" rows="5" required></textarea>
                                </div>
                                <div class="form-group ">
                                    <label for="experience">Years of experience</label>
                                    <input type="text" required id="experience" value='' class="form-control" name="experience" placeholder="" autocomplete="on">
                                </div>
                                <div class="form-group">
                                    <label>Bio</label>
                                    <textarea class="form-control" style="min-width: 100%; max-width: 100%;" name="bio" id="bio" rows="5" required></textarea>
                                </div>
                                <div class="form-group ">
                                    <label for="gender">Gender : </label>
                                    <Select id="gender" required class="form-control " placeholder="" name="gender">
                                        <option hidden value="" selected disabled>Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </Select>
                                </div>


                            </div>

                            <div class="col-12">
                                <div class="form-group ">
                                    <label for="my_img">Profile Image</label>
                                    <input type="file" required accept=".png, .jpg, .jpeg" id="my_img" value='' class="form-control" name="profile_image" placeholder="" autocomplete="on">
                                </div>
                                <img alt="profile_image" src="https://psychx.io/backoffice/uploads/download.png" id="img_loader" style="border-radius: 5%; border-color:grey; border-style: solid; height:auto; width:50%;">
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 text-center">
                                <div class="text-center">
                                    <button id="add" onclick="return valid();" class="btn btn-primary ">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->

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

    <?php include_once 'footer.php'; ?>