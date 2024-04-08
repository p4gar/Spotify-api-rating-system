<?php
if (isset($_POST['user_id'])) {
    // Include the database connection file
    include('connection.php');

    // Get the user ID from the AJAX request
    $user_id = $_POST['user_id'];

    // Perform the delete operation in the database
    $sql = "DELETE FROM accounts WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $con->close();
} else {
    echo "Invalid request";
}
?>