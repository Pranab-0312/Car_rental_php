<?php 
session_start();
$error= "";
		if(isset($_POST['submit']))
		{
		$customer_email=$_SESSION['customer_email'];
		$new_pass=$_POST['new_password'];
		$cnf_pass=$_POST['confirm_password'];
		require 'connection.php';
		$conn = Connect();
		if($new_pass==$cnf_pass){
		$sql="UPDATE customers SET customer_password='$new_pass' WHERE customer_email='$customer_email'";
		if ($conn->query($sql)===TRUE) {
			echo "<script>alert('Password successfully updated.');</script>";
			echo "<script>window.location.href ='customerlogin.php'</script>";
			}
			
		}
		else{
			echo "<script>window.location.href ='reset_password2.php'</script>";
		}
	}
	
?>