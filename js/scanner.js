// <!-- QR CODE SCANNER SECTION -->

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
// <!-- END --> 