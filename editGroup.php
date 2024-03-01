<?php
session_start();
include_once "php/config.php";
?>
<?php include_once "header.php"; ?>

<body>
    <div class="loading-screen">
        <img class="loading-icon" src="chat.png" alt="Chat Icon">
        <p>Cakap Messenger</p>
    </div>
    <div class="wrapper">
        <section class="form signup">            
            <?php
            $idGroup = mysqli_real_escape_string($conn, $_GET['idGroup']);
            $sql = mysqli_query($conn, "SELECT * FROM tbl_groups WHERE id = {$idGroup}");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
            } else {
                header("location: users.php");
            }
            ?>

            <form id="form-editGroup" enctype="multipart/form-data" autocomplete="off">
                <div class="field input">
                    <img class="preview-img" src="php/images/<?php echo $row['img'] ?>" alt="">
                    <label>Nama Grup</label>
                    <input type="text" name="nameGroup" placeholder="Masukan nama grup" value="<?php echo $row['name_group'] ?>" required>
                    <input type="hidden" name="idGroup" value="<?php echo $_GET['idGroup']; ?>">
                </div>
                <div class="field image">
                    <label>Pilih Gambar</label>
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Ubah Grup">
                </div>
            </form>
        </section>        
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

        const form = document.getElementById("form-editGroup");

        form.onsubmit = function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch('php/editGroup.php', {
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