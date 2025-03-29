<?php
$page = 'home';
include_once 'header.php';

$product            = get_single_product(security('id', 'GET'));

$images             = get_product_images($product['product_id']);
$category_name      = get_single_category($product['category_id'])['category_name'];

$tag                = get_by_id('tag', $product['tag_id']);
$product_name       = $product['product_name'];
$product_image      = $product['product_image'];
$description        = $product['product_description'];
$quantity           = $product['product_quantity'];

if ($product['product_offer_price'] > 0) {
    $current_price  = $product['product_offer_price'];
} else {
    $current_price  = $product['product_price'];
}

$users     = get_dropdown_data(get_all('user'), 'user_name', 'user_id');
?>


<div class="card">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-9 col-sm-11">
                <div class="product-gallery-wrapper">
                    <div class="main-gallery">
                        <div class="single-image">
                            <img src="<?= file_url . $product_image ?>" class="MainImgShop" alt="Image">
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-10">
                <div class="product-short-summary">
                    <div class="summary-top">
                        <div class="summary-top-left">
                            <h3 class="product-title">Medical Face Mask</h3>
                            <span>Feature flexible, Cotton-covered</span>
                        </div>
                        <div class="summary-top-right">
                            <span class="product-price">Ksh <?= $current_price ?></span>
                        </div>
                    </div>

                    <p class="short-info">
                        <?= $product['product_description'] ?>
                    </p>
                    <form action="<?= model_url ?>cart" method="POST" enctype="multipart/form-data">
                        <div class="row product-meta">
                            <div class="col-12">
                                <?php
                                input_select_array("User", "user_id", $row, true, $users);
                                ?>
                            </div>

                        </div>
                        <div class="product-cart-form">
                            <div class="quantity-wrap">
                                <input type="number" name="cart_quantity" value="1" class="quantity">
                            </div>
                            <input hidden name="product_id" value="<?= $product['product_id'] ?>" />
                            <input hidden value="<?= admin_url ?>single_product?id=<?= $_GET['id'] ?>" name="page" />
                            <input hidden name="current_price" value="<?= $current_price ?>" />
                            <div class="submit-btn-wrap">
                                <button type="submit" class="template-btn">Add to Cart</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="description-wrapper">
            <div class="product-description">
                <h4 class="common-title">Description</h4>
                <p>
                    <?= $product['product_description'] ?>
                </p>
            </div>

        </div>
    </div>
</div>


<style>
    .MainImgShop {
        height: 25em;
        object-fit: cover;
        width: 100%;
    }
</style>

<?php
include_once 'footer.php';
?>