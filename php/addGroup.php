<?php
include_once "config.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nameGroup = isset($_POST['nameGroup']) ? $_POST['nameGroup'] : '';
    $idUser = isset($_POST['userId']) ? $_POST['userId'] : '';
    $img_name = '';

    if (isset($_FILES['image'])) {
        $img_name = uploadImage();
    }

    $response = createGroup($nameGroup, $img_name, $idUser);

    echo json_encode($response);
}

function createGroup($name, $image, $idUser)
{
    global $conn;

    try {
        http_response_code(201);

        $stmt = $conn->prepare("INSERT INTO groups (name_group, img, created_at, updated_at) VALUES (?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        $stmt->bind_param("ss", $name, $image);
        $stmt->execute();
        $groupId = $conn->insert_id;
        $stmt->close();

        $role = 1;

        $stmt = $conn->prepare("INSERT INTO member_group (id_user, id_group, id_role, created_at, updated_at) VALUES (?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        $stmt->bind_param("iii", $idUser, $groupId, $role);
        $stmt->execute();
        $stmt->close();

        return [
            'status'    => 'success',
            'message'   => 'Grup berhasil dibuat',
            'timestamp' => time()
        ];
    } catch (Exception $e) {
        return [
            'status'  => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ];
    }
}


function uploadImage()
{
    $img_name = $_FILES['image']['name'];
    $img_type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $img_explode = explode('.', $img_name);
    $img_ext = strtolower(end($img_explode));

    $allowed_extensions = ["jpeg", "png", "jpg"];
    $allowed_types = ["image/jpeg", "image/jpg", "image/png"];

    if (in_array($img_ext, $allowed_extensions) && in_array($img_type, $allowed_types)) {
        $new_img_name = time() . $img_name;
        $destination_path = "images/" . $new_img_name;

        if (move_uploaded_file($tmp_name, $destination_path)) {
            return $new_img_name;
        }
    }

    return "default.png";
}
?>