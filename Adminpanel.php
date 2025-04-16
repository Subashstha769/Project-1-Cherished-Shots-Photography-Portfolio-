<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CherishedShots";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request for gallery
if (isset($_GET['delete_gallery'])) {
    $id = $_GET['delete_gallery'];

    // Delete image file from server
    $result = $conn->query("SELECT image_path FROM gallery WHERE id=$id");
    $row = $result->fetch_assoc();
    if ($row['image_path'] && file_exists($row['image_path'])) {
        unlink($row['image_path']);
    }

    // Delete the record
    $conn->query("DELETE FROM gallery WHERE id=$id");

    // Reorder IDs
    $conn->query("SET @count = 0");
    $conn->query("UPDATE gallery SET id = (@count := @count + 1)");
    $conn->query("ALTER TABLE gallery AUTO_INCREMENT = 1");
}

// Handle add/update request for gallery
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gallery_submit'])) {
    $title = $_POST['title'];
    $id = $_POST['id'] ?? null;

    // Handle image upload
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $image_path = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    if ($id) {
        // Update record
        $query = "UPDATE gallery SET title='$title'";
        if ($image_path) {
            $query .= ", image_path='$image_path'";
        }
        $query .= " WHERE id=$id";
        $conn->query($query);
    } else {
        // Add new record
        $conn->query("INSERT INTO gallery (title, image_path) VALUES ('$title', '$image_path')");
    }
}

// Handle delete request for contact
if (isset($_GET['delete_contact'])) {
    $id = $_GET['delete_contact'];

    // Delete the record
    $conn->query("DELETE FROM contact_info WHERE id=$id");

    // Reorder IDs
    $conn->query("SET @count = 0");
    $conn->query("UPDATE contact_info SET id = (@count := @count + 1)");
    $conn->query("ALTER TABLE contact_info AUTO_INCREMENT = 1");
}

// Fetch gallery images
$gallery_result = $conn->query("SELECT * FROM gallery");

// Fetch contact information
$contact_result = $conn->query("SELECT * FROM contact_info");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Panel</title>
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Contact Information</h2>

        <!-- Contact Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $contact_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td>
                            <a href="Adminpanel.php?delete_contact=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2 class="text-center mt-5">Gallery Management</h2>

        <!-- Add/Edit Form for Gallery -->
        <form method="POST" enctype="multipart/form-data" class="mb-4">
            <input type="hidden" name="id" id="gallery_id">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="title" id="gallery_title" class="form-control" placeholder="Image Title">
                </div>
                <div class="col-md-4">
                    <input type="file" name="image" id="gallery_image" class="form-control">
                </div>
                <div class="col-md-4">
                    <button type="submit" name="gallery_submit" class="btn btn-primary w-100">Save</button>
                </div>
            </div>
        </form>

        <!-- Gallery Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $gallery_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td>
                            <?php if ($row['image_path']): ?>
                                <img src="<?php echo $row['image_path']; ?>" alt="Image" width="50">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editGallery(<?php echo htmlspecialchars(json_encode($row)); ?>)">Edit</a>
                            <a href="Adminpanel.php?delete_gallery=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editGallery(record) {
            document.getElementById('gallery_id').value = record.id;
            document.getElementById('gallery_title').value = record.title;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>