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

// Retrieve the check-in, check-out, and guests values from the previous form submission
$check_in = isset($_POST['check-in']) ? $_POST['check-in'] : '';
$check_out = isset($_POST['check-out']) ? $_POST['check-out'] : '';
$guests = isset($_POST['guests']) ? $_POST['guests'] : '';

// Display the chosen check-in, check-out, and guests values
$chosen_dates = "Check-in date: $check_in - Check-out date: $check_out - Number of guests: $guests";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accommodations | Hotel Montclair</title>
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
    </nav>
    <div class="icons">
      <a href="http://localhost/hotel/login/login_form.php" id="login-btn" class="signin-btn animated-button">Sign In</a>
      <a href="http://localhost/hotel/login/register_form.php" id="register-btn" class="register-btn animated-button">Register</a>
    </div>
  </header>
    
  </section>
  <section class="rooms" id="rooms">
    <h2 class="heading">Accommodations</h2>
    <?php if ($check_in && $check_out && $guests) : ?>
      <p class="chosen-dates"><?php echo "Chosen dates: $check_in - $check_out, Number of guests: $guests" ?></p>
    <?php endif; ?>
    <div class="checkout-menu"></div>
    <div id="login-form">
    <div id="payment-form">
  <form action="process_payment.php" method="post">
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

  <form action="/hotel/login/login_form.php" method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Login">
  </form>
</div>
    <div class="room-list-container">
      <div class="room-list">
        <div class="room">
          <div class="img-container">
            <img src="img/room-1.jpg" alt="Standard Room">
          </div>
          <div class="room-info">
            <h3>Standard Room</h3>
            <p>The Standard Room Is A Cozy Option That Can Accommodate Up To Two Guests With One King-Size Bed Or Two Twin-Size Beds, 
              And Features Amenities Like A Flat-Screen TV, Free Wi-Fi, And A Private Bathroom With A Shower.</p>
            <div class="price">$100.00 <span>/night</span></div>
            <button class="btn select-room" data-room-type="Standard Room" data-room-price="100.00">Book Room</button>
          </div>
        </div>
        <div class="room">
          <div class="img-container">
            <img src="img/room-2.jpg" alt="Deluxe Room">
          </div>
          <div class="room-info">
            <h3>Deluxe Room</h3>
            <p>The Deluxe Room Is A Spacious Option That Can Accommodate Up To Four Guests With Two Queen-Size Beds, And 
              Features Amenities Like A Flat-Screen TV, Free Wi-Fi, And A Private Bathroom With A Bathtub And Shower.</p>
            <div class="price">$150.00 <span>/night</span></div>
            <button class="btn select-room" data-room-type="Deluxe Room">Select Room</button>
          </div>
        </div>
        <div class="room">
          <div class="img-container">
            <img src="img/room-3.jpg" alt="Suite">
          </div>
          <div class="room-info">
            <h3>Executive Room</h3>
            <p>The Executive Room Is A Luxurious Option That Can Accommodate Up To Two Guests With One King-Size Bed, And Features Amenities Like A Flat-Screen TV, Free Wi-Fi, 
              A Private Bathroom With A Spa Tub, And Access To An Exclusive Executive Lounge.</p>
            <div class="price">$250.00 <span>/night</span></div>
            <button class="btn select-room" data-room-type="Suite">Select Room</button>
          </div>
        </div>
      </div>
    </div>
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
  });
});

// Get the login and payment form elements
const loginForm = document.querySelector('#login-form');
const paymentForm = document.querySelector('#payment-form');

selectRoomButtons.forEach((button) => {
  button.addEventListener('click', () => {
    const roomType = button.dataset.roomType;
    const roomPrice = button.dataset.roomPrice;
    
    // Show the login form
    loginForm.style.display = 'block';
    
    // Hide the room list container
    const roomListContainer = document.querySelector('.room-list-container');
    roomListContainer.style.display = 'none';
    
    // Set the room type and price in the payment form
    const roomTypeInput = paymentForm.querySelector('#room-type');
    const roomPriceInput = paymentForm.querySelector('#room-price');
    roomTypeInput.value = roomType;
    roomPriceInput.value = roomPrice;
  });
});

</script>

<!-- footer section -->
<section class="footer">
    <h1 class="credit">Made by Group 4 | All rights reserved!!</h1>
</section> 
<!-- End of footer section --> 
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="main.js"></script>
</body>
</html>