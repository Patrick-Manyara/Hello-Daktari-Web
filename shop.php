<?php
$page = 'home';
include_once 'header.php';

$start      = 0;
$page  = $p = 1;
$sorting    = '';
$page_url   = base_url . 'shop?';
$sort       = 'product_date_created DESC';
$limit      = 9;

if (isset($_GET['sorting'])) {
    $sort_alg = security('sorting', 'GET');
    $sorting  = "&sorting=" . $_GET['sorting'];

    if ($sort_alg == 'default' || $sort_alg == 'latest') {
        $sort = 'product_date_created DESC';
    }

    if ($sort_alg == 'low') {
        $sort = 'product_price ASC';
    }

    if ($sort_alg == 'high') {
        $sort = 'product_price DESC';
    }

    if ($sort_alg == 'rating') {
        $sort = 'product_date_created DESC';
    }

    $page_url .= (isset($_GET['product_id']) && isset($_GET['product_name'])) ? '&sorting=' . $_GET['sorting'] . '&' : 'sorting=' . $_GET['sorting'] . '&';
}

$product_count  = get_products_count();

$number_of_pages = ceil($product_count / $limit);

if (isset($_GET['p'])) {
    $page = $p = security('p', 'GET');

    if (!empty($error) || ($page > $number_of_pages) || ($page < 0)) {
        $page = $p = 1;
    }
}

$start          = ($page - 1) * $limit;

$products       = get_products_for_shop_page($start, $sort, $limit);

$page_prev      = $p - 1;

function load_more($product_count, $num)
{
    global $number_of_pages, $p, $page, $page_url;
    if ($product_count >= $num) {
?>
        <ul class="pagination product-pagination">

            <?php
            $page_prev = $p - 1;
            if ($p != 1) :
            ?>
                <li><a href="<?= $page_url ?>p=<?= encrypt($page_prev) ?>"><i class="fas fa-angle-left"></i></a></li>


            <?php endif ?>
            <?php
            $radius = 3;
            if ($number_of_pages > 1) {
                for ($page = 1; $page <= $number_of_pages; $page++) {
                    if (($page >= 1 && $page <= $radius) || ($page > $p - $radius && $page < $p + $radius) || ($page <= $number_of_pages && $page > $number_of_pages - $radius)) {
            ?>

                        <li>
                            <?php
                            if ($page != $p) : ?>
                                <a href="<?= $page_url ?>p=<?= encrypt($page) ?>">
                                    <?= $page ?>
                                </a>

                            <?php else : ?>
                                <a>
                                    <?= $page ?>
                                </a>
                            <?php endif ?>

                        </li>
            <?php
                    } elseif ($page == $p - $radius || $page == $p + $radius) {
                        echo " <li class='dots'><span></span><span></span><span></span></li> ";
                    }
                }
            }
            ?>


            <?php
            $page_next = $p + 1;
            if ($p != $number_of_pages) : ?>
                <li>
                    <a href="<?= $page_url ?>p=<?= encrypt($page_next) ?>">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            <?php endif ?>

        </ul>
<?php
    }
}

$count_total   = $limit * $page;
$product_count = get_products_count();
$count_start   = $product_count > $start ? $start + 1 : $start;
$product_limit = $count_total > $product_count ? $product_count : $count_total;

$return_page = creator_url . $_SERVER['REQUEST_URI'];

// echo $return_page;

$categories = get_all_categories();

?>
<!--====== Page Title Start ======-->
<section class="page-title-area">
    <div class="container">
        <h1 class="page-title">&nbsp;</h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home</a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li>Shop</li>
        </ul>
    </div>
</section>
<!--====== Page Title End ======-->

<!--====== Shop Area Start ======-->
<section class="shop-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="product-loop-topbar">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-sm-6">
                            <div class="product-loop-count">
                                <p>Showing <?= $count_start ?> - <?= $product_limit ?> of <?= $product_count ?> results of
                                    our products</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="product-loop-filter">
                                <form id="sort_mechanism" action="<?= $sort_url ?>" method="get">
                                    <div class="filter-short">
                                        <!--<label class="filter-label">Sort by :</label>-->
                                        <select name="sorting" class="form-select filter-select" id="shop-sort" onchange="onSelectChange();">
                                            <option <?= (isset($sort_alg) && $sort_alg == 'default')  ? 'selected' : '' ?> value="<?= encrypt('default') ?>">Default sorting</option>
                                            <option <?= (isset($sort_alg) && $sort_alg == 'latest')  ? 'selected' : '' ?> value="<?= encrypt('latest') ?>">Latest</option>
                                            <option <?= (isset($sort_alg) && $sort_alg == 'low')  ? 'selected' : '' ?> value="<?= encrypt('low') ?>">low to high</option>
                                            <option <?= (isset($sort_alg) && $sort_alg == 'high')  ? 'selected' : '' ?> value="<?= encrypt('high') ?>">high to low</option>
                                            <option <?= (isset($sort_alg) && $sort_alg == 'rating')  ? 'selected' : '' ?> value="<?= encrypt('rating') ?>">average rating</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                <?php
                load_more($product_count, $limit);
                ?>
            </div>
            <div class="col-lg-3">
                <div class="shop-sidebar">
                    <div class="widget categories-widget">
                        <h5 class="widget-title">Product Categories</h5>

                        <ul>
                            <?php
                            foreach ($categories as $category) {
                                $cid = encrypt($category['category_id']);
                                $cat_count = get_products_by_category_count($category['category_id']);
                            ?>
                                <li><a href="#"><?= $category['category_name'] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="widget product-widget">
                        <h5 class="widget-title">Sale Product</h5>
                        <ul>
                            <li>
                                <div class="thumbnail">
                                    <img src="assets/img/shop/products/sidebar-1.jpg" alt="Thumbnail">
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="#">Face Mask</a></h6>
                                    <span class="price">65</span>
                                </div>
                            </li>
                            <li>
                                <div class="thumbnail">
                                    <img src="assets/img/shop/products/sidebar-2.jpg" alt="Thumbnail">
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="#">Medical Glove</a></h6>
                                    <span class="price">65</span>
                                </div>
                            </li>
                            <li>
                                <div class="thumbnail">
                                    <img src="assets/img/shop/products/sidebar-3.jpg" alt="Thumbnail">
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="#">Body Belts</a></h6>
                                    <span class="price">65</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--====== Shop Area End ======-->
<script>
	function onSelectChange() {
		document.getElementById('sort_mechanism').submit();
	}
</script>
<?php
include_once 'footer.php';
?>