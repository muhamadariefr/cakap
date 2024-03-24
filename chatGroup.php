<?php
session_start();
include_once 'php/config.php';
if (!isset($_SESSION['unique_id'])) {
    header('location: login.php');
}
?>
<?php include_once 'header.php'; ?>

<body>
    <div class="wrapper">
        <section class="chat-area group-chat">
            <header>
                <?php
                $sql = mysqli_query($conn, "SELECT g.*, mg.id_role, COUNT(mg.id_user) AS total_members
                                    FROM tbl_groups g
                                    INNER JOIN member_group mg ON mg.id_group = g.id
                                    WHERE g.id = {$_GET['idGroup']}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                } else {
                    header('location: users.php');
                }
                ?>
                <div class="col-1">
                    <a href="groups.php" class="back-icon"><i class="fas fa-chevron-left"></i></a>
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                </div>
                <div class="details col-5">
                    <span class="name-group">
                        <div class="col fw-bold">
                            <?php echo $row['name_group'] ?>
                        </div>
                        <div class="col" style="font-size: 12px; color: #e6e6e6;">
                            <?php echo $row['total_members']; ?> Member
                        </div>
                    </span>
                </div>
                <div class="col d-flex justify-content-end align-items-center">
                    <?php if ($row['id_role'] == 1) { ?>
                    <button onclick="addMember(<?php echo $row['id']; ?>)" class="add-member">
                        <i class="fas fa-user-plus"></i>
                    </button>
                    <?php } ?>

                    <div>
                        <button type="button" class="del-contact btn dropdown-toggle dropdown-toggle-split border-0"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" style="font-size: 14px;">
                            <li>
                                <a href="editGroup.php?idGroup=<?php echo $_GET['idGroup']; ?>" class="dropdown-item">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-1">
                                            <i class="fas fa-edit"></i>
                                        </div>
                                        <div class="col-sm-2">
                                            Edit Grup
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    onclick="DeleteGroup(<?php echo $_GET['idGroup']; ?>, <?php echo $row['id_role']; ?>)"
                                    class="dropdown-item">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-1">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                        <div class="col-sm-2">
                                            Hapus Grup
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item" onclick="listMember(<?php echo $row['id']; ?>)">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-1">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="col-sm-2">
                                            Info Grup
                                        </div>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area" enctype="multipart/form-data">                
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $row['id']; ?>" hidden>
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
                            window.location.href = "groups.php";
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>