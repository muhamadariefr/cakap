<?php
session_start();
include_once("config.php");

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    $delete_account_query = "DELETE FROM messages WHERE outgoing_msg_id = '$id_user' OR incoming_msg_id = '$id_user'";
    $delete_account_query .= "; DELETE FROM users WHERE unique_id = '$id_user'";
    
    $delete_account_result = mysqli_multi_query($conn, $delete_account_query);

    if ($delete_account_result) {
        session_destroy();
        echo "success";
    } else {
        echo "error " . mysqli_error($conn);
    }
} else {
    echo "Parameter tidak valid";
}
?>
