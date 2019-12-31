<?php include('includes/header.php'); ?>
    <div class="row">
        <div class="col-6">
            <form class="mt-5" action="">
                <div class="form-group">
                    <label for="currentEmail" class="col-form-label text-light">Current Email</label>
                    <div>
                        <input type="text" readonly class="form-control-plaintext text-light" id="currentEmail" value="<?php echo $userLoggedIn->getEmail(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="changeEmail" class="col-form-label text-light">Change Email</label>
                    <input type="email" class="form-control text-light" id="changeEmail" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-success"></small>
                </div>
                <button type="button" class="btn btn-info float-right" onclick="">Update Email</button>
            </form>
        </div>
        <div class="col-6">
            <form class="mt-5" action="">
                <div class="form-group">
                    <label for="currentPassword" class="text-light">Current Password</label>
                    <input type="password" class="form-control text-light" id="currentPassword" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="newPassword" class="text-light">Current Password</label>
                    <input type="password" class="form-control text-light" id="newPassword" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="confirmPassword" class="text-light">Current Password</label>
                    <input type="password" class="form-control text-light" id="confirmPassword" placeholder="Password">
                </div>
                <button type="button" class="btn btn-info float-right" onclick="">Update Pasword</button>
            </form>
        </div>
    </div>
<?php include('includes/footer.php'); ?>