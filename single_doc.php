<?php
$page = 'home';
include_once 'header.php';

$doctor = get_by_id('doctor', security('id', 'GET'));

if (isset($_GET['sid'])) {
    $session = get_by_id('session', security('sid', 'GET'));
    if ($session['session_date'] != NULL && $session['session_start_time']  != NULL) {
        $url = 'payment?from=session&did='.$doctor['doctor_id'];
    }
} else {
    $url = 'rebook?tid=' . $doctor['doctor_id'];
}
?>

<!--====== Page Title Start ======-->
<section class="page-title-area page-title-bg" style="background-image: url(assets/img/section-bg/page-title.jpg);">
    <div class="container">
        <h1 class="page-title">&nbsp;</h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home</a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li>Specialists</li>
        </ul>
    </div>
</section>
<!--====== Page Title End ======-->

<!--====== Contact Info Section Start ======-->
<section class="section-gap contact-top-wrappper">
    <div class="container">
        <p>
            Specialist Profile
        </p>
        <div class="DeeFlex Margins">
            <img src="<?= file_url . $doctor['doctor_image'] ?>" class="ProfileImg" />
        </div>

        <div class="DeeFlex Margins">
            <h3 class="AitchOneLight">
                <?= $doctor['doctor_name'] ?>
            </h3>
        </div>

        <div class="DeeFlex Margins">
            <p class="Details">
                <?= $doctor['doctor_qualifications'] ?>
            </p>
        </div>

        <div class="DeeFlex Margins">
            <p class="Details">

            </p>
        </div>

        <div class="DeeFlex Margins">
            <h3 class="AitchOneLight">
                About
            </h3>
        </div>

        <div class="DeeFlex Margins">
            <p class="Details">
                <?= $doctor['doctor_bio'] ?>
            </p>
        </div>

        <?php
        if (isset($_GET['sid'])) {

            if ($session['session_date'] != NULL && $session['session_start_time']  != NULL) {
        ?>
                <div class="DeeFlex Margins">
                    <p class="Details">
                        Date: <?= get_ordinal_month_year($session['session_date']) ?>
                    </p>
                </div>
                <div class="DeeFlex Margins">
                    <p class="Details">
                        Time: <?= get_hours_mins($session['session_start_time']) ?>
                    </p>
                </div>
        <?php
            }
        }
        ?>

        <div class="DeeFlex Margins">
            <a class="MainBtn" style="font-size: 0.7em;" href="<?= $url ?>">Proceed</a>
        </div>
    </div>
</section>
<!--====== Contact Info Section End ======-->

<style>
    .ProfileImg {
        width: 15em;
        height: 15em;
        border-radius: 50%;
        object-fit: cover;
    }

    .Details {
        text-align: center;
    }

    .DocBox {
        border-radius: 8px;
        background: #F4F5F7;
        width: 3em;
        height: 3em;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .DocBox i {
        color: <?= $sec_color ?>
    }
</style>

<?php
include_once 'footer.php';
?>