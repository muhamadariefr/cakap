<?php
include_once "config.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = isset($_POST['idUser']) ? $_POST['idUser'] : '';
    $id_group = isset($_POST['idGroup']) ? $_POST['idGroup'] : '';

    $response = addMember($idUser, $id_group);

    echo json_encode($response);
}

function isUserInGroup($idUser, $id_group)
{
    global $conn;

    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM member_group WHERE id_user = ? AND id_group = ?");
    $stmt->bind_param("ii", $idUser, $id_group);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['count'] > 0;
}

function addMember($idUser, $id_group)
{
    global $conn;

    try {
        // Memeriksa apakah ID user sudah ada dalam grup
        if (isUserInGroup($idUser, $id_group)) {
            return [
                'status'  => 'error',
                'message' => 'ID user sudah ada dalam grup'
            ];
        }

        http_response_code(201);

        $role = 2;

        // Melakukan INSERT jika ID user belum ada dalam grup
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