<?php
$page = 'profile';
require_once '../path.php';
include_once 'header.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> Profile</h4>

    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="<?= admin_url ?>assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="<?= file_url . $image ?>" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4><?= $profile['user_name'] ?></h4>
                                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">

                                    <li class="list-inline-item fw-semibold"><i class="bx bx-map"></i> <?= $profile['user_address'] ?></li>
                                    <li class="list-inline-item fw-semibold">
                                        <i class="bx bx-calendar-alt"></i> Joined <?= get_month_name($profile['user_date_created']) . ' ' . get_full_year($profile['user_date_created']) ?>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary text-nowrap">
                                <i class="bx bx-user-check me-1"></i>Connected
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- Navbar pills -->
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="my_profile"><i class="bx bx-user me-1"></i> Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="password"><i class="bx bx-lock-alt me-1"></i> Security</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="edit_profile"><i class="bx bx-detail me-1"></i>Edit Profile</a>
                </li>
            </ul>
        </div>
    </div>
    <!--/ Navbar pills -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="text-muted text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-user"></i><span class="fw-semibold mx-2">Full Name:</span>
                            <span><?= $profile['user_name'] ?></span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-check"></i><span class="fw-semibold mx-2">Status:</span> <span>Active</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-star"></i><span class="fw-semibold mx-2">ID/Passport:</span> <span><?= $profile['user_passport'] ?></span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-flag"></i><span class="fw-semibold mx-2">Location:</span> <span><?= $profile['user_address'] ?></span>
                        </li>

                    </ul>
                    <small class="text-muted text-uppercase">Contacts</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-phone"></i><span class="fw-semibold mx-2">Contact:</span>
                            <span><?= $profile['user_phone'] ?></span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-chat"></i><span class="fw-semibold mx-2">Message:</span> <span><?= $profile['user_phone'] ?></span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-envelope"></i><span class="fw-semibold mx-2">Email:</span>
                            <span><?= $profile['user_email'] ?></span>
                        </li>
                    </ul>

                </div>
            </div>
            <!--/ About User -->
        </div>
        <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Activity Timeline -->
            <div class="card card-action mb-4">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0"><i class="bx bx-list-ul me-2"></i>Session Timeline</h5>

                </div>
                <div class="card-body">
                    <p>
                        <b>
                            Past Sessions
                        </b>
                    </p>
                    <ul class="timeline ms-2">
                        <?php
                        foreach ($past_sessions as $past) { ?>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">Session <?= $past['session_code'] ?> </h6>
                                        <small class="text-muted">on <?= get_ordinal_month_year($past['session_date']) ?></small>
                                    </div>
                                    <p class="mb-2">With: <?= get_by_id('user', $past['client_id'])['user_name'] ?></p>
                                    <p class="mb-2">Mode: <?= ucwords($past['session_mode']) ?></p>
                                    <p class="mb-2">From: <?= $past['session_start_time'] ?> . To: <?= $past['session_end_time'] ?></p>

                                </div>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="timeline-end-indicator">
                            <i class="bx bx-check-circle"></i>
                        </li>
                    </ul>

                    <p style="margin-top:80px;">
                        <b>
                            Upcoming Sessions
                        </b>
                    </p>

                    <ul class="timeline ms-2">
                        <?php
                        foreach ($next_sessions as $next) { ?>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">Session <?= $next['session_code'] ?> </h6>
                                        <small class="text-muted">on <?= $next['session_date'] ?></small>
                                    </div>
                                    <p class="mb-2">With: <?= get_by_id('user', $next['client_id'])['user_name'] ?></p>
                                    <p class="mb-2">Mode: <?= $next['session_mode'] ?></p>
                                    <p class="mb-2">From: <?= $next['session_start_time'] ?> . To: <?= $next['session_end_time'] ?></p>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="timeline-end-indicator">
                            <i class="bx bx-check-circle"></i>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!--/ User Profile Content --
</div>

<?php include_once 'footer.php'; ?>