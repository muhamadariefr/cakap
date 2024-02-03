<?php
include_once "config.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = isset($_POST['idUser']) ? $_POST['idUser'] : '';
    $id_group = isset($_POST['idGroup']) ? $_POST['idGroup'] : '';

    $response = addMember($idUser, $id_group);

    echo json_encode($response);
}

function addMember($idUser, $id_group)
{
    global $conn;

    try {
        http_response_code(201);

        $role = 2;

        $stmt = $conn->prepare("INSERT INTO member_group (id_user, id_group, id_role, created_at, updated_at) VALUES (?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        $stmt->bind_param("iii", $idUser, $id_group, $role);
        $stmt->execute();
        $stmt->close();

        return [
            'status'    => 'success',
            'message'   => 'Member berhasil ditambahkan',
            'timestamp' => time()
        ];
    } catch (Exception $e) {
        return [
            'status'  => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ];
    }
}
?>