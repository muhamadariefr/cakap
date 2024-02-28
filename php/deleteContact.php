<?php
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Assuming $conn is the mysqli connection object
    $id_user = mysqli_real_escape_string($conn, $_GET['id_user']);
    $id_other_user = mysqli_real_escape_string($conn, $_GET['id_other_user']);

    // Use prepared statement to prevent SQL injection
    $deleteQuery = "DELETE FROM contact_user 
                    WHERE (id_user = ? AND id_other_user = ?)
                    OR
                    (id_user = ? AND id_other_user = ?)";
    
    $stmt = mysqli_prepare($conn, $deleteQuery);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "iiii", $id_user, $id_other_user, $id_other_user, $id_user);

    // Execute the statement
    $deleteResult = mysqli_stmt_execute($stmt);

    if ($deleteResult) {
        header("location: ../users.php");
    } else {
        header("location: ../users.php");
    }
} else {
    header("location: ../users.php");
}
?>
