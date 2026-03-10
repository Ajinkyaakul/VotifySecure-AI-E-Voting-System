<?php
header("Content-Type: application/json");

// Connect to DB
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "voting";   // change if needed

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["error" => "Database Connection Failed"]);
    exit;
}

// -------------------------------
// Read JSON body from JS
// -------------------------------
$data = json_decode(file_get_contents("php://input"), true);

$voter_id = $data["voter_id"] ?? null;
$live_descriptor = $data["live_descriptor"] ?? null;

if (!$voter_id || !$live_descriptor) {
    echo json_encode(["error" => "Missing voter_id or live descriptor"]);
    exit;
}

// -------------------------------
// Fetch stored descriptor from DB
// -------------------------------
$sql = "SELECT face_descriptor FROM voters WHERE voter_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $voter_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["error" => "Voter not found"]);
    exit;
}

$row = $result->fetch_assoc();
$stored_descriptor_json = $row["face_descriptor"];

// Convert stored descriptor from string → PHP array
$stored_descriptor = json_decode($stored_descriptor_json);

if (!$stored_descriptor) {
    echo json_encode(["error" => "Stored face data corrupted"]);
    exit;
}

// -------------------------------
// Euclidean Distance Calculation
// -------------------------------
function euclideanDistance($arr1, $arr2) {
    if (count($arr1) != count($arr2)) return 999;

    $sum = 0;
    for ($i = 0; $i < count($arr1); $i++) {
        $diff = $arr1[$i] - $arr2[$i];
        $sum += $diff * $diff;
    }
    return sqrt($sum);
}

// Compare both descriptors
$distance = euclideanDistance($live_descriptor, $stored_descriptor);

// Threshold (You can adjust this)
$threshold = 0.55;

// -------------------------------
// Send Final Result
// -------------------------------
$response = [
    "match"    => ($distance <= $threshold),
    "distance" => $distance
];

echo json_encode($response);
exit;

?>
