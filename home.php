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

    <!-- About Start -->
      <section class="about" id="about">
        <div class="container">
          <div class="main-txt align-text-center">
            <h1>About <span>Us</span></h1>
          </div>
          <div class="row" style="margin-top: 50px;">
            <div class="col-md-6 py-3 py-md-0">
              <div class="card">
                <img src="258.jpg" alt="">
              </div>
            </div>
          <div class="col-md-6 py-3 py-md-0">
            <h2>How Travel Agency Work</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident perferendis dolorem, numquam earum at nam beatae voluptate natus consectetur facere, saepe cupiditate ut exercitationem deserunt, facilis quam perspiciatis autem iure illo harum minima. Quas, vitae aperiam laudantium alias asperiores nulla rerum, nihil eveniet perferendis sint illum accusamus officiis aliquam nam.</p>
            <button class=" btn custom-btn-bg border">Read More...</button>
          </div>
        </div>
      </section>
    <!-- About End -->
      <br><br><br>
      <br><br><br>
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
        }
      });
    </script>
  </body>
</html>