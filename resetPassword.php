<?php
session_start();
include_once 'php/config.php';

if (!isset($_SESSION['unique_id'])) {
    header('location: login.php');
    exit();
}

include_once 'header.php';

?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header class="fs-5 d-flex justify-content-center align-items-center">
                <div class="col-1 text-center">
                    <a href="users.php" class="back-icon"><i class="fas fa-chevron-left"></i></a>
                </div>
                <div class="col-10 text-center">
                    <p style="margin: 0;">Cakap Messenger</p>
                </div>
                <div class="col-1"></div>
            </header>

            <form action="resetPass.php" method="post" autocomplete="off">
                <div class="field input">
                    <label>New Password</label>
                    <input type="password" name="new_password" placeholder="Enter new password" required>
                </div>
                <div class="field input">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm new password" required>                    
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Reset Password">
                </div>
            </form>
        </section>
        <footer>
            <p>&#169; 2024 Cakap Messenger</p>
        </footer>
    </div>
</body>

</html>