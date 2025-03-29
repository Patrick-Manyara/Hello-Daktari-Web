<?php
$page        = 'category';
$header_name = 'all_categories';

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
                        Add category
                    </h3>
                </div>
                <div class=" m-5">
                    <form method="post" enctype="multipart/form-data" action="<?= model_url ?>category">
                <?php  ?>
                <div class="row clearfix m-2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Name", "category_name", $category, true);
                       
                        textarea_input("Description", "category_description", $category, false);
                        
                        
                        if (!empty($category['category_image'])) {
                                $require = false;
                                $category_image = $category['category_image'];
                            } else {
                                $require = true;
                                $category_image = 'white_bg_image.png';
                            }
                            input_hybrid("Category Image", "category_image", $category, $require, "file", 'my_img', '', 'img');
                        ?>
                      
                        <img alt="category_image" src="<?= file_url . $category_image ?>" id="img_loader"style="border-radius: 5%; border-color:grey; border-style: solid; height:auto; width: 60%;">
                  
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <?= submit('Submit', 'info', 'text-center'); ?>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->


    <?php include_once 'footer.php'; ?>