<?php
session_start();
$error='';
if (isset($_POST['submit'])) {
    if (empty($_POST['customer_name'])|| empty($_POST['customer_phone'])|| empty($_POST['customer_email'])) {
    $error = "Invalid details. Please try with valid details.....";
    }
    else
    {
    // Define $username and $password
    $customer_name=$_POST['customer_name'];
    $customer_phone=$_POST['customer_phone'];
    $customer_email=$_POST['customer_email'];
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    require 'connection.php';
    $conn = Connect();
    // SQL query to fetch information of registerd users and finds user match.
    $query = "SELECT customer_name,customer_phone,customer_email FROM customers WHERE customer_name=?  AND customer_phone=? AND customer_email=? LIMIT 1";

    // To protect MySQL injection for Security purpose
    $stmt = $conn->prepare($query);
    $stmt -> bind_param("sss",$customer_name,$customer_phone,$customer_email);
    $stmt -> execute();
    $stmt -> bind_result($customer_name,$customer_phone, $customer_email);
    $stmt -> store_result();
    
    if ($stmt->fetch())  //fetching the contents of the row
    {
        $_SESSION['customer_email']=$customer_email;
        header("location: reset_password2.php"); // Redirecting To Other Page
    } else {
    $error = "Invalid details. Please try with valid details";
    }
    mysqli_close($conn); // Closing Connection
    }
    }
    ?>