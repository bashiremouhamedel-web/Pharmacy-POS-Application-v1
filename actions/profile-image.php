<?php
session_start();

if (!isset($_SESSION['store_id']) || !isset($_FILES['profile_image'])) {
    header('Location: ../index.php');
    exit();
}

include('../config/db.php');

$upload = $_FILES['profile_image'];
$allowedTypes = array('image/jpeg', 'image/png', 'image/webp');
$maxSize = 2 * 1024 * 1024;

if ($upload['error'] !== UPLOAD_ERR_OK || !in_array($upload['type'], $allowedTypes, true) || $upload['size'] > $maxSize) {
    $_SESSION['e-msg'] = 'Please choose a JPG, PNG, or WebP image up to 2 MB.';
    header('Location: ../index.php');
    exit();
}

$extension = strtolower(pathinfo($upload['name'], PATHINFO_EXTENSION));
$fileName = 'profile_' . (int) $_SESSION['store_id'] . '_' . time() . '.' . $extension;
$uploadDirectory = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'profile';

if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0755, true);
}

$destination = $uploadDirectory . DIRECTORY_SEPARATOR . $fileName;
if (!move_uploaded_file($upload['tmp_name'], $destination)) {
    $_SESSION['e-msg'] = 'The profile picture could not be saved.';
    header('Location: ../index.php');
    exit();
}

$storeId = (int) $_SESSION['store_id'];
$escapedFileName = $conn->real_escape_string($fileName);
if (!$conn->query("UPDATE `store` SET `profile_image` = '$escapedFileName' WHERE `store_id` = '$storeId'")) {
    unlink($destination);
    $_SESSION['e-msg'] = 'The profile picture could not be updated in the database.';
    header('Location: ../index.php');
    exit();
}

$_SESSION['msg'] = 'Profile picture updated successfully.';
header('Location: ../index.php');
exit();
