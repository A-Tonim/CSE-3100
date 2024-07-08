    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container">
          <a class="navbar-brand  " href="home.html" id="logo"><span>Tour</span>Planner</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span><i class="fa-solid fa-bars"></i></span>
          </button>
          <div class="collapse navbar-collapse " id="mynavbar">
                    
                            <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                              <a class="nav-link active" href="home.php">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#about">About</a>
                            </li> 
                            <li class="nav-item">
                              <a class="nav-link " href="#Rooms">Rooms</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#Bus">Bus</a>
                            </li>
                    
                          </ul>
                  
                    <div class="d-flex ">
                            
                            <ul class="navbar-nav me-auto">
                          
                              <li class="nav-item">
                                <a class="nav-link"data-bs-toggle="modal" data-bs-target="#LoginModal" href="#Login">Login</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link"data-bs-toggle="modal" data-bs-target="#SignupModal" href="#Login">Signup</a>
                              </li>
                            
                            </ul>
                          
                    </div>
                    
          </div>
        </div>
      </nav>
    <!-- Navbar End -->

     <!-- login start -->

     <div class="modal fade" id="LoginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form >
              <div class="modal-header">
                          <h5 class="modal-title  " ><i class="bi bi-person-circle fs-2 me-2"></i>User Login</h5>
                          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control shadow-none"  >

                </div>
                <div class="mb-4">
                  <label for="exampleInputEmail1" class="form-label">Password</label>
                  <input type="password" class="form-control shadow-none"  >
                 
                </div>
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <button type="submit" class="btn custom-btn-bg border shadow-none ">LOGIN</button>
                    <a href="javascript: void(0)" class="text-secodary text-decoration-none">Forgot Password</a>
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
          <form >
              <div class="modal-header">
                          <h5 class="modal-title d-flex align-items-center " ><i class="bi bi-person-vcard fs-2 me-2"></i>User Registration</h5>
                          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-6 ps-0 mb-3">
                      <label class="form-label">Name</label>
                      <input type="text" class="form-control shadow-none"  >
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Email</label>
                      <input type="email" class="form-control shadow-none"  >
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Phone Number</label>
                      <input type="number" class="form-control shadow-none"  >
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Picture</label>
                      <input type="file" class="form-control shadow-none"  >
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Address</label>
                      <textarea class="form-control shadow-none" rows="1"></textarea>
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Date of Birth</label>
                      <input type="date" class="form-control shadow-none"  >
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Password</label>
                      <input type="password" class="form-control shadow-none"  >
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Confirm Password</label>
                      <input type="Password" class="form-control shadow-none"  >
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