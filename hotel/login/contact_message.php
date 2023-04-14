<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Save message to database
    $sql = "INSERT INTO messages (name, email, phone, subject, message) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
    if (mysqli_query($db, $sql)) {
        // Message saved successfully
        header('Location: /hotel/index.php?success=1');
        exit();
    } else {
        // Error saving message
        header('Location: /hotel/index.php?success=0');
        exit();
    }
}
?>
