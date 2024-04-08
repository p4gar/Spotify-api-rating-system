<?php
require 'connection.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artistName = $_POST['artistName'];
    $genres = $_POST['genres'];

    // Insert artist data into the database
    $sql = "INSERT INTO favoriteartists (artist_name, artist_genre) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $artistName, $genres);

    $response = array();
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = "Insertion failed: " . $stmt->error;
    }

    echo json_encode($response);

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$con->close();
?>