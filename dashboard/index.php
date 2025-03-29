<?php
$page        = 'dashboard';
$header_name = 'Home';

require_once '../path.php';
require_once 'header.php';


$past_sessions  = get_past_sessions();
$next_sessions  = get_upcoming_sessions();

$connection = connect();


// Get the current month (numerical value, 1 for January, 2 for February, etc.)
$currentMonth = date('n');
$currentYear = date('Y');

// Array to store session counts per month
$sessionCounts = [];

// Array of month names
$monthNames = [
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December',
];

// Array to store the last 12 months in full names
$last12Months = [];

// Loop through the last 12 months, starting from the current month
for ($i = 0; $i < 12; $i++) {
    // Calculate the month index, considering the year boundaries
    $monthIndex = ($currentMonth - $i) <= 0 ? ($currentMonth - $i + 12) : ($currentMonth - $i);
    // Get the month name
    $monthName = $monthNames[$monthIndex];
    // Add the month name to the array
    $last12Months[] = $monthName;
}

for ($i = 0; $i < 12; $i++) {
    // Calculate the month and year for the current iteration
    $month = $currentMonth - $i;
    $year = $currentYear;

    // Adjust the month and year if necessary to handle year boundaries
    if ($month <= 0) {
        $month += 12;
        $year--;
    }

    // Convert the month to a two-digit format (e.g., 02 for February)
    $month = sprintf('%02d', $month);

    // Calculate the number of days in the current month
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Create the start and end dates for the current month
    $startDate = "$year-$month-01";
    $endDate = "$year-$month-$daysInMonth";

    // SQL query to count sessions for the current month
    $sqlQuery = "SELECT COUNT(*) AS session_count FROM session 
                 WHERE session_date >= '$startDate' AND session_date <= '$endDate'";
    

    // Execute the query and fetch the result
    $result = $connection->query($sqlQuery);
    $row = $result->fetch_assoc();

    // Store the session count in the array with the month name as the key
    $sessionCounts[] = (int)$row['session_count'];
}


// Reverse the array to get the months in the correct order (from current to past)
$last12Months = array_reverse($last12Months);
$last12Months = json_encode($last12Months);

$sessionCounts = array_reverse($sessionCounts);
$sessionCounts = json_encode($sessionCounts);

?>

<head>
    <script src="assets/js/charts-apex.js"></script>
</head>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Welcome <?= $_SESSION['admin_name'] ?>! 🎉</h5>
                            <p class="mb-4">
                                Welcome to the <?= APP_NAME ?> administrative dashboard. Manage and view all activities being undertaken on the website from this platform.
                            </p>

                            <a href="javascript:;" class="btn btn-sm btn-label-primary">View Badges</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <!-- Line Chart -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Sessions</h5>
                        <small class="text-muted">Number of attempted session registrations per month</small>
                    </div>
                    <div class="d-sm-flex d-none align-items-center">
                        <h5 class="fw-bold mb-0 me-3"><?= sizeof(get_all_sessions()) ?> Sessions</h5>
                        <span class="badge bg-label-secondary">
                            <i class="bx bx-down-arrow-alt bx-xs text-danger"></i>
                            <span class="align-middle"></span>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div id="lineChart"></div>
                </div>
            </div>
        </div>
        <!-- /Line Chart -->
    </div>

    <div class="row">


        <?php
        if (!empty($past_sessions)) { ?>

            <!-- Activity Timeline -->
            <div class="col-md-12 col-lg-12 order-4 order-lg-3" style="margin-bottom:2em;">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Past Sessions</h5>

                    </div>
                    <div class="card-body">
                        <!-- Activity Timeline -->
                        <ul class="timeline">
                            <?php
                            foreach ($past_sessions as $past) { ?>
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Session <?= $past['session_code'] ?> </h6>
                                            <small class="text-muted">on <?= get_ordinal_month_year($past['session_date']) ?></small>
                                        </div>
                                        <p class="mb-2">doctor: <?= $past['doctor_name'] ?></p>
                                        <p class="mb-2">Client: <?= get_by_id('user', $past['client_id'])['user_name'] ?></p>
                                        <p class="mb-2">Mode: <?= ucwords($past['session_mode']) ?></p>
                                        <p class="mb-2">From: <?= get_hours_mins($past['session_start_time']) ?> . To: <?= get_hours_mins($past['session_end_time']) ?></p>

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
                </div>
            </div>
            <!--/ Activity Timeline -->

        <?php
        }

        if (!empty($next_sessions)) { ?>

            <!-- Activity Timeline -->
            <div class="col-md-12 col-lg-12 order-4 order-lg-3">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Upcoming Sessions</h5>

                    </div>
                    <div class="card-body">
                        <!-- Activity Timeline -->
                        <ul class="timeline">
                            <?php
                            foreach ($next_sessions as $next) { ?>
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Session <?= $next['session_code'] ?> </h6>
                                            <small class="text-muted">on <?= $next['session_date'] ?></small>
                                        </div>
                                        <p class="mb-2">doctor: <?= $past['doctor_name'] ?></p>
                                        <p class="mb-2">Client: <?= get_by_id('user', $next['client_id'])['user_name'] ?></p>
                                        <p class="mb-2">Mode: <?= $next['session_mode'] ?></p>
                                        <p class="mb-2">From: <?= get_hours_mins($next['session_start_time']) ?> . To: <?= get_hours_mins($next['session_end_time']) ?></p>
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
                </div>
            </div>
            <!--/ Activity Timeline -->

        <?php
        }
        ?>
    </div>

</div>
<!-- / Content -->

<!-- Page JS -->


<script>
    $(document).ready(function() {
        let cardColor, headingColor, labelColor, borderColor, legendColor;

        if (isDarkStyle) {
            cardColor = config.colors_dark.cardColor;
            headingColor = config.colors_dark.headingColor;
            labelColor = config.colors_dark.textMuted;
            legendColor = config.colors_dark.bodyColor;
            borderColor = config.colors_dark.borderColor;
        } else {
            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            labelColor = config.colors.textMuted;
            legendColor = config.colors.bodyColor;
            borderColor = config.colors.borderColor;
        }

        // Color constant
        const chartColors = {
            column: {
                series1: '#826af9',
                series2: '#d2b0ff',
                bg: '#f8d3ff'
            },
            donut: {
                series1: '#fee802',
                series2: '#3fd0bd',
                series3: '#826bf8',
                series4: '#2b9bf4'
            },
            area: {
                series1: '#29dac7',
                series2: '#60f2ca',
                series3: '#a5f8cd'
            }
        };
        // Line Chart
        // --------------------------------------------------------------------
        const lineChartEl = document.querySelector('#lineChart'),
            lineChartConfig = {
                chart: {
                    height: 200,
                    type: 'line',
                    parentHeightOffset: 0,
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    data: <?php echo $sessionCounts; ?>
                }],
                markers: {
                    strokeWidth: 7,
                    strokeOpacity: 1,
                    strokeColors: [cardColor],
                    colors: [config.colors.warning]
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                colors: [config.colors.warning],
                grid: {
                    borderColor: borderColor,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
                    padding: {
                        top: -20
                    }
                },
                tooltip: {
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '%</span>' + '</div>';
                    }
                },



                xaxis: {
                    categories: <?php echo $last12Months; ?>,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '13px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '13px'
                        }
                    }
                }
            };
        if (typeof lineChartEl !== undefined && lineChartEl !== null) {
            const lineChart = new ApexCharts(lineChartEl, lineChartConfig);
            lineChart.render();
        }

    })
</script>

<?php include_once 'footer.php'; ?>