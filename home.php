<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cherished Shots - Home</title>
  <link rel="icon" href="image/camera.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



  
</head>
<body>
    <?php
    
    //  --------------------------------- INCLUDING HEADER  ---------------------------------  
    include("CS_header.php");
    ?>
    
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert" id="adminAlert">
    <strong>Enable Admin Button!</strong> Login first to enable Admin Panel button.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>



    <?php
     //  --------------------------------- INCLUDING MAIN SECTION  --------------------------------- 

    if(isset($_GET['click'])){
        include($_GET['click'].".php");
    }
    else{
        include("portfolio.php");
    }
 //  --------------------------------- INCLUDING FOOTER  --------------------------------- 
    include("CS_footer.php");
    
    ?>
    <script>
  // Automatically dismiss the alert after 10 seconds
  setTimeout(function() {
    var alertElement = document.getElementById('adminAlert');
    if (alertElement) {
      var bootstrapAlert = new bootstrap.Alert(alertElement);
      bootstrapAlert.close();
    }
  }, 5000); // 10000 milliseconds = 10 seconds
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>
</html>