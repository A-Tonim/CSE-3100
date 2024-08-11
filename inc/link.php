   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!--custom css link-->
   <link rel="stylesheet" href="style.css">
<!-- Bootstrap Link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootstrap Link -->
<!-- Font Awesome Cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<!-- Font Awesome Cdn -->
<!-- Google Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
<!-- Google Fonts -->
<!-- icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- icons -->
<!-- swiperjs -->
   <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
   <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js">></script>

<?php
   session_start();
   require('admin/inc/db_config.php');
   require('admin/inc/essentials.php');
   $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
   $values=[1];
   $settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));
   if($settings_r['shutdown']){
      echo<<<alertbar
      <div class='bg-danger text-center p-2 fw-bold'>
         Bookings are temporarily closed!
      </div>
      alertbar;
   }
?>