<head>
  <title>Cherished Shots - Home</title>
  <link rel="icon" href="image/camera.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>


<!-- -----------HEADER HERE !! --------------------- -->
<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"
        style="font-size: 30px; font-family:cursive; color: rgb(34, 224, 167);">Cherished Shots</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?php if (!isset($_GET['click'])) echo 'active'; ?>" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  <?php if (isset($_GET['click']) && $_GET['click'] == 'skills') echo 'active'; ?> " aria-current="page" href="home.php?click=skills">Experiences & Skills</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (isset($_GET['click']) && $_GET['click'] == 'contact') echo 'active'; ?> " aria-current="page" href="home.php?click=contact">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (isset($_GET['click']) && $_GET['click'] == 'Gallery') echo 'active'; ?> " aria-current="page" href="home.php?click=Gallery">Gallery</a>
          </li>



        </ul>
        <!-- -----------------ADMIN PANEL BUTTON HERE ------------------- -->

        <button class="btn btn-success mx-2 " onclick="window.location.href='home.php?click=Adminpanel'" >Admin Panel</button>


        <!-- -----------------LOGIN BUTTON HERE ------------------- -->
        <button type="submit" class="btn btn-outline-success mx-2  " data-bs-toggle="modal"
          data-bs-target="#login-modal">Login</button>
        <!-- -----------------LOGIN MODAL ------------------- -->
        <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5 " id="exampleModalLabel" style="color: rgba(255, 255, 255, 0.697); ">Login
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="color: white;">
                <!-- -----------------LOGIN FORM HERE--------------- -->
                <form action="" method="post">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="l-email" placeholder="name@example.com">
                    <label for="l-email">Email address</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="l-password" placeholder="Password">
                    <label for="l-password">Password</label>
                  </div>
                  <br>
                  <input type="checkbox" id="l-show-pwd"> <label for="show-pwd">Show Password</label> <br>
                  <button type="submit" class="btn btn-primary my-4">Login</button>
                  <div class="error"></div>
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>


              </div>
            </div>
          </div>
        </div>
        <!-- --------------SignUp BUTTON HERE ---------------------- -->
        <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#sign-modal">Sign up?</button>
        <!-- -----------------SIGN UP MODAL ------------------- -->
        <div class="modal fade" id="sign-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5 " id="exampleModalLabel" style="color: rgba(255, 255, 255, 0.697); ">Create an Account
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="color: white;">
                <!-- -----------------SignUP FORM HERE--------------- -->
                <form action="" method="post">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="username" id="s-email" placeholder="name@example.com">
                    <label for="s-email">Email address</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="s-password" placeholder="Password">
                    <label for="s-password">Password</label>
                  </div>
                  <div class="form-floating my-3">
                    <input type="password" class="form-control" id="s-re-password" placeholder="Re-type Password">
                    <label for="s-re-password ">Re-type Password</label>
                  </div>
                  <br>
                  <input type="checkbox" id="s-show-pwd"> <label for="show-pwd">Show Password</label> <br>
                  <button type="submit" class="btn btn-primary my-4">Get an Account</button>
                  <div class="error"></div>
                </form>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>



</header>
<script>
  // ---------------For LoginPage ----------------------------
  let email = document.getElementById("l-email");
  let password = document.getElementById("l-password");
  let show = document.getElementById("l-show-pwd");

  show.addEventListener("change", () => {
    if (show.checked) {
      password.type = "text";
    } else {
      password.type = "password";
    }

  });
  // ----------------For SignPage ------------------------------
  let semail = document.getElementById("s-email");
  let spassword = document.getElementById("s-password");
  let repassword = document.getElementById("s-re-password");
  let sshow = document.getElementById("s-show-pwd");

  sshow.addEventListener("change", () => {
    if (sshow.checked) {
      spassword.type = "text";
      repassword.type = "text";
    } else {
      spassword.type = "password";
      repassword.type = "password";
    }


  });
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
  integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
  crossorigin="anonymous"></script>


</body>

</html>