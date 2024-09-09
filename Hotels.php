<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Planner</title>
    <!--front awesome cdn link-->
    <?php require('inc/link.php')?>
  </head>
  <body>
    <?php require('inc/header.php')?>
    <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">Our Hotels</h2>
      <div class="h-line bg-dark"></div>
    </div>
    <div class="container">
      <div class="row"> 
        <div class="col-lg-12 col-md-0 px-4">
          <?php
            $hotel_res = select("SELECT * FROM `hotels` WHERE `removed`=?",[0],'i');
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
                <div class="card mb-4 border-0 shadow">
                  <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                      <img src="$hotel_thumb" class="img-fluid rounded">
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                      <h5 class="mb-2">$hotel_data[name]</h5>
                      <div class="rooms mb-3">
                        <h6 class="mb-2">Rooms</h6>
                        $room_data
                      </div>
                      <div class="place mb-3">
                        <h6 class="mb-2">Place</h6>
                      <span class='badge rounded-pill  bg-light text-dark text-wrap me-1 mb-1'>
                          $hotel_data[place]
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 text-center">
                      <a href="Rooms.php?id=$hotel_data[id]" class="btn btn-sm w-100 btn-outline-dark shadow-none mb-3 ">More Details</a>
                    </div>
                  </div>
                </div>
              data;
            }
          ?>
        </div>
      </div>
    </div>
  <br><br><br>
  <?php require('inc/footer.php')?>
</body>
</html>