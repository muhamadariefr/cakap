<?php
session_start();
include_once("config.php");

if (isset($_GET['id_user']) && isset($_GET['id_other_user'])) {
    $id_user = $_GET['id_user'];
    $id_other_user = $_GET['id_other_user'];

    // Hapus semua pesan yang terkait dengan dua pengguna ini
    $delete_messages_query = "DELETE FROM messages WHERE 
                             (outgoing_msg_id = '$id_user' AND incoming_msg_id = '$id_other_user') OR 
                             (outgoing_msg_id = '$id_other_user' AND incoming_msg_id = '$id_user')";
    $delete_messages_result = mysqli_query($conn, $delete_messages_query);

    if ($delete_messages_result) {
        echo "<script>alert('Pesan berhasil dihapus');</script>";
        header("location: ../users.php");
    } else {
        echo "<script>alert('Gagal menghapus pesan: " . mysqli_error($conn) . "');</script>";
        header("location: ../users.php");
    }
} else {
    echo "<script>alert('Parameter tidak valid');</script>";
    header("location: ../users.php");
}
?>
