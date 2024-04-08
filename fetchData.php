<?php
require 'connection.php';

$response = array();

$sql = "SELECT track_image, track_name, track_artist, track_duration, track_album, rat_value, id FROM songlists";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $dataList = array();
    while ($row = $result->fetch_assoc()) {
        $dataList[] = array(
            "track_image" => $row['track_image'],
            "track_name" => $row['track_name'],
            "track_artist" => $row['track_artist'],
            "track_duration" => $row['track_duration'],
            "track_album" => $row['track_album'],
            "rat_value" => $row['rat_value'],
            "id" => $row['id']
        );
    }
    $response['success'] = true;
    $response['data'] = $dataList;
} else {
    $response['success'] = false;
    $response['message'] = "No data found.";
}

echo json_encode($response);

$con->close();
?>