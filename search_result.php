<?php
$page = 'home';
include_once 'header.php';

$query = $_GET['query'];

$doc_query  = "SELECT doctor.* FROM doctor WHERE doctor.doctor_name LIKE '%$query%'";
$doctors    = select_rows($doc_query);

$cat_query  = "SELECT doc_category_id FROM doc_category WHERE doc_category_name LIKE '%$query%'";
$categories = select_rows($cat_query);

$doctors_in_category = array();

foreach ($categories as $category) {
    $doc_query  = "SELECT doctor.* FROM doctor WHERE category_id LIKE '%".$category['doc_category_id']."%'";
    $doctors_in_category = array_merge($doctors_in_category, select_rows($doc_query));
}


$lab_query = "SELECT * FROM lab WHERE lab_care_name LIKE  '%$query%' LIMIT 5";
$labs = select_rows($lab_query);

$shop_query = "SELECT * FROM product WHERE product_name LIKE  '%$query%' LIMIT 5";
$products = select_rows($shop_query);

$table_name = ''; 

if (!empty($doctors)) {
    $table_name = 'Doctors';
} elseif (!empty($doctors_in_category)) {
    $table_name = 'Doctors in Category';
} elseif (!empty($labs)) {
    $table_name = 'Labs';
} elseif (!empty($products)) {
    $table_name = 'Products';
}



?>

<!--====== Page Title Start ======-->
<section class="page-title-area page-title-bg" style="background-image: url(assets/img/section-bg/page-title.jpg);">
	<div class="container">
		<h1 class="page-title"> </h1>

		<ul class="breadcrumb-nav">
			<li><a href="#">Home</a></li>
			<li><i class="fas fa-angle-right"></i></li>
			<li><?php echo $table_name; ?></li>
		</ul>
	</div>
</section>
<!--====== Page Title End ======-->

<!--====== Contact Info Section Start ======-->
<section class="section-gap contact-top-wrappper">
	<div class="container">
	<?php
	    if (!empty($doctors)) {?>
            		<div class="DeeFlex">
			<div class="QuotesCard2">
				<div class="QuotesInner2">
					<p class="AitchOne">
						Specialists
					</p>
					<p>
						If you wish to read more about a specialist, click on their name or image.
					</p>
					<div class="row">
						<?php
						foreach ($doctors as $doctor) { ?>
							<div class="col-lg-3 col-sm-12 col-12">
								<div class="SpecialistCard">
									<a href="single_doc?id=<?= encrypt($doctor['doctor_id']) ?>">
										<img src="<?= file_url . $doctor['doctor_image'] ?>" alt="Avatar">
									</a>
									<div class="SpecialistContainer">
										<h4 class="AitchOneLight PaddedHeader"><a href="single_doc?id=<?= encrypt($doctor['doctor_id']) ?>"><?= $doctor['doctor_name'] ?></a></h4>
										<p><?= $doctor['doctor_qualifications'] ?></p>
										<p><b>Years of Experience:</b> <?= $doctor['doctor_experience'] ?></p>
										<?php
										if ($special == 1) { ?>
											<p><b>Daily Rate:</b> Ksh. <?= $doctor['doctor_rate'] ?>/Day</p>
										<?php
										}
										?>
										<a class="MainBtn" style="font-size: 0.7em;" href="rebook?tid=<?= encrypt($doctor['doctor_id']) ?>">Check Availability</a>
									</div>
								</div>
							</div>
						<?php
						}
						?>

					</div>
				</div>
			</div>
		</div>

<?php } elseif (!empty($doctors_in_category)) {?>
            		<div class="DeeFlex">
			<div class="QuotesCard2">
				<div class="QuotesInner2">
					<p class="AitchOne">
						Specialists
					</p>
					<p>
						If you wish to read more about a specialist, click on their name or image.
					</p>
					<div class="row">
						<?php
						foreach ($doctors_in_category as $doctor) { ?>
							<div class="col-lg-3 col-sm-12 col-12">
								<div class="SpecialistCard">
									<a href="single_doc?id=<?= encrypt($doctor['doctor_id']) ?>">
										<img src="<?= file_url . $doctor['doctor_image'] ?>" alt="Avatar">
									</a>
									<div class="SpecialistContainer">
										<h4 class="AitchOneLight PaddedHeader"><a href="single_doc?id=<?= encrypt($doctor['doctor_id']) ?>"><?= $doctor['doctor_name'] ?></a></h4>
										<p><?= $doctor['doctor_qualifications'] ?></p>
										<p><b>Years of Experience:</b> <?= $doctor['doctor_experience'] ?></p>
										<?php
										if ($special == 1) { ?>
											<p><b>Daily Rate:</b> Ksh. <?= $doctor['doctor_rate'] ?>/Day</p>
										<?php
										}
										?>
										<a class="MainBtn" style="font-size: 0.7em;" href="rebook?tid=<?= encrypt($doctor['doctor_id']) ?>">Check Availability</a>
									</div>
								</div>
							</div>
						<?php
						}
						?>

					</div>
				</div>
			</div>
		</div>
<?php } elseif (!empty($labs)) {?>
            <div class="DeeFlex">
            <div class="QuotesCard2">
                <div class="InsuranceHeader">
                    <div class="InsuranceHeaderTop">
                        <div class="row">
                            <div class="col-2">
                                Test
                            </div>
                            <div class="col-6">
                                Description
                            </div>
                            <div class="col-2">
                                Amount
                            </div>
                            <div class="col-2">

                                Get Test

                            </div>
                        </div>

                    <div class="InsuranceHeaderBottom" style="height:auto;">
                        <?php
                        $cnt = 1;
                        foreach ($labs as $lab) {
                            $lab_id = encrypt($lab['lab_id']);
                        ?>
                            <div class="row">
                                <div class="col-2">
                                    <?= $lab['lab_care_code'] ?>
                                </div>
                                <div class="col-6">
                                    <?= $lab['lab_care_name'] ?>
                                </div>
                                <div class="col-2">
                                    Ksh <?= $lab['lab_amount'] ?>/-
                                </div>
                                <div class="col-2">
                                    <a class="MainBtn" href="payment?from=lab&id=<?= $lab_id ?>">
                                        Get Test
                                    </a>
                                </div>
                            </div>
                            <div class="MyDivider" style="margin-top: 1em;margin-bottom: 1em;"></div>
                        <?php
                            $cnt++;
                        }
                        ?>
                    </div>


                </div>
            </div>
        </div>
    </div>

<?php } elseif (!empty($products)) {?>
            <div class="row">
            <div class="col-lg-9">
                <div class="product-loop-topbar">
                    <div class="row align-items-center justify-content-lg-between">
                    </div>
                </div>
                <div class="product-loop row">
                    <?php
                    foreach ($products as $product) {

                        $id                 = encrypt($product['product_id']);
                        $images             = get_product_images($product['product_id']);
                        $category_name      = get_single_category($product['category_id'])['category_name'];
                        $subcategory_name   = get_single_sub_category($product['subcategory_id'])['subcategory_name'];
                        $tag                = get_by_id('tag', $product['tag_id']);
                        $pid                = $product['product_id'];
                        if ($product['product_offer_price'] > 0) {
                            $current_price  = $product['product_offer_price'];
                        } else {
                            $current_price  = $product['product_price'];
                        }
                    ?>
                        <div class="col-xl-4 col-sm-6">
                            <div class="single-product mb-40">
                                <div class="thumbnail">
                                    <img src="<?= file_url . $product['product_image'] ?>" class="ProductImg" alt="Product">
                                    <a href="single_product?id=<?= $id ?>" class="wishlist-btn"><i class="fas fa-heart"></i></a>
                                </div>
                                <div class="content">
                                    <div class="content-left">
                                        <h6 class="name">
                                            <a href="single_product?id=<?= $id ?>"><?= $product['product_name'] ?></a>
                                        </h6>

                                    </div>

                                </div>
                                <div class="JusStart">
                                    <span class="price">Ksh. <?= $current_price ?> </span>
                                </div>
                                <div class="JusStart">
                                    <form action="<?= cart_url ?>add" method="POST" enctype="multipart/form-data">
                                        <input hidden name="product_id" value="<?= $pid ?>" />
                                        <input hidden value="<?= $return_page ?>" name="page" />
                                        <input hidden name="cart_quantity" value="1" />
                                        <input hidden name="current_price" value="<?= $current_price ?>" />
                                        <input hidden value="<?= csrf_generate() ?>" name="csrf_token" />
                                        <button type="submit" class="TransBtn2">
                                            Add To Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
               </div>
        </div>

<?php }?>

	</div>
</section>
<!--====== Contact Info Section End ======-->

<style>
	.SpecialistCard {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		transition: 0.3s;
		width: 100%;
		border-radius: 10px;
		margin: 1em 0em;
		padding-bottom: 1em;
	}

	.SpecialistCard:hover {
		box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
	}

	.SpecialistCard img {
		width: 100%;
		height: 20em;
		object-fit: cover;
	}

	.SpecialistContainer {
		padding: 2px 16px;
	}

	.SpecialistContainer p {
		font-size: 0.8em;
	}

	.PaddedHeader {
		height: 3em;
	}
</style>

<?php
include_once 'footer.php';
?>