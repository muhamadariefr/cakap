<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
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
            <header class="title-log-reg">Cakap Messenger
            </header>

            <form id="formAddMember" enctype="multipart/form-data" autocomplete="off">
                <div class="field input">
                    <label>Id User</label>
                    <input type="text" name="idUser" placeholder="Masukan id user" required>
                    <input type="text" name="idGroup" value="<?php echo $_GET['idGroup'] ?>" hidden>
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Add Group">
                </div>
            </form>
        </section>
        <footer>
            <p>&#169; 2024 Cakap Messenger</p>
        </footer>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Tampilkan layar loading
            const loadingScreen = document.querySelector('.loading-screen');
            loadingScreen.style.display = 'flex'; // Gunakan 'flex' agar ikon berada di tengah

            // Sembunyikan halaman registrasi
            const registrationPage = document.querySelector('.wrapper');
            registrationPage.style.display = 'none';

            // Tunda tampilan halaman registrasi selama 1000ms (1 detik)
            setTimeout(function () {
                // Sembunyikan layar loading
                loadingScreen.style.display = 'none';

                // Tampilkan halaman registrasi
                registrationPage.style.display = 'block';
            }, 2000);
        });

        const form = document.getElementById("formAddMember");

        form.onsubmit = function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch('php/addMember.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(error => {
                    alert(data.message);
                });
        };
    </script>

</body>

</html>