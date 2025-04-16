<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CherishedShots";

// Create connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection failed
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle User Registration
if (isset($_POST['register'])) {
  $email = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

  // Check if email already exists
  $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $checkEmail->bind_param("s", $email);
  $checkEmail->execute();
  $result = $checkEmail->get_result();

  if ($result->num_rows > 0) {
    $error = "Email already exists!";
  } else {
    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);
    if ($stmt->execute()) {
      $_SESSION['success'] = "Registration successful! You can now log in.";
    } else {
      $error = "Failed to register!";
    }
  }
}

// Handle User Login
if (isset($_POST['login'])) {
  $email = $_POST['username'];
  $password = $_POST['password'];

  // Check if user exists
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $user['password'])) {
      $_SESSION['loggedin'] = true;
      $_SESSION['email'] = $user['email'];
      header("Location: home.php"); // Redirect to home.php after successful login
      exit();
    } else {
      $error = "Invalid password!";
    }
  } else {
    $error = "User not found!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cherished Shots - Home</title>
  <link rel="icon" href="image/camera.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <!-- -----------HEADER HERE !! --------------------- -->
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Cherished Shots</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link <?php if (!isset($_GET['click'])) echo 'active'; ?>" aria-current="page" href="home.php">Home</a></li>
            <li class="nav-item"><a class="nav-link  <?php if (isset($_GET['click']) && $_GET['click'] == 'skills') echo 'active'; ?> " aria-current="page" href="home.php?click=skills">Experiences & Skills</a></li>
            <li class="nav-item"><a class="nav-link <?php if (isset($_GET['click']) && $_GET['click'] == 'contact') echo 'active'; ?> " aria-current="page" href="home.php?click=contact">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link <?php if (isset($_GET['click']) && $_GET['click'] == 'gallery') echo 'active'; ?> " aria-current="page" href="home.php?click=gallery">Gallery</a></li>
          </ul>
          <!-- -----------------ADMIN PANEL BUTTON HERE ------------------- -->




          <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <span class="navbar-text">Welcome, <?php echo $_SESSION['email']; ?></span>
            <button class="btn btn-danger mx-2" onclick="window.location.href='logout.php'">Logout</button>


          <?php else: ?>
            <button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
            <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signup-modal">Sign Up</button>
          <?php endif; ?>

          <!-- Admin Panel Button -->
          <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <button class="btn btn-info mx-2" onclick="window.location.href='home.php?click=Adminpanel'">Admin Panel</button>
          <?php endif; ?>
        </div>
      </div>
    </nav>
  </header>

  <!-- LOGIN MODAL -->
  <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Login</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <div class="form-floating mb-3">
              <input type="email" class="form-control" name="username" placeholder="name@example.com" required>
              <label>Email address</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
              <label>Password</label>
            </div>
            <button type="submit" name="login" class="btn btn-primary my-4">Login</button>
          </form>
          <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- SIGNUP MODAL -->
  <div class="modal fade" id="signup-modal" tabindex="-1" aria-labelledby="signupLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Create an Account</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <div class="form-floating mb-3">
              <input type="email" class="form-control" name="username" placeholder="name@example.com" required>
              <label>Email address</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
              <label>Password</label>
            </div>
            <button type="submit" name="register" class="btn btn-primary my-4">Get an Account</button>
          </form>
          <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
          <?php if (isset($_SESSION['success'])) echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>"; ?>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>