<?php
$voter_id = $_GET["voter_id"] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Capture Face</title>
    <style>
        body { text-align: center; font-family: Arial; }
        #videoBox {
            width: 420px;
            height: 340px;
            margin: auto;
            border: 3px solid black;
            border-radius: 12px;
            overflow: hidden;
        }
        video { width: 420px; height: 340px; object-fit: cover; }
        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: blue;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
        }
    </style>
</head>

<body>

<h2>Face Registration for Voter ID: <?php echo $voter_id; ?></h2>

<div id="videoBox">
    <video id="video" autoplay muted playsinline></video>
</div>

<button id="saveFace">Save Face</button>

<script defer src="face-api/face-api.min.js"></script>
<script defer src="face-api/save-face.js"></script>

</body>
</html>
