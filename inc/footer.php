<footer id="footer">
      <a  href="home.html" id="logo"><span>Tour</span>Planner</a>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus fugiat, ipsa quos nulla qui alias.</p>
      <div class="social-links">
        <i class="fa-brands fa-twitter"></i>
        <i class="fa-brands fa-facebook"></i>
        <i class="fa-brands fa-instagram"></i>
        <i class="fa-brands fa-youtube"></i>
        <i class="fa-brands fa-pinterest-p"></i>
      </div>
      
    </footer>
    <!-- Footer End -->

<!-- custom js link -->

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



<script>

var swiper = new Swiper(".Swiper-destination", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView:"4",
      loop:true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints:{
        320:{
          sliderPerView:1
        },
        640:{
          sliderPerView:2
        },
        768:{
          slidesPerView:3
        },
        1024:{
          slidesPerView:4
        }
       
      }
    });
</script>