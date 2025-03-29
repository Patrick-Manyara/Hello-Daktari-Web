<?php
$page        = 'doctor';

require_once '../path.php';
require_once 'header.php';

$current_year   = date("Y");

$doctor = get_by_id('doctor', security('id', 'GET'));

if (!empty($doctor)) {
    session_assignment(array(
        'edit' => $doctor['doctor_id']
    ), false);
    $require = false;
} else {
    $require = true;
}


$alphanumericArray = explode('|', $doctor['category_id']);

$cats = array();
foreach ($alphanumericArray as $value) {
    $cats[] =  get_by_id('doc_category', $value)['doc_category_name'];
}

$cats = implode(",", $cats);
// cout($cats);
$all_cats = get_all('doc_category');


?>
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
                                <?php
                                input_hybrid('Name', 'doctor_name', $doctor, $require);
                                ?>
                                <div class="form-group">
                                    <label for='email'>Email</label>
                                    <div class="input-group">
                                        <input autocomplete="on" type="text" class="form-control" name="doctor_email" id="email" placeholder="Email" value="<?php echo isset($doctor['doctor_email']) ? $doctor['doctor_email'] : ''; ?>" onBlur="checkAvailabilityEmailid()" required>
                                    </div>
                                    <span id="emailid-availability" style="font-size:12px;"></span>
                                </div>
                                
                                
                                <div class="form-group">
                                    <p>If you choose to edit your category, re-select all the categories that you fall under.</p>
                                    <label for="doc_category"><?= ucfirst('Category ') ?> : <?= !empty($doctor) ? $cats : '' ?> </label>
                                    <select id="exampleFormControlSelect2" multiple data-placeholder="Select a category" class="select2 form-control" name="category_id[]">

                                        <?php foreach ($all_cats as $value) {
                                            $category_id = $value['doc_category_id'];
                                        ?>
                                            <option value="<?= $category_id ?>"><?= ucwords($value['doc_category_name']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                
                                
                                <?php
                                if (empty($doctor)) { 
                                input_hybrid('password', 'doctor_password', $doctor, $require);
                                }
                                
                                ?>
                                
                                

                                <?php
                                input_hybrid('Phone Number', 'doctor_phone', $doctor, $require);

                                // input_select_array("Category?", "category_id", $doctor, false, $categories);

                                input_hybrid('Location', 'doctor_location', $doctor, $require);
                                input_hybrid('address', 'doctor_address', $doctor, $require);
                                
                                input_hybrid('gender', 'doctor_gender', $doctor, $require);
                                input_hybrid('Registration/ license number', 'doctor_license', $doctor, $require);
                                input_hybrid('Area of speciality', 'doctor_specialty', $doctor, $require);

                                input_hybrid('Years of experience', 'doctor_experience', $doctor, $require, 'number');
                                textarea_input('statement quote', 'doctor_statement', $doctor, $require);
                                textarea_input('qualifications', 'doctor_qualifications', $doctor, $require);
                                textarea_input('bio', 'doctor_bio', $doctor, $require);

                                if (!empty($doctor['doctor_image'])) :
                                    $require = false;
                                    $image = $doctor['doctor_image'];
                                else :
                                    $require = true;
                                    $image = 'white_bg_image.png';
                                endif;
                                input_hybrid("doctor Image", "doctor_image", $doctor, $require, "file", 'my_img', '', 'img');
                                ?>
                                <img alt="image" src="<?= file_url . $image ?>" id="img_loader" style="border-radius: 5%; border-color:grey; border-style: solid; height:auto; width: 60%;">

                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 text-center">
                                <div class="text-center">
                                    <button class="btn btn-primary" type="submit" id="submit">Submit</button>
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
                url: "../check_available.php",
                data: 'doctor_email=' + $("#email").val(),
                type: "POST",
                success: function(data) {
                    $("#emailid-availability").html(data);
                },
                error: function() {}
            });
        }
    </script>

    <?php include_once 'footer.php'; ?>