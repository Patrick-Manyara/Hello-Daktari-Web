<?php
$page        = 'doc_category';
$header_name = 'all_categories';

require_once '../path.php';
require_once 'header.php';

$category = get_by_id('doc_category', security('id', 'GET'));

if (!empty($category)) {
    session_assignment(array(
        'edit' => $category['doc_category_id']
    ), false);
    $require = false;
} else {
    $require = true;
}
?>
<div class="content-wrapper"><!-- Begin Page Content -->

    <div class="container-fluid">
        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mr-5 ml-5">
            <div class="card-body card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Add category
                    </h3>
                </div>
                <div class=" m-5">
                    <form method="post" enctype="multipart/form-data" action="<?= model_url ?>simple&table=doc_category&url=view_doc_categories">
                <?php  ?>
                <div class="row clearfix m-2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Name", "doc_category_name", $category, true);
                       
                        textarea_input("Description", "doc_category_description", $category, false);
                        
                        ?>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <?= submit('Submit', 'info', 'text-center'); ?>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->


    <?php include_once 'footer.php'; ?>