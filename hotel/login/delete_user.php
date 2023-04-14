<?php
include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

if(isset($_GET['id'])){
   $id = $_GET['id'];

   // delete user from the database
   $sql = "DELETE FROM user_form WHERE id=$id";
   mysqli_query($db, $sql);

   header('location:view_users.php');
}
?>
