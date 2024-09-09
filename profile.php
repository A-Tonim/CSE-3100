<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Planner-PROFILE</title>
    <!--front awesome cdn link-->
    <?php require('inc/link.php')?>
  </head>
  <body class="bg-light">
    <?php 
      require('inc/header.php');
      if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
        redirect('home.php');
      }
      $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],'s');
      if(mysqli_num_rows($u_exist) == 0){
        redirect('home.php');
      }
      $u_fetch = mysqli_fetch_assoc($u_exist);
    ?>
    <div class="container">
      <div class="row">
        <div class="col-12 my-5 px-4">
          <h2 class="fw-bold">PROFILE</h2>
          <div style="font-size: 14px;">
            <a href="home.php" class="text-secondary text-decoration-none">HOME</a>
            <span class="text-secondary"> > </span>
            <a href="#" class="text-secondary text-decoration-none">PROFILE</a>
          </div>
        </div>

        <div class="col-12 mb-5 px-4">
          <div class="bg-white p-3 p-md-4 rounded shadow-sm">
            <form id="info-form">
              <h5 class="mb-3 fw-bold">Basic Information</h5>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label">Name</label>
                  <input name="name" type="text" value="<?php echo $u_fetch['name'] ?>"class="form-control shadow-none"required>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Phone Number</label>
                  <input name="phonenum" type="number" value="<?php echo $u_fetch['phonenum'] ?>" class="form-control shadow-none"required>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Date of Birth</label>
                  <input name="dob" type="date" value="<?php echo $u_fetch['dob'] ?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-8 mb-4">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $u_fetch['address'] ?></textarea>
                </div>
              </div>
              <button type="submit" class="btn text-white custom-btn-bg shadow-none">Save Changes</button>
            </form>
          </div>
        </div>

        <div class="col-md-4 mb-5 px-4">
          <div class="bg-white p-3 p-md-4 rounded shadow-sm">
            <form id="profile-form">
              <h5 class="mb-3 fw-bold">Picture</h5>
              <img src="<?php echo USERS_IMG_PATH.$u_fetch['profile'] ?>" class="rounded-circle img-fluid mb-3">
             
              <label class="form-label">New Picture</label>
              <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="mb-4 form-control shadow-none" required>
              
              <button type="submit" class="btn text-white custom-btn-bg">Save Changes</button>
            </form>
          </div>
        </div>

       

      </div>
    </div>
    <script>
      let info_form = document.getElementById('info-form');
      info_form.addEventListener('submit',function(e){
        e.preventDefault();
        let data = new FormData();
        data.append('info_form','');
        data.append('name',info_form.elements['name'].value);
        data.append('phonenum',info_form.elements['phonenum'].value);
        data.append('address',info_form.elements['address'].value);
        data.append('dob',info_form.elements['dob'].value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/profile.php",true);

        xhr.onload = function(){
          if(this.responseText == 'phone_already'){
            alert('error',"Phone number is already registered!");
          }
          else if(this.responseText == 0){
            alert('error',"No Changes Made!");
          }
          else{
            alert('success',"Changes Saved!");
          }
        }
        xhr.send(data);
      });
      let profile_form = document.getElementById('profile-form');
      profile_form.addEventListener('submit',function(e){
        e.preventDefault();

        let data = new FormData();
        data.append('profile_form','');
        data.append('profile',profile_form.elements['profile'].files[0]);
      

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/profile.php",true);

        xhr.onload = function(){
          if(this.responseText == 'inv_img'){
            alert('error',"Only JPG, WEBP & PNG images are allowed!");
          }
          else if(this.responseText == 'upd_failed'){
            alert('error',"Image upload failed!");
          }
          else if(this.responseText == 0){
            alert('error',"Updation failed!");
          }
          else{
            window.location.href = window.location.pathname;
          }
        }
        xhr.send(data);
      });
      
    
    </script>
    <?php require('inc/footer.php')?>
    <link rel="stylesheet" href="style.css">
</body>
</html>