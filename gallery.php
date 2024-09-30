<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CherishedShots";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle image upload
if (isset($_POST['upload'])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Debug - Check if file is uploaded
    if ($_FILES['image']['error'] == 0) {
        echo "File upload successful.";
    } else {
        echo "Error in file upload: " . $_FILES['image']['error'];
    }

    // Check if file is a valid image
    if (getimagesize($_FILES["image"]["tmp_name"]) !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Insert image into database
            $stmt = $conn->prepare("INSERT INTO gallery_images (image_path) VALUES (?)");
            $stmt->bind_param("s", $targetFile);
            if ($stmt->execute()) {
                $_SESSION['success'] = "Image uploaded successfully!";
            } else {
                $_SESSION['error'] = "Failed to insert image: " . $stmt->error;
            }
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        }
    } else {
        $_SESSION['error'] = "File is not an image.";
    }
}

// Handle image deletion
if (isset($_GET['delete'])) {
    $imageId = $_GET['delete'];

    // Get image path from database
    $stmt = $conn->prepare("SELECT image_path FROM gallery_images WHERE id = ?");
    $stmt->bind_param("i", $imageId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Delete image file from server
    if (file_exists($row['image_path'])) {
        if (unlink($row['image_path'])) {
            echo "File deleted successfully.";
        } else {
            echo "Failed to delete file.";
        }
    }

    // Delete image entry from database
    $stmt = $conn->prepare("DELETE FROM gallery_images WHERE id = ?");
    $stmt->bind_param("i", $imageId);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Image deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete image: " . $stmt->error;
    }
}

// Fetch all images from the database
$result = $conn->query("SELECT * FROM gallery_images");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Cherished Shots</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="my-4">Gallery</h1>

        <!-- Success/Error Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Image Upload Form -->
        <form action="" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="input-group">
                <input type="file" name="image" class="form-control" required>
                <button type="submit" name="upload" class="btn btn-primary">Add Image</button>
            </div>
        </form>

        <!-- Gallery Grid -->
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="card mb-4">
                        <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <a href="gallery.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>