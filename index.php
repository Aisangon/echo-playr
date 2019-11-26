
<?php include('includes/header.php'); ?>

    <h1 class="text-light text-center py-3">You might also like</h1>
    <div class="row">
        <?php 
            $albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");
            while($row = mysqli_fetch_array($albumQuery)) {
                echo "<div class='col-2 mb-3'>
                        <div class='card bg-dark border-secondary'>
                        <img class='card-img-top' src='" . $row['artworkPath'] ."'> 
                            <div class='card-body p-1 bg-dark'>
                                <p class='card-text text-light text-truncate'>" . $row['title'] ." </p>
                            </div>
                        </div>
                    </div>";
            }
        ?>
    </div>

<?php include('includes/footer.php'); ?>