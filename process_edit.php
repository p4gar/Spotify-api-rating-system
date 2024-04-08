<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require 'connection.php';

    if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
    }

    $id = $_SESSION['id']; // Get the id from the session
    $name = $_POST["text"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Handle image upload
    if ($_FILES['profile_photo']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "web/"; // Adjust the upload directory as needed
        $targetFile = $targetDir . basename($_FILES["profile_photo"]["name"]);
        
        // Check if the temporary file exists
        if (file_exists($_FILES["profile_photo"]["tmp_name"])) {
            // Check if the target directory exists
            if (is_dir($targetDir)) {
                if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFile)) {
                    echo "<script>alert('Image uploaded successfully.');</script>";
                } else {
                    echo "<script>alert('Error uploading image.');</script>";
                }
            } else {
                echo "<script>alert('Target directory does not exist or is not accessible.');</script>";
            }
        } else {
            echo "<script>alert('Temporary file does not exist.');</script>";
        }
    }

    // Update data in the "accounts" table
    $query = "UPDATE accounts SET acc_username = '$name', acc_email = '$email', acc_password = '$password', acc_image = '$targetFile' WHERE id = $id";
    if (mysqli_query($con, $query)) {
        echo "<script>window.location.href = 'homepage.php?status=success';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating data: " . mysqli_error($con) . "');</script>";
    }

    mysqli_close($con);
}
?>
