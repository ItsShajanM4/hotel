<?php
// Database configuration
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'hoteldb';

// Create a database connection
$mysqli = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the database connection was successful
if (!$mysqli) {
  die("Connection failed: " . mysqli_connect_error());
}

// Start the session
session_start();

// Check if the login form was submitted
if(isset($_POST['submit'])){
   $name = '';
   $cpassword = '';
   $user_type = '';
   $email = mysqli_real_escape_string($mysqli, $_POST['email']);
   $pass = md5($_POST['password']);

   // Run the query to check if the user exists in the database
   $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
   $result = mysqli_query($mysqli, $select);

   // Check if the query returned any rows
   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);

      // Check the user type and redirect to the appropriate page
      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');
      }elseif($row['user_type'] == 'user'){
         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');
      }  
   }else{
      $error[] = 'incorrect email or password!';
   }
};
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Login Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Enter Email">
      <input type="password" name="password" required placeholder="Enter Password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
   </form>

</div>

</body>
</html>