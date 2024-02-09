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

            <form id="formAddMember" enctype="multipart/form-data" autocomplete="off">
                <div class="field input">
                    <label>User ID</label>
                    <input type="text" name="idUser" placeholder="Masukan User ID" required>
                    <input type="text" name="idGroup" value="<?php echo $_GET['idGroup'] ?>" hidden>
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Tambah User">
                </div>
            </form>
        </section>
        <footer>
            <p>&#169; 2024 Cakap Messenger</p>
        </footer>
    </div>
    <script>
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