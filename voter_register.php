<<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>New Voter Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container" style="max-width:600px; margin-top:40px;">
    <div class="custom-card">

        <h3 class="text-center mb-3">
            <i class="bi bi-person-add"></i> New Voter Registration
        </h3>

        <?php if(isset($_GET['msg'])): ?>
            <div class="alert alert-danger"><?= $_GET['msg']; ?></div>
        <?php endif; ?>

        <form method="POST" action="voter_register_save.php" enctype="multipart/form-data">

            <div class="mb-3">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control" required pattern="[A-Za-z]{2,}">
            </div>

            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" required pattern="[A-Za-z]{2,}">
            </div>

            <div class="mb-3">
                <label>Aadhaar Number</label>
                <input type="text" name="aadhaar_no" class="form-control" minlength="12" maxlength="12" required pattern="[0-9]{12}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Upload Photo</label>
                <input type="file" name="photo" class="form-control" required accept=".jpg,.jpeg,.png">
            </div>

            <button type="submit" class="btn btn-success btn-main w-100">
                <i class="bi bi-check-circle"></i> Register
            </button>

            <a href="portal.php" class="btn btn-link w-100 mt-2">Back</a>

        </form>

    </div>
</div>

</body>
</html>
