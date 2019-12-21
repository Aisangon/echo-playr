<?php 

    $songQuery = mysqli_query($con, "SELECT * FROM songs ORDER BY RAND() LIMIT 10");
    $resultArray = array();

    while($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    $jsonArray = json_encode($resultArray);

?>

<div class="container-fluid bg-dark fixed-bottom border border-secondary">
    <div class="row h-25 p-2 align-items-center">
        <div class="col-lg-3 col-12">
            <div class="media album-art">
                <img id="albumArt" src="" class="align-self-start mr-3 img-thumbnail" alt="album1">
                <div class="media-body">
                    <h5 id="trackName" class="text-light m-0"></h5>
                    <p id="trackArtist" class="lead text-light mt-0"></p>
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
                <span id="currentTime" class="text-light float-left mt-2">0:00</span>
                <span id="remainingTime" class="text-light float-right mt-2"></span>
                <div class="progress">
                    <div id="audioProgress" class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    (function() {
        currentPlaylist = <?php echo $jsonArray ?>;
        audioElement = new Audio();
        setTrack(currentPlaylist[0], currentPlaylist, false);
    })();

    function setTrack(trackId, newPlaylist, play) {
        const trackData = `songId=${trackId}`;
        fetch('includes/handlers/ajax/getSongJSON.php', {
            headers: {"Content-type": "application/x-www-form-urlencoded"},
            method: 'POST',
            body: trackData
        })
        .then(response => response.json())
        .then(track => {
            document.getElementById('trackName').textContent += track.title;

            const artistData = `artistId=${track.artist}`;
            fetch('includes/handlers/ajax/getArtistJSON.php', {
                headers: {"Content-type": "application/x-www-form-urlencoded"},
                method: 'POST',
                body: artistData
            })
            .then(response => response.json())
            .then(artist => document.getElementById('trackArtist').textContent += artist.name);
        
            const albumData = `albumId=${track.album}`;
            fetch('includes/handlers/ajax/getAlbumJSON.php', {
                headers: {"Content-type": "application/x-www-form-urlencoded"},
                method: 'POST',
                body: albumData
            })
            .then(response => response.json())
            .then(album => document.getElementById('albumArt').src = album.artworkPath);

            audioElement.setTrack(track);
            playSong();
        });

        if(play == true) audioElement.play();
    }

    function playSong() {
        if(audioElement.audio.currentTime === 0) {
            fetch('includes/handlers/ajax/updatePlays.php', {
                headers: {"Content-type": "application/x-www-form-urlencoded"},
                method: 'POST',
                body: `songId=${audioElement.currentlyPlaying.id}`
            });
        } else {
            console.log('dont update time');
        }
        document.getElementById('playBtn').style.display = "none";
        document.getElementById('pauseBtn').style.display = "block";
        audioElement.play();
    }

    function pauseSong() {
        document.getElementById('playBtn').style.display = "block";
        document.getElementById('pauseBtn').style.display = "none";
        audioElement.pause();
    }

</script>