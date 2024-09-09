<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Planner - ABOUT US</title>
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <?php require('inc/link.php')?>
    <style>
      .box{
        border-top-color: #2ec1ac !important
      }
    </style>
  </head>
  <body class="bg-light">
    <?php require('inc/header.php')?>
    <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    </div>
    <div class="container px-4">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper mb-5">
          <?php
            $about_r = selectAll('team_details');
            $path = ABOUT_IMG_PATH;
            while($row = mysqli_fetch_assoc($about_r)){
              echo<<<data
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                  <img src="$path$row[picture]" class="w-100">
                  <h5 class="mt-2">$row[name]</h5>
                </div>
              data;
            }
          ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
    <?php require('inc/footer.php')?>
    <script scr="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
      var swiper = new Swiper(".mySwiper",{
        spaceBetween: 40,
        pagination: {
          el: ".swiper-pagination",
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
          },
          640: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 3,
          },
          1024: {
            slidesPerView: 3,
          },
        }
      });
    </script>
  </body>
</html>