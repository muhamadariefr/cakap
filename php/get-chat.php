<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

if (isset($_SESSION['unique_id'])) {
    include_once 'config.php';
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = '';

    // Mendapatkan tanggal hari ini dan kemarin
    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime('-1 days'));

    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $currentStatus = '';  // Variable untuk menyimpan status tanggal saat ini
        while ($row = mysqli_fetch_assoc($query)) {
            $timestamp = date('H:i', strtotime($row['timestamp']));
            $message_date = date('Y-m-d', strtotime($row['timestamp']));
            $file = $row['file'];

            // Menentukan status pesan (hari ini, kemarin, atau sebelumnya)
            $status = '';
            if ($message_date == $today) {
                $status = 'Hari ini';
            } elseif ($message_date == $yesterday) {
                $status = 'Kemarin';
            } else {
                $status = date('d M Y', strtotime($row['timestamp']));
            }

            // Jika status berubah, tampilkan status baru di atas percakapan
            if ($status != $currentStatus) {
                $output .= '<div class="status-container">                                    
                                    <div class="status">' . $status . '</div>                                    
                                </div>';
                $currentStatus = $status;
            }
            $nameFile = "";
            $files = ($row['file']);
            if (!empty($row['file'])) {
                $nameFile = '<br><a class="file-link" href="./assets/file/'.$files.'" target="_blank" download>
                    <i class="fas fa-download file-icon"></i> ' . $files . '
                </a>';
            }
            
            
            

            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . $nameFile .'<span class="timestamp"> <br>' . $timestamp . '</span></p>
                                </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                    <img src="php/images/' . $row['img'] . '" alt="">
                                    <div class="details">
                                        <p>' . $row['msg'] . $nameFile .'<span class="timestamp"> <br>' . $timestamp . '</span></p>
                                    </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">Tidak ada pesan yang tersedia. Setelah Anda mengirim pesan, pesan itu akan muncul di sini.</div>';
    }
    echo $output;
} else {
    header('location: ../login.php');
}
?>