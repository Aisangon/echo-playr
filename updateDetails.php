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
                    <input type="email" class="form-control" id="changeEmail" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-success"></small>
                    <small id="emailError" class="form-text text-danger"></small>
                </div>
                <button type="button" class="btn btn-info float-right" onclick="updateEmail()">Update Email</button>
            </form>
        </div>
        <div class="col-6">
            <form class="mt-5" action="">
                <div class="form-group">
                    <label for="currentPassword" class="text-light">Current Password</label>
                    <input type="password" class="form-control" id="currentPassword" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="newPassword" class="text-light">New Password</label>
                    <input type="password" class="form-control" id="newPassword" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="confirmPassword" class="text-light">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Password">
                    <small id="passHelp" class="form-text text-success"></small>
                    <small id="passFail" class="form-text text-danger"></small>
                </div>
                <button type="button" class="btn btn-info float-right" onclick="updatePassword()">Update Pasword</button>
            </form>
        </div>
    </div>
<?php include('includes/footer.php'); ?>