<?php 

    $songQuery = mysqli_query($con, "SELECT * FROM songs ORDER BY RAND() LIMIT 10");
    $resultArray = array();

    while($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    $jsonArray = json_encode($resultArray);

?>

<script>

(function() {
    currentPlaylist = <?php echo $jsonArray ?>;
    audioElement = new Audio();
    setTrack(currentPlaylist[0], currentPlaylist, false);
})();

function setTrack(trackId, newPlaylist, play) {
    let data = `songId=${trackId}`;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/handlers/ajax/getSongJSON.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(data);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            let track = JSON.parse(xhr.response);
            audioElement.setTrack(track.path);
            audioElement.play();
        }
    }

    if(play) audioElement.play();
}

function playSong() {
    let playButton = document.getElementById('playBtn');
    let pauseButton = document.getElementById('pauseBtn');
    audioElement.play();
    playButton.style.display = "none";
    pauseButton.style.display = "block";
}

function pauseSong() {
    let playButton = document.getElementById('playBtn');
    let pauseButton = document.getElementById('pauseBtn');
    audioElement.pause();
    playButton.style.display = "block";
    pauseButton.style.display = "none";
}

</script>

<div class="container-fluid bg-dark fixed-bottom border border-secondary">
    <div class="row h-25 p-2 align-items-center">
        <div class="col-lg-3 col-12">
            <div class="media album-art">
                <img class="align-self-start mr-3 img-thumbnail" src="assets/img/album1.jpg" alt="album1">
                <div class="media-body">
                    <h5 class="mt-0 text-light">Top 10 artist</h5>
                    <p class="lead text-light m-0">My new cool song</p>
                    <p class="text-light m-0">My new album</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="col-12">
                <div class="controls media justify-content-around">
                    <button class="border-0 bg-transparent" title="Shuffle button">
                        <img src="assets/img/icons/shuffle.png" alt="Shuffle">
                    </button>
                    <button class="border-0 bg-transparent" title="Previous button">
                        <img src="assets/img/icons/previous.png" alt="Previous">
                    </button>
                    <button id="playBtn" class="border-0 bg-transparent play" title="Play button" onclick="playSong()">
                        <img src="assets/img/icons/play.png" alt="Play">
                    </button>
                    <button id="pauseBtn" class="border-0 bg-transparent pause" style="display: none" title="Pause button" onclick="pauseSong()">
                        <img src="assets/img/icons/pause.png" alt="Pause">
                    </button>
                    <button class="border-0 bg-transparent" title="Next button">
                        <img src="assets/img/icons/next.png" alt="Next">
                    </button>
                    <button class="border-0 bg-transparent" title="Repeat button">
                        <img src="assets/img/icons/repeat.png" alt="Repeat">
                    </button>
                </div>
            </div>
            <div class="col-12 mt-3">
                <span class="text-light float-left mt-2">0.00</span>
                <span class="text-light float-right mt-2">0.00</span>
                <div class="progress">
                    <div class="progress-bar bg-light" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12 align-self-center">
            <div class="media">
                <button class="border-0 bg-transparent" title="Volume button">
                    <img class="align-self-end mr-3 volume" src="assets/img/icons/volume.png" alt="Volume-on">
                </button>
                <div class="media-body align-self-center">
                    <div class="progress">
                        <div class="progress-bar bg-light" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>