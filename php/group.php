<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
// die($outgoing_id);
$sql = "SELECT g.* 
        FROM member_group mg
        INNER JOIN groups g ON g.id = mg.id_group
        WHERE id_user = {$outgoing_id}";
$query = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "Tidak ada grup yang tersedia";
} elseif (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $sql2 = "SELECT * FROM message_group";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['message'] : $result = "Tidak ada pesan tersedia";
        (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;
        if (isset($row2['outgoing_msg_id'])) {
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Anda: " : $you = "";
        } else {
            $you = "";
        }

        $output .= '<a href="chatGroup.php?idGroup=' . $row['id'] . '">
                        <div class="content">
                        <img src="php/images/' . $row['img'] . '" alt="">
                        <div class="details">
                            <span>' . $row['name_group'] . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                        </div>
                    </a>';
    }
}
echo $output;
?>