<?php 
include('include/header.php');
include('include/navbar.php');
?>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>


    <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">POS</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
             
                </div>
            </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <?php include('tab/tab.php')?>
                <input type='text' class='form-control' id='barcode-input' onkeydown ="getProd(this.value)">
             
            </div>
            
            <?php include('include/footer.php'); ?>
            <?php include('include/script.php'); ?>

            

<script>
            var barcode = '';
            var interval;
            document.addEventListener('onKeyPress', function(evt) {
                if (interval)
                    clearInterval(interval);
                if (evt.code === 13) {
                    if (barcode)
                        handleBarcode(barcode);
                    barcode = '';
                    return;
                }
                if (evt.key != 'Shift')
                    barcode += evt.key;
                interval = setInterval(() => barcode = '', 1000);
            });

            function handleBarcode(scanned_barcode) {
                document.querySelector('#barcode-input').innerHTML = scanned_barcode; 
            }
</script>



            