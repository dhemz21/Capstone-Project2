<?php

session_start();


// DATABASE CONNECTION
require_once('database/db_conn.php');

// FUNCTION TO CHECK INTERNET CONNECTION
function checkInternetConnection() {
    $curlInit = curl_init('https://www.google.com');
    curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curlInit, CURLOPT_HEADER, true);
    curl_setopt($curlInit, CURLOPT_NOBODY, true);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curlInit);

    curl_close($curlInit);

    if ($response) {
        return true;
    }

    return false;
}

// GETTING THE INFORMATION OF THE QRID FROM THE TABLE
if (isset($_POST['text'])) {

    $qrID = $_POST['text'];
    $date = date("Y-m-d");
    $time = date("H:i:s", time());
    date_default_timezone_set('Australia/Perth');

    $validate = "SELECT *FROM registered_users WHERE qrID ='$qrID'";
    $result = mysqli_query($conn, $validate);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // GETTING THE ROW OF TABLE WERE THE TABLE IS LOCATED ON REGISTERED_USERS
        $reg_id = $row['Registered_ID'];
        $idnumber = $row['IDnumber'];
        $mail = $row['email'];
        $login_username = $row['username'];
        $fname = $row['Firstname'];
        $lname = $row['Lastname'];
        $type = $row['login_type'];

        // CHECK THE USER THAT IS ALREADY EXISTED ON THE DATABASE
        $checkUser = "SELECT * FROM online_attendance WHERE email='$mail'";
        $result = mysqli_query($conn, $checkUser);

        $count = mysqli_num_rows($result);
        if($count>0){
            $_SESSION['validate'] = "existed";
            echo "<script>window.location.href='.?folder=pages/&page=school_event';</script>"; 

            // echo "<script>alert('Data is already existed!'); window.location.href='.?folder=pages/&page=school_event';</script>";

        } else {
            // CHECK INTERNET CONNECTION BEFORE INSERTING DATA INTO THE ONLINE_ATTENDANCE TABLE
            if (checkInternetConnection()) {
                // Insert data into the database
                $sql = "INSERT INTO online_attendance (Registered_ID, IDnumber, Email, username, firstname, lastname, log_date, time_in, login_type)VALUES ('$reg_id', '$idnumber', '$mail', '$login_username', '$fname', '$lname', '$date', '$time', '$type')";

                if (mysqli_query($conn, $sql)) {
                    $_SESSION['validate'] = "successful";
                    echo "<script>window.location.href='.?folder=pages/&page=school_event';</script>"; 
                    // echo "<script>alert('You successfully registered online!');  window.location.href='.?folder=pages/&page=school_event';</script>";
                } else {
                    echo "Error: " . $sql . "" . mysqli_error($conn);
                }
            } else {

                // Store data in local storage
                $attendanceData = array(
                    'Registered_ID' => $reg_id,
                    'IDnumber' => $idnumber,
                    'Email' => $mail,
                    'username' => $login_username,
                    'firstname' => $fname,
                    'lastname' => $lname,
                    'log_date' => $date,
                    'time_in' => $time,
                    'login_type' => $type
                );

                $attendanceDataJson = json_encode($attendanceData);
                echo "<script>localStorage.setItem('attendanceData', '$attendanceDataJson');</script>";

                $_SESSION['validate'] = "offline";
                echo "<script>window.location.href='.?folder=pages/&page=school_event';</script>"; 

                // echo "<script>alert('No internet connection. Attendance data has been stored locally.'); window.location.href='.?folder=pages/&page=school_event';</script>";
            }
        }
    } else {
        $_SESSION['validate'] = "unsuccessful";
        echo "<script>window.location.href='.?folder=pages/&page=school_event';</script>"; 
        // echo "<script>alert('Invalid QR Code!'); window.location.href='.?folder=pages/&page=school_event';</script>";
    }
}

?>
