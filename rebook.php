<?php
include_once 'header.php';
function timeslots($data, $dt = array())
{
    $days = array();
    $start_date = new DateTime();
    $interval = new DateInterval('P1D'); // 1 day interval
    for ($i = 0; $i < 7; $i++) {
        $day = $start_date->format('D');
        $date = $start_date->format('Y-m-d');
        $day_data = array('day' => $day, 'date' => $date, 'times' => array());

        foreach ($data as $entry) {
            if ($entry['day'] === strtolower($day)) {
                $day_data['times'][] = array('start_time' => $entry['start_time'], 'end_time' => $entry['end_time']);
            }
        }

        if (!empty($day_data['times'])) {
            $days[] = $day_data;
        }

        $start_date->add($interval);
    }

    foreach ($dt as $item) {

        foreach ($days as $key => $item2) {

            if ($item['session_date'] == $item2['date']) {

                foreach ($item2['times'] as $key2 => $item3) {
                    // cout($item3);
                    if (strtotime($item3['start_time']) == strtotime($item['time'])) {
                        // echo $item['time'];
                        unset($days[$key]['times'][$key2]);
                    }
                }
            }
        }
    }

    return $days;
}



if (isset($_SESSION['login'])) {
    $column = 'user_id';
    $value = $_SESSION['user_id'];
} else {
    $column = 'device_id';
    $value = $_COOKIE['device'];
}

$doctors = get_rebook_doctor($_GET['tid']);
// echo $_GET['tid'];
?>

<style>
    .cnt {
        max-width: 800px;

        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

        margin: 0 auto;
        margin-top: 11em;
        margin-bottom: 20px;
    }

    h2 {
        margin-top: 10px;
        font-size: 16px;
        font-weight: bold;
        color: #1da1f2;
    }

    .time-slots {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .time-slot {
        width: calc(100% / 3 - 10px);
        margin: 5px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        padding: 10px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .time-slot:hover {
        transform: scale(1.05);
    }

    .time-slot.selected {
        background-color: #1da1f2;
        color: #ffffff;
    }

    .time-slot p {
        margin: 0;
        /* remove default margin */
        font-size: 16px;
        /* adjust font size as desired */
        font-weight: bold;
        /* make text bold */
        text-align: center;
        /* center text horizontally */
        line-height: 1.2;
        /* adjust line height as desired */
    }

    .selected p {
        color: #fff;
    }

    .time-slot.selected:hover {
        transform: scale(1);
    }

    .time-slot:not(.available) {
        background-color: #e1e8ed;
        cursor: not-allowed;
    }

    .time-slot:not(.available):hover {
        transform: scale(1);
    }

    .cnt-btn-container {
        background-color: #f2f2f2;
        border-radius: 10px;
        display: flex;
        justify-content: flex-end;
        padding: 10px 20px;
        margin-top: 20px;
    }

    .cnt-btn {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .cnt-btn:hover {
        background-color: #3e8e41;
    }

    .no-timeslots {
        font-weight: bold;
        text-align: center;
        margin-top: 1rem;
    }
</style>


<?php
foreach ($doctors as $doctor) {
    $doctorname = get_by_id('doctor', $doctor['doctor_id'])['doctor_name'];
    $sql = "select weekly_schedule.* from weekly_schedule
    join calendar_info on calendar_info.id = weekly_schedule.calendar_info_id
    where calendar_info.tid = '$doctor[doctor_id]'
    ";


    $data = select_rows($sql);

    $sql = "select * from session where doctor_id = '$doctor[doctor_id]'";
    $dt = select_rows($sql);

    foreach ($dt as $key => $item) {
        $time = $item['session_start_time'];
        $dt[$key]['time'] = $time;
    }
    // cout($dt)
?>
    <div class="cnt">
        <p><b><?= $doctorname ?></b></p>
        <h4 style="margin:20px">Book a time to schedule your session</h4>
        <?php if (empty($data)) { ?>
            <div class="no-timeslots">This doctor has no available time slots at the moment.</div>
        <?php } ?>
        <?php
        $time_slots = timeslots($data, $dt);
        foreach ($time_slots as $time_slot) {
            $date = $time_slot['date'];
            $day = $time_slot['day'];
            $times = $time_slot['times'];
        ?>

            <h2><?php echo $day . " - " . $date; ?></h2>
            <div class="time-slots">
                <?php
                foreach ($times as $time) {
                    $start_time = $time['start_time'];
                    $end_time = $time['end_time'];
                    $available = true; // Replace with logic to check if the time slot is available

                    if ($available) {
                        $class = "time-slot available";
                    } else {
                        $class = "time-slot";
                    }
                ?>
                    <div class="<?php echo $class; ?>" data-date="<?php echo $date; ?>" data-id="<?= $doctor['bookmark_id'] ?>" data-time="<?php echo $start_time . "-" . $end_time; ?>" onclick="bookTimeSlot(this)">
                        <p><?php echo $start_time; ?> - <?php echo $end_time; ?></p>
                    </div>
                <?php  } ?>
            </div>
        <?php } ?>

        <form method="post" enctype="multipart/form-data" action="<?= model_url ?>session_update" id="proceed<?= $doctor['bookmark_id'] ?>" style="display:none">
            <input type="hidden" name="date" id="date<?= $doctor['bookmark_id'] ?>">
            <input type="hidden" name="time" id="time<?= $doctor['bookmark_id'] ?>">
            <input type="hidden" name="doctor_id" value="<?= $_GET['tid'] ?>">
            <div class="cnt-btn-container">
                <button type="submit" class="cnt-btn">Proceed</button>
            </div>
        </form>
    </div>


<?php
}
?>
<script>
    function bookTimeSlot(slot) {
        // Toggle the 'selected' class of the clicked time slot
        const timeSlots = document.querySelectorAll('.time-slot');
        <?php
        foreach ($doctors as $col) { ?>
            // Check if the clicked slot is already selected
            if (!slot.classList.contains('selected')) {
                let date = slot.getAttribute('data-date');
                let time = slot.getAttribute('data-time');
                let bid = slot.getAttribute('data-id');
                $("#date" + bid).val(date);
                $("#time" + bid).val(time);
                $("#proceed" + bid).show();
                console.log('Selected timeslot:', {
                    date,
                    time
                });
            }
            timeSlots.forEach((ts) => ts.classList.remove('selected'));
            slot.classList.toggle('selected');

        <?php
        }
        ?>
    }
</script>
<?php
include_once 'footer.php';
?>