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
if (!empty($product['subcategory_id'])) {
    $related_products   = get_products_by_subcategory($product['subcategory_id'], '', 4, $product['product_id']);
    $subcategory_name   = get_single_sub_category($product['subcategory_id'])['subcategory_name'];
    $variations         = get_variations($product['subcategory_id']);
} else {
    $related_products   = get_products_by_category($product['category_id'], '', 4, $product['product_id']);
    $subcategory_name   = '';
}

?>
<!--====== Page Title Start ======-->
<section class="page-title-area">
    <div class="container">
        <h1 class="page-title"><?= space() ?></h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home</a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li><?= $category_name ?></li>
        </ul>
    </div>
</section>
<!--====== Page Title End ======-->

<!--====== Shop Area Start ======-->
<section class="shop-area section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-9 col-sm-11">
                <div class="product-gallery-wrapper">
                    <div class="main-gallery">
                        <div class="single-image">
                            <img src="<?= file_url . $product_image ?>" class="MainImgShop" alt="Image">
                        </div>
                        <?php
                        if (!empty($images['product_image_one'])) { ?>
                            <div class="single-image">
                                <img src="<?= file_url . $images['product_image_one'] ?>" class="MainImgShop" alt="Image">
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if (!empty($images['product_image_two'])) { ?>
                            <div class="single-image">
                                <img src="<?= file_url . $images['product_image_two'] ?>" class="MainImgShop" alt="Image">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="thumb-gallery">
                        <div class="single-image">
                            <img src="<?= file_url . $product_image ?>" class="ThumbnailImgShop" alt="Image">
                        </div>
                        <?php
                        if (!empty($images['product_image_one'])) { ?>
                            <div class="single-image">
                                <img src="<?= file_url . $images['product_image_one'] ?>" class="ThumbnailImgShop" alt="Image">
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if (!empty($images['product_image_two'])) { ?>
                            <div class="single-image">
                                <img src="<?= file_url . $images['product_image_two'] ?>" class="ThumbnailImgShop" alt="Image">
                            </div>
                        <?php
                        }
                        ?>
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
                            <!--<ul class="product-rating">-->
                            <!--    <li><i class="fas fa-star"></i></li>-->
                            <!--    <li><i class="fas fa-star"></i></li>-->
                            <!--    <li><i class="fas fa-star"></i></li>-->
                            <!--    <li><i class="fas fa-star"></i></li>-->
                            <!--    <li><i class="far fa-star"></i></li>-->
                            <!--    <li class="rating-count">(012)</li>-->
                            <!--</ul>-->
                        </div>
                    </div>
                    <!--<ul class="color-filter">-->
                    <!--    <li>Color</li>-->
                    <!--    <li><span></span></li>-->
                    <!--    <li><span></span></li>-->
                    <!--    <li><span></span></li>-->
                    <!--    <li><span></span></li>-->
                    <!--    <li><span></span></li>-->
                    <!--</ul>-->
                    <p class="short-info">
                        <?= $product['product_description'] ?>
                    </p>
                    <div class="row product-meta">
                        <div class="col-sm-6">
                            <ul class="categories">
                                <li><span>Categories:</span></li>
                                <li><a href="#"><?= $category_name ?>,</a></li>
                                <li><a href="#">Lights</a></li>
                            </ul>
                        </div>
                        <!--<div class="col-sm-6">-->
                        <!--    <ul class="tags">-->
                        <!--        <li><span>Tags:</span></li>-->
                        <!--        <li><a href="#">Decor,</a></li>-->
                        <!--        <li><a href="#">Interior</a></li>-->
                        <!--    </ul>-->
                        <!--</div>-->
                    </div>
                    <div class="product-cart-form">
                        <form action="<?= cart_url ?>add" method="POST" enctype="multipart/form-data">
                            <div class="quantity-wrap">
                                <input type="number" name="cart_quantity" value="1" class="quantity">
                            </div>
                            <input hidden name="product_id" value="<?= $product['product_id'] ?>" />
                            <input hidden value="<?= base_url ?>single_product?id=<?= $_GET['id'] ?>" name="page" />
                            <input hidden name="current_price" value="<?= $current_price ?>" />
                            <input hidden value="<?= csrf_generate() ?>" name="csrf_token" />

                            <div class="submit-btn-wrap">
                                <button type="submit" class="template-btn">Add to Cart</button>
                            </div>
                        </form>
                    </div>
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
        <?php
        if (!empty($related_products)) { ?>
            <div class="related-products">
                <h2 class="related-title">Related Products</h2>
                <div class="product-loop row">
                    <?php
                    foreach ($related_products as $item) {

                        $id                 = encrypt($item['product_id']);
                        $images             = get_product_images($item['product_id']);
                        $category_name      = get_single_category($item['category_id'])['category_name'];
                        $subcategory_name   = get_single_sub_category($item['subcategory_id'])['subcategory_name'];
                        $tag                = get_by_id('tag', $item['tag_id']);
                        $pid                = $item['product_id'];
                        if ($item['product_offer_price'] > 0) {
                            $current_price2  = $item['product_offer_price'];
                        } else {
                            $current_price2  = $item['product_price'];
                        }
                    ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="single-product mt-40">
                                <div class="thumbnail">
                                    <img src="<?= file_url . $item['product_image'] ?>" class="RelatedImg" alt="Product">
                                    <a href="single_product?id=<?= $id ?>" class="wishlist-btn"><i class="fas fa-heart"></i></a>
                                </div>
                                <div class="content">
                                    <div class="content-left">
                                        <h6 class="name">
                                            <a href="single_product?id=<?= $id ?>"><?= $item['product_name'] ?></a>
                                        </h6>

                                    </div>
                                    <div class="JusStart">
                                        <span class="price">Ksh. <?= $current_price2 ?> </span>
                                    </div>
                                    <div class="JusStart">
                                        <form action="<?= cart_url ?>add" method="POST" enctype="multipart/form-data">
                                            <input hidden name="product_id" value="<?= $pid ?>" />
                                            <input hidden value="<?= base_url ?>single_product?id=<?= $_GET['id'] ?>" name="page" />
                                            <input hidden name="cart_quantity" value="1" />
                                            <input hidden name="current_price" value="<?= $current_price2 ?>" />
                                            <input hidden value="<?= csrf_generate() ?>" name="csrf_token" />
                                            <button type="submit" class="TransBtn2">
                                                Add To Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>
<!--====== Shop Area End ======-->

<style>
    .RelatedImg {
        width: 100%;
        height: 15em;
        border-radius:1em;
        object-fit: cover;
    }

    .ThumbnailImgShop {
        width: 100%;
        height: 5em;
        object-fit: cover;
    }
</style>

<?php
include_once 'footer.php';
?>