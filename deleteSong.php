<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $songId = $_POST['songId'];

    // Delete the row from the database
    $sql = "DELETE FROM songlists WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $songId);

    $response = array();
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = "Deletion failed: " . $stmt->error;
    }

    echo json_encode($response);

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$con->close();
?>