<?php
session_start();
include_once 'php/config.php';
if (!isset($_SESSION['unique_id'])) {
    header('location: login.php');
}
?>
<?php include_once 'header.php'; ?>

<body>
    <div class="loading-screen">
        <img class="loading-icon" src="chat.png" alt="Chat Icon">
        <p>Cakap Messenger</p>
    </div>
    <div class="wrapper">
        <section class="form signup">
            <header class="title-log-reg">Cakap Messenger
            </header>

            <?php
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                } else {
                    header('location: users.php');
                }
            ?>

            <form id="form-addGroup" enctype="multipart/form-data" autocomplete="off">
                <div class="field input">
                    <label>Nama Group</label>
                    <input type="text" name="nameGroup" placeholder="Masukan nama grup" required>
                    <input type="hidden" name="userId" value="<?php echo $user_id; ?>">
                </div>
                <div class="field image">
                    <label>Pilih Gambar</label>
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Buat Grup">
                </div>
            </form>
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

    const form = document.getElementById("form-addGroup");

    form.onsubmit = function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('php/addGroup.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                window.location.href = './groups.php';
            })
            .catch(error => {
                alert(data.message);
            });
    };
    </script>

</body>

</html>