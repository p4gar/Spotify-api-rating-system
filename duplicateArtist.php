<?php
require 'connection.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $artistName = $_GET['artistName'];

    // Check for duplicate artist
    $sql = "SELECT COUNT(*) AS count FROM favoriteartists WHERE artist_name = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $artistName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
        echo "duplicate";
    } else {
        echo "not_duplicate";
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$con->close();
?>