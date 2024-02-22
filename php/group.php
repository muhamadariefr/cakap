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
        $sql2 = "SELECT * FROM message_group WHERE id_group='{$row['id']}' ORDER BY timestamp DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);

        // Check if there are any messages in the group
        if ($query2 && mysqli_num_rows($query2) > 0) {
            $row2 = mysqli_fetch_assoc($query2);
            $lastMessage = $row2['message'];
        } else {
            $lastMessage = "Tidak ada pesan tersedia";
        }

        $output .= '<a href="chatGroup.php?idGroup=' . $row['id'] . '">
                        <div class="content">
                        <img src="php/images/' . $row['img'] . '" alt="">
                        <div class="details">
                            <span>' . $row['name_group'] . '</span>
                            <p>' . $lastMessage . '</p>
                        </div>
                        </div>
                    </a>';
    }
}
echo $output;
?>
