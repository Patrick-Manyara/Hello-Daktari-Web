<?php
$page = 'banner';
require_once '../path.php';
include_once 'header.php';

$banner = array();
if (isset($_GET['id'])) $banner = get_banner_by_id(security('id', 'GET'));

if (!empty($banner)) {
    session_assignment(array(
        'edit' => $banner['banner_id']
    ), false);
}
// cout(TARGET_DIR);
?>


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">banners /</span> Create An banner</h4>

    <div class="row">
        <div class="col-md-10 col-lg-10 col-sm-12">
            <div class="card mb-4">
                <h5 class="card-header">Default</h5>

                <form method="post" id="quickForm" enctype="multipart/form-data" action="<?= model_url ?>banner">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php
                                input_hybrid("Title", "banner_title", $banner, true);


                                textarea_input("Description", "banner_description", $banner, false);

                                if (!empty($banner['banner_poster'])) :
                                    $require = false;
                                    $image = $banner['banner_poster'];
                                else :
                                    $require = true;
                                    $image = 'white_bg_image.png';
                                endif;
                                input_hybrid("Banner Image", "banner_poster", $banner, $require, "file", 'my_img', '', 'img');
                                ?>
                                <img alt="image" src="<?= file_url . $image ?>" id="img_loader" style="border-radius: 5%; border-color:grey; border-style: solid; height:auto; width: 60%;">
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <?= submit('Submit', 'dark', 'text-center'); ?>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<?php include_once 'footer.php'; ?>