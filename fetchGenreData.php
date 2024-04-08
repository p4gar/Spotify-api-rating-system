<?php
require 'connection.php'; // Include your database connection

// Fetch data from the database
$query = "SELECT artist_genre, COUNT(*) AS genre_count FROM favoriteartists GROUP BY artist_genre";
$result = mysqli_query($con, $query);

$genresData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $genreData = array(
        "name" => $row['artist_genre'],
        "count" => $row['genre_count']
    );
    array_push($genresData, $genreData);
}

// Return the data as JSON
echo json_encode($genresData);

mysqli_close($con);
?>