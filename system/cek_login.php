<?php

session_start();
require "proses.php";

$response = [];
$username = $_POST['username'];
$password = $_POST['password'];

$result = $db->get("*", "petugas", "WHERE username='$username' AND password='$password'");
$row = $result->rowCount();
$data = $result->fetch();

if ($row > 0) {
    $_SESSION['login'] = $data['id_petugas'];
    $_SESSION['login_id'] = $data['id_petugas'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];
    $response = [
        "status" => "sukses"
    ];
} else {
    $response = [
        "status" => "error",
        "message" => "Username atau Password Salah"
    ];
}
echo json_encode($response);
