<?php
header("Content-Type: application/json");

// DB connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "voting";  // change if needed

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$voter_id   = $data["voter_id"] ?? null;
$descriptor = $data["descriptor"] ?? null;

if (!$voter_id || !$descriptor) {
    echo json_encode(["success" => false]);
    exit;
}

$descriptor_json = json_encode($descriptor);

// Update DB
$sql = "UPDATE voters SET face_descriptor = ? WHERE voter_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $descriptor_json, $voter_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}

$stmt->close();
$conn->close();
?>
