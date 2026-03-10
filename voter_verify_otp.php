<?php
session_start();
include 'includes/conn.php';

// Must have OTP session
if (!isset($_SESSION['otp'])) {
    header("Location: voter_login_otp.php?msg=Session expired. Try again.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $input_otp = $_POST['otp'];

    if ($input_otp == $_SESSION['otp']) {

        $voter_id = $_SESSION['voter_id'];

        // Optional: Update verification flag
        $update = $conn->prepare("UPDATE voters SET is_verified = 1 WHERE voters_id = ?");
        $update->bind_param("s", $voter_id);
        $update->execute();

        // Login success
        $_SESSION['voter_logged_in'] = true;

        unset($_SESSION['otp']);

        header("Location: index.php");
        exit;

    } else {
        header("Location: voter_verify_otp.php?msg=Invalid OTP. Try again.");
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Verify OTP</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="custom-card" style="max-width:400px;">

        <h3 class="text-center mb-4"><i class="bi bi-shield-check"></i> Verify OTP</h3>

        <?php 
        if (isset($_GET['msg'])) {
            echo "<div class='alert alert-danger'>".$_GET['msg']."</div>";
        }
        ?>

        <form method="POST">

            <div class="mb-3">
                <label>Enter OTP</label>
                <input type="text" name="otp" class="form-control" minlength="6" maxlength="6" required>
            </div>

            <button type="submit" class="btn btn-success btn-main w-100">
                <i class="bi bi-check2-circle"></i> Verify OTP
            </button>

            <a href="voter_login_otp.php" class="btn btn-link w-100 mt-2">Back</a>

        </form>

    </div>
</div>

</body>
</html>
