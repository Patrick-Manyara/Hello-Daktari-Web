<?php
$page        = 'note';

require_once '../path.php';
require_once 'header.php';

$current_year   = date("Y");

$note = get_by_id('note', security('id', 'GET'));

if (!empty($note)) {
    session_assignment(array(
        'edit' => $note['note_id']
    ), false);
    $require = false;
} else {
    $require = true;
}

$sessions     = get_dropdown_data(get_all_sessions('', $_SESSION['doctor_id']), 'session_code', 'session_id');
?>


<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    Add notes </h3>
            </div>
            <div class="mt-4">
                <form enctype="multipart/form-data" action="<?= model_url ?>note" method="POST">
                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php
                            if (!isset($_GET['code'])) {
                                input_select_array("Session?", "session_id", $note, $require, $sessions);
                            } else { ?>
                                <input hidden name="session_id" value="<?= security('code', 'GET') ?>" />
                            <?php
                            }

                            textarea_input('Notes', 'note_text', $note, $require);
                            ?>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 text-center mt-4">
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>