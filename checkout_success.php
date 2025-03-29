<?php
$page = 'home';
include_once 'header.php';
$oid = $_GET['oid'];



// build_sql_edit('orders', $arr, $oid, 'orders_id');


?>

<!--====== Page Title Start ======-->
<section class="page-title-area page-title-bg" style="background-image: url(assets/img/section-bg/page-title.jpg);">
    <div class="container">
        <h1 class="page-title">&nbsp;</h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home</a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li>Checkout Success</li>
        </ul>
    </div>
</section>
<!--====== Page Title End ======-->

<!--====== Contact Info Section Start ======-->
<section class="section-gap contact-top-wrappper">
    <div class="container">
       <h3>Your payment was successful</h3>
       </div>

</section>
<!--====== Contact Info Section End ======-->

<style>
    .form-check-input {
        height: 1em;
        position: inherit;
        width: auto;
        margin: 0em 1em;
    }

    .ShippingArea {}

    .SingleShipping {
        margin: 2em 0em;
        border-radius: 2px;
        border-bottom: 1px solid #D1D1D8;
    }

    .TransInput {
        border: none;
    }

    .MySpan {
        font-size: 0.8em;
        font-style: normal;
        font-weight: 200;
    }

    .Remove {
        color: #E14B4B;
    }
    
    
    
    table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
</style>

<?php
include_once 'footer.php';
?>