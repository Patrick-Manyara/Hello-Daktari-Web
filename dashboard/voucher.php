<?php
$page = 'voucher';
$header_name = 'vouchers';

require_once '../path.php';
include_once 'header.php';

$voucher = get_by_id('voucher', security('id', 'GET'));

if (!empty($voucher)) {
    session_assignment(array(
        'edit' => $voucher['voucher_id']
    ), false);
}


$companys     = get_dropdown_data(get_all('company'), 'company_name', 'company_id');
?>


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?= ucwords($header_name) ?> /</span> Create A Voucher</h4>

    <div class="row">
        <div class="col-md-10 col-lg-10 col-sm-12">
            <div class="card mb-4">
                <form method="post" id="quickForm" enctype="multipart/form-data" action="<?= model_url ?>simple&table=voucher&url=view_vouchers">
                    <div class="card-body">
                        <div>
                            <?php
                            input_hybrid("Voucher Code", "voucher_code", $voucher, $required);
                            input_select_array("Link to Film(optional)?", "company_id", $voucher, $required, $companys);
                            ?>
                        </div>
                        <?php submit("Submit Data", "primary", "center", "mt-5"); ?>
                </form>
            </div>
        </div>

    </div>
</div>


<?php include_once 'footer.php'; ?>