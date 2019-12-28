<?php
    include('includes/header.php');

    if(isset($_GET["id"])) {
        $artistId = $_GET["id"];
    } else {
        header("Location: index.php");
    }

    $artist = new Artist($con, $artistId);
?>

<div class="jumbotron-fluid bg-dark">
    <div class="container">
        <h1 class="display-4 text-light text-center mb-3"><?php echo $artist->getName(); ?></h1>
        <button type="button" class="btn btn-success btn-lg d-block mx-auto px-5 rounded" onclick="playFirstSong()">Play</button>
    </div>
</div>

<hr class="bg-light">

<div class="row">
    <div class="col-12">
    <h1 class="display-4 text-light text-center mb-3">Popular</h1>
        <ul class="list-unstyled">
            <?php 
                $songIdArray = $artist->getSongIds();
                
                $i = 1;
                foreach($songIdArray as $songId) {

                    if($i > 5) {
                        break;
                    }

                    $albumSong = new Song($con, $songId);
                    $albumArtist = $albumSong->getArtist();

                    echo "<li class='trackListRow p-1'>
                    <div class='media'>
                        <img src='assets/img/icons/play-white.png' onclick='setTrack(\"{$albumSong->getId()}\", tempPlaylist, true)'>
                        <h5 class='text-light'>$i</h5>
                        <div class='media-body ml-4'>
                            <p class='text-light m-0'>{$albumArtist->getName()}</p>
                            <p class='text-muted m-0'>{$albumSong->getTitle()}</p>
                        </div>
                        <img class='mr-5' src='assets/img/icons/more.png'>
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
        <h1 class="display-5 text-light text-center">Albums</h1>
    </div>
    <?php 
        $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist='$artistId'");
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