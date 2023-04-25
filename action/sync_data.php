<?php
// DATABASE CONNECTION
require_once('../database/db_conn.php');

// Check if there is an internet connection
$connected = check_internet_connection();

// If there is an internet connection, insert the attendance data into the online_attendance table
if ($connected) {
  // Retrieve the attendance data from the AJAX request
  $attendanceData = json_decode(file_get_contents('php://input'), true);

  // Insert the attendance data into the online_attendance table
  $sql = "INSERT INTO online_attendance (Registered_ID, IDnumber, Email, username, firstname, lastname, log_date, time_in, login_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'sssssssss', $attendanceData['Registered_ID'], $attendanceData['IDnumber'], $attendanceData['Email'], $attendanceData['username'], $attendanceData['firstname'], $attendanceData['lastname'], $attendanceData['log_date'], $attendanceData['time_in'], $attendanceData['login_type']);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  if (mysqli_error($conn)) {
      echo "Error: " . mysqli_error($conn);
  } else {
      echo "Data saved successfully!";
  }
} else {
  // If there is no internet connection, store the attendance data in local storage
  echo "No internet connection, Please try again later!";
  // code to store data in local storage
}

// Close the database connection
mysqli_close($conn);

// Function to check for an internet connection using curl
function check_internet_connection() {
  $url = 'https://www.google.com';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  $output = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  if ($httpcode >= 200 && $httpcode < 300) {
    return true;
  } else {
    return false;
  }
}
?>
