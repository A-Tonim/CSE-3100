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
    
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-0 px-4">
            <?php
                if(!isset($_GET['id'])){
                redirect('Rooms.php');
                }
                $data = filteration($_GET);
                $room_res = select("SELECT `room_id` FROM `hotel_rooms` WHERE `hotel_id`=?",[$data['id']],'i');
                $crow_res = select("SELECT * FROM `hotels` WHERE `id`=?",[$data['id']],'i');
               
                $crow_data1 = "";
                while($crow_data = mysqli_fetch_assoc($crow_res))
                {
                   $crow_data1 .="$crow_data[name]";
                }
                echo<<<data
                <div class="my-5 px-4">
                  <h2 class="fw-bold h-font text-center">$crow_data1</h2>
                  <div class="h-line bg-dark"></div>
                </div>
                data;
                while($room_data = mysqli_fetch_assoc($room_res))
                {
                    
                //get rooms of hotel
                $rm_q = mysqli_query($con,"SELECT * FROM `rooms` r
                WHERE `id`= '$room_data[room_id]'");
                
                $rm_data1 = ""; $rm_data2 = ""; $rm_data3 = ""; $rm_data4 = "";
                while($rm_row = mysqli_fetch_assoc($rm_q)){
                    $rm_data1 .= "$rm_row[name]";
                    $rm_data2 .= "$rm_row[price]";
                    $rm_data3 .= "$rm_row[adult]";
                    $rm_data4 .= "$rm_row[children]";
                }
            

                //get features of room
                $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f
                INNER JOIN `room_features` rfea ON f.id = rfea.features_id
                WHERE rfea.room_id = '$room_data[room_id]'");

                $features_data = "";
                while($fea_row = mysqli_fetch_assoc($fea_q)){
                    $features_data .= 
                    "<span class='badge rounded-pill  bg-light text-dark text-wrap me-1 mb-1'>
                        $fea_row[name]
                    </span>";
                }

                //get facilities of room
                $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
                INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                WHERE rfac.room_id = '$room_data[room_id]'");

                $facilities_data = "";
                while($fac_row = mysqli_fetch_assoc($fac_q)){
                    $facilities_data .= 
                    "<span class='badge rounded-pill  bg-light text-dark text-wrap me-1 mb-1'>
                        $fac_row[name]
                    </span>";
                }

                //get thumbnail of image
                $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
                WHERE `room_id`='$room_data[room_id]'");
                
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];

                //print room card
                echo<<<data
                    <div class="card mb-4 border-0 shadow">
                        <div class="row g-0 p-3 align-items-center">
                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                <img src="$room_thumb" class="img-fluid rounded">
                            </div>
                            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                <h5 class="mb-1">$rm_data1</h5>
                                <div class="features mb-3">
                                    <h6 class="mb-2">Features</h6>
                                    $features_data
                                </div>
                                <div class="facilities mb-3">
                                    <h6 class="mb-2">Facilities</h6>
                                    $facilities_data
                                </div>
                                <div class="guests ">
                                    <h6 class="mb-2">Guests</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    $rm_data3 Adults
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    $rm_data4  Children
                                    </span>       
                                </div>
                            </div>
                                <div class="col-md-2 text-center">
                                <h6 class="mb-4"> ৳ $rm_data2 per night</h6>
                               
                                <a href="room_details.php?id=$room_data[room_id]?hotelid=$data[id]" class="btn btn-sm w-100 btn-outline-dark shadow-none mb-3 ">More Details</a>
                            </div>
                        </div>
                    </div>
                data;
                }
            ?>
        </div>
    </div>
  </body>
</html>