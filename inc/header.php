<!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="home.php" id="logo"><span>Tour</span>Planner</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span><i class="fa-solid fa-bars"></i></span>
      </button>
      <div class="collapse navbar-collapse " id="mynavbar">        
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="Hotels.php">Hotels</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="facilities.php">Facilities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About Us</a>
          </li>                       
        </ul>                  
        <div class="d-flex">
          <?php
            if(isset($_SESSION['login']) && $_SESSION['login'] == true)
            {
              $path = USERS_IMG_PATH;
              echo<<<data
              <div class="btn-group">
                <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  <img src="$path$_SESSION[uPic]" style="width: 25px; height: 25px" class="me-1 rounded-circle">
                  $_SESSION[uName]
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                  <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </div>
              data;
            }
            else{
              echo<<<data
                <ul class="navbar-nav me-auto">           
                  <li class="nav-item">
                    <a class="nav-link"data-bs-toggle="modal" data-bs-target="#LoginModal" href="#Login">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"data-bs-toggle="modal" data-bs-target="#SignupModal" href="#Signup">Signup</a>
                  </li>                            
                </ul>                         
              data;
            }
          ?>
        </div>                   
      </div>
    </div>
  </nav>
<!-- Navbar End -->

<!-- login start -->
  <div class="modal fade" id="LoginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="login-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-2 me-2"></i>User Login</h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email / Mobile</label>
              <input type="text" name="email_mob" required class="form-control shadow-none"  >
            </div>
            
            <div class="mb-4">
              <label for="exampleInputEmail1" class="form-label">Password</label>
              <input type="password" name="pass" required class="form-control shadow-none"  >
            </div>

            <div class="text-center my-1">
              <button type="submit" class="btn custom-btn-bg border shadow-none">LOGIN</button>
            </div>        
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- login end -->

<!-- signup -->
  <div class="modal fade" id="SignupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="Signup-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center " ><i class="bi bi-person-vcard fs-2 me-2"></i>User Registration</h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Name</label>
                  <input name="name" type="text" class="form-control shadow-none"required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Email</label>
                  <input name="email" type="email" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Phone Number</label>
                  <input name="phonenum" type="number" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Picture</label>
                  <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Date of Birth</label>
                  <input name="dob" type="date" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Password</label>
                  <input name="pass" type="password" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label  class="form-label">Confirm Password</label>
                  <input name="cpass" type="Password" class="form-control shadow-none" required>
                </div>
              </div>
            </div>
            <div class="text-center my-1">
              <button type="submit" class="btn custom-btn-bg border shadow-none">SignUp</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- signup end -->
 