<?php
session_start();
include 'includes/conn.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';
require __DIR__ . '/PHPMailer/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;

// Get form input
$email = $_POST['email'];
$aadhaar = $_POST['aadhaar_no'];

// Validate input
if (empty($email) || empty($aadhaar)) {
    header("Location: voter_login_otp.php?msg=All fields are required");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: voter_login_otp.php?msg=Invalid email format");
    exit;
}

if (!preg_match('/^[0-9]{12}$/', $aadhaar)) {
    header("Location: voter_login_otp.php?msg=Invalid Aadhaar number");
    exit;
}

// Check voter exists
$stmt = $conn->prepare("SELECT voters_id, firstname FROM voters WHERE email = ? AND aadhaar_no = ?");
$stmt->bind_param("ss", $email, $aadhaar);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: voter_login_otp.php?msg=No voter found with given details");
    exit;
}

$row = $result->fetch_assoc();
$voter_id = $row['voters_id'];
$name = $row['firstname'];

// Generate OTP
$otp = mt_rand(100000, 999999);
$_SESSION['otp'] = $otp;
$_SESSION['voter_id'] = $voter_id;
$_SESSION['email'] = $email;

// Send OTP using PHPMailer
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "ajinkyakulkarni2003@gmail.com";    // YOUR EMAIL
    $mail->Password = "pgzajukbqrbnutrk";      // APP PASSWORD
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom("ajinkyakulkarni2003@gmail.com", "Online Voting System");
    $mail->addAddress($email, $name);

    $mail->isHTML(true);
    $mail->Subject = "Your OTP for Voting Login";
    $mail->Body = "<h3>Hello $name,</h3>
                   <p>Your OTP for voter login is:</p>
                   <h2><b>$otp</b></h2>
                   <p>Do not share this code with anyone.</p>";

    $mail->send();
    header("Location: voter_verify_otp.php?msg=OTP sent to your email");
    exit;

} catch (Exception $e) {
    header("Location: voter_login_otp.php?msg=Failed to send OTP. Check email settings.");
    exit;
}

?>
