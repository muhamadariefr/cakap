<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $timestamp = date('Y-m-d H:i');
   

    if (!empty($message)) {

        $file = $_FILES['file']['name'];

        if(!empty($file)){
            
            $tmp_name = $_FILES['file']['tmp_name'];
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $file_name = pathinfo($file, PATHINFO_FILENAME);
            
            $file = explode( '.', $ext );

            $uploadFile = $file_name .".".$file[0];

            move_uploaded_file(
                // Temp image location
                $tmp_name,
            
                // New image location
                __DIR__ . "../../assets/file/" . $uploadFile
            );

            // Insert
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, file, timestamp)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$uploadFile}' ,'{$timestamp}')") or die();

        }else{
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, file, timestamp)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '' ,'{$timestamp}')") or die();
        }

        
    }
} else {
    header("location: ../login.php");
}
?> 
