<?php 
session_start();
$error= "";
		if(isset($_POST['submit']))
		{
		$client_email=$_SESSION['client_email'];
		//$client_phone =$_SESSION['client_phone'];
		//$client_email=$_SESSION['client_email'];
		$new_pass=$_POST['new_password'];
		$cnf_pass=$_POST['confirm_password'];
		require 'connection.php';
		$conn = Connect();
		if($new_pass==$cnf_pass){
		$sql="UPDATE clients SET client_password='$new_pass' WHERE client_email='$client_email'";
		if ($conn->query($sql)===TRUE) {
			echo "<script>alert('Password successfully updated.');</script>";
			echo "<script>window.location.href ='clientlogin.php'</script>";
			}
			
		}
		else{
			echo "<script>window.location.href ='reset_password.php'</script>";;
		}
	}
	
?>