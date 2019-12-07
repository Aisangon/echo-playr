<?php 
    include('includes/header.php');

    if(isset($_GET["id"])) {
        $albumId = $_GET["id"];
    } else {
        header("Location: index.php");
    }
    $album = new Album($con, $albumId);
    $artist = $album->getArtist();
?>

<div class="row">
    <div class="col-12">
        <div class="media py-4">
            <img class="mr-3" src="<?php echo $album->getArtwork(); ?>" alt="Generic placeholder image">
            <div class="media-body">
                <h2 class="mt-0 text-light"><?php echo $album->getTitle(); ?></h2>
                <p class="text-muted">By <?php echo $artist->getName(); ?></p>
                <p class="text-muted"><?php echo $album->getNumberOfSongs(); ?> Songs</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <divl class="col-12">
        <ul class="list-unstyled">
            <?php 
                $songIdArray = $album->getSongIds();
                
                $i = 1;
                foreach($songIdArray as $songId) {
                    $albumSong = new Song($con, $songId);
                    $albumArtist = $albumSong->getArtist();

                    echo "<li class='trackListRow p-1'>
                    <div class='media'>
                        <img src='assets/img/icons/play-white.png'>
                        <h5 class='text-light'>$i</h5>
                        <div class='media-body ml-4'>
                            <p class='text-light m-0'>" . $albumArtist->getName() . "</p>
                            <p class='text-muted m-0'>" . $albumSong->getTitle() . "</p>
                        </div>
                        <img class='mr-5' src='assets/img/icons/more.png'>
                        <span class='text-light'>" . $albumSong->getDuration() . "</span>
                    </div>
                    </li>";

                    $i = $i+1;
                }

            ?>
        </ul>
    </divl>
</div>

<?php include('includes/footer.php'); ?>