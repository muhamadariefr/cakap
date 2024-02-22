<?php
include_once 'config.php';
$user_id = htmlspecialchars($_POST['user_id']);
$oldFile = htmlspecialchars($_POST['oldTextFile']);
$namaDepan = htmlspecialchars($_POST['namaDepan']);
$namaBelakang = htmlspecialchars($_POST['namaBelakang']);
$alamatEmail = htmlspecialchars($_POST['alamatEmail']);
$newFile = $_FILES['fileUpdate']['name'];


if (!empty($newFile)){

    
    $tmp_file = $_FILES['fileUpdate']['tmp_name'];
    $ext = pathinfo($newFile, PATHINFO_EXTENSION);
    $file_name = pathinfo($newFile, PATHINFO_FILENAME);
    
    $newFile = explode( '.', $ext );

    $newImg = rand(102, 2310). "-" .$file_name ."." .$newFile[0];

    move_uploaded_file(
        // Temp image location
        $tmp_file,
    
        // New image location
        __DIR__ . "./images/" . $newImg
    );

    $sql = "UPDATE users SET fname='$namaDepan', lname='$namaBelakang', email='$alamatEmail', img='$newImg' WHERE user_id='$user_id'";

    $query = mysqli_query($conn, $sql);

    // var_dump($sql);
    // die();

    if($query){
        session_start();

        $SESSION['message'] = "Data Berhasil di Ubah";

        header("location: ../users.php");
    }else{
        session_start();

        $SESSION['message'] = "Data Gagal di Ubah";

        header("location: ../users.php");
    }

}else{
    $sql = "UPDATE users SET fname='$namaDepan', lname='$namaBelakang', email='$alamatEmail', img='$oldFile' WHERE user_id='$user_id'";

    $query = mysqli_query($conn, $sql);
    
    if($query){
        session_start();

        $SESSION['message'] = "Data Berhasil di Ubah";

        header("location: ../users.php");
    }else{
        session_start();

        $SESSION['message'] = "Data Gagal di Ubah";

        header("location: ../users.php");
    }
}
