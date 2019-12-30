<?php
    include('includes/header.php');

    if(isset($_GET['term'])) {
        $term = urldecode($_GET['term']);
    } else {
        $term = "";
    }
?>

<div class="row mt-5">
    <div class="col-12">
        <div class="input-group mb-3">
            <input id="searchInput" type="text" value="<?php echo $term; ?>" class="form-control form-control-lg" placeholder="Search artist, album, song..." aria-label="Search" aria-describedby="search-addon" onfocus="this.value = this.value;">
        </div>
    </div>
</div>

<script>
    (function() {
        let search = document.getElementById('searchInput');
        search.focus();

        var timer;
        function endAndStartTimer() {
            clearTimeout(timer);
            timer = window.setTimeout(function() {
                let val = search.value;
                if(val !== "") window.location = `search.php?term=${val}`;
            }, 2000);
        }

        search.addEventListener("keyup", endAndStartTimer);
    })();
</script>

<?php if($term == "") exit(); ?>

<div class="row">
    <div class="col-12">
    <h1 class="display-4 text-light text-center mb-3">Songs</h1>
        <ul class="list-unstyled">
            <?php 
                $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");
                if(mysqli_num_rows($songsQuery) == 0) {
                    echo "<h4 class='text-light text-center mt-5'>No songs found matching '{$term}'.</h4>";
                }

                $songIdArray = array();
                
                $i = 1;
                while($row = mysqli_fetch_array($songsQuery)) {

                    if($i > 15) {
                        break;
                    }

                    array_push($songIdArray, $row['id']);

                    $albumSong = new Song($con, $row['id']);
                    $albumArtist = $albumSong->getArtist();

                    echo "<li class='trackListRow p-1'>
                    <div class='media'>
                        <img class='position-absolute' src='assets/img/icons/play-white.png' onclick='setTrack({$albumSong->getId()}, tempPlaylist, true)'>
                        <h5 class='text-light'>$i</h5>
                        <div class='media-body ml-4'>
                            <p class='text-light m-0'>{$albumArtist->getName()}</p>
                            <p class='text-muted m-0'>{$albumSong->getTitle()}</p>
                        </div>
                        <div class='dropdown addToPlaylist'>
                            <input class='albumSongId' type='hidden' value='{$albumSong->getId()}'>
                            <img class='mr-5 dropdown-toggle' src='assets/img/icons/more.png' data-toggle='dropdown'>
                            <ul class='dropdown-menu dropdown-menu-right'>
                            <input type='hidden' class='songId'></input>"
                            . Playlist::getPlaylistsDropdown($con, $loggedInUser) .
                            "</ul>
                        </div>
                        <span class='text-light'>{$albumSong->getDuration()}</span>
                    </div>
                    </li>";

                    $i = $i+1;
                }
            ?>

            <script>
                let tempSongIds = '<?php echo json_encode($songIdArray); ?>';
                tempPlaylist = JSON.parse(tempSongIds);

                function playFirstSong() {
                    setTrack(tempPlaylist[0], tempPlaylist, true);
                }
            </script>
        </ul>
    </div>
</div>

<hr class="bg-light">

<div class="row">
    <div class="col-12">
        <h1 class="display-4 text-light text-center mb-3">Artists</h1>
        <ul class="list-unstyled">
            <?php 
                $artistsQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");
                if(mysqli_num_rows($artistsQuery) == 0) {
                    echo "<h4 class='text-light text-center mt-5'>No artists found matching '{$term}'.</h4>";
                }

                while($row = mysqli_fetch_array($artistsQuery)) {
                    $artistFound = new Artist($con, $row['id']);
                    echo "<li class='trackListRow p-2'>
                            <a class='text-light text-decoration-none' href='artist.php?id={$artistFound->getid()}'>
                                {$artistFound->getName()}
                            </a>
                        </li>";
                }
            ?>
        </ul>
    </div>
</div>

<hr class="bg-light">

<div class="row">
    <div class="col-12">
        <h1 class="display-4 text-light text-center mb-3">Albums</h1>
    </div>
    <?php 
        $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '$term%' LIMIT 10");
        if(mysqli_num_rows($albumQuery) == 0) {
            echo "<h4 class='text-light text-center mt-5'>No albums found matching '{$term}'.</h4>";
        }
        while($row = mysqli_fetch_array($albumQuery)) {
            echo "<div class='col-2 mb-3'>
                    <div class='card bg-dark border-secondary'>
                        <a class='text-decoration-none' href='album.php?id={$row['id']}'>
                            <img class='card-img-top' src='{$row['artworkPath']}'>
                            <div class='card-body p-1 bg-dark'>
                                <p class='card-text text-light text-truncate'>{$row['title']}</p>
                            </div>
                        </a>
                    </div>
                </div>";
        }
    ?>
</div>

<?php include('includes/footer.php'); ?>