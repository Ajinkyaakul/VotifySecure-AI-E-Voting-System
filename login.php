<?php
session_start();
include 'includes/conn.php';

if(isset($_POST['login'])){

    $voter = $_POST['voter'];
    $password = $_POST['password'];

    // Fetch voter
    $stmt = $conn->prepare("SELECT * FROM voters WHERE voters_id = ?");
    $stmt->bind_param("s", $voter);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows < 1){
        $_SESSION['error'] = 'Cannot find voter with that ID';
        header('Location: index.php');
        exit();
    }

    $row = $result->fetch_assoc();

    // Verify password
    if(password_verify($password, $row['password'])){

        // Clear any old admin login
        unset($_SESSION['admin']);
        unset($_SESSION['admin_logged_in']);

        // Set voter session
        $_SESSION['voter'] = $row['id'];     // required by index.php
        $_SESSION['voter_id'] = $row['voters_id']; // optional use
        $_SESSION['voter_logged_in'] = true;

        // Redirect to voter dashboard
        header("Location: home.php");
        exit();

    } else {
        $_SESSION['error'] = 'Incorrect password';
        header("Location: index.php");
        exit();
    }

} 
else {
    $_SESSION['error'] = 'Input voter credentials first';
    header("Location: index.php");
    exit();
}
?>

