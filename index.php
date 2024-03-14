<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        header("location: users.php");
    }
?>

<?php include_once "header.php"; ?>

<body>
    <div class="loading-screen">
        <img class="loading-icon" src="chat.png" alt="Chat Icon">
        <p>Cakap Messenger</p>       
    </div>
    <div class="wrapper">
        <section class="form signup">
            <header class="title-log-reg text-center fs-5">Daftar Akun</header>
            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>Nama Depan</label>
                        <input type="text" name="fname" placeholder="Nama depan" required>
                    </div>
                    <div class="field input">
                        <label>Nama Belakang</label>
                        <input type="text" name="lname" placeholder="Nama belakang" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Masukan email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukan password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Pilih Gambar</label>
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Lanjutkan ke Chat">
                </div>
            </form>
            <div class="link">Sudah punya akun? <a href="login.php">Masuk</a></div>
        </section>
        <footer>
            <p>&#169; 2024 Cakap Messenger</p>
        </footer>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tampilkan layar loading
        const loadingScreen = document.querySelector('.loading-screen');
        loadingScreen.style.display = 'flex'; // Gunakan 'flex' agar ikon berada di tengah

        // Sembunyikan halaman registrasi
        const registrationPage = document.querySelector('.wrapper');
        registrationPage.style.display = 'none';

        // Tunda tampilan halaman registrasi selama 1000ms (1 detik)
        setTimeout(function() {
            // Sembunyikan layar loading
            loadingScreen.style.display = 'none';

            // Tampilkan halaman registrasi
            registrationPage.style.display = 'block';
        }, 2000);
    });
    </script>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>

</body>

</html>