<?php
$page = 'signature';
require_once '../path.php';
require_once 'header.php';

?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link" href="my_profile"><i class="bx bx-user me-1"></i> Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);"><i class="bx bx-lock-alt me-1"></i> Security</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="edit_profile"><i class="bx bx-detail me-1"></i>Edit Profile</a>
                </li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->

                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <canvas id="signatureCanvas" width="400" height="200"></canvas>
                        <button id="saveSignature" class="btn btn-primary">Save Signature</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<style>
    #signatureCanvas {
        border: 1px solid black;
    }
</style>


<script>
    const canvas = document.getElementById('signatureCanvas');
    const signatureDataInput = document.getElementById('signature_data');
    const context = canvas.getContext('2d');
    let isDrawing = false;

    canvas.addEventListener('mousedown', () => {
        isDrawing = true;
        context.beginPath();
    });

    canvas.addEventListener('mousemove', (e) => {
        if (!isDrawing) return;
        context.lineWidth = 2;
        context.lineCap = 'round';
        context.strokeStyle = 'black';
        context.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
        context.stroke();
    });

    canvas.addEventListener('mouseup', () => {
        isDrawing = false;
    });



    const saveButton = document.getElementById('saveSignature');

    saveButton.addEventListener('click', () => {
        const signatureDataUrl = canvas.toDataURL('image/png');

        fetch('create.php', {
                method: 'POST',
                body: JSON.stringify({
                    signatureData: signatureDataUrl
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message); // Assuming your PHP script returns a JSON response
                alert(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>


<?php include_once 'footer.php'; ?>