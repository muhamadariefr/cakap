<?php
session_start();
include_once "config.php";

if(isset($_GET['idGroup']) && !empty($_GET['idGroup'])){
    $userId = $_SESSION['unique_id'];
    $groupId = $_GET['idGroup'];

    // Hapus pengguna dari grup
    $sqlDelete = mysqli_query($conn, "DELETE FROM member_group WHERE id_user = '$userId' AND id_group = '$groupId'");

    if($sqlDelete){
        // Redirect kembali ke halaman chatGroup setelah keluar dari grup
        header("location: ../groups.php?idGroup=$groupId");
    } else {
        // Jika ada kesalahan saat menghapus, Anda bisa menangani di sini
        echo "Terjadi kesalahan saat mencoba untuk keluar dari grup.";
    }
} else {
    header("location: ../users.php");
    exit();
}
?>
