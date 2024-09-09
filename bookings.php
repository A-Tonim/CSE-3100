<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Planner-BOOKINGS</title>
    <!--front awesome cdn link-->
    <?php require('inc/link.php')?>
  </head>
  <body class="bg-light">
    <?php 
      require('inc/header.php');
      if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
        redirect('home.php');
      }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-12 my-5 px-4">
          <h2 class="fw-bold">BOOKINGS</h2>
          <div style="font-size: 14px;">
            <a href="home.php" class="text-secondary text-decoration-none">HOME</a>
            <span class="text-secondary"> > </span>
            <a href="#" class="text-secondary text-decoration-none">BOOKINGS</a>
          </div>
        </div>
        <?php
          $query = "SELECT bo.*, bd.* FROM `booking_order` bo
          INNER JOIN `booking_details` bd on bo.booking_id = bd.booking_id
          WHERE (bo.user_id=?)
          ORDER BY bo.booking_id DESC";
          $result = select($query,[$_SESSION['uId']],'i');
          while($data = mysqli_fetch_assoc($result))
          {
            $date = date("d-m-Y",strtotime($data['datentime']));
            $checkin = date("d-m-Y",strtotime($data['check_in']));
            $checkout = date("d-m-Y",strtotime($data['check_out']));

            echo<<<bookings
              <div class='col-md-4 px-4 mb-4'>
                <div class='bg-white p-3 rounded shadow-sm'>
                  <h5 class='fw-bold'>$data[room_name]</h5>
                  <p>$data[price]৳ per night</p>
                  <p>
                    <b>Check in: </b> $checkin <br>
                    <b>Check out: </b> $checkout
                  </p>
                  <p>
                    <b>Amount: </b> $data[price] <br>
                    <b>Date: </b> $date
                  </p>
                </div>
              </div>
            bookings;
          }
        ?>
      </div>
    </div>
    <?php require('inc/footer.php')?>
</body>
</html>