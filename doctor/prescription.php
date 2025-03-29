<?php
$page = 'prescription';
require_once '../path.php';
require_once 'header.php';

$products   = json_products();

$patients   = get_dropdown_data(get_patients($_SESSION['doctor_id']), 'user_name', 'user_id');
$tests      = get_all('lab');
?>

<head>
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/typeahead-js/typeahead.css" />
</head>

<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->

    <form enctype="multipart/form-data" action="<?= model_url ?>prescription" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Patient Details </h3>
                </div>
                <div class="mt-4">
                    <div class="row clearfix m-2">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input hidden name="user_id" value="<?= $_GET['id'] ?>" />
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php
                            textarea_input("prescription_allergies", "prescription_allergies", $row, true);
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Prescription Details </h3>
                </div>
                <div class="mt-4">
                    <div class="row clearfix m-2">
                        <div class="MedicationRow">
                            <p class="MedicationCounter">MEDICINE 1</p>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="form-label">Medicine Name</label>
                                <input class="form-control typeahead" type="text" autocomplete="off" name="medication_name[]" placeholder="Enter name of medicine" />
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                    <div class="form-group ">
                                        <label>medication_dose</label>
                                        <input type="text" required class="form-control" name="medication_dose[]" placeholder="medication_dose" autocomplete="on">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                    <div class="form-group ">
                                        <label>medication_route</label>
                                        <input type="text" required class="form-control" name="medication_route[]" placeholder="medication_route" autocomplete="on">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                    <div class="form-group ">
                                        <label>medication_frequency</label>
                                        <input type="text" required class="form-control" name="medication_frequency[]" placeholder="medication_frequency" autocomplete="on">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                    <div class="form-group ">
                                        <label>medication_duration</label>
                                        <input type="text" required class="form-control" name="medication_duration[]" placeholder="medication_duration" autocomplete="on">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="AdditionButton">
                            <button type="button" class="btn btn-primary" style="margin-top:1em;" id="add_medication_row">Add Another</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Lab Test Details </h3>
                </div>
                <div class="mt-4">
                    <div class="row clearfix m-2">

                        <div class="form-group">
                            <label for="prescription_tests"><?= ucfirst('Tests ') ?> : </label>
                            <select id="exampleFormControlSelect2" multiple data-placeholder="Select tests here" class="select2 form-control" name="prescription_tests[]">

                                <?php foreach ($tests as $value) {
                                    $lab_id = $value['lab_id'];
                                ?>
                                    <option value="<?= $lab_id ?>"><?= ucwords($value['lab_care_name']) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <?= submit('Submit', 'dark', 'text-center'); ?>
            </div>
        </div>
    </form>
</div>

<script src="<?= admin_url ?>assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="<?= admin_url ?>assets/js/forms-typeahead.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/bloodhound/bloodhound.js"></script>

<script>
    $(function() {
        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substrRegex;
                matches = [];
                substrRegex = new RegExp(q, 'i');
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };

        var states = <?php echo $products; ?>;

        if (isRtl) {
            $('.typeahead').attr('dir', 'rtl');
        }

        function initializeAutocomplete(inputElement) {
            inputElement.typeahead({
                hint: !isRtl,
                highlight: true,
                minLength: 1
            }, {
                name: 'states',
                source: substringMatcher(states)
            });
        }

        // Initialize autocomplete for the initial input
        initializeAutocomplete($('.typeahead'));

        var rowCounter = 1;

        // Add click event listener to the "Add Another" button
        $("#add_medication_row").click(function() {
            rowCounter++;

            var clonedRow = $(".MedicationRow").first().clone();

            clonedRow.find(".MedicationCounter").text("MEDICINE " + rowCounter);
            clonedRow.find("input").val("");

            // Initialize autocomplete for the cloned row input
            initializeAutocomplete(clonedRow.find('.typeahead'));

            $(".AdditionButton").before(clonedRow);
        });
    });
</script>


<?php include_once 'footer.php'; ?>