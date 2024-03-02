<?php
include_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nameGroup = isset($_POST['nameGroup']) ? $_POST['nameGroup'] : '';
    $idGroup = isset($_POST['idGroup']) ? $_POST['idGroup'] : '';
    $img_name = '';

    if (isset($_FILES['image'])) {
        $img_name = uploadImage();
    }

    $response = editGroup($nameGroup, $img_name, $idGroup);

    echo json_encode($response);
}

function editGroup($name, $image, $idGroup)
{
    global $conn;

    try {
        http_response_code(201);

        if ($image == '') {
            $sql = "
        UPDATE tbl_groups
        SET
        name_group = '$name'
        WHERE id = '$idGroup'
        ";

            $query = mysqli_query($conn, $sql);
        } else {
            $sql = "
        UPDATE tbl_groups
        SET
        name_group = '$name',
        img = '$image'
        WHERE id = '$idGroup'
        ";

            $query = mysqli_query($conn, $sql);
        }

        if ($query) {
            return [
                'status' => 'success',
                'message' => 'Grup berhasil dirubah',
                'timestamp' => time()
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ];
        }
    } catch (Exception $e) {
        return [
            'status' => 'error',
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

    $allowed_extensions = ['jpeg', 'png', 'jpg'];
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];

    if (in_array($img_ext, $allowed_extensions) && in_array($img_type, $allowed_types)) {
        $new_img_name = time() . $img_name;
        $destination_path = 'images/' . $new_img_name;

        if (move_uploaded_file($tmp_name, $destination_path)) {
            return $new_img_name;
        }
    }

    return 'default.png';
}
