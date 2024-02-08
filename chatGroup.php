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
        <section class="chat-area">
            <header>
                <?php
        $id_group = mysqli_real_escape_string($conn, $_GET['id_group']);
        $sql = mysqli_query($conn, "SELECT g.*, mg.id_role 
                                    FROM groups g
                                    INNER JOIN member_group mg ON mg.id_user = {$_SESSION['unique_id']}
                                    WHERE g.id = {$id_group}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users.php");
        }
        ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span>
                        <?php echo $row['name_group'] ?>
                    </span>
                </div>
                <div>
                    <?php if ($row["id_role"] == 1) { ?>
                    <button style="margin-left: 180px;" onclick="addMember(<?php echo $row['id']; ?>)" class="add-member">
                        <i class="fas fa-user-plus"></i>
                    </button>
                    <?php } ?>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area" enctype="multipart/form-data">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $row["id"]; ?>" hidden>
                <input type="text" class="id_user" name="id_user" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Ketik pesan" autocomplete="off">
                <div name="btnFile" id="btnFile" class="BtnFile">
                    <i class="fas fa-paperclip"></i>
                </div>
                <input type="file" name="file" id="file" class="file" style="width: 50px; display: none;">
                <button id="sendBtnChat"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script>
    var btnFile = document.getElementById("btnFile");
    var btnj = document.getElementById("file");
    btnFile.addEventListener('click', function() {
        btnj.click();
    });
    </script>
    <script src="javascript/chatGroup.js"></script>
</body>

</html>