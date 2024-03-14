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
        <section class="chat-area">
            <header>
                <?php
                    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    } else {
                        header('location: users.php');
                    }
                ?>
                <div class="col-1">
                    <a href="users.php" class="back-icon"><i class="fas fa-chevron-left"></i></a>
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                </div>
                <div class="details col-5">
                    <span><?php echo $row['fname'] . ' ' . $row['lname'] ?></span>
                    <br>
                    <p class="m-0 p-0"><?php echo $row['status']; ?></p>
                </div>
                <div class="col d-flex justify-content-end align-items-center">
                    <a href="./php/videoContact.php?id_user=<?php echo $_SESSION['unique_id']; ?>&id_other_user=<?php echo $row['unique_id']; ?>"
                        class="del-contact">
                        <i class="fas fa-video"></i>
                    </a>
                    <a href="./php/phoneContact.php?id_user=<?php echo $_SESSION['unique_id']; ?>&id_other_user=<?php echo $row['unique_id']; ?>"
                        class="del-contact">
                        <i class="fas fa-phone"></i>
                    </a>
                    <div>
                        <button type="button" class="del-contact btn dropdown-toggle dropdown-toggle-split border-0"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" style="font-size: 14px;">
                            <li>
                                <a href="./php/deleteContact.php?id_user=<?php echo $_SESSION['unique_id']; ?>&id_other_user=<?php echo $row['unique_id']; ?>"
                                    class="dropdown-item">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-1">
                                            <i class="fas fa-user-alt-slash"></i>
                                        </div>
                                        <div class="col-sm-2">
                                            Hapus Kontak
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="./php/deleteChat.php?id_user=<?php echo $_SESSION['unique_id']; ?>&id_other_user=<?php echo $row['unique_id']; ?>"
                                    class="dropdown-item">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-1">
                                            <i class="fas fa-comment-slash"></i>
                                        </div>
                                        <div class="col-sm-2">
                                            Bersihkan Chat
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item"
                                    onclick="openContactInfoModal('<?php echo $row['unique_id']; ?>')">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-1">
                                            <i class="far fa-address-card"></i>
                                        </div>
                                        <div class="col-sm-2">
                                            Info Kontak
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
                <div name="btnEmote" id="btnEmote" class="BtnEmote">
                    <i class="fas fa-smile"></i>
                </div>
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Ketik pesan" autocomplete="off">
                <div name="btnFile" id="btnFile" class="BtnFile">
                    <i class="fas fa-paperclip"></i>
                </div>
                <div name="btnMic" id="btnMic" class="BtnMic">
                    <i class="fas fa-microphone"></i>
                </div>
                <input type="file" name="file" id="file" class="file" style="width: auto; display: none;">
                <button id="sendBtnChat"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
        <!-- Modal Info Kontak -->
        <div class="modal fade" id="contactInfoModal" tabindex="-1" aria-labelledby="contactInfoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="contactInfoModalLabel">Informasi Kontak</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div style="display: grid; place-content: center;">
                            <img src="" id="contactInfoImage" alt=""
                                style="width: 150px; height: 150px; border-radius: 100%;">
                        </div>
                        <div class="m-1">
                            <label for="#">User ID</label>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="contactInfoUniqueId" readonly>
                        </div>
                        <div class="m-1">
                            <label for="#">Nama Depan</label>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="contactInfoFname" readonly>
                        </div>
                        <div class="m-1">
                            <label for="#">Nama Belakang</label>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="contactInfoLname" readonly>
                        </div>
                        <div class="m-1">
                            <label for="#">Email</label>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="contactInfoEmail" readonly>
                        </div>
                        <!-- Tambahkan elemen lainnya sesuai kebutuhan -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
    var btnFile = document.getElementById("btnFile");
    var btnj = document.getElementById("file");
    btnFile.addEventListener('click', function() {
        btnj.click();
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="javascript/chat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script>
    function openContactInfoModal(user_id) {
        $.ajax({
            type: 'POST',
            url: './php/getContactInfo.php', // Gantilah dengan titik akhir backend yang sebenarnya untuk mengambil informasi kontak
            data: {
                user_id: user_id
            },
            success: function(response) {
                // Isi konten modal dengan informasi kontak yang diperoleh
                $('#contactInfoModal .modal-content').html(response);
                $('#contactInfoModal').modal('show'); // Munculkan modal
            }
        });
    }
    </script>
</body>

</html>