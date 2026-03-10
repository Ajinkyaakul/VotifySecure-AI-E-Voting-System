<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Voting Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="custom-card text-center" style="max-width:400px;">
        <h2 class="mb-4">Online Voting System</h2>

        <a href="admin/login.php" class="btn btn-primary btn-main w-100 mb-3">
            <i class="bi bi-person-badge-fill"></i> Admin Login
        </a>

        <a href="voter_login_otp.php" class="btn btn-success btn-main w-100 mb-3">
            <i class="bi bi-people-fill"></i> Registered Voter
        </a>

        <a href="voter_register.php" class="btn btn-warning btn-main w-100">
            <i class="bi bi-person-add"></i> New Voter Registration
        </a>
    </div>
</div>

</body>
</html>
