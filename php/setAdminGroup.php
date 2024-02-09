<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

if (isset($_GET['idGroup']) && isset($_GET["idMember"])) {
    include_once 'config.php';
    
    $idGroup = mysqli_real_escape_string($conn, $_GET['idGroup']);
    $idMember = mysqli_real_escape_string($conn, $_GET["idMember"]);

    $sql = "UPDATE member_group
            SET id_role = '1'
            WHERE id_user='{$idMember}'
            AND id_group='{$idGroup}'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // Menggunakan header untuk mengarahkan kembali ke halaman chatGroup
        header("location: ../chatGroup.php?idGroup={$idGroup}");
        exit(); // Pastikan untuk menghentikan eksekusi setelah melakukan redirect
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
} else {
    header('location: ../login.php');
    exit();
}
?>
