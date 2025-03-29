<?php
$page        = 'group';
$header_name = 'Groups';

require_once '../path.php';
require_once 'header.php';


?>
<div class="content-wrapper"><!-- Begin Page Content -->

    <div class="container-fluid">
        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mr-5 ml-5">
            <div class="card-body card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Add group
                    </h3>
                </div>
                <div class=" m-5">
                    <form enctype="multipart/form-data" action="../model/create.php?action=group" method="POST">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ">
                                    <label for="name">Name</label>
                                    <input type="text" required id="name" value='' class="form-control" name="name" placeholder="" autocomplete="on">
                                </div>
                                <div class="text-center">
                                    <button id="add" onclick="return valid();" class="btn btn-info ">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->


    <?php include_once 'footer.php'; ?>