<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container-fluid">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                </div>
            </div>
            <div class="col-lg-4 d-flex flex-column align-items-center justify-content-center shadow bg-white ">
                <div class="container-title w-100">
                    <h3 class="card-title p-3 text-center bg-danger text-white rounded-0">qr code scanner</h3>
                </div>

                <div class="mainpage mb-5">
                    <div class="mainpage-image">
                        <img src="img/evsu.png" alt="">
                    </div>
                    <div class="header-form">
                        <h4 class="card-title pb-2 text-center">Attendance Management System </h4>
                    </div>
                    <div class="Login-title">
                        <h4 class="login-title">Scanned Offline</h4>
                    </div>
                    <div class="d-flex col-12 align-items-center justify-content-center">
                        <div class="card m-1 rounded-0 d-flex col-12 align-items-center justify-content-center" style="width: 100%">
                            <div class="card-body">
                                <h5>
                                    <div class="btn btn-danger d-flex rounded-0" id="sync-btn">Sync now</div>

                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2 mt-4">
                        <p class="text-start"><a href=".?page=school_event" class="text-decoration-none">Go Back</a> </p>
                    </div>
                </div>
            </div>

    </div>
    </div>
    </div>
    </section>
    </div>

    <script>
    // Get the button element
    const syncBtn = document.getElementById('sync-btn');

    // Add an event listener to the button
    syncBtn.addEventListener('click', function() {
        // Get the attendance data from the local storage
        const attendanceData = JSON.parse(localStorage.getItem('attendanceData'));

        // Check if there is any data to sync
        if (!attendanceData) {
            alert('No data to sync!');
            return;
        }

        // Check for internet connection
        const xhr = new XMLHttpRequest();
        xhr.open('HEAD', 'https://jsonplaceholder.typicode.com/');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Send the attendance data to the sync.php file using an AJAX request
                    const syncXhr = new XMLHttpRequest();
                    syncXhr.open('POST', 'action/sync_data.php');
                    syncXhr.setRequestHeader('Content-Type', 'application/json');
                    syncXhr.send(JSON.stringify(attendanceData));

                    // When the AJAX request is complete, remove the attendance data from the local storage
                    syncXhr.onload = function() {
                        if (syncXhr.status === 200) {
                            // localStorage.removeItem('attendanceData');
                            console.log(xhr.responseText);
                            alert('Attendance data has been synchronized successfully!');
                        } else {
                            alert('An error occurred while synchronizing the attendance data.');
                        }
                    };
                } else {
                    alert('No internet connection!');
                }
            }
        };
        xhr.send();
    });
</script>

</body>

</html>