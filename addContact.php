<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header class="title-log-reg">Cakap Messenger
            </header>

            <form id="formAddContact" enctype="multipart/form-data" autocomplete="off">
                <div class="field input">
                    <label>User ID</label>
                    <input type="text" name="id_to_add" placeholder="Masukan User ID" required>
                    <input type="text" name="user_id" value="<?php echo $_GET['user_id'] ?>" hidden>
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Tambah Kontak">
                </div>
            </form>
        </section>
        <footer>
            <p>&#169; 2024 Cakap Messenger</p>
        </footer>
    </div>
    <script>
        const form = document.getElementById("formAddContact");

        form.onsubmit = function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch('php/addContact.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    window.location.href = './users.php';
                })
                .catch(error => {
                    alert(data.message);
                });
        };
    </script>

</body>

</html>