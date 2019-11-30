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
                
                foreach($songIdArray as $songId) {
                    echo $songId . "<br>";
                }
            ?>
        </ul>
    </divl>
</div>

<?php include('includes/footer.php'); ?>