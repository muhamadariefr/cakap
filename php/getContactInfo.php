<?php
// getContactInfo.php

include_once 'config.php';

if (isset($_POST['user_id'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");

    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        // Hasilkan dan echo konten HTML untuk modal berdasarkan $row
        echo '<div class="modal-header">
                <h1 class="modal-title fs-5" id="contactInfoModalLabel">Informasi Kontak</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div style="display: grid; place-content: center;">
                    <img src="php/images/' . $row['img'] . '" alt="Profil" style="width: 150px; height: 150px; border-radius: 50%;">
                </div>
                <div class="m-1">
                    <label for="#">User ID</label>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="contactInfoUniqueId" value="' . $row['unique_id'] . '" readonly>
                </div>
                <div class="m-1">
                    <label for="#">Nama Lengkap</label>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="contactInfoFullname" value="' . $row['fname'] . ' ' . $row['lname'] . '" readonly>
                </div>
                <div class="m-1">
                    <label for="#">Email</label>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="contactInfoEmail" value="' . $row['email'] . '" readonly>
                </div>
                <div class="m-1">
                    <label for="#">Status</label>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="contactInfoStatus" value="' . $row['status'] . '" readonly>
                </div>
                <!-- Tambahkan informasi kontak lainnya sesuai kebutuhan -->
              </div>';
    } else {
        // Tangani kesalahan jika pengguna tidak ditemukan
        echo 'Pengguna tidak ditemukan.';
    }
} else {
    // Tangani kesalahan jika ID pengguna tidak disediakan
    echo 'ID Pengguna tidak disediakan.';
}
?>
