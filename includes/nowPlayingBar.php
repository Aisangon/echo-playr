<?php 

    $songQuery = mysqli_query($con, "SELECT * FROM songs ORDER BY RAND() LIMIT 10");
    $resultArray = array();

    while($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    $jsonArray = json_encode($resultArray);

?>

<div id="nowPlayingBarContainer" class="container-fluid bg-dark fixed-bottom border border-secondary">
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
                    <button class="border-0 bg-transparent shuffle" title="Shuffle button" onclick="shuffleSongs()">
                        <img src="assets/img/icons/shuffle.png" alt="Shuffle">
                    </button>
                    <button class="border-0 bg-transparent" title="Previous button" onclick="prevSong()">
                        <img src="assets/img/icons/previous.png" alt="Previous">
                    </button>
                    <button id="playBtn" class="border-0 bg-transparent play" title="Play button" onclick="playSong()">
                        <img src="assets/img/icons/play.png" alt="Play">
                    </button>
                    <button id="pauseBtn" class="border-0 bg-transparent pause" style="display: none" title="Pause button" onclick="pauseSong()">
                        <img src="assets/img/icons/pause.png" alt="Pause">
                    </button>
                    <button class="border-0 bg-transparent" title="Next button" onclick="nextSong()">
                        <img src="assets/img/icons/next.png" alt="Next">
                    </button>
                    <button class="border-0 bg-transparent repeat" title="Repeat button" onclick="repeatSong()">
                        <img src="assets/img/icons/repeat.png" alt="Repeat">
                    </button>
                </div>
            </div>
            <div class="col-12 mt-3">
                <span id="currentTime" class="text-light float-left mt-2">0:00</span>
                <span id="remainingTime" class="text-light float-right mt-2"></span>
                <div class="progress audio">
                    <div id="audioProgress" class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12 align-self-center">
            <div class="media">
                <button class="border-0 bg-transparent" title="Volume button" onclick="muteSong()">
                    <img class="align-self-end mr-3 volume" src="assets/img/icons/volume.png" alt="Volume-on">
                </button>
                <div class="media-body align-self-center">
                    <div class="progress volumeBar">
                        <div id="volumeProgress" class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        let newPlaylist = <?php echo $jsonArray ?>;
        audioElement = new Audio();
        setTrack(newPlaylist[0], newPlaylist, false);
        const progressDrag = document.querySelector('.progress.audio');
        const volumeDrag = document.querySelector('.progress.volumeBar');

        "mousedown touchstart mousemove touchmove".split(" ").forEach(function(element) {
            document.getElementById('nowPlayingBarContainer').addEventListener(element, function(event) {
                event.preventDefault();
            }, false);
        });

        progressDrag.addEventListener('mousedown', function() {
            mouseDown = true;
        });

        progressDrag.addEventListener('mousemove', function(e) {
            if(mouseDown === true) {
                timeFromOffset(e, this);
            }
        });

        progressDrag.addEventListener('mouseup', function(e) {
            timeFromOffset(e, this);
        });

        volumeDrag.addEventListener('mousedown', function() {
            mouseDown = true;
        });

        volumeDrag.addEventListener('mousemove', function(e) {
            if(mouseDown === true) {
                let percentageVolume = e.offsetX / this.offsetWidth;
                if(percentageVolume >= 0 && percentageVolume <= 1) {
                    audioElement.audio.volume = percentageVolume;
                }
            }
        });

        volumeDrag.addEventListener('mouseup', function(e) {
            let percentageVolume = e.offsetX / this.offsetWidth;
            if(percentageVolume >= 0 && percentageVolume <= 1) {
                audioElement.audio.volume = percentageVolume;
            }
        });

        document.addEventListener('mouseup', function() {
            mouseDown = false;
        });

    });

    function timeFromOffset(mouse, progressBar) {
        const percentage = mouse.offsetX / progressBar.offsetWidth * 100;
        const seconds = audioElement.audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }

    function prevSong() {
        if(audioElement.audio.currentTime >= 3 || currentIndex === 0) {
            audioElement.setTime(0);
        } else {
            currentIndex--;
            setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
        }
    }

    function nextSong() {
        if(repeat === true) {
            audioElement.setTime(0);
            playSong();
            return;
        }

        if(currentIndex === currentPlaylist.length - 1) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }

        const trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);
    }

    function repeatSong() {
        repeat = !repeat;
        const repeatIcon = repeat ? 'repeat-active.png' : 'repeat.png';
        document.querySelector('.controls .repeat img').src = `assets/img/icons/${repeatIcon}`;
    }

    function muteSong() {
        audioElement.audio.muted = !audioElement.audio.muted;
        const volumeLevel = document.getElementById('volumeProgress');
        audioElement.audio.muted ? volumeLevel.style.display = "none" : volumeLevel.style.display = "block";
        const volumeIcon = audioElement.audio.muted ? 'volume-mute.png' : 'volume.png';
        document.querySelector('.media img.volume').src = `assets/img/icons/${volumeIcon}`;
    }

    function shuffleSongs() {
        shuffle = !shuffle;
        const shuffleIcon = shuffle ? 'shuffle-active.png' : 'shuffle.png';
        document.querySelector('.controls .shuffle img').src = `assets/img/icons/${shuffleIcon}`;

        if(shuffle === true) {
            doShuffle(shufflePlaylist);
            currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
        } else {
            currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
        }
    }

    function doShuffle(array) {
        for(let i = array.length - 1; i > 0; i--) {
            let j = Math.floor(Math.random() * (i + 1));
            let x = array[i];
            array[i] = array[j];
            array[j] = x;
        }
        return array;
    }

    function setTrack(trackId, newPlaylist, play) {
        if(newPlaylist !== currentPlaylist) {
            currentPlaylist = newPlaylist;
            shufflePlaylist = currentPlaylist.slice();
            doShuffle(shufflePlaylist);
        }

        if(shuffle === true) {
            currentIndex = shufflePlaylist.indexOf(trackId);
        } else {
            currentIndex = currentPlaylist.indexOf(trackId);
        }
        pauseSong();

        const trackData = `songId=${trackId}`;
        fetch('includes/handlers/ajax/getSongJSON.php', {
            headers: {"Content-type": "application/x-www-form-urlencoded"},
            method: 'POST',
            body: trackData
        })
        .then(response => response.json())
        .then(track => {
            document.getElementById('trackName').innerHTML = track.title;

            const artistData = `artistId=${track.artist}`;
            fetch('includes/handlers/ajax/getArtistJSON.php', {
                headers: {"Content-type": "application/x-www-form-urlencoded"},
                method: 'POST',
                body: artistData
            })
            .then(response => response.json())
            .then(artist => document.getElementById('trackArtist').innerHTML = artist.name);
        
            const albumData = `albumId=${track.album}`;
            fetch('includes/handlers/ajax/getAlbumJSON.php', {
                headers: {"Content-type": "application/x-www-form-urlencoded"},
                method: 'POST',
                body: albumData
            })
            .then(response => response.json())
            .then(album => document.getElementById('albumArt').src = album.artworkPath);

            audioElement.setTrack(track);
        });

        if(play === true) audioElement.play();
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