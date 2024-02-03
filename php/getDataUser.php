<?php
include_once 'config.php';

$user_id = $_POST['user_id'];

$sql = "SELECT * FROM users WHERE unique_id='$user_id'";
$query = mysqli_query($conn, $sql);

$result = mysqli_fetch_assoc($query);

$jsonResponse = json_encode($result);
header('Content-Type: application/json');
echo $jsonResponse;