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

    <!-- Hotel Start -->
     <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Hotels</h2>
     <div class="container">
      <div class="row">
        <?php
          $hotel_res = select("SELECT * FROM `hotels` WHERE `removed`=? LIMIT 3",[0],'i');
          while($hotel_data = mysqli_fetch_assoc($hotel_res))
          {
            $rm_q = mysqli_query($con,"SELECT r.name FROM `rooms` r
            INNER JOIN `hotel_rooms` hrms ON r.id = hrms.room_id
            WHERE hrms.hotel_id = '$hotel_data[id]'");

            $room_data = "";
          
            while($rm_row = mysqli_fetch_assoc($rm_q)){
              $room_data .= 
                "<span class='badge rounded-pill  bg-light text-dark text-wrap me-1 mb-1'>
                  $rm_row[name]
                </span>";
            }

            //get thumbnail of image
            $thumb_q = mysqli_query($con,"SELECT * FROM `hotel_images` 
            WHERE `hotel_id`='$hotel_data[id]'");
            
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $hotel_thumb = HOTELS_IMG_PATH.$thumb_res['image'];
            
            //print hotel card
            echo<<<data
              <div class="col-lg-4 col-md-5 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                  <img src="$hotel_thumb" class="card-img-top">
                  <div class="card-body">
                    <h5>$hotel_data[name]</h5>
                    <div class="place">
                      <h6>Place</h6>
                      <span class='badge rounded-pill  bg-light text-dark text-wrap me-1 mb-1'>
                        $hotel_data[place]
                      </span>
                    </div>
                    <div class="Rooms mb-3">
                      <h6>Rooms</h6>
                      $room_data
                    </div>
                    <div class="d-flex justify-content-evenly mb-2">
                      <a href="Rooms.php?id=$hotel_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                    </div>
                  </div>
                </div>
              </div>
            data;
          }
        ?>
        <div class="col-lg-12 text-center mt-5">
          <a href="hotels.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Hotels >>></a>
        </div>
      </div>
     </div>
    <!-- Hotel End -->
    
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