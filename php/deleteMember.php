<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

if (isset($_GET['idGroup']) && isset($_GET["idMember"])) {
    include_once 'config.php';
    
    $idGroup = mysqli_real_escape_string($conn, $_GET['idGroup']);
    $idMember = mysqli_real_escape_string($conn, $_GET["idMember"]);

    $sql = "DELETE FROM member_group WHERE id_group='{$idGroup}' AND id_user='{$idMember}'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("location: ../chatGroup.php?idGroup={$idGroup}");
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
} else {
    header('location: ../login.php');
    exit();
}
?>