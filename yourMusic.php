<?php include('includes/header.php'); ?>

<div class="jumbotron-fluid bg-dark">
    <div class="container">
        <h1 class="display-4 text-light text-center mb-3">Playlists</h1>
        <button type="button" class="btn btn-success btn-lg d-block mx-auto px-5 rounded" onclick="createPlaylist()">New Playlist</button>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12">
    <?php 
        $username = $userLoggedIn->getUsername();
        $playlistQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username'");
        if(mysqli_num_rows($playlistQuery) == 0) {
            echo "<h4 class='text-light text-center mt-5'>You don't have any playlists yet.</h4>";
        }
        while($row = mysqli_fetch_array($playlistQuery)) {
            $playlist = new Playlist($con, $row);
            echo "<div class='col-2 mb-3'>
                    <div class='card bg-dark border-light'>
                        <a class='text-decoration-none' href='playlist.php?id={$playlist->getId()}'>
                            <img class='card-img-top' src='assets/img/icons/playlist.png'>
                            <div class='card-body p-1 bg-light'>
                                <p class='card-text text-center text-dark text-truncate'>{$playlist->getName()}</p>
                            </div>
                        </a>
                    </div>
                </div>";
        }
    ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>