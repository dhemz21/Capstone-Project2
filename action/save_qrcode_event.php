<?php

// DATABASE CONNECTION
require_once('database/db_conn.php');


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
            echo "<script>alert('Data Existed!'); window.location.href='.?folder=pages/&page=school_event';</script>";

            
        }else{

            $sql = "INSERT INTO online_attendance (Registered_ID, IDnumber, Email, username, firstname, lastname, log_date, time_in, login_type)VALUES ('$reg_id', '$idnumber', '$mail', '$login_username', '$fname', '$lname', '$date', '$time', '$type')";
        }
        
         // CHECK IF INSERTION TO TABLE IS SUCCESS
        if (mysqli_query($conn, $sql)) {
            
            echo "<script>alert('You successfully registered!');  window.location.href='.?folder=pages/&page=school_event';</script>";
           
        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }
    } 
    else {
        echo "<script>alert('Invalid QR Code!'); window.location.href='.?folder=pages/&page=school_event';</script>";
    }
}

?>

