<!DOCTYPE html>
<html>
<head>
<title>Face Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="p-4 border rounded shadow" style="max-width:400px; width:100%;">
        
        <h3 class="text-center mb-3">Voter Face Login</h3>

        <?php if(isset($_GET['msg'])) echo "<div class='alert alert-danger'>".$_GET['msg']."</div>"; ?>

        <form action="face_verification.php" method="GET">
            <label>Enter Voter ID</label>
            <input type="text" name="voter_id" class="form-control mb-3" required>
            <button class="btn btn-primary w-100">Verify Face</button>
        </form>

    </div>
</div>

</body>
</html>
