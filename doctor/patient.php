<?php
$page = 'profile';
require_once '../path.php';
include_once 'header.php';
$user = get_by_id('user', security('id', 'GET'));
$uploads = get_all_uploads(security('id', 'GET'));
$prescriptions = get_all_prescriptions('', security('id', 'GET'));

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_name', 'title' => 'Name'),
        array('data' => 'prescription_mode', 'title' => 'Code'),
        array('data' => 'a', 'title' => 'Meds'),
        array('data' => 'b', 'title' => 'PDF'),
        array('data' => 'prescription_end_time', 'title' => 'Action')
    );
}

$user_past = get_past_sessions(security('id', 'GET'), $_SESSION['doctor_id']);
$user_next = get_upcoming_sessions(security('id', 'GET'), $_SESSION['doctor_id']);
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User / View /</span> Account</h4>
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded my-4" src="<?= file_url . $user['user_image'] ?>" height="110" width="110" alt="User avatar" />
                            <div class="user-info text-center">
                                <h4 class="mb-2"><?= $user['user_name'] ?></h4>
                                <span class="badge bg-label-secondary">Active</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                        <div class="d-flex align-items-start me-4 mt-3 gap-3">
                            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-check bx-sm"></i></span>
                            <div>
                                <h5 class="mb-0"><?= sizeof($uploads) ?></h5>
                                <span>Uploaded Records</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mt-3 gap-3">
                            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-customize bx-sm"></i></span>
                            <div>
                                <h5 class="mb-0"><?= sizeof($prescriptions) ?></h5>
                                <span>Prescriptions Written</span>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-2 border-bottom mb-4">Details</h5>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold me-2">Username:</span>
                                <span><?= $user['user_name'] ?></span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Email:</span>
                                <span><?= $user['user_email'] ?></span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Contact:</span>
                                <span><?= $user['user_phone'] ?></span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Status:</span>
                                <span class="badge bg-label-success">Active</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">ID/Passport:</span>
                                <span><?= $user['user_passport'] ?></span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">DOB:</span>
                                <span><?= $user['user_dob'] ?></span>
                            </li>

                            <li class="mb-3">
                                <span class="fw-bold me-2">Height:</span>
                                <span><?= $user['user_height'] ?></span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Weight:</span>
                                <span><?= $user['user_weight'] ?></span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Blood Group:</span>
                                <span><?= $user['user_blood_group'] ?></span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <!-- /User Card -->

        </div>
        <!--/ User Sidebar -->

        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">


            <!-- Project table -->
            <div class="card mb-4">
                <h5 class="card-header">Prescriptions <a href="prescription?id=<?= security('id', 'GET') ?>" class="btn btn-primary" style="width: fit-content;">ADD</a></h5>
                
                <?php
                if (!empty($prescriptions)) { ?>
                    <div class="table-responsive mb-3" style="padding:0.5em;">
                        <table class="datatables-basic table border-top">
                            <thead>
                                <tr>
                                    <th></th>

                                    <th>id</th>
                                    <th>Client</th>
                                    <th>Code</th>
                                    <th>Meds</th>
                                    <th>PDF</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cnt = 1;
                                foreach ($prescriptions as $prescription) {
                                    $prescription_id = encrypt($prescription['prescription_id']);
                                ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $cnt ?></td>
                                        <td> <?= get_by_id('user', $prescription['user_id'])['user_name'] ?> </td>
                                        <td> <?= $prescription['prescription_code'] ?> </td>
                                        <td>
                                            <a href="view_meds?id=<?= $prescription_id ?>" class="btn btn-primary">
                                                View
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= pdf_uri ?>?id=<?= $prescription_id ?>" class="btn btn-primary">
                                                Send to User
                                            </a>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                <?php
                                    $cnt++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                <?php
                } else { ?>
                    <p>This Patient Does Not Have Any Prescriptions Yet</p>
                <?php
                }
                ?>
            </div>
            <!-- /Project table -->

            <!-- Activity Timeline -->
            <div class="card mb-4">
                <h5 class="card-header">Past Sessions</h5>
                <?php
                if (!empty($user_past)) { ?>
                    <div class="card-body">
                        <!-- Activity Timeline -->
                        <ul class="timeline">
                            <?php
                            foreach ($user_past as $past) { ?>
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
                        <!-- /Activity Timeline -->
                    </div>
                <?php
                } else { ?>
                    <div class="card-body">
                        <p>No Past Sessions With This Patient</p>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- /Activity Timeline -->


            <!-- Activity Timeline -->
            <div class="card mb-4">
                <h5 class="card-header">Upcoming Sessions</h5>
                <?php
                if (!empty($user_next)) { ?>
                    <div class="card-body">
                        <!-- Activity Timeline -->
                        <ul class="timeline">
                            <?php
                            foreach ($user_next as $next) { ?>
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Session <?= $next['session_code'] ?> </h6>
                                            <small class="text-muted">on <?= get_ordinal_month_year($next['session_date']) ?></small>
                                        </div>
                                        <p class="mb-2">With: <?= get_by_id('user', $next['client_id'])['user_name'] ?></p>
                                        <p class="mb-2">Mode: <?= ucwords($next['session_mode']) ?></p>
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
                        <!-- /Activity Timeline -->
                    </div>
                <?php
                } else { ?>
                    <div class="card-body">
                        <p>No Upcoming Sessions With This Patient</p>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- /Activity Timeline -->


            <!-- Activity Timeline -->
            <div class="card mb-4">
                <h5 class="card-header">Uploads <a href="upload?id=<?= security('id', 'GET') ?>" class="btn btn-primary" style="width: fit-content;">ADD</a></h5>
                <?php
                if (!empty($uploads)) { ?>


                    <div class="card-body">
                        <?php
                        foreach ($uploads as $file) {
                        ?>
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>
                                        NAME: <?= $file['upload_name'] ?>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <p>
                                        UPLOADED ON: <?= $file['upload_date_created'] ?>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <a href="<?= doc_url . $file['upload_file'] ?>" class="btn btn-primary">
                                        DOWNLOAD
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                } else { ?>
                    <div class="card-body">
                        <p>This Patient Has Not Uploaded Any Records</p>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- /Activity Timeline -->

        </div>
        <!--/ User Content -->
    </div>


</div>

<?php include_once 'footer.php'; ?>