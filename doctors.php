<?php
$page = 'home';
include_once 'header.php';

if (isset($_GET['sid'])) {
    $doctors = get_all('doctor');
} else {
    if (isset($_GET['s'])) {
        $specialty = security('s', 'GET');
        $content1 = " AND category_id LIKE '%$specialty%' ";
    } else {
        $content1 = '';
    }


    if (isset($_SESSION['doctor_location'])) {
        $content2 = " AND doctor_location = '$_SESSION[doctor_location]' ";
    } else {
        $content2 = '';
    }

    $session    = get_by_id('session', $_GET['id']);

    if (isset($_GET['s']) || isset($_SESSION['doctor_location'])) {
        $sql        = "SELECT * FROM doctor WHERE doctor_status = 'active' " . $content1 .  $content2;
        $sql        .= " ORDER BY rand()";
        $doctors    = select_rows($sql);
        $special    = 1;
    } else {
        if (!empty($session['doc_category_id'])) {
            $doctors    = get_doctor_by_category($session['doc_category_id']);
            $special    = 1;
        } else {
            $doctors    = get_all_doctors();
            $special    = 2;
        }
    }
}
// cout($sql);
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
                        foreach ($doctors as $doctor) {
                            if (isset($_GET['sid'])) {
                                $url = 'single_doc?sid=' . $_GET['sid'];
                            } else {
                                $url = 'rebook?tid=' . $doctor['doctor_id'];
                            }

                        ?>
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
                                        <a class="MainBtn" style="font-size: 0.7em;" href="<?= $url . (isset($_GET['sid']) ? '&id=' . encrypt($doctor['doctor_id']) : '') ?>">Check Availability</a>
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