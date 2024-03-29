<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

if (isset($_SESSION['unique_id'])) {
    include_once 'config.php';
    $id_group = $_POST['id_group'];
    $id_user = $_POST['id_user'];
    $output = '';

    // Mendapatkan tanggal hari ini dan kemarin
    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime('-1 days'));

    $sql = "SELECT mg.*, u.img, u.fname, u.lname 
            FROM message_group mg
            INNER JOIN users u ON u.unique_id = mg.message_from_id
            WHERE mg.id_group = {$id_group}
            ORDER BY mg.timestamp ASC";
    $query = mysqli_query($conn, $sql);

    $currentUserName = '';  // Variabel untuk melacak nama pengguna saat ini

    if (mysqli_num_rows($query) > 0) {
        $currentStatus = '';  // Variabel untuk menyimpan status tanggal saat ini

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

            // Tampilkan nama pengirim jika berubah
            $senderName = $row['fname'] . ' ' . $row['lname'];
            $senderClass = ($row['message_from_id'] === $id_user) ? 'outgoing-name' : 'incoming-name';
            
            $nameFile = "";
            $files = ($row['file']);
            if (!empty($row['file'])) {
                $nameFile = '<br><a class="file-link" href="./assets/file/'.$files.'" target="_blank" download>
                    <i class="fas fa-download file-icon"></i> ' . $files . '
                </a>';
            }

            if ($row['message_from_id'] === $id_user) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <div class="sender-name">' . $senderName . '</div>
                                    <p><span class="message-content">' . $row['message'] . $nameFile . '</span><span class="timestamp"> <br>' . $timestamp . '</span></p>
                                </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                    <img src="php/images/' . $row['img'] . '" alt="">
                                    <div class="details">
                                        <div class="sender-name">' . $senderName . '</div>
                                        <p><span class="message-content">' . $row['message'] . $nameFile . '</span><span class="timestamp"> <br>' . $timestamp . '</span></p>
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
