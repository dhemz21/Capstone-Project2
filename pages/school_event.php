<!DOCTYPE html>
<html lang="en">

<body>
<div class="container">
        <div class="card rounded-0 border-0 shadow-lg">
            <h5 class="card-header rounded-0 bg-danger">evsu scanner</h5>
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
                <p class="text-center"><a href=".?page=offline" class="text-decoration-none">Data offline</a> </p>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="vendors/instascan/instascan.min.js"></script>


    <!-- QR CODE SCANNER SECTION -->
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview'),
            mirror: false,
            captureImage: true,
            rotation: 90
        });
        scanner.addListener('scan', function(content) {
            console.log(content);
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                // if the user has a rear/back camera 
                if (cameras[1]) {
                    // Use that by default
                    scanner.start(cameras[1]);
                } else {
                    scanner.start(cameras[0]);
                }
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('text').value = c;
            document.forms[0].submit();
        });
    </script>
    <!-- END --> 
</body>
</html>