<?php 
    include('includes/header.php');

    if(isset($_GET["id"])) {
        $playlistId = $_GET["id"];
    } else {
        header("Location: index.php");
    }
    $playlist = new Playlist($con, $playlistId);
    $owner = new User($con, $playlist->getOwner());
?>

<div class="row">
    <div class="col-12">
        <div class="media py-4">
            <img class="mr-3" src="assets/img/icons/playlist.png" alt="Generic placeholder image">
            <div class="media-body">
                <h2 class="mt-0 text-light"><?php echo $playlist->getName(); ?></h2>
                <p class="text-muted">By <?php echo $playlist->getOwner(); ?></p>
                <p class="text-muted"><?php echo $playlist->getNumberOfSongs(); ?> Songs</p>
                <button type="button" class="btn btn-danger" onclick="deletePlaylist('<?php echo $playlistId; ?>')">Delete Playlist</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <divl class="col-12">
        <ul class="list-unstyled">
            <?php 
                $songIdArray = $playlist->getSongIds();

                $i = 1;
                foreach($songIdArray as $songId) {
                    $playlistSong = new Song($con, $songId);
                    $songArtist = $playlistSong->getArtist();

                    echo "<li class='trackListRow p-1'>
                    <div class='media'>
                        <img class='position-absolute' src='assets/img/icons/play-white.png' onclick='setTrack({$playlistSong->getId()}, tempPlaylist, true)'>
                        <h5 class='text-light'>$i</h5>
                        <div class='media-body ml-4'>
                            <p class='text-light m-0'>{$songArtist->getName()}</p>
                            <p class='text-muted m-0'>{$playlistSong->getTitle()}</p>
                        </div>
                        <div class='dropdown addToPlaylist'>
                            <input class='albumSongId' type='hidden' value='{$playlistSong->getId()}'>
                            <img class='mr-5 dropdown-toggle' src='assets/img/icons/more.png' data-toggle='dropdown'>
                            <ul class='dropdown-menu dropdown-menu-right'>
                            <input type='hidden' class='songId'></input>"
                            . Playlist::getPlaylistsDropdown($con, $loggedInUser) .
                            "<div class='dropdown-divider'></div>
                            <li class='dropdown-item text-danger deletePlaylist' onclick='removeFromPlaylist(this, {$playlistId})'>Remove from playlist</li>
                            </ul>
                        </div>
                        <span class='text-light'>{$playlistSong->getDuration()}</span>
                    </div>
                    </li>";

                    $i = $i+1;
                }

            ?>

            <script>
                let tempSongIds = '<?php echo json_encode($songIdArray); ?>';
                tempPlaylist = JSON.parse(tempSongIds);
            </script>
        </ul>
    </divl>
</div>

<?php include('includes/footer.php'); ?>