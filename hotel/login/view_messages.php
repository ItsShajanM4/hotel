<?php
include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

// Retrieve all messages from the database
$sql = "SELECT * FROM messages";
$result = mysqli_query($db, $sql);

// Delete message from database if delete button is clicked
if (isset($_POST['delete'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM messages WHERE id=$id";
    mysqli_query($db, $sql);
    header('Location: view_messages.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>View User Messages</title>

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
      <h1>View User Messages</h1>
      
      <div class="table-wrapper">
         <table>
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Delete</th>
               </tr>
            </thead>
            <tbody>
               <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                     <td><?php echo $row['name'] ?></td>
                     <td><?php echo $row['email'] ?></td>
                     <td><?php echo $row['phone'] ?></td>
                     <td><?php echo $row['subject'] ?></td>
                     <td><?php echo $row['message'] ?></td>
                     <td>
                        <form method="post" action="">
                           <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                           <button type="submit" name="delete" class="btn"><i class="fa fa-trash"></i></button>
                        </form>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>

   <div class="admin-links">
      <a href="admin_page.php">Back to Admin Page</a>
   </div>

</div>

</body>
</html>
