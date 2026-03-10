<?php
$voter_id = $_GET['voter_id'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Face Verification</title>

    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background: #f7f7f7;
        }
        #videoBox {
            width: 420px;
            height: 340px;
            margin: auto;
            margin-top: 20px;
            border: 3px solid black;
            border-radius: 12px;
            overflow: hidden;
            background: white;
        }
        #video {
            width: 420px;
            height: 340px;
            object-fit: cover;
        }
        #match {
            margin-top: 20px;
            padding: 10px 20px;
            background: green;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }
        #match:hover {
            background: #008800;
        }
    </style>
</head>

<body>

    <h1>Face Verification for Voter ID: <?php echo $voter_id; ?></h1>
    <p>Position your face inside the frame...</p>

    <div id="videoBox">
        <video id="video" autoplay muted></video>
    </div>

    <button id="match">Match Face</button>

    <!-- Load face-api.js FIRST -->
    <script defer src="face-api/face-api.min.js"></script>

    <!-- Load your JS code AFTER face-api -->
    <script defer src="face-api/face-verification.js?v=2"></script>

</body>
</html>
