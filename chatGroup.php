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
        <section class="chat-area group-chat">
            <header>
                <?php
                $sql = mysqli_query($conn, "SELECT g.*, mg.id_role 
                                    FROM tbl_groups g
                                    INNER JOIN member_group mg ON mg.id_user = {$_SESSION['unique_id']}
                                    WHERE g.id = {$_GET['idGroup']}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                } else {
                    header("location: users.php");
                }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-chevron-left"></i></a>
                <a class="d-flex" href="editGroup.php?idGroup=<?php echo $_GET['idGroup']; ?>">
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span style="padding: 0px 180px 0px 0px;">
                            <?php echo $row['name_group'] ?>
                        </span>
                    </div>
                </a>
                <div>
                    <?php if ($row["id_role"] == 1) { ?>
                        <button style="margin-right: 5px" onclick="addMember(<?php echo $row['id']; ?>)" class="add-member">
                            <i class="fas fa-user-plus"></i>
                        </button>
                        <button onclick="DeleteGroup(<?php echo $_GET['idGroup']; ?>, <?php echo $row['id_role']; ?>)" class="add-member">
                            <i class="fas fa-trash"></i>
                        </button>
                    <?php } ?>

                    <button onclick="listMember(<?php echo $row['id']; ?>)" class="add-member">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
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
    <script>
        function DeleteGroup(groupId, userRole) {
            console.log(userRole)
            if (userRole === 1) {
                var confirmation = confirm("Apakah Anda yakin ingin menghapus grup ini?");

                if (confirmation) {
                    $.ajax({
                        type: 'POST',
                        url: './php/deleteGroup.php',
                        data: {
                            group_id: groupId
                        },
                        success: function(response) {
                            if (response === "success") {
                                window.location.href = "users.php";
                            } else {
                                alert("Gagal menghapus grup. Silakan coba lagi.");
                            }
                        }
                    });
                }
            } else {
                alert("You don't have the permission to delete this group.");
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>

</html>