<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-12">
            <div class="jumbotron jumbotron-fluid bg-dark">
                <div class="container text-center">
                    <h1 class="display-4 text-light"><?php echo $userLoggedIn->getFirstAndLastName() ?></h1>
                    <div>
                        <a role="button" class="btn btn-primary" href="updateDetails.php">User Details</a>
                        <button type="button" class="btn btn-secondary" onclick="logout()">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>