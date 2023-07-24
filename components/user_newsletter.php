<?php 

 if(isset($_POST['submit-news'])){
  $email=$_POST['news-email'];

  $insert_email=$conn->prepare("INSERT INTO `newsletter` (user_id,email) VALUES (?,?)");
  $insert_email->execute([$user_id,$email]);

  $message[]='email submitted !';
 }

 ?>

<div class="banner">
    <p>NEWSLETTER</p>
  </div>
  <section id="newsletter">
    <div class="news-content">
      <div class="news-text">
        <h1>Subscribe to our <br>newsletter</h1>
        <p>Stay Updated about the latest products</p>
      </div>
      <form id="news-form" class="news-form" action="" method="POST">
        <input type="email" id="email" name="news-email" placeholder="email" required oninput="this.value = this.value.replace(/\s/g, '')"><br>
        <input type="submit" name="submit-news" value="Subscribe">
      </form>
    </div>
  </section>