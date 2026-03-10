<?php
session_start();
include 'includes/conn.php';

$fn  = $_POST['firstname'];
$ln  = $_POST['lastname'];
$aad = $_POST['aadhaar_no'];
$email = $_POST['email'];

// Basic server-side empty check
if (empty($fn) || empty($ln) || empty($aad) || empty($email)) {
    header("Location: voter_register.php?msg=All fields are required");
    exit;
}

// Aadhaar validation (exactly 12 digits)
if (!preg_match('/^[0-9]{12}$/', $aad)) {
    header("Location: voter_register.php?msg=Invalid Aadhaar Number");
    exit;
}

// Email format check
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: voter_register.php?msg=Invalid Email Address");
    exit;
}

// check existing email/aadhaar
$stmt = $conn->prepare("SELECT id FROM voters WHERE aadhaar_no=? OR email=?");
$stmt->bind_param("ss", $aad, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    header("Location: voter_register.php?msg=Aadhaar or Email already registered");
    exit;
}
$stmt->close();

// ---------- PHOTO UPLOAD ----------

// Save directly inside /images/
$targetDir = __DIR__ . "/images/";

// create folder if not exists
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// unique file name
$photoName  = time() . "_" . basename($_FILES["photo"]["name"]);
$targetFile = $targetDir . $photoName;

$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// allowed file types
$allowedTypes = array("jpg", "jpeg", "png");

if (!in_array($imageFileType, $allowedTypes)) {
    header("Location: voter_register.php?msg=Only JPG, JPEG, PNG allowed");
    exit;
}

// upload file
if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
    header("Location: voter_register.php?msg=Error uploading photo");
    exit;
}

// Save only file name in DB
$photoSave = $photoName;

// ---------------------------------

// Voter ID + default password
$voters_id = "VOT" . time();
$pass = password_hash("Temp@123", PASSWORD_BCRYPT);  // required by DB structure

$stmt = $conn->prepare("INSERT INTO voters (voters_id, password, firstname, lastname, photo, email, aadhaar_no, is_verified)
                        VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
$stmt->bind_param("sssssss", $voters_id, $pass, $fn, $ln, $photoSave, $email, $aad);

if ($stmt->execute()) {
    $msg = "Registration successful! Your Voter ID: $voters_id";
    header("Location: voter_register.php?msg=" . urlencode($msg));
} else {
    header("Location: voter_register.php?msg=Registration failed");
}

$stmt->close();
?>
