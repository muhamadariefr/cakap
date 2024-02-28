<?php
include_once "config.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_to_add = isset($_POST['id_to_add']) ? $_POST['id_to_add'] : '';
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

    $response = addContact($id_to_add, $user_id);

    echo json_encode($response);
}

function isUserInContact($idUser, $user_id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM contact_user WHERE id_user = ? AND id_other_user = ?");
    $stmt->bind_param("ii", $user_id, $idUser);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['count'] > 0;
}

function addContact($id_to_add, $user_id)
{
    global $conn;

    try {
        // Memeriksa apakah ID user sudah ada dalam grup
        if (isUserInContact($id_to_add, $user_id)) {
            return [
                'status'  => 'error',
                'message' => 'ID user sudah ada dalam kontak'
            ];
        }

        http_response_code(201);

        // Melakukan INSERT jika ID user belum ada dalam kontak
        $stmt = $conn->prepare("INSERT INTO contact_user (id_user, id_other_user) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $id_to_add);
        $stmt->execute();
        $stmt->close();

        return [
            'status'    => 'success',
            'message'   => 'Kontak berhasil ditambahkan',
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