<?php
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
    
    $deleteGroupQuery = "DELETE FROM tbl_groups WHERE id = '$group_id'";
    $deleteMemberQuery = "DELETE FROM member_group WHERE id_group = '$group_id'";
    
    $deleteGroupResult = mysqli_query($conn, $deleteGroupQuery);
    $deleteMemberResult = mysqli_query($conn, $deleteMemberQuery);

    if ($deleteGroupResult && $deleteMemberResult) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
