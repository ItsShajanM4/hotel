<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
  header('Location: /hotel/login/login_form.php');
  exit();
}

// Check if the payment form is submitted
if (isset($_POST['room-type'], $_POST['room-price'], $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['card-holder-name'], $_POST['card-number'], $_POST['expiry-month'], $_POST['expiry-year'], $_POST['cvv'])) {

  // Process the payment
  // ...
  // Redirect to a confirmation page
  header('Location: confirmation.php');
  exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment | Hotel Montclair</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div id="menu-bar" class="fas fa-bars"></div>
    <a href="#" class="logo"><span>H</span>otel <span>M</span>ontclair</a>
    <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="#rooms">Packages</a>
      <a href="#amenities">Amenities</a>
      <a href="#gallery">Gallery</a>
      <a href="#contact">Contact</a>
      <?php if (isset($_SESSION['user_name'])) : ?>
        <a href="logout.php">Logout</a>
      <?php endif; ?>
    </nav>
    <?php if (!isset($_SESSION['user_name'])) : ?>
      <div class="icons">
        <a href="http://localhost/hotel/login/login_form.php" id="login-btn" class="signin-btn animated-button">Sign In</a>
        <a href="http://localhost/hotel/login/register_form.php" id="register-btn" class="register-btn animated-button">Register</a>
      </div>
    <?php endif; ?>
  </header>

  <section class="payment" id="payment">
    <h2 class="heading">Payment</h2>
    <div class="checkout-menu"></div>
    <?php if (!isset($_SESSION['user_name'])) : ?>
      <p class="error-msg">Please log in to book a room.</p>
    <?php else : ?>
      <div id="login-form">
        <form action="login.php" method="post">
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="submit" value="Login">
        </form>
      </div>
      <div id="payment-form">
        <form action="payment.php" method="post">
          <input type="hidden" name="room-type" id="room-type">
          <input type="hidden" name="room-price" id="room-price">
          <input type="text" name="name" placeholder="Name" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="text" name="phone" placeholder="Phone" required>
          <input type="text" name="address" placeholder="Address" required>
         <input type="text" name="city" placeholder="City" required>
        <input type="text" name="state" placeholder="State" required>
        <input type="text" name="zip" placeholder="Zip" required>
        <input type="text" name="card-holder-name" placeholder="Card Holder Name" required>
        <input type="text" name="card-number" placeholder="Card Number" required>
        <input type="text" name="expiry-month" placeholder="Expiry Month" required>
        <input type="text" name="expiry-year" placeholder="Expiry Year" required>
        <input type="text" name="cvv" placeholder="CVV" required>
        <input type="submit" value="Pay">
    </form>
  </div>
<?php endif; ?>
</section>
  <script>
    const selectRoomButtons = document.querySelectorAll('.select-room');
    const checkoutMenu = document.querySelector('.checkout-menu');

    selectRoomButtons.forEach((button) => {
      button.addEventListener('click', () => {
        const roomType = button.dataset.roomType;
        const roomPrice = button.dataset.roomPrice;
        
        // Create a new checkout menu item
        const menuItem = document.createElement('div');
        menuItem.classList.add('menu-item');
        menuItem.innerHTML = `${roomType} - $${roomPrice}`;
        
        // Add the new menu item to the checkout menu container
        checkoutMenu.appendChild(menuItem);
        
        // Hide the room list container
        const roomListContainer = document.querySelector('.room-list-container');
        roomListContainer.style.display = 'none';
        
        // Show the payment form
        const paymentForm = document.querySelector('#payment-form');
        paymentForm.style.display = 'block';
        
        // Set the room type and price in the payment form
        const roomTypeInput = paymentForm.querySelector('#room-type');
        const roomPriceInput = paymentForm.querySelector('#room-price');
        roomTypeInput.value = roomType;
        roomPriceInput.value = roomPrice;
      });
    });
  </script>
</body>
</html>