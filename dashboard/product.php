<?php
$page        = 'doctor';

require_once '../path.php';
require_once 'header.php';

$product        = get_single_product(security('id', 'GET'));
$categories     = get_dropdown_data(get_all_categories(), 'category_name', 'category_id');
$units          = get_dropdown_data(get_units(), 'unit_name', 'unit_id');
$brands         = get_dropdown_data(get_brands(), 'brand_name', 'brand_id');
$tags           = get_dropdown_data(get_all('tag'), 'tag_title', 'tag_id');
$subcategories  = get_dropdown_data(get_subcategories(), 'subcategory_name', 'subcategory_id');

$text           = 'Add';
$require        = true;
if (!empty($product)) {
	$text = 'Edit';
	$require = false;
	session_assignment(array(
		'edit' => $product['product_id']
	), false);
}
?>
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Add product </h3>
                </div>
                <div class="mt-4">
                    <form enctype="multipart/form-data" action="<?= model_url ?>product" method="POST">
                        <div class="row clearfix m-2">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php
						input_hybrid("product_name", "product_name", $product, $require);
						?>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
						<?php
						input_hybrid("Price (price before discount)", "product_price", $product, $require);
						?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
						<?php
				// 		input_hybrid("New Price (price after discount)", "product_offer_price", $product, false);
						?>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
						<?php
						input_select_array("Category", "category_id", $product, $require, $categories);
						?>

					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
						<?php
						input_select_array("Subcategory", "subcategory_id", $product, false, $subcategories);
						?>
					</div>
					
					
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
						<?php
						input_select_array("Brands", "brand_id", $product, false, $brands);
						?>
					</div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
						<?php
						input_select_array("Product Tags", "tag_id", $product, false, $tags);
						?>
					</div>



					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
						<?php
						input_select('In Stock?', 'product_in_stock', $product, $require, array('yes', 'no'));
						?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
						<?php
						input_hybrid("Quantity/Stock", "product_quantity", $product, $require, 'number');
						?>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
						<?php
						input_select_array("Unit", "unit_id", $product, false, $units);
						?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
						<?php
						input_select('Featured?', 'product_group', $product, $require, array('featured', 'no'));

						?>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php

						textarea_input("Description", "product_description", $product, $require);

						?>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php

						if (!empty($product['product_image'])) {
							$require = false;
							$product_image = $product['product_image'];
						} else {
							$require = true;
							$product_image = 'white_bg_image.png';
						}
						input_hybrid("Product Image", "product_image", $product, $require, "file", 'my_img', '', 'img');
						?>
						<div class="text-center">
							<i>accepetd image types are: .png, .jpg, .jpeg</i>
						</div>
						<img alt="image" src="<?= file_url . $product_image ?>" id="img_loader" style="border-radius: 5%; border-color:grey; border-style: solid; height:auto; width: 60%;">
					</div>


					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
						<?= submit('Submit', 'dark', 'text-center'); ?>
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