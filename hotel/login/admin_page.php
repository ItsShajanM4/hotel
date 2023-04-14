<?php
@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

// Query the database for all messages
$sql = "SELECT * FROM messages";
$result = mysqli_query($db, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Admin Control Panel</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">

   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-PYCMQsqm4z4f0YYKpzwtrX74tjqMg84iSjP0n4P+e7YQ2yf4a4nErxdv1uX7V8RDFZuJ7A54x3qB3ymw5l5j5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>Hi, <span><?php echo $_SESSION['admin_name'] ?></span></h3>
      <h1>Welcome to the Admin Control Panel</h1>
      <p>Here, you can manage user accounts.</p>
      
      <div class="admin-actions">
         <h2>User Management</h2>
         <div class="buttons">
            <a href="view_users.php" class="btn">View All Users</a>
            <a href="view_messages.php" class="btn">View User Messages</a>
            <a href="logout.php" class="btn logout">Logout</a>
         </div>
      </div>

      <div class="messages">
         <h2>User Messages</h2>
         <?php if(mysqli_num_rows($result) > 0): ?>
            <table>
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Phone</th>
                     <th>Subject</th>
                     <th>Message</th>
                  </tr>
               </thead>
               <tbody>
                  <?php while($row = mysqli_fetch_assoc($result)): ?>
                     <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                     </tr>
                  <?php endwhile; ?>
               </tbody>
            </table>
         <?php else: ?>
            <p>No messages found.</p>
         <?php endif; ?>
      </div>

   </div>

</div>

</body>
</html>
