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

  <section id="aboutus">
    <div class="heading">
      <h1>Welcome to <span>ARTiO</span></h1>
    </div>
    <h2>About Us</h2>

    <img src="img/about-us.png" alt="" type="img/png">

    <p>At <span>Artio</span> we are passionate about providing you with a seamless and enjoyable online shopping experience. We aim to be your one-stop destination for all your arts and crafts needs. Here's what you need to know about us:</p>

    <div class="about-details">

      <h3>Our Mission</h3>
      <p class="about-desc">Our mission is to deliver high-quality products and exceptional service to our customers. We strive to exceed your expectations by offering a wide range of products, competitive prices, and a user-friendly shopping platform.
      </p>

      <h3>Quality Products</h3>
      <p class="about-desc">We understand that quality is of utmost importance to our customers. That's why we source our products from trusted suppliers and reputable brands to ensure you receive only the best. Whether you're looking for <strong>craft items</strong>, we have you covered with a carefully curated selection that meets our strict quality standards.</p>

      <h3>Exceptional Customer Service</h3>
      <p class="about-desc">We believe that outstanding customer service is the backbone of any successful business. Our dedicated team of customer support professionals is always ready to assist you with any questions, concerns, or issues you may have. We aim to provide prompt and helpful responses to ensure your shopping experience with us is smooth and hassle-free.</p>

      <h3>Secure Shopping</h3>
      <p class="about-desc">Your security is our priority. We utilize the latest encryption and security measures to safeguard your personal information and ensure secure transactions. You can shop with confidence, knowing that your privacy and data protection are in good hands.</p>

      <h3>Fast and Reliable Shipping</h3>
      <p class="about-desc">We know you're excited to receive your purchases, which is why we work hard to process and ship your orders quickly. We partner with trusted shipping providers to ensure your packages arrive on time and in excellent condition. We provide tracking information for all orders, allowing you to stay updated on your shipment's progress.</p>

      <h3>Easy Returns and Exchanges</h3>
      <p class="about-desc">We understand that sometimes things don't go as planned, and you may need to return or exchange a product. Our hassle-free return and exchange policy ensures that you can shop risk-free. If you're not completely satisfied with your purchase, we'll do our best to make it right.</p>

      <h3>Community Engagement</h3>
      <p class="about-desc">We believe in giving back to the community that supports us. We actively participate in charitable initiatives and contribute to causes that align with our values. Your purchase contributes to making a positive impact in various communities.</p>
    </div>

    <p>We appreciate your trust in us and strive to continually improve our services. Thank you for choosing <span>Artio</span> Happy shopping!</p>

    <p>If you have any further questions or need assistance, please don't hesitate to contact our friendly customer support team.</p>
    
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