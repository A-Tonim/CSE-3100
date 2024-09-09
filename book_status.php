<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Planner-BOOKING STATUS</title>
    <!--front awesome cdn link-->
    <?php require('inc/link.php')?>
  </head>
  <body class="bg-light">
    <?php require('inc/header.php')?>
    <div class="container">
      <div class="row">
        <div class="col-12 my-5 mb-4 px-4">
          <h2 class="fw-bold">BOOKING STATUS</h2>
        </div>
        <?php
          $frm_data = filteration($_GET);
          if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
            redirect('home.php');
          }
          echo<<<data
            <div class="col-12 px-4">
              <p class="fw-bold alert alert-success"
                <i class="bi bi-check-circle-fill"></i>
                Booking successful!
                <br><br>
                <a href='bookings.php'>Go to Bookings</a> 
              </p>
            </div>
          data;
        ?>
      </div>
    </div>
   <?php require('inc/footer.php')?>
</body>
</html>