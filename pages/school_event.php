<!DOCTYPE html>
<html lang="en">

<?php
session_start();

?>

<body>
    <div class="container">
        <div class="card rounded-0 border-0 shadow-lg" id="main-container">
            <h5 class="card-header rounded-0" id="top-color">evsu scanner</h5>
            <div class="card-body">
                <form method="post" action=".?folder=action/&page=save_qrcode_event" novalidate>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <video id="preview" width="100%"> </video>

                            </div>
                            <div class="col-12">
                                <div class="input-group mb-2">
                                    <input type="text" class="input form-control rounded-0" name="text" id="text" readonly placeholder="Place your QR code in the camera" />
                                </div>
                            </div>
                            <div class="col-12 mb-2 mt-4">
                                <p class="text-start"><a href=".?page=menu" class="text-decoration-none">Go Back</a> </p>
                            </div>
                            <div class="col-12 mb-2 mt-4">
                                <p class="text-center"><a href=".?page=offline" class="text-decoration-none">Saved offline</a> </p>
                            </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="vendors/instascan/instascan.min.js"></script>

    <?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'successful') {
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Successful',
                text: 'You successfully registered online!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>

    <?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'offline-successful') {
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Successful',
                text: 'No internet! Your data has been saved locally'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>


    <?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'existed') {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Data Existed ',
                text: 'This data is already existed!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>

    <?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'offline-existed') {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Data Existed ',
                text: 'This data is already existed!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>


    <!-- QR CODE VALIDATION SECTION -->
    <?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] != '') {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid QR Code ',
                text: 'Please check your QR Code!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>
    <!-- END -->

    <script src="js/scanner.js"></script>
</body>

</html>