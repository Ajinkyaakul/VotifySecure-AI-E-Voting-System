<?php
include "includes/conn.php";

$data = json_decode(file_get_contents("php://input"), true);

$voter_id = $data['voter_id'];
$descriptor = $data['descriptor'];

$stm = $conn->prepare("UPDATE voters SET face_descriptor=? WHERE voters_id=?");
$stm->bind_param("ss", $descriptor, $voter_id);

if($stm->execute()){
    echo "Descriptor saved successfully!";
} else {
    echo "Error saving descriptor.";
}
?>
