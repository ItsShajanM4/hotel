<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Hotel Montclair </title>
<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- custom css file link -->
<link rel="stylesheet" href="style.css"> 
</head>
<body>

<!-- header section starts -->
<header>
    <div id="menu-bar" class="fas fa-bars"></div>
    <a href="#home" class="logo"><span>H</span>otel <span>M</span>ontclair</a>
    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#reservation">Reservation</a>
        <a href="#amenities">Amenities</a>
        <a href="#gallery">Gallery</a>
        <a href="#contact">Contact</a>
    </nav>
    <div class="icons">
        <a href="http://localhost/hotel/login/login_form.php" id="login-btn" class="signin-btn animated-button">Sign In</a>
        <a href="http://localhost/hotel/login/register_form.php" id="register-btn" class="register-btn animated-button">Register</a>
    </div>
</header>

<script>
    // Get the login and register button elements
    const loginBtn = document.getElementById("login-btn");
    const registerBtn = document.getElementById("register-btn");
    
    // Add an event listener to the login button to redirect to login_form.php
    loginBtn.addEventListener("click", function() {
        window.location.href = "http://localhost/hotel/login/login_form.php";
    });
    
    // Add an event listener to the register button to redirect to register_form.php
    registerBtn.addEventListener("click", function() {
        window.location.href = "http://localhost/hotel/login/register_form.php";
    });
</script>

<!-- header section ends -->

<!-- home section starts -->
<section class="home" id="home">
    <div class="content">
        <h3>WELCOME TO HOTEL MONTCLAIR</h3>
        <p>When elegance meets comfort</p>
    </div>


    <div class="video-container">
        <video src="img/vid-1.mp4" id="video-slider" loop autoplay muted></video>
    </div>

</section>
<!-- home section ends -->

<!-- reservation section starts -->
<section class="reservation" id="reservation">
<h1 class="heading">
        <span>R</span>
        <span>E</span>
        <span>S</span>
        <span>E</span>
        <span>R</span>
        <span>V</span>
        <span>A</span>
        <span>T</span>
        <span>I</span>
        <span>O</span>
        <span>N</span>
        <span>S</span>
    </h1>
  <div class="reservation-container">

    <h2>Make a reservation</h2>
    <form action="choose_room.php" method="POST">
      <div class="form-row">
        <label for="check-in" class="label-check-in">Check In</label>
        <input type="date" id="check-in" name="check-in" required>
      </div>
      <div class="form-row">
        <label for="check-out" class="label-check-out">Check Out</label>
        <input type="date" id="check-out" name="check-out" required>
      </div>
      <div class="form-row">
        <label for="guests">Number of guests:</label>
        <select id="guests" name="guests" required>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
      </div>
      <button type="submit" class="check-availability">Check availability</button>
    </form>
  </div>
</section>

<script>
// Add a focus event listener to the check-in and check-out input fields
const checkInInput = document.getElementById("check-in");
const checkOutInput = document.getElementById("check-out");

// Function to open the calendar popup
function openCalendar(input) {
  input.type = "date";
  input.click();
}

// Add focus event listener to the check-in and check-out input fields
checkInInput.addEventListener("focus", () => {
  checkInInput.placeholder = "Check In";
  openCalendar(checkInInput);
});

checkOutInput.addEventListener("focus", () => {
  checkOutInput.placeholder = "Check Out";
  const checkInDate = new Date(checkInInput.value);
  const checkOutInputMin = new Date(checkInDate.getFullYear(), checkInDate.getMonth(), checkInDate.getDate() + 1).toISOString().split("T")[0];
  checkOutInput.setAttribute("min", checkOutInputMin);
  openCalendar(checkOutInput);
});

// Add change event listener to the check-in and check-out input fields
checkInInput.addEventListener("change", () => {
  const checkInDate = new Date(checkInInput.value);
  const today = new Date();
  const limitYear = new Date("2025-01-01");
  if (checkInDate <= today) {
    alert("Check-in date must be after today");
    checkInInput.value = "";
  } else if (checkInDate >= limitYear) {
    alert("Check-in date cannot be after 2025");
    checkInInput.value = "";
  }
});

checkOutInput.addEventListener("change", () => {
  const checkOutDate = new Date(checkOutInput.value);
  const checkInDate = new Date(checkInInput.value);
  const today = new Date();
  const limitYear = new Date("2025-01-01");
  if (checkOutDate <= checkInDate) {
    alert("Check-out date must be after the check-in date");
    checkOutInput.value = "";
  } else if (checkOutDate <= today) {
    alert("Check-out date must be after today");
    checkOutInput.value = "";
  } else if (checkOutDate >= limitYear) {
    alert("Check-out date cannot be after 2025");
    checkOutInput.value = "";
  }
});

</script>
<style>

.reservation {
  text-align: center;
  background-color: #f8f8f8;
  padding: 50px 0;
}

.reservation h2 {
  margin-bottom: 20px;
}

.reservation-container {
  max-width: 800px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.form-row {
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.form-row label {
  margin-bottom: 10px;
  font-size: 16px;
}

.form-row select {
  width: 100%;
  padding: 8px;
  border-radius: 4px;
  border: none;
  box-shadow: 0 0 4px rgba(0,0,0,0.2);
  font-size: 16px;
  font-weight: 500;
  outline: none;
}

.check-availability {
  background-color: #fd5e53;
  color: #fff;
  padding: 10px 20px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

.check-availability:hover {
  background-color: #f03c32;
}


</style>
</body>
</html>

<!-- services section starts -->
<section class="amenities" id="amenities">
<h1 class="heading">
        <span>A</span>
        <span>M</span>
        <span>E</span>
        <span>N</span>
        <span>I</span>
        <span>T</span>
        <span>I</span>
        <span>E</span>
        <span>S</span>
    </h1>
  <div class="grid-container" data-aos="fade-up">
    <div class="grid-item" data-aos="flip-up">
      <i class="fas fa-door-open"></i><br>Connecting Rooms
    </div>
    <div class="grid-item" data-aos="flip-up">
      <i class="fas fa-wifi"></i><br>Free WiFi
    </div>
    <div class="grid-item" data-aos="flip-up">
      <i class="fas fa-smoking-ban"></i><br>Non-smoking rooms
    </div>
    <div class="grid-item" data-aos="flip-up">
      <i class="fas fa-concierge-bell"></i><br>Concierge
    </div>
    <div class="grid-item" data-aos="flip-up">
      <i class="fas fa-glass-cheers"></i><br>Executive lounge
    </div>
    <div class="grid-item" data-aos="flip-up">
      <i class="fas fa-dumbbell"></i><br>Fitness center
    </div>
    <div class="grid-item" data-aos="flip-up">
      <i class="fas fa-utensils"></i><br>Room service
    </div>
    <div class="grid-item" data-aos="flip-up">
      <i class="fas fa-users"></i><br>Meeting rooms
    </div>
    <div class="grid-item" data-aos="flip-up">
      <i class="fas fa-paw"></i><br>Pets not allowed
    </div>
  </div>
</section>

<!-- services section ends -->
<div class="clearfix"></div>

<!-- gallery section starts -->
<section class="gallery" id="gallery">
<h1 class="heading">
    <span>g</span>
    <span>a</span>
    <span>l</span>
    <span>l</span>
    <span>e</span>
    <span>r</span>
    <span>y</span>
  </h1>
<div class="img-slider-container">
<div class="slider">
      <div class="slide active">
        <img src="img/g-1.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/g-2.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/g-3.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/g-4.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/g-5.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/g-6.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/g-7.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/g-8.jpg" alt="">
      </div>
      <div class="navigation">
        <i class="fas fa-chevron-left prev-btn"></i>
        <i class="fas fa-chevron-right next-btn"></i>
      </div>
      <div class="navigation-visibility">
        <div class="slide-icon active"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
      </div>
    </div>
    </div>
    </section>
    <script type="text/javascript">
const slider = document.querySelector(".slider");
const nextBtn = document.querySelector(".next-btn");
const prevBtn = document.querySelector(".prev-btn");
const slides = document.querySelectorAll(".slide");
const slideIcons = document.querySelectorAll(".slide-icon");
const numberOfSlides = slides.length;
var slideNumber = 0;

//image slider next button
nextBtn.addEventListener("click", () => {
  slides.forEach((slide) => {
    slide.classList.remove("active");
  });
  slideIcons.forEach((slideIcon) => {
    slideIcon.classList.remove("active");
  });

  slideNumber++;

  if(slideNumber > (numberOfSlides - 1)){
    slideNumber = 0;
  }

  slides[slideNumber].classList.add("active");
  slideIcons[slideNumber].classList.add("active");
});

//image slider previous button
prevBtn.addEventListener("click", () => {
  slides.forEach((slide) => {
    slide.classList.remove("active");
  });
  slideIcons.forEach((slideIcon) => {
    slideIcon.classList.remove("active");
  });

  slideNumber--;

  if(slideNumber < 0){
    slideNumber = numberOfSlides - 1;
  }

  slides[slideNumber].classList.add("active");
  slideIcons[slideNumber].classList.add("active");
});

//image slider autoplay
var playSlider;

var repeater = () => {
  playSlider = setInterval(function(){
    slides.forEach((slide) => {
      slide.classList.remove("active");
    });
    slideIcons.forEach((slideIcon) => {
      slideIcon.classList.remove("active");
    });

    slideNumber++;

    if(slideNumber > (numberOfSlides - 1)){
      slideNumber = 0;
    }

    slides[slideNumber].classList.add("active");
    slideIcons[slideNumber].classList.add("active");
  }, 4000);
}
repeater();

//stop the image slider autoplay on mouseover
slider.addEventListener("mouseover", () => {
  clearInterval(playSlider);
});

//start the image slider autoplay again on mouseout
slider.addEventListener("mouseout", () => {
  repeater();
});
</script>

<!-- gallery section ends -->



<!-- contact section starts -->

<section class="contact" id="contact">
    <h1 class="heading">
        <span>c</span>
        <span>o</span>
        <span>n</span>
        <span>t</span>
        <span>a</span>
        <span>c</span>
        <span>t</span>
        &nbsp;
        &nbsp;
        <span>U</span>
        <span>S</span>
    </h1>
    <div class="row">
        <div class="img">
            <img src="img/contact-img.png" alt="">
        </div>
        <form action="/hotel/login/contact_message.php" method="POST">
            <div class="inputBox">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="inputBox">
                <input type="number" name="phone" placeholder="Phone">
                <input type="text" name="subject" placeholder="Subject" required>
            </div>
            <textarea name="message" placeholder="Message" required></textarea>
            <input type="submit" class="btn" value="Send Message">
        </form>
        <?php if (isset($_GET['success'])) {
            if ($_GET['success'] == 1) {
                echo "<div class='alert success'>Message sent successfully!</div>";
                echo "<script>alert('Message sent successfully!');</script>"; // add pop-up message
            } else {
                echo "<div class='alert error'>Error sending message. Please try again later.</div>";
            }
        } ?>
    </div>
</section>



<!-- contact section ends -->

<!-- footer section -->
<section class="footer">
    <h1 class="credit">Made by Group 4 | All rights reserved!!</h1>
</section> 
<!-- End of footer section --> 

</body>
</html>