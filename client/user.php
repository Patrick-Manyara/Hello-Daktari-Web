<?php
$page        = 'user';
$header_name = 'Clients';

require_once '../path.php';
require_once 'header.php';


?>
<div class="content-wrapper"><!-- Begin Page Content -->


    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Add Clients </h3>
                </div>
                <div class="mt-4">
                    <form enctype="multipart/form-data" action="../model/create.php?action=user&admin" method="POST">
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
                                        <input autocomplete="on" type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" value="" onBlur="checkAvailabilityMobileno()" required>
                                    </div>
                                    <span id="mobileno-availability" style="font-size:12px;"></span>
                                </div>
                                <div class="form-group ">
                                    <label for="id_number">ID/Passport Number</label>
                                    <input type="text" required id="id_number" value='' class="form-control" name="id_number" placeholder="" autocomplete="on">
                                </div>
                                <div class="form-group ">
                                    <label for="address">Address</label>
                                    <input type="text" required id="address" value='' class="form-control" name="address" placeholder="" autocomplete="on">
                                </div>


                            </div>
                            <input hidden name="doctor_id" value="ADMIN">
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

        function checkAvailabilityMobileno() {
            jQuery.ajax({
                url: "check_available.php",
                data: 'phone_number=' + $("#phone_number").val(),
                type: "POST",
                success: function(data) {
                    $("#mobileno-availability").html(data);
                },
                error: function() {}
            });
        }
    </script>


    <?php include_once 'footer.php'; ?>