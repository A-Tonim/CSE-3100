<?php
  $settings_q = "SELECT `site_about` FROM `settings` WHERE `sr_no`=?";
  $values = [1];
  $settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));
?>
<!-- Footer Start -->
  <footer id="footer">
    <a href="home.html" id="logo"><span>Tour</span>Planner</a>
    <h6><?php echo $settings_r['site_about'] ?></h6>
    <div class="social-links">
      <i class="fa-brands fa-twitter"></i>
      <i class="fa-brands fa-facebook"></i>
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-youtube"></i>
      <i class="fa-brands fa-pinterest-p"></i>
    </div>
  </footer>
<!-- Footer End -->

<!-- custom js link -->=
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script>
  function alert(type,msg,position='body')
  {
      let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
      let element = document.createElement('div');
      element.innerHTML = `
      <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
          <strong class="me-3">${msg}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      `;
      if(position == 'body'){
          document.body.append(element);
          element.classList.add('custom-alert');
      }
      else{
          document.getElementById(position).appendChild(element);
      }
      setTimeout(remAlert, 3000);
  }
  function remAlert(){
      document.getElementsByClassName('alert')[0].remove();
  }
  let Signup_form = document.getElementById('Signup-form');

  Signup_form.addEventListener('submit', (e)=>{
    e.preventDefault();
    let data = new FormData();
    data.append('name',Signup_form.elements['name'].value);
    data.append('email',Signup_form.elements['email'].value);
    data.append('phonenum',Signup_form.elements['phonenum'].value);
    data.append('address',Signup_form.elements['address'].value);
    data.append('dob',Signup_form.elements['dob'].value);
    data.append('pass',Signup_form.elements['pass'].value);
    data.append('cpass',Signup_form.elements['cpass'].value);
    data.append('profile',Signup_form.elements['profile'].files[0]);
    data.append('Signup','');

    var myModal = document.getElementById('SignupModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_Signup.php",true);

    xhr.onload = function(){
      if(this.responseText == 'pass_mismatch'){
        alert('error',"Password mismatch!");
      }
      else if(this.responseText == 'email_already'){
        alert('error',"Email is already registered!");
      }
      else if(this.responseText == 'phone_already'){
        alert('error',"Phone number is already registered!");
      }
      else if(this.responseText == 'inv_img'){
        alert('error',"Only JPG,WEBP & PNG images are allowed!");
      }
      else if(this.responseText == 'upd_failed'){
        alert('error',"Image upload failed!");
      }
      else if(this.responseText == 'ins_failed'){
        alert('error',"Registration failed. Server down!");
      }
      else{
        alert('success',"Registration successful");
        Signup_form.reset();
      }
    }
    xhr.send(data);
  });

  let login_form = document.getElementById('login-form');
  
  login_form.addEventListener('submit', (e)=>{
    e.preventDefault();

    let data = new FormData();

    data.append('email_mob',login_form.elements['email_mob'].value);
    data.append('pass',login_form.elements['pass'].value);
    data.append('login','');

    var myModal = document.getElementById('loginModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    //modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_Signup.php",true);

    xhr.onload = function(){
      if(this.responseText == 'inv_email_mob'){
        alert('error',"Invalid Email or Mobile Number!");
      }
      else if(this.responseText == 'invactive'){
        alert('error',"Account Suspended! Please contact Admin.");
      }
      else if(this.responseText == 'invalid_pass'){
        alert('error',"Incorrect Password!");
      }
      else{
        let fileurl = window.location.href.split('/').pop().split('?').shift();
        if(fileurl == 'room_details.php'){
          window.location = window.location.href;
        }
        else{
          window.location = window.location.pathname;
        }
      }
    }
    xhr.send(data);
  });

  function checkLoginToBook(status,room_id){
    if(status){
      window.location.href = 'confirm_booking.php?id='+room_id;
    }
    else{
      alert('error','Please Login to book room!');
    }
  }
</script>
