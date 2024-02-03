<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    } else {
        $output .= '<div style="text-align: center; background-color: #f8d7da; padding: 10px; border-radius: 10px;">
                        <i style="display: block; font-size: 50px; color: #721c24; padding: 20px;" class="fas fa-user-slash"></i>                        
                        <span style="color: #721c24; font-size: 20px;">Pengguna tidak ditemukan</span>
                    </div>';
    }

    echo $output;
?>
