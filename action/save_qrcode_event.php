<?php

session_start();
// DATABASE CONNECTION
require_once('database/db_conn.php');

// FUNCTION TO CHECK INTERNET CONNECTION
function check_internet_connection()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    } else {
        return false;
    }
}

// GETTING THE INFORMATION OF THE QRID FROM THE TABLE
if (isset($_POST['text'])) {

    $qrID = $_POST['text'];
    $date = date("Y-m-d");
    $time = date("H:i:s", time());
    date_default_timezone_set('Australia/Perth');

    $validate = "SELECT * FROM registered_users WHERE qrID ='$qrID'";
    $result = mysqli_query($conn, $validate);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // GETTING THE ROW OF TABLE WHERE THE TABLE IS LOCATED ON registered_users
        $reg_id = $row['Registered_ID'];
        $idnumber = $row['IDnumber'];
        $mail = $row['email'];
        $login_username = $row['username'];
        $fname = $row['Firstname'];
        $lname = $row['Lastname'];
        $type = $row['login_type'];

        // CHECK IF USER ALREADY EXISTS IN THE DATABASE
        $checkUser = "SELECT * FROM online_attendance WHERE email='$mail'";
        $result = mysqli_query($conn, $checkUser);
        $count = mysqli_num_rows($result);
        
        if($count > 0){
            $_SESSION['validate'] = "existed";
            echo "<script>window.location.href='.?folder=pages/&page=school_event';</script>"; 
        } else {
            $scanned_data = array(
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
            // CHECK INTERNET CONNECTION
            if (check_internet_connection()) {
                // INSERT THE DATA INTO THE online_attendance TABLE
                $sql = "INSERT INTO online_attendance (Registered_ID, IDnumber, Email, username, firstname, lastname, log_date, time_in, login_type) VALUES ('$reg_id', '$idnumber', '$mail', '$login_username', '$fname', '$lname', '$date', '$time', '$type')";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['validate'] = "successful";
                    echo "<script>window.location.href='.?folder=pages/&page=school_event';</script>"; 
                } else {
                    echo "Error: " . $sql . "" . mysqli_error($conn);
                }
            } else {
    // IF THERE IS NO INTERNET CONNECTION, SAVE THE DATA TO A TEMPORARY JSON FILE
    $data = json_decode(file_get_contents('action/scanned_data.json'), true);

    if (is_array($data) && !empty($data)) {
        
        // CHECK IF DATA ALREADY EXISTS IN JSON FILE
        $already_saved = false;
        foreach ($data as $item) {
            if ($item['Email'] == $mail && $item['log_date'] == $date) {
                $already_saved = true;
                break;
            }
        }
        if ($already_saved) {
            $_SESSION['validate'] = "offline-existed";
            echo "<script>window.location.href='.?folder=pages/&page=school_event';</script>"; 
        } else {
            $data[] = $scanned_data;
            $count = count($data);
            file_put_contents('action/scanned_data.json', json_encode($data));
            $_SESSION['validate'] = "offline-successful";
            echo "<script>window.location.href='.?folder=pages/&page=school_event';</script>"; 
        }
    } else {
        $data = array($scanned_data);
        file_put_contents('action/scanned_data.json', json_encode($data));
        $_SESSION['validate'] = "offline-successful";
        echo "<script>window.location.href='.?folder=pages/&page=school_event';</script>";
    }
}
        }
    } else {
        $_SESSION['validate'] = "unsuccessful";
        echo "<script>window.location.href='.?folder=pages/&page=school_event';</script>"; 
    }
    
}
