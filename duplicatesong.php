<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['trackName'])) {
    $track_name = $_GET['trackName'];

    // Check if the song with the same name already exists
    $check_sql = 'SELECT COUNT(*) FROM songlists WHERE track_name = ?';
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param("s", $track_name);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        echo "duplicate";
    } else {
        echo "not_duplicate";
    }
} else {
    echo "Invalid request.";
}

$con->close();
?>