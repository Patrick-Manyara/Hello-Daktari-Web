<?php
$page = 'manager';
include_once 'header.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Project Managers /</span> Create A Project Manager</h4>

    <div class="row">
        <div class="col-md-10 col-lg-10 col-sm-12">
            <div class="card mb-4">
                <h5 class="card-header">Default</h5>
                <div class="card-body">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Name</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                        <div id="defaultFormControlHelp" class="form-text">
                            We'll never share your details with anyone else.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<?php include_once 'footer.php'; ?>