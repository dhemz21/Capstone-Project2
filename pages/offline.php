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
                    <h3 class="card-title p-3 text-center bg-danger text-white rounded-0">evsu scanner</h3>
                </div>

                <div class="mainpage mb-5">
                    <div class="mainpage-image">
                        <img src="img/evsu.png" alt="">
                    </div>
                    <div class="header-form">
                        <h4 class="card-title pb-2 text-center">Attendance Management System </h4>
                    </div>
                    <div class="Login-title">
                        <h4 class="login-title">Saved Offline</h4>
                    </div>
                    <div class="d-flex col-12 align-items-center justify-content-center">
                        <div class="card m-1 rounded-0 d-flex col-12 align-items-center justify-content-center" style="width: 100%">
                            <div class="card-body">
                           <form action=".?folder=action/&page=sync_data" method="post" novalidate>
                           <h5>
                                    <div class="btn btn-danger d-flex rounded-0 mb-4" onclick="syncData()">Sync now</div>
                                    
                                    <?php
                                    // Read the scanned data from the JSON file
                                    $data = json_decode(file_get_contents('action/scanned_data.json'), true);

                                    // Check if the $data variable is not null or empty
                                    if ($data && is_array($data)) {
                                        // Get the count of saved data
                                        $count = count($data);

                                        // Display the count inside the card
                                        echo "<h5>Saved data: " . $count . "</h5>";
                                    } else {
                                        echo "<h5>No data found!</h5>";
                                    }

                                    ?>


                                </h5>
                           </form>
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
    setTimeout(function(){
    location.reload();
  }, 5000);
   </script>

<script>
function syncData() {
    // Call the PHP script that will synchronize the data
    fetch('action/sync_data.php')
        .then(response => response.text())
        .then(data => {
            alert(data); // Show the response from the PHP script
        });
}
</script>


</body>

</html>