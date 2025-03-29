<?php
$page = 'schedule';
require_once '../path.php';
include_once 'header.php';

$sql = "select * from doctor where doctor_id = '$_SESSION[doctor_id]'";
$token = select_rows($sql)[0]['doctor_id'];
$conn = connect();
$sql = "select * from calendar_info where tid = '$token'";
$calendar  = select_rows($sql);
if (empty($calendar)) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://hello.angacinemas.com/model/calendar_info.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('start_time' => '08:00', 'slot_minutes' => '60', 'token' => $token),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $calendar  = select_rows($sql);
    echo $response;
}

$calendar = $calendar[0];
$sql = "select * from weekly_schedule where calendar_info_id = '$calendar[id]'";
$wk = select_rows($sql);
$days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
if (empty($wk)) {
    foreach ($days as $vl) {
        $$vl = false;
    }
} else {
    foreach ($days as $vl) {
        $sql = "select * from weekly_schedule where calendar_info_id = '$calendar[id]' and day = '$vl'";
        $wkid = select_rows($sql);
        if (!empty($wkid)) {
            $wkid = $wkid[0]['id'];
            $n = $vl . "_id";
            $$n = $wkid;
            $$vl = true;
        } else {
            $$vl = false;
        }
    }
}
?>

<div id="overlay2">
    <div id="text">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">doctor /</span> Create A Schedule</h4>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card mb-4">
                <h5 class="card-header">Schedule</h5>


                <div class="card-body">
                    <h3 class="m-3">
                        You are editing your schedule
                    </h3>

                    <div class="badge badge-success m-2" style="display:none" id="suc">
                        <p>changes have been successfully updated</p>
                    </div>

                    <div class="row">
                        <section class="connectedSortable col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Service Time period</h3>
                                </div>
                                <div class="card-body">


                                    <div class="form-group">
                                        <label>
                                            How long in minutes does your session take (1hr = 60min)
                                        </label>
                                        <input type="number" value="<?= $calendar['slot_minutes'] ?>" onchange="mymin(this.value)" class="form-control" id="min">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            What time do you start?
                                        </label>
                                        <input type="time" value="<?= $calendar['start_time'] ?>" onchange="mytime(this.value)" class="form-control" id="start_time">
                                    </div>

                                    <!-- Bootstrap Switch -->
                                    <div class="card card-indigo">
                                        <div class="card-header">
                                            <h3 class="card-title">Select general available days</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php foreach ($days as $value) { ?>
                                                    <div class="col">
                                                        <p style="text-transform:uppercase;"><?= $value ?></p>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" <?php
                                                                                    if ($$value) {
                                                                                        echo "checked";
                                                                                    }
                                                                                    ?> class="custom-control-input" id="<?= $value ?>">
                                                            <label class="custom-control-label" for="<?= $value ?>"></label>
                                                        </div>
                                                    </div>
                                                <?php  }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                        <section class="connectedSortable col-md-6">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        weekly schedule
                                    </h3>
                                </div>
                                <div class="card-body">

                                    <?php
                                    $arr = ["mon", "tue", "wed", "thu", "fri", "sat", "sun"];
                                    $arr2 = ["primary", "dark", "indigio", "blue", "pink", "info", "danger"];
                                    foreach ($arr as $key => $value) {
                                        $n = $value . "_id";
                                    ?>
                                        <div id="<?= $value ?>card" class="card card-<?= $arr2[$key] ?>">
                                            <div class="card-header">
                                                <h3 class="card-title" style="text-transform:uppercase;"><?= $value ?></h3>
                                                <div class="card-tools">
                                                    <Button class="btn btn-success" id="addcols<?= $value ?>">
                                                        <i class="fa fa-plus"></i>
                                                    </Button>

                                                </div>

                                            </div>
                                            <div class="card-body">
                                                <input type="hidden" value="1" id="cols<?= $value ?>">

                                                <div class="row mb-1" id="col-1">
                                                    <div class="col-2">
                                                        <input type="text" id="<?= $value ?>stime" style="width:70px" class="form-control" readonly value="10:00">
                                                    </div>

                                                    <div class="col-2">
                                                        <i class="fa fa-minus  ml-2 mt-2"></i>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" id="<?= $value ?>etime" style="width:70px" class="form-control" readonly value="11:00">
                                                    </div>
                                                </div>
                                                <div id="colparent<?= $value ?>"></div>

                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<style>
    #overlay2 {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 2;
        cursor: pointer;
    }

    #text {
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 50px;
        color: white;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
    }
</style>

<script>
    function suc() {
        $("#suc").show();
        setTimeout(function() {
            $("#suc").hide();
        }, 1000);
    }

    function myfunction(val, id, day) {
        $("#overlay2").show();
        var form = new FormData();
        form.append("token", "<?= $token ?>");
        form.append("id", id);
        var settings = {
            "url": "https://hello.angacinemas.com/model/delete_slot.php",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Cookie": "PHPSESSID=7e04c50846483facaa7e4b1603f34814"
            },
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form
        };
        $.ajax(settings).done(function(response) {
            $("#overlay2").hide();
            suc();
            console.log(response);
        });
        $("#" + val).remove();
        let newcolnumber = parseInt($("#cols" + day).val()) - 1;
        $("#cols" + day).val(newcolnumber);

    }

    function delete_day(day) {

        $("#overlay2").show();
        var form = new FormData();
        form.append("day", day);
        form.append("token", "<?= $token ?>");
        form.append("calendar_info_id", "<?= $calendar['id'] ?>");


        var settings = {
            "url": "https://hello.angacinemas.com/model/delete_day.php",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Cookie": "PHPSESSID=7e04c50846483facaa7e4b1603f34814"
            },
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form
        };

        $.ajax(settings).done(function(response) {
            $("#overlay2").hide();
            suc();
        });
    }

    function delete_slots() {

        $("#overlay2").show();
        var form = new FormData();
        form.append("token", "<?= $token ?>");
        form.append("calendar_info_id", "<?= $calendar['id'] ?>");


        var settings = {
            "url": "https://hello.angacinemas.com/model/delete_slots.php",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Cookie": "PHPSESSID=7e04c50846483facaa7e4b1603f34814"
            },
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form
        };

        $.ajax(settings).done(function(response) {
            $("#overlay2").hide();
            suc();
        });
    }
    async function insert_schedule(start_time, end_time, day) {

        $("#overlay2").show();
        var form = new FormData();
        form.append("start_time", start_time);
        form.append("end_time", end_time);
        form.append("day", day);
        form.append("token", "<?= $token ?>");
        form.append("calendar_info_id", "<?= $calendar['id'] ?>");

        var settings = {
            "url": "https://hello.angacinemas.com/model/schedule.php",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Cookie": "PHPSESSID=7e04c50846483facaa7e4b1603f34814"
            },
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form
        };

        let id = $.ajax(settings).done(function(response) {
            $("#overlay2").hide();
            suc();
        });
        return id;
    }

    function changedb() {
        $("#overlay2").show();
        var form = new FormData();
        form.append("start_time", $("#start_time").val());
        form.append("slot_minutes", $("#min").val());

        form.append("token", "<?= $token ?>");
        var settings = {
            "url": "https://hello.angacinemas.com/model/calendar_info.php",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Cookie": "PHPSESSID=7e04c50846483facaa7e4b1603f34814"
            },
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form
        };

        $.ajax(settings).done(function(response) {
            $("#overlay2").hide();
            suc();
        });
    }

    function add_time(start_time, val) {
        var today = new Date();

        var oldtime = new Date(today.toDateString() + ' ' + start_time).getTime();
        var addMlSeconds = parseInt(val) * 1000 * 60;
        var newDateObj = new Date(oldtime + addMlSeconds);
        var mins = newDateObj.getMinutes();
        var hr = newDateObj.getHours();

        if (mins < 10) {
            mins = "0" + mins;
        }
        if (hr < 10) {
            hr = "0" + hr;

        }
        return (hr + ":" + mins);
    }

    function mymin(val) {
        //$("#overlay2").show();
        let newTime = add_time($("#start_time").val(), val);
        <?php foreach ($arr as $value) { ?>
            $("#<?= $value ?>stime").val($("#start_time").val());
            $("#<?= $value ?>etime").val(newTime);
            delete_slots();
            $("#colparent<?= $value ?>").text('');
        <?php } ?>
        changedb();
    }

    function mytime(val) {
        let newTime = add_time(val, $("#min").val());

        <?php foreach ($arr as $value) { ?>
            $("#<?= $value ?>stime").val($("#start_time").val());
            $("#<?= $value ?>etime").val(newTime);
            $("#colparent<?= $value ?>").text('');
            delete_slots();
        <?php } ?>
        changedb();
    }

    $(document).ready(function() {

        let newcolnumber = "";
        let start_time = "";
        let end_time = "";
        let wk_id = "";
        let vl = "";
        let r = "";
        let newTime = add_time($("#start_time").val(), <?= $calendar['slot_minutes'] ?>);
        <?php foreach ($arr as $value) {
            $n = $value . "_id";
        ?>
            $("#<?= $value ?>stime").val($("#start_time").val());
            $("#<?= $value ?>etime").val(newTime);

            <?php if ($$value) { ?>
                $("#<?= $value ?>card").show();
                <?php
                $sql = "select * from weekly_schedule where calendar_info_id = '$calendar[id]' and day = '$value'";
                $ff = select_rows($sql);
                $i = 1;
                foreach ($ff as $key => $item) {
                    if ($i != 1) {
                ?>
                        newcolnumber = <?= $i ?>;
                        start_time = "<?= $item['start_time'] ?>";
                        end_time = "<?= $item['end_time'] ?>";

                        wk_id = <?= $item['id'] ?>;
                        vl = "<?= $value ?>col_" + newcolnumber;
                        r = '<div class="mb-1 row" id="<?= $value ?>col_' + newcolnumber + '">' +
                            '<div class="col-2">' +
                            '<input class="form-control" id="<?= $value ?>stime_col' + newcolnumber + '" readonly style="width:70px" value="' + start_time + '">' +
                            '</div>' +
                            '<div class="col-2">' +
                            '<i class="fa fa-minus ml-2 mt-2"></i>' +
                            '</div>' +
                            '<div class="col-2">' +
                            '<input class="form-control" id="<?= $value ?>etime_col' + newcolnumber + '"readonly style="width:70px" value="' + end_time + '">' +
                            '</div>' +
                            '<div class="mt-2 col-1">' +
                            '<i onclick = "myfunction(\'' + vl + '\',\'' + wk_id + '\',\'<?= $value ?>\')" class="fa-trash fas"></i>' +
                            '</div>' +
                            '</div>';
                        $("#colparent<?= $value ?>").append(r);
                        $("#cols<?= $value ?>").val(newcolnumber);
                <?php
                    }
                    $i++;
                } ?>
            <?php } else {  ?>
                $("#<?= $value ?>card").hide();
            <?php } ?>
            $('#<?= $value ?>').change(function() {
                let val = $(this).is(':checked');
                if (val) {
                    $("#<?= $value ?>card").show();
                    var start_time = $("#start_time").val();
                    var end_time = newTime;

                    var day = "<?= $value ?>";
                    insert_schedule(start_time, end_time, day);
                } else {
                    $("#<?= $value ?>card").hide();
                    $("#colparent<?= $value ?>").text('');
                    delete_day("<?= $value ?>");
                }
            });
            $("#addcols<?= $value ?>").click(async function() {
                let colnumber = parseInt($("#cols<?= $value ?>").val());
                let newcolnumber = colnumber + 1;
                let st = $("#start_time").val();
                let mins = parseInt($("#min").val());
                let start_time = add_time(st, (mins * colnumber));
                let end_time = add_time(st, (mins * (newcolnumber)));
                let vl = "<?= $value ?>col_" + newcolnumber;
                insert_schedule(start_time, end_time, "<?= $value ?>").then((res) => {
                    console.log(res);
                    let wk_id = res;
                    let r = '<div class="mb-1 row" ' +
                        'id="<?= $value ?>col_' + newcolnumber + '">' +
                        '<div class="col-2"><input class="form-control" id="<?= $value ?>' +
                        'stime_col' + newcolnumber + '" readonly style="width:70px" value="' + start_time + '">' +
                        '</div><div class="col-2"><i class="fa fa-minus ml-2 mt-2"></i></div>' +
                        '<div class="col-2"><input class="form-control" ' +
                        'id="<?= $value ?>etime_col' + newcolnumber + '"readonly style="width:70px" ' +
                        'value="' + end_time + '"></div>' +
                        '<div class="mt-2 col-1">' +
                        '<i onclick = "myfunction(\'' + vl + '\',\'' + wk_id + '\',\'<?= $value ?>\')" class="fa-trash fas"></i>' +
                        '</div></div>';
                    $("#colparent<?= $value ?>").append(r);
                    $("#cols<?= $value ?>").val(newcolnumber);
                })
            });
        <?php } ?>
    });
</script>
<?php include_once 'footer.php'; ?>