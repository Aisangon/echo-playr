<?php
    include("../../config.php");

    if(isset($_POST["playlistId"]) && isset($_POST["songId"])) {
        $playlistId = $_POST["playlistId"];
        $songId = $_POST["songId"];

        $query = mysqli_query($con, "DELETE FROM playlistSongs WHERE playlistId='$playlistId' AND songId='$songId'");
        $row = mysqli_fetch_array($orderIdQuery);
        $order = $row['playlistOrder'];

        $query = mysqli_query($con, "INSERT INTO playlistSongs VALUES('', '$songId', '$playlistId', '$order')");
    } else {
        echo "Playlist id or song id have not been passed into file";
    }
?>