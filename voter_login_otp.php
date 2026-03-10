
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Voter OTP Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="custom-card" style="max-width:400px;">

        <h3 class="text-center mb-4"><i class="bi bi-shield-lock-fill"></i> Voter OTP Login</h3>

        <?php if(isset($_GET['msg'])): ?>
            <div class="alert alert-danger"><?= $_GET['msg']; ?></div>
        <?php endif; ?>

        <form method="POST" action="voter_send_otp.php">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required placeholder="Enter Email">
            </div>

            <div class="mb-3">
                <label>Aadhaar Number</label>
                <input type="text" name="aadhaar_no" class="form-control" required minlength="12" maxlength="12" pattern="[0-9]{12}">
            </div>

            <button type="submit" class="btn btn-primary btn-main w-100">
                <i class="bi bi-envelope-fill"></i> Send OTP
            </button>

            <a href="portal.php" class="btn btn-link w-100 mt-2">Back</a>
        </form>

    </div>
</div>

</body>
</html>
