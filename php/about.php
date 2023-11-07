<?php

include 'config_db.php';

session_start();

$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email']; 

if(!isset($user_id))
{
   header('location:login.php');
}

if(!isset($user_email))
{
   header('location:login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TrusyBuysLk About Us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="/css/styles.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<script>
$(document).ready(function() {
    $(window).scroll(function() {
        $('.reviews').each(function() {
            var top_of_element = $(this).offset().top;
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            if (bottom_of_window > top_of_element) {
                $(this).css('position','relative').css('top','50px').css('opacity', 0).animate({
                    top: '0px',
                    opacity: 1
                }, 2000);
            }
        });
    });
});

</script>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>About Us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="\src\home_about1.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>Trusty Buys LK is your one-stop shop for all your electronic needs. We offer a wide range of products from headphones, mobile phones, and accessories to laptops, tablets, and speakers. We source our products from reliable suppliers like JBL, Beasus, and Apple, and we guarantee their quality and authenticity.</p>
         <p>We also provide fast and secure delivery, easy payment options, and excellent customer service. Whether you are looking for the latest gadgets, the best deals, or the most convenient shopping experience, Trusty Buys LK has it all. Trust us, we won't let you down.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section> 


<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
        <img src="/src/pic-1.png" alt="">
         <p>I bought a pair of wireless headphones from Trusty Buys and I'm very happy with them. They have great sound quality, long battery life, and comfortable fit. They also arrived on time and in good condition. I would definitely recommend Trusty Buys to anyone looking for quality headphones at a reasonable price.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Lisa Chen</h3>
      </div>

      <div class="box">
         <img src="/src/pic-3.png" alt="">
         <p>I ordered a mobile phone from Trusty Buys and I'm very impressed with their service. The phone was delivered fast and securely, and it works perfectly. It has all the features I wanted, and it looks sleek and stylish. Trusty Buys has the best deals on mobile phones and accessories, and I will definitely shop with them again.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
         </div>
         <h3>Pramuditha Weerakon</h3>
      </div>

      <div class="box">
         <img src="/src/pic-4.png" alt="">
         <p>I purchased a Bluetooth speaker from Trusty Buys and I'm very satisfied with it. The speaker has amazing sound quality, easy connectivity, and long-lasting battery. It's also portable and durable, so I can take it anywhere I want, and I highly recommend them to anyone who loves music.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Maria Garcia</h3>
      </div>

   </div>

</section> 

<section class="authors">

   <h1 class="title">Our Suppliers</h1>

   <div class="box-container">

      <div class="box">
         <img src="/src/jbl_logo.jpg" alt="">
         <div class="share">
            <a href="https://web.facebook.com/JBL" class="fab fa-facebook-f" target="_blank"></a>
            <a href="https://twitter.com/JBLAUDIO" class="fab fa-twitter" target="_blank"></a>
            <a href="https://www.instagram.com/JBLAUDIO/" class="fab fa-instagram" target="_blank"></a>
            <a href="https://www.linkedin.com/company/jbl-professional" class="fab fa-linkedin" target="_blank"></a>
         </div>
         <h3>JBL</h3>
      </div>

      <div class="box">
         <img src="/src/baesus_logo.png" alt="">
         <div class="share">
            <a href="https://web.facebook.com/Baseus.fans" class="fab fa-facebook-f" target="_blank"></a>
            <a href="https://twitter.com/Baseus_Global" class="fab fa-twitter" target="_blank"></a>
            <a href="https://www.instagram.com/baseus_global/" class="fab fa-instagram" target="_blank"></a>
            <a href="https://www.linkedin.com/company/baseuszp/" class="fab fa-linkedin" target="_blank"></a>
         </div>
         <h3>Baesus</h3>
      </div>

      <div class="box">
         <img src="/src/beats_logo.jpg" alt="">
         <div class="share">
            <a href="https://web.facebook.com/beatsbydre/" class="fab fa-facebook-f" target="_blank"></a>
            <a href="https://twitter.com/beatsbydre" class="fab fa-twitter" target="_blank"></a>
            <a href="https://www.instagram.com/beatsbydre/" class="fab fa-instagram" target="_blank"></a>
            <a href="https://www.linkedin.com/company/beats-by-dr.-dre" class="fab fa-linkedin" target="_blank"></a>
         </div>
         <h3>Beats</h3>
      </div>     
   </div>

</section> 

<?php include 'footer.php'; ?>

<script src="/scripts/sc_user.js"></script>
</body>
</html>