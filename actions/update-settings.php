<?php
session_start();
if (!isset($_SESSION['store_id'])) {
    header('location:../login.php');
    exit();
}
include('../config/db.php');

if (!isset($_POST['save_settings'])) {
    header('location:../settings.php');
    exit();
}

$currency = strtoupper(trim($_POST['currency'] ?? ''));
if (!array_key_exists($currency, SUPPORTED_CURRENCIES)) {
    $_SESSION['e-msg'] = 'Please select a supported currency.';
    header('location:../settings.php');
    exit();
}

$currency = $conn->real_escape_string($currency);
$storeId = (int) $_SESSION['store_id'];
if ($conn->query("UPDATE `store` SET `currency` = '$currency' WHERE `store_id` = '$storeId'")) {
    $_SESSION['msg'] = 'Currency settings updated successfully.';
} else {
    $_SESSION['e-msg'] = 'Unable to update currency settings.';
}

header('location:../settings.php');
exit();
