<?php
include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

// select all users from the database
$sql = "SELECT * FROM user_form";
$result = mysqli_query($db, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View All Users</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      /* add some padding to the table cells */
      table td {
         padding: 10px;
      }
      /* add some margin to the table rows */
      table tbody tr {
         margin-bottom: 10px;
      }
   </style>
</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>Hi, <span><?php echo $_SESSION['admin_name'] ?></span></h3>
      <h1>View All Users</h1>
      
      <div class="user-list">
         <table>
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
               <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn delete">Delete</a></td>
               </tr>
            <?php } ?>
            </tbody>
         </table>
      </div>

   </div>

</div>

</body>
</html>
