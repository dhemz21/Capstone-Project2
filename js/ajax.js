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
                        localStorage.removeItem('attendanceData');
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
