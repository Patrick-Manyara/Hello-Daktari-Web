<?php
$page = 'home';
include_once 'header.php';
$labs = get_all('lab');
?>

<!--====== Page Title Start ======-->
<section class="page-title-area page-title-bg" style="background-image: url(assets/img/section-bg/page-title.jpg);">
    <div class="container">
        <h1 class="page-title">&nbsp;</h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home</a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li>Lab Services</li>
        </ul>
    </div>
</section>
<!--====== Page Title End ======-->

<!--====== Contact Info Section Start ======-->
<section class="section-gap contact-top-wrappper">
    <div class="container">
        <div class="DeeFlex">
            <div class="QuotesCard2">
                <div class="InsuranceHeader">
                    <div class="InsuranceHeaderTop">
                        <div class="row">
                         
                            <div class="col-8">
                                Description
                            </div>
                            <div class="col-2">
                                Amount
                            </div>
                            <div class="col-2">

                                Get Test

                            </div>
                        </div>

                    </div>
                    <div class="InsuranceHeaderBottom" style="height:auto;">
                        <?php
                        $cnt = 1;
                        foreach ($labs as $lab) {
                            $lab_id = encrypt($lab['lab_id']);
                        ?>
                            <div class="row">
                               
                                <div class="col-8">
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
</section>
<!--====== Contact Info Section End ======-->
<?php
include_once 'footer.php';
?>