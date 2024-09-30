<title>Cherished Shots - Home</title>
  <link rel="icon" href="image/camera.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    

    <main>
        <div class="container my-4  ">
            <div class="row">
                <div class="col-sm col-md-6 col-lg-6">
                    <img src="https://www.signupgenius.com/cms/images/business/appointment-scheduling-tips-photographers-article-600x400.jpg"
                        style="height: 85vh; width: 45vw;" alt="">

                </div>
                <div class="col-sm col-md-6 col-lg-6 bg-dark text-white">
                    <p class="h2  my-4 text-center " style="font-size: 3rem;">Get In Touch</p><br><br>
                    <div class="container-fluid">
                        <p class="h5 text-center" style="color: rgb(138, 135, 135); font-family:Verdana, Geneva, Tahoma, sans-serif;">If you want to get in touch you can email me at <br> cherished769@gmail.com or fill
                            out the contract form below.</p>
                    </div>
                    <br>
                    <div class="container my-5 " style="height: auto;">
                        <!-- ------------------------------- FORM HERE !! ------------------- -->
                        <form action="" method="POST">
                            <div class="row" >
                                <div class="col">
                                    <input type="text" class="form-control" name="first_name" placeholder="First name"
                                        aria-label="First name" autocomplete="off" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="Last name"
                                        aria-label="Last name" required>
                                </div>
                            </div>
                            <div class="row mb-3 my-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email:-</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="inputEmail3" required>
                                </div>
                            </div>
                            <div class="row mb-3 my-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Phone no:- </label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" name="phone" id="ph-num" autocomplete="off" required>
                                </div>
                            </div>
                            
                            

                            <div class="d-grid gap-4">
                                <button type="submit" class="btn btn-primary my-4 btn-lg" >Submit</button>

                            </div>


                        </form>
                    </div>
                    <hr style="color: white;">
                    <div class="container">
                        <p class="text-center">&copy; 2024 Cherished Short. All reserved</p>
                        
                        
                    </div>

                </div>
            </div>
            
        </div>
    </main>
    <?php
// Database connection
$servername = "localhost";
$username = "root"; // default username
$password = ""; // default password (leave empty)
$dbname = "CherishedShots";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contact_info (first_name, last_name, email, phone) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $first_name, $last_name, $email, $phone);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
    
    exit;
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
    