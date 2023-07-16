<?php 

  include 'components/connect.php';

  session_start();

  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
  }
  else{
    $user_id = '';
  }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>
</head>

<body>

  <a href="#" class="to-top">
    <i class="fa-solid fa-angle-up"></i>
  </a>

<?php include 'components/user_header.php'?>

  <section id="contact-hero">
    <div class="contact-hero-text">
      <p>CONTACT US</p>
    </div>
    <div class="contact-hero-img">
      <img src="img/contact.png" type="img/png" alt="contact-img">
    </div>
  </section>

  <section id="contact-details">
    <div class="details">
      <span>GET IN TOUCH</span>
      <h1>Visit one of our agency locations or contact us today</h1>
      <h4>Head Office</h4>
      <div>
        <li>
          <i class="fa-regular fa-map"></i><p>Kassia Udyog Bhavan 2, 106, 17th Cross Rd, Stage 1, Vijayanagar</p>
        </li>
        <li>
          <i class="fa-regular fa-envelope"></i><p>contact@artio.com</p>
        </li>
        <li>
          <i class="fa-solid fa-phone"></i><p>+91 88411 73891 / 0381-136-5948</p>
        </li>
        <li>
          <i class="fa-regular fa-clock"></i><p>Monday to Friday, 10:00-18:00</p>
        </li>
      </div>
    </div>
    <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3224.765271206474!2d77.54755223774298!3d12.975493816478306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3de5a1824a75%3A0x247036f33dfcb5f5!2sDMart%20Vijayanagar!5e1!3m2!1sen!2sin!4v1689091758330!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>

  <section id="contact-form">
    <h1>WE LOVE TO HEAR FROM YOU !</h1>
    <span>Leave a message </span>
    <form id="form-container" class="" action="">
      <input type="text" placeholder="Your name" required>
      <input type="email" placeholder="Email address" required>
      <input type="text" placeholder="Subject" required>
      <textarea name="" id="" cols="20" rows="5" placeholder="Your Message" required></textarea>
      <input type="submit" value="submit">
    </form>
  </section>

  <div class="banner">
    <p>NEWSLETTER</p>
  </div>

  <section id="newsletter">
    <div class="news-content">
      <div class="news-text">
        <h1>Subscribe to our <br>newsletter</h1>
        <p>Stay Updated about the latest products</p>
      </div>
      <form id="news-form" class="news-form" action="" method="">
        <input type="email" id="email" name="email" placeholder="email" required><br>
        <input type="submit" value="Subscribe">
      </form>
    </div>
  </section>

  <?php include 'components/user_footer.php'?>

  <script src="js/main.js"></script>

</body>
</html>