<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}

?>

<?php if (isset($SESSION['message'])) { ?>
<script>
alert('<?= $SESSION['message'] ?>');
</script>
<?php } ?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">

        <?php if (isset($_SESSION['message'])) { ?>
            <script>
                alert("<?php echo $_SESSION['message']; ?>");
                <?php $_SESSION['message'] = null; ?>
            </script>
        <?php } ?>

        <section class="users">
            <header>
                <div class="content">
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    }
                    ?>
                    <!-- <button type="button" class="" style="border: none; background: transparent; cursor:pointer;"
                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                        onclick="openModalProfile('<?= $row['unique_id'] ?>')">

                    </button> -->
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                        <p style="color: #000;"><?php echo $row['status']; ?></p>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split border-0"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" style="font-size: 14px;">
                        <li>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                onclick="openModalProfile('<?= $row['unique_id'] ?>')" class="dropdown-item">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-1">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                    <div class="col-sm-2">
                                        Edit Profil
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="resetPassword.php?user_id=<?php echo $row['unique_id']; ?>" class="dropdown-item">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-1">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <div class="col-sm-2">
                                        Reset Password
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onclick="deleteAccount('<?php echo $row['unique_id']; ?>')"
                                class="dropdown-item">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-1">
                                        <i class="fas fa-user-alt-slash"></i>
                                    </div>
                                    <div class="col-sm-2">
                                        Hapus Akun
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="dropdown-item">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-1">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </div>
                                    <div class="col-sm-2">
                                        Keluar
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

            </header>
            <div class="contact-grouplist justify-content-start">
                <a href="groups.php?user_id=<?php echo $row['unique_id']; ?>" class="lgrup">
                    <i class="fas fa-users"></i> Daftar Grup
                </a>
                <a href="addContact.php?user_id=<?php echo $row['unique_id']; ?>" class="lgrup">
                    <i class="fas fa-user-plus"></i> Tambah Kontak
                </a>
            </div>
            <div class="search">
                <span class="text">Pilih kontak untuk mulai obrolan</span>
                <input type="text" placeholder="Masukan nama kontak...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">

            </div>
        </section>

        <!-- Modal Profile -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profil</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div style="display: grid; place-content: center;">
                            <img src="" id="oldFile" alt="" style="width: 150px; height: 150px; border-radius: 100%;">
                        </div>
                        <div class="m-1">
                            <label for="#">User ID</label>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="unique_id" readonly>
                        </div>
                        <form action="./php/prosesUpdate.php" method="post" class="mt-3" enctype="multipart/form-data">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <input type="text" name="oldTextFile" id="oldTextFile" hidden>
                            <div class="d-flex">
                                <div class="m-1">
                                    <label for="#">Nama Depan</label>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" name="namaDepan" id="namaDepan">
                                </div>
                                <div class="m-1">
                                    <label for="#">Nama Belakang</label>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" name="namaBelakang" id="namaBelakang">
                                </div>
                            </div>
                            <div class="m-1">
                                <label for="#">Email</label>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" name="alamatEmail" id="alamatEmail">
                            </div>
                            <div class="m-1 mt-2">
                                <label for="#">Pilih Gambar</label>
                                <input type="file" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" name="fileUpdate" id="fileUpdate">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sync-alt"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Profile -->

    </div>
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

    <script src="javascript/users.js"></script>

    <script>
    function openModalProfile(user_id) {
        console.log(user_id);

        var namaDepan = $('#namaDepan');
        var namaBelakang = $('#namaBelakang');
        var alamatEmail = $('#alamatEmail');

        $.ajax({
            type: 'POST',
            url: './php/getDataUser.php',
            data: {
                user_id: user_id
            },
            success: function(response) {
                console.log(response);

                namaDepan.val(response.fname);
                namaBelakang.val(response.lname);
                alamatEmail.val(response.email);

                // Old File
                $('#oldFile').attr('src', "./php/images/" + response.img);
                $('#user_id').val(response.user_id);
                $('#unique_id').val(response.unique_id);
                $('#oldTextFile').val(response.img);

            }
        })

    }
    </script>
    <script>
    function deleteAccount(userId) {
        var confirmation = confirm("Apakah Anda yakin ingin menghapus akun ini?");

        if (confirmation) {
            $.ajax({
                type: 'GET',
                url: 'php/deleteAccount.php',
                data: {
                    id_user: userId
                },
                success: function(response) {
                    console.log("Ajax success:", response); // Debugging statement
                    if (response.trim() === "success") {
                        window.location.href = "index.php";
                    } else {
                        alert("Gagal menghapus Akun. Silakan coba lagi.");
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Ajax error:", status, error); // Debugging statement
                    alert("Terjadi kesalahan saat menghubungi server.");
                }
            });
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>