<?php
include_once 'path.php';
require_once MODEL_PATH . 'operations.php';
// cout($_SESSION);
if (isset($_SESSION['cart'])) cookie_assignment(array('cart' => json_encode($_SESSION['cart'])));

if (!isset($_SESSION['cart'])) {
	if (isset($_COOKIE['cart'])) {
		$_SESSION['cart'] = json_decode($_COOKIE['cart'], true);
	}
}

$cart_count = count((is_countable($_SESSION['cart']) ? $_SESSION['cart'] : []));


if (!empty($_SESSION['error'])) {
	foreach ($_SESSION['error'] as $err) {
		error_message(ERROR_DEFINITION[$err]) . PHP_EOL;
	}
}

if (!empty($_SESSION['success'])) {
	foreach ($_SESSION['success'] as $success) {
		success_message(SUCCESS_DEFINITION[$success]) . PHP_EOL;
	}
}

if (!empty($_SESSION['warning'])) {
	foreach ($_SESSION['warning'] as $warning) {
		warning_message(WARNING_DEFINITION[$warning]) . PHP_EOL;
	}
}

unset_session_error();
unset_session_success();
unset_session_warning();


if(isset($_SESSION['status_response'])){
    $message = $_SESSION['status_response']['status_msg'];
    $status = $_SESSION['status_response']['status'];
    if($status === true){
        success_message($message) . PHP_EOL;
    }else{
        error_message($message) . PHP_EOL; 
    }
  unset($_SESSION['status_response']);
}

if(isset($_SESSION['user_login'])){
    $user = get_by_id('user',$_SESSION['user_id']);   
}

$main_color = '#4C84C3';
$sec_color = '#FF594D';
$light_color = '#E8F5FA';

if (!empty($_SESSION['cart'])) {
	$total = 0;
	foreach ($_SESSION['cart'] as $carte) {
		$total += $carte['cart_price'];
	}

	function order_box($link = '')
	{ ?>
		<div class="OrderBox">
			<h3 class="AitchOneBlack">
				Order Summary
			</h3>

			<?php
			foreach ($_SESSION['cart'] as $car) { ?>
				<div class="DeeJus Margins">
					<p class="Item1">
						<?= $car['product_name'] ?>
					</p>
					<p class="Value1">
						<?= $car['cart_quantity'] ?> x Ksh. <?= $car['product_price'] ?>
					</p>
				</div>
			<?php
			$totale += $car['cart_price'];
			}
			?>
			<div class="MyDivider"></div>

			<div class="DeeJus Margins">
				<p class="Item1">
					TOTAL
				</p>
				<p class="Value1">
					Ksh. <?= $totale ?>
				</p>
			</div>

			<?php
			if ($link != '') { ?>
				<div class="col-12">
					<a href="<?= $link ?>" class="MainBtn">
						Continue
					</a>
				</div>
			<?php
			}
			?>
		</div>
	<?php
	}
} else {
	function order_box($link = '')
	{ ?>
		<div class="OrderBox">
			<h3 class="AitchOneBlack">
				No Orders Yet
			</h3>


			<?php
			if ($link != '') { ?>
				<div class="col-12">
					<a href="<?= $link ?>" class="MainBtn">
						Continue to Shipping
					</a>
				</div>
			<?php
			}
			?>

		</div>
<?php
	}
}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= APP_NAME ?></title>

	<!--====== Favicon Icon ======-->
	<link rel="shortcut icon" href="assets/img/images/circle.png" type="img/png" />
	<!--====== Animate Css ======-->
	<link rel="stylesheet" href="assets/css/animate.min.css" />
	<!--====== Bootstrap css ======-->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<!--====== Slick Slider ======-->
	<link rel="stylesheet" href="assets/css/slick.min.css" />
	<!--====== Nice Select ======-->
	<link rel="stylesheet" href="assets/css/nice-select.min.css" />
	<!--====== Magnific Popup ======-->
	<link rel="stylesheet" href="assets/css/magnific-popup.min.css" />
	<!--====== Font Awesome ======-->
	<link rel="stylesheet" href="assets/fonts/fontawesome/css/all.min.css" />
	<!--====== Flaticon ======-->
	<link rel="stylesheet" href="assets/fonts/flaticon/css/flaticon.css" />
	<!--====== Main Css ======-->
	<link rel="stylesheet" href="assets/css/style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,500,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script type="text/javascript">
		function getCookie(name) {
			var cookieValue = null;
			if (document.cookie && document.cookie !== '') {
				var cookies = document.cookie.split(';');
				for (var i = 0; i < cookies.length; i++) {
					var cookie = cookies[i].trim();
					// Does this cookie string begin with the name we want?
					if (cookie.substring(0, name.length + 1) === (name + '=')) {
						cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
						break;
					}
				}
			}
			return cookieValue;
		}

		function uuidv4() { //universally unique identifier version 4
			return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
				var r = Math.random() * 16 | 0,
					v = c == 'x' ? r : (r & 0x3 | 0x8);
				return v.toString(16);
			});
		}

		let device = getCookie('device')

		if (device == null || device == undefined) {
			device = uuidv4()
		}

		document.cookie = 'device=' + device + ";domain=;path=/"
	</script>
<!-- Hotjar Tracking Code for Hello Daktari -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:5065142,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</head>

<body>

<div id="preloader">
		<div id="loading-center">
			<div id="object"></div>
		</div>
	</div>
	<!--====== Start Template Header ======-->
	<header class="template-header sticky-header sticky-secondary-bg absolute-header header-four">
		<div class="header-top-note">
			<div class="container container-1450">
				<p>
					Welcome to Hello Daktari. We provide all medical services you need
					<a href="#"><i class="fas fa-phone" style="color:#FF594D;"></i><strong>Call US</strong>: +012 (345) 6789</a>
				</p>
			</div>
		</div>
		<div class="container container-1450">
			<div class="header-navigation navigation-white-color" style="background:#E8F5FA;">
				<div class="header-left">
					<div class="site-logo">
						<a href="index">
							<img src="assets/img/images/logo.png" class="MyLogo" alt="">
						</a>
					</div>
					<div class="SearchArea">
                      <ul class="extra-icons">
                        <li class="d-none d-sm-block">
                          <div class="header-search-area">
                            <form action="search_result.php" method="GET">
                              <input type="search" name="query" placeholder="Search Here">
                              <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                          </div>
                        </li>
                      </ul>
                    </div>

					<nav class="site-menu menu-gap-left item-extra-gap d-none d-xl-block">
						<ul class="primary-menu">
							<li class="active"> <a href="index">Home</a></li>
							<li><a href="about">About</a></li>
							<li><a href="shop">shop</a></li>
							<!--<li><a href="lab">lab services</a></li>-->
							<li><a href="contact">Contact</a></li>

							<li class="off-canvas-btn style-two">
								<button class="header-widget header-cart" title="Cartlist">
									<i class="fas fa-shopping-basket"></i>
									<sup><?= $cart_count; ?></sup>
								</button>
							</li>
							<li>
								<a class="TransBtn" href="<?= !isset($_SESSION['user_login']) ? 'login' : 'client/' ?>">
									<i class="fa-regular fa-user"></i>
									<?= !isset($_SESSION['user_login']) ? 'SIGN IN' : 'ACCOUNT' ?>
								</a>
							</li>
						</ul>

					</nav>
				</div>
				<div class="header-right HiddenOnLaptop">
					<ul class="extra-icons">

						<li class="d-none d-xl-block">
							<div class="off-canvas-btn">
								<span></span>
							</div>
						</li>
						<li class="d-xl-none">
							<a href="#" class="navbar-toggler">
								<span></span>
								<span></span>
								<span></span>
							</a>
						</li>
					</ul>
				</div>


			</div>
		</div>

		<!-- Start Off Canvas -->
		<div class="slide-panel off-canvas-panel">
			<div class="panel-overlay"></div>
			<div class="panel-inner">
				<div class="cart-header">
					<div class="cart-total">
						<i class="fas fa-shopping-basket"></i>
						<span>total items (<?= $cart_count ?>)</span>
					</div>
					<button class="cart-close"><i class="icofont-close"></i></button>
				</div>
				<?php
				if (!empty($_SESSION['cart'])) { ?>
					<div>
						<ul class="cart-list">
							<?php
							foreach ($_SESSION['cart'] as $cart) { ?>
								<li class="cart-item">
									<div class="cart-media">
										<a href="#">
											<img src="<?= file_url . $cart['product_image'] ?>" class="CartImg" alt="product">
										</a>
										<a href="<?= cart_url ?>remove&id=<?= $cart['product_id'] ?>" class="cart-delete"><i class="far fa-trash-alt"></i></a>
									</div>
									<div class="cart-info-group">
										<div class="cart-info">
											<h6><a href="single_product?id=<?= encrypt($cart['product_id']) ?>"><?= $cart['product_name'] ?></a></h6>
											<p><?= $cart['cart_quantity'] ?> x K<?= $cart['product_price'] ?></p>
										</div>
										<div class="cart-action-group">

											<h6>K<?= $cart['cart_price'] ?></h6>
										</div>
									</div>
								</li>
							<?php
							}
							?>
						</ul>
					</div>
					<div class="cart-footer">

						<a class="cart-checkout-btn" href="cart">
							<span class="checkout-label">Proceed to Checkout</span>
							<span class="checkout-price">K<?= $total ?></span>
						</a>
					</div>

				<?php
				} else { ?>
					<ul class="cart-list">
						<li class="cart-item">
							You currently have no products in your cart.
						</li>
					</ul>
				<?php
				}
				?>

				<a href="#" class="panel-close">
					<i class="fal fa-times"></i>
				</a>
			</div>
		</div>
		<!-- End Off Canvas -->

		<!-- Start Mobile Panel -->
		<div class="slide-panel mobile-slide-panel">
			<div class="panel-overlay"></div>
			<div class="panel-inner">
				<div class="panel-logo">
					<img src="assets/img/images/logo.png" class="MyLogo" alt="">
				</div>
				<nav class="mobile-menu">
					<ul class="primary-menu">
						<li class="active"><a href="index">Home</a></li>
						<li><a href="about">About</a></li>
						<li><a href="shop">shop</a></li>
						<li><a href="cart">cart</a></li>
						<li><a href="contact">Contact</a></li>
					</ul>
				</nav>
				<a href="#" class="panel-close">
					<i class="fal fa-times"></i>
				</a>
			</div>
		</div>
		<!-- Start Mobile Panel -->
	</header>
	<!--====== End Template Header ======-->