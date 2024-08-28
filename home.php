<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Planner</title>
    <?php require('inc/link.php')?>
  </head>
  <body class="bg-light">
    <?php require('inc/header.php')?>
    <!-- Home Section Start -->

    <!-- Carousel Start-->
      <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
          <div class="swiper-wrapper">
            <?php
              $res = selectAll('carousel');
              while($row = mysqli_fetch_assoc($res))
              {
                $path = CAROUSEL_IMG_PATH;
                echo <<<data
                  <div class="swiper-slide">
                    <img src="$path$row[image]" class="w-100 d-block">
                  </div>
                data;
              }
            ?> 
          </div>
        </div>
      </div>
    <!-- Carousel End-->
   
    <!-- booking availablity Start-->
      <div class="container upper-slider">
        <div class="row ">
          <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="mb-4">check booking availability </h5>
            <form >
              <div class="row align-items-center">
                <div class="col-lg-3 mb-3">
                  <label  class="form-label" style="font-weight: 500;">check in</label>
                  <input type="date" class="form-control shadow-none"  >
                </div>    
                <div class="col-lg-3 mb-3">
                  <label  class="form-label" style="font-weight: 500;">check out</label>
                  <input type="date" class="form-control shadow-none"  >                                  
                </div>
                <div class="col-lg-3 mb-3">
                  <label  class="form-label" style="font-weight: 500;">adults</label>
                  <select class="form-select shadow-none" >     
                    <option value="1">1</option>
                    <option value="2" selected>2</option>
                    <option value="3">3</option>
                    <option value="4">3</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>     
                </div>
                <div class="col-lg-2 mb-3">
                  <label  class="form-label" style="font-weight: 500;">children</label>
                  <select class="form-select shadow-none" >     
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>          
                  </select> 
                </div>
                <div class="col-lg-1 mb-lg-2 mt-2 " >
                  <button type="submit" class=" btn shadow-none custom-btn-bg my-lg-4 border" >submit</button>
                </div>
              </div>           
            </form>
          </div>
        </div>
      </div>
    <!-- booking availablity End-->

    <!-- Popular Destinations Start-->
      <div class="container">
        <h1 class="mt-5 pt-4 mb-4 h-front text-color-black main-text"> Popular Destinations</h1>
        <br>
        <div class="swiper Swiper-destination">
          <div class="swiper-wrapper mb-5 ">
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>    
    <!-- Popular Destinations End-->

    <!-- Facilities Start-->
     
    <!-- Facilities End-->
    
    <!-- Reach Us Start -->
      <?php
        $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
        $values = [1];
        $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
      ?>
      <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
              <iframe class="w-100 rounded mb-4" height="320px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy"></iframe>
              <h5>Address</h5>
              <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block mb-2 text-decoration-none text-dark">
                <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address'] ?>
              </a>
            </div>
            <div class="col-lg-4 col-md-4">
              <div class="bg-white p-4 rounded mb-4">
                <h5>Call us</h5>
                <a href="tel: <?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                  <i class="bi bi-telephone-fill"><?php echo $contact_r['pn1'] ?></i>
                </a>
                <br>
                <?php
                  if($contact_r['pn2']!=''){
                    echo<<<data
                      <a href="tel: $contact_r[pn2]>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> $contact_r[pn2]
                      </a>
                    data;
                  }
                ?>
              </div>
              <div class="bg-white p-4 rounded mb-4">
                  <h5>Email</h5>
                  <a href="mail: <?php $contact_r['email'] ?>" class="d-inline-block mb-3">
                  <i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email'] ?>
              </div>
              <div class="bg-white p-4 rounded mb-4">
                <?php 
                  if($contact_r['tw'] != ''){
                    echo<<<data
                    <a href="$contact_r[tw]" class="d-inline-block mb-3">
                        <i class="bi bi-twitter me-1"></i> Twitter
                    </a>
                    data;
                  }
                ?>
                <br>
                <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
                    <i class="bi bi-facebook me-1"></i> Facebook
                </a>
                <br>
                <a href="<?php echo $contact_r['insta'] ?> class="d-inline-block">
                    <i class="bi bi-instagram me-1"></i> Instagram
                </a>
              </div>
            </div>
          </div>
        </div>
    <!-- Reach Us End -->
     
    <!-- Home Section End -->
    <?php require('inc/footer.php')?>
    <script>
      var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
          delay: 2500,
          disableonInteraction: false,
        },
      });
    </script>
  </body>
</html>