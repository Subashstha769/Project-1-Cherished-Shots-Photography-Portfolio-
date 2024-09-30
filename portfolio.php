<title>Cherished Shots - Home</title>
<link rel="icon" href="image/camera.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- --------------------------------- CSS STYLING HERE ! ---------------------------------  -->
<style>
  .card {}

  .card:hover {
    transform: scale(103%);
    box-shadow: 2px 2px 10px black;
    transition: 0.8s;
  }

  .error {
    color: red;
  }

  .slogan {
    position: relative;
    overflow: hidden;
    /* Ensure content stays within the container */
  }

  
  .btn:hover{
    transform: scale(102%);
    box-shadow: 2px 2px 10px black;
  }
  textarea{
    border: none;
    outline: none;
    text-align: center;
    display: inline-block;
    font-size: 17px;
  }
</style>
<?php
// Database connection details
$host = 'localhost'; // usually localhost
$user = 'root'; // default XAMPP MySQL username
$pass = ''; // default XAMPP MySQL password (usually empty)
$dbname = 'CherishedShots';

// Create a connection to the database
$conn = new mysqli($host, $user, $pass, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the existing slogan
$result = $conn->query("SELECT slogan FROM slogans WHERE id = 1");
$slogan = '';

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $slogan = $row['slogan'];
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new slogan from the form
    $slogan = isset($_POST['slogan']) ? $_POST['slogan'] : '';

    // Update the slogan in the database
    $stmt = $conn->prepare("UPDATE slogans SET slogan = ? WHERE id = 1");
    $stmt->bind_param("s", $slogan);
    $stmt->execute();
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!-- --------------------------------- MAIN SECTION  HERE ! ---------------------------------  -->
<main>
  <div id="carouselExampleCaptions" class="carousel slide carousel-fade " data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="image/slide-1.webp" height="700" class="d-block w-100 " alt="Slide-1">
        <div class="carousel-caption d-none d-md-block">
          <h5>Welcome to Cherished Shots</h5>
          <p>"Cherished Shots: Where Every Moment is Captured with Passion and Preserved with Perfection."</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="image/slide-2.jpg" height="700" class="d-block w-100 " alt="Slide-2">
        <div class="carousel-caption d-none d-md-block">
          <h5>Welcome to Cherished Shots</h5>
          <p>"Cherished Shots: Where Every Moment is Captured with Passion and Preserved with Perfection."</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="image/slide-3.jpg" height="700" class="d-block w-100 " alt="Slide-3">
        <div class="carousel-caption d-none d-md-block">
          <h5>Welcome to Cherished Shots</h5>
          <p>"Cherished Shots: Where Every Moment is Captured with Passion and Preserved with Perfection."</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- <div class="slogan container-fluid px-4 text-center my-4">
    <span class="typewriter-text">
      We are a team of passionate photographers with years of experience capturing unforgettable moments. From events to portraits, our goal is to deliver stunning images that clients will cherish forever. <br><br> Explore our work and connect with us for bookings!
    </span>

    <div class="container my-3">
      <button class="btn btn-success" id>Edit</button>
      <button class="btn text-bg-dark">Save Changes</button>
    </div>
  </div> -->
  <div class="container my-4">
        
        <form method="post">
            <div class="form-group">
                <textarea class="form-control" name="slogan" rows="5" style="font-family:monospace;"><?php echo htmlspecialchars($slogan); ?></textarea>

            </div>
            <div class="container my-2 text-center"><button type="submit" class="btn btn-success">Save Changes</button></div>
            
        </form>
    </div>
  <p class="h2 text-center my-4">Projects</p>
  <div class="container-fluid justify-content-center  my-4 d-flex flex-wrap ">
    <!-- ---------------Project-1 ----------------------------- -->

    <div class="card mx-3 my-2" style="width: 20rem;">
      <img src="https://media-cdn.tripadvisor.com/media/photo-s/1d/b5/55/24/hiwaga-weddings-team.jpg"
        class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Wedding Photography</h5>
        <p class="card-text">Capturing timeless moments of love and joy, our wedding photography tells the story of
          your special day with elegance and creativity</p>
        <a href="https://www.google.com/search?q=wedding+photography&sca_esv=820aaa15062e62d5&rlz=1C5CHFA_enNP1032NP1032&udm=2&biw=1440&bih=813&sxsrf=ADLYWIKDtgBDkBty_zWVc3CFmkqmNtetJA%3A1724252217066&ei=OQDGZurVA-2k2roP8NfcyAY&ved=0ahUKEwiq1pqHrIaIAxVtklYBHfArF2kQ4dUDCBA&uact=5&oq=wedding+photography&gs_lp=Egxnd3Mtd2l6LXNlcnAiE3dlZGRpbmcgcGhvdG9ncmFwaHkyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyBRAAGIAESMUHUABYAHABeACQAQCYAQCgAQCqAQC4AQPIAQCYAgGgAgmYAwCIBgGSBwExoAcA&sclient=gws-wiz-serp"
          class="btn btn-outline-success">View</a>
      </div>
    </div>
    <!-- ---------------Project-2 ----------------------------- -->
    <div class="card mx-3 my-2" style="width: 20rem;">
      <img
        src="https://www.jesvenues.com/images/services/corporate-photography/corporate-event-photography-in-hyderabad-1.jpg"
        class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Event Photography</h5>
        <p class="card-text">Capturing the essence of every occasion with creativity and precision. From intimate
          gatherings to grand celebrations, our photos tell the story of your special moments.</p>
        <a href="https://www.google.com/search?q=Event+photography&sca_esv=820aaa15062e62d5&rlz=1C5CHFA_enNP1032NP1032&udm=2&biw=1440&bih=813&sxsrf=ADLYWIKIfl63Cbcv2ln0JknWnCrM6nU-Lg%3A1724253231860&ei=LwTGZp2WNIPc2roP6KmT8Aw&ved=0ahUKEwjd6Yzrr4aIAxUDrlYBHejUBM4Q4dUDCBA&uact=5&oq=Event+photography&gs_lp=Egxnd3Mtd2l6LXNlcnAiEUV2ZW50IHBob3RvZ3JhcGh5MgoQABiABBhDGIoFMgUQABiABDIFEAAYgAQyBRAAGIAEMgUQABiABDIFEAAYgAQyBRAAGIAEMgUQABiABDIFEAAYgAQyBRAAGIAESP8CUABYAHABeACQAQCYAQCgAQCqAQC4AQPIAQCYAgGgAgaYAwCIBgGSBwExoAcA&sclient=gws-wiz-serp"
          class="btn btn-outline-success">View</a>
      </div>
    </div>
    <!-- ---------------Project-3 ----------------------------- -->
    <div class="card mx-3 my-2" style="width: 20rem;">
      <img
        src="https://media.istockphoto.com/id/1034301914/photo/nature-photographer-norway-lofoten-archipelago.webp?b=1&s=170667a&w=0&k=20&c=jwzlo-cFxJv0xaN-ral78aJRTKrVRxuZ8W8SfwwQC0c="
        class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Travel Photography</h5>
        <p class="card-text">Travel photography showcases breathtaking landscapes and vibrant cultures from around the
          globe. Each image tells a story of adventure and discovery.</p>
        <a href="https://www.google.com/search?q=travel+photography&sca_esv=820aaa15062e62d5&rlz=1C5CHFA_enNP1032NP1032&udm=2&biw=1440&bih=813&sxsrf=ADLYWIIep-H6qznPVDJMvuuLyumKUCoy9g%3A1724253757947&ei=PQbGZoO6OeeN2roPqtac0Q4&ved=0ahUKEwjDzPrlsYaIAxXnhlYBHSorJ-oQ4dUDCBA&uact=5&oq=travel+photography&gs_lp=Egxnd3Mtd2l6LXNlcnAiEnRyYXZlbCBwaG90b2dyYXBoeTIKEAAYgAQYQxiKBTIKEAAYgAQYQxiKBTIKEAAYgAQYQxiKBTIFEAAYgAQyBRAAGIAEMgUQABiABDIFEAAYgAQyBRAAGIAEMgUQABiABDIFEAAYgARI8gFQAFgAcAF4AJABAJgBAKABAKoBALgBA8gBAJgCAaACCZgDAIgGAZIHATGgBwA&sclient=gws-wiz-serp"
          class="btn btn-outline-success">View</a>
      </div>
    </div>
    <!-- ---------------Project-4 ----------------------------- -->

    <div class="card mx-3 my-2" style="width: 20rem;">
      <img src="https://cloudfront.omsphoto.com/wp-content/uploads/2023/12/GucciGuilty59015.jpg" class="card-img-top"
        alt="...">
      <div class="card-body">
        <h5 class="card-title">Product Photography</h5>
        <p class="card-text">Showcasing products with precision and creativity to highlight their features and appeal.
          High-quality images designed to attract and engage potential buyers.</p>
        <a href="https://www.google.com/search?q=product+photography&sca_esv=820aaa15062e62d5&rlz=1C5CHFA_enNP1032NP1032&udm=2&biw=1440&bih=813&sxsrf=ADLYWILQ9MAN_1Um4AENuajxH7YDCglgvQ%3A1724253336302&ei=mATGZoCQEr_l2roP_-P0wAE&ved=0ahUKEwiAvPOcsIaIAxW_slYBHf8xHRgQ4dUDCBA&uact=5&oq=product+photography&gs_lp=Egxnd3Mtd2l6LXNlcnAiE3Byb2R1Y3QgcGhvdG9ncmFwaHkyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyChAAGIAEGEMYigUyBRAAGIAEMgUQABiABDIFEAAYgARIxwtQAFgAcAF4AJABAJgBAKABAKoBALgBA8gBAJgCAaACCJgDAIgGAZIHATGgBwA&sclient=gws-wiz-serp"
          class="btn btn-outline-success">View</a>
      </div>
    </div>

  </div>


</main>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
  integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
  crossorigin="anonymous"></script>