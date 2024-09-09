<?php
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();
   if(isset($_POST['add_hotel']))
   {
      $rooms = filteration(json_decode($_POST['rooms']));

      $frm_data = filteration($_POST);
      $flag = 0;

      $q1 = "INSERT INTO `hotels`(`name`, `place`, `description`) VALUES (?,?,?)";
      $values = [$frm_data['name'],$frm_data['place'],$frm_data['desc']];

      if(insert($q1,$values,'sss')){
        $flag = 1;
      }
      $hotel_id = mysqli_insert_id($con);

      $q2 = "INSERT INTO `hotel_rooms`(`hotel_id`, `room_id`) VALUES (?,?)";

      if($stmt = mysqli_prepare($con,$q2)){
        foreach($rooms as $r){
            mysqli_stmt_bind_param($stmt,'ii',$hotel_id,$r);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
      }
      else{
        $flag = 0;
        die('query cannot be prepared - insert');
      }
      if($flag){
        echo 1;
      }
      else{
        echo  0;
      }
   }
   if(isset($_POST['get_all_hotels']))
   {
      $res = select("SELECT * FROM `hotels` WHERE `removed`=?",[0],'i');
      $i = 1;
      $data = "";
      while($row = mysqli_fetch_assoc($res))
      {
        $data.="
          <tr class='align-middle'>
            <td>$i</td>
            <td>$row[name]</td>
            <td>$row[place]</td>
            <td>
              <button type='button' onclick='edit_details($row[id])'class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-hotel'>
                <i class='bi bi-pencil-square'></i>
              </button>
              <button type='button' onclick=\"hotel_images($row[id],'$row[name]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#hotel-images'>
                <i class='bi bi-images'></i>
              </button>
                <button type='button' onclick='remove_hotel($row[id])' class='btn btn-danger shadow-none btn-sm'>
                  <i class='bi bi-trash'></i>
                </button>
            </td>
        ";
        $i++;
      }
      echo $data;
   }
   if(isset($_POST['get_hotel']))
   {
      $frm_data = filteration($_POST);
      $res1 = select("SELECT * FROM `hotels` WHERE `id`=?",[$frm_data['get_hotel']],'i');
      $res2 = select("SELECT * FROM `hotel_rooms` WHERE `hotel_id`=?",[$frm_data['get_hotel']],'i');
       
      $hoteldata = mysqli_fetch_assoc($res1);
      $rooms = [];
       
       if(mysqli_num_rows($res2) > 0){
        while($row = mysqli_fetch_assoc($res2)){
          array_push($rooms,$row['room_id']);
        }
       }
       $data = ["hoteldata" => $hoteldata, "rooms" => $rooms];
       $data = json_encode($data);
       echo $data;
   }
   if(isset($_POST['edit_hotel']))
   {
      $rooms = filteration(json_decode($_POST['rooms']));
      
      $frm_data = filteration($_POST);
      $flag = 0;

      $q1 = "UPDATE `hotels` SET `name`=?,`place`=?,`description`=? WHERE `id`=?";
      $values = [$frm_data['name'],$frm_data['place'],$frm_data['desc'],$frm_data['hotel_id']];
      if(update($q1,$values,'sssi')){
        $flag = 1;
      }
      $del_rooms = delete("DELETE FROM `hotel_rooms` WHERE `hotel_id`=?",[$frm_data['hotel_id']],'i');
       
      if(!($del_rooms)){
        $flag = 0;
      }

      $q2 = "INSERT INTO `hotel_rooms`(`hotel_id`, `room_id`) VALUES (?,?)";
      if($stmt = mysqli_prepare($con,$q2)){
        foreach($rooms as $r){
            mysqli_stmt_bind_param($stmt,'ii',$frm_data['hotel_id'],$r);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
      }
      else{
        $flag = 0;
        die('query cannot be prepared - insert');
      }
      if($flag){
        echo 1;
      }
      else{
        echo 0;
      }
   }
   if(isset($_POST['add_image']))
    {
        $frm_data = filteration($_POST);
        $img_r = uploadImage($_FILES['image'],HOTELS_FOLDER);
        if($img_r == 'inv_img'){
          echo $img_r;
        }
        else if($img_r == 'inv_size'){
          echo $img_r;
        }
        else if($img_r == 'upd_failed'){
          echo $img_r;
        }
        else{
          $q = "INSERT INTO `hotel_images`(`hotel_id`, `image`) VALUES (?,?)";
          $values = [$frm_data['hotel_id'],$img_r];
          $res = insert($q,$values,'is');
          echo $res;
        }
    }
    if(isset($_POST['get_hotel_images']))
    {
        $frm_data = filteration($_POST);
        $res = select("SELECT * FROM `hotel_images` WHERE `hotel_id`=?",[$frm_data['get_hotel_images']],'i');
        $path = HOTELS_IMG_PATH;
        while($row = mysqli_fetch_assoc($res))
        {
            echo<<<data
                <tr class='align-middle'>
                    <td><img src='$path$row[image]' class='img-fluid'</td>
                    <td>
                      <button onclick='rem_image($row[sr_no],$row[hotel_id])' class='btn btn-danger shadow-none'>
                        <i class='bi bi-trash'></i>
                      </button>
                    </td>
                </tr>
            data;
        }
    }
    if(isset($_POST['rem_image']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['image_id'], $frm_data['hotel_id']];
        $pre_q = "SELECT * FROM `hotel_images` WHERE `sr_no`=? AND `hotel_id`=?";
        $res = select($pre_q,$values,'ii');
        $img = mysqli_fetch_assoc($res);
        if(deleteImage($img['image'],HOTELS_FOLDER)){
            $q = "DELETE FROM `hotel_images` WHERE `sr_no`=? AND `hotel_id`=?";
            $res = delete($q,$values,'ii');
            echo $res;
        }
        else{
            echo 0;
        }
    }
    if(isset($_POST['remove_hotel']))
    {
        $frm_data = filteration($_POST);

        $res1 = select("SELECT * FROM `hotel_images` WHERE `hotel_id`=?",[$frm_data['hotel_id']],'i');
        while($row = mysqli_fetch_assoc($res1)){
            deleteImage($row['image'],HOTELS_FOLDER);
        }

        $res2 = delete("DELETE FROM `hotel_images` WHERE `hotel_id`=?",[$frm_data['hotel_id']],'i');
        $res3 = delete("DELETE FROM `hotel_rooms` WHERE `hotel_id`=?",[$frm_data['hotel_id']],'i');
        $res4 = update("UPDATE `hotels` SET `removed`=? WHERE `id`=?",[1,$frm_data['hotel_id']],'ii');

        if($res2 || $res3 || $res4){
          echo 1;
        }
        else{
          echo 0;
        }
    }
?>