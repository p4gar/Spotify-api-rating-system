<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageURL = $_POST['imageURL'];
    $track_name = $_POST['trackName'];
    $track_artist = $_POST['artistName'];
    $track_duration = $_POST['duration'];
    $track_album = $_POST['albumName'];

    // Check if the song already exists in the database
    $check_query = 'SELECT COUNT(*) AS count FROM songlists WHERE track_name = ?';
    $check_stmt = $con->prepare($check_query);
    $check_stmt->bind_param("s", $track_name);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $row = $check_result->fetch_assoc();
    $song_count = $row['count'];


    $insert_query = 'INSERT INTO songlists (track_image, track_name, track_artist, track_duration, track_album) VALUES (?, ?, ?, ?, ?)';
    $insert_stmt = $con->prepare($insert_query);
    $insert_stmt->bind_param("sssss", $imageURL, $track_name, $track_artist, $track_duration, $track_album);

    if ($insert_stmt->execute()) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $insert_stmt->error;
    }

    $insert_stmt->close();


    $check_stmt->close();
} else {
    echo "Invalid request method.";
}

$con->close();
?>