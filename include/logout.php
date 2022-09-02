<?php include "db.php"; ?>

<?php session_start(); ?>

<?php
//assign to the null for ending the session
	$_SESSION['user_id']     =  null;
	$_SESSION['username']    =  null;
	$_SESSION['user_email']  =  null;
	$_SESSION['role_id']     =  null;
	$_SESSION['dept_id']     =  null;

        echo "<script>alert('You logged out')</script>";
        echo "<script>window.location.href='../index.php' </script>";

?>