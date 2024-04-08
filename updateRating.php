<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $songId = $_POST['songId'];
    $rating = $_POST['rating'];

    // Update the rating in the database
    $sql = "UPDATE songlists SET rat_value = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $rating, $songId);

    $response = array();
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = "Rating update failed: " . $stmt->error;
    }

    echo json_encode($response);

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$con->close();
?>