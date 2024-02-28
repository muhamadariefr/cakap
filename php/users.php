<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "select * from users u 
    where unique_id in (select cu.id_other_user from users u 
    inner join contact_user cu on cu.id_user = u.unique_id 
    where cu.id_user = {$outgoing_id})";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "Tidak ada pengguna yang tersedia";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>