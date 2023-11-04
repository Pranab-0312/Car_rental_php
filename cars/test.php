<?php
session_start();
$error='';
if (isset($_POST['submit'])) {
    if (empty($_POST['client_name'])|| empty($_POST['client_phone'])|| empty($_POST['client_email'])) {
    $error = "Invalid details. Please try with valid details.....";
    }
    else
    {
    // Define $username and $password
    $client_name=$_POST['client_name'];
    $client_phone=$_POST['client_phone'];
    $client_email=$_POST['client_email'];
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    require 'connection.php';
    $conn = Connect();
    // SQL query to fetch information of registerd users and finds user match.
    $query = "SELECT client_name,client_phone,client_email FROM clients WHERE client_name=?  AND client_phone=? AND client_email=? LIMIT 1";

    // To protect MySQL injection for Security purpose
    $stmt = $conn->prepare($query);
    $stmt -> bind_param("sss",$client_name,$client_phone,$client_email);
    $stmt -> execute();
    $stmt -> bind_result($client_name,$client_phone, $client_email);
    $stmt -> store_result();
    
    if ($stmt->fetch())  //fetching the contents of the row
    {
        $_SESSION['client_email']=$client_email;
        //$_SESSION['client_phone']=$client_phone;
        //$_SESSION['client_email']=$client_email;
        //$_SESSION['recover_email']=$client_name; // Initializing Session
        header("location: reset_password.php"); // Redirecting To Other Page
    } else {
    $error = "Invalid details. Please try with valid details";
    }
    mysqli_close($conn); // Closing Connection
    }
    }
    ?>