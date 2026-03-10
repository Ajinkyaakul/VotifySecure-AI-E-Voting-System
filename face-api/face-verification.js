console.log("face-verification.js loaded");

// ---------------------------
// Start Face Verification
// ---------------------------
async function startFaceVerification() {

    const video = document.getElementById("video");
    const matchBtn = document.getElementById("match");

    // ---------------------------
    // Load models
    // ---------------------------
    try {
        console.log("Loading models...");

        await Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri("face-api/models"),
            faceapi.nets.faceLandmark68Net.loadFromUri("face-api/models"),
            faceapi.nets.faceRecognitionNet.loadFromUri("face-api/models")
        ]);

        console.log("Models loaded successfully!");
    } 
    catch (err) {
        console.error("Model loading error:", err);
    }

    // ---------------------------
    // Start webcam
    // ---------------------------
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
            console.log("Camera started successfully");
        })
        .catch(err => {
            console.error("Camera error:", err);
            alert("Unable to access camera. Please allow camera permission.");
        });

    // ---------------------------
    // Match Face Button Click
    // ---------------------------
    matchBtn.onclick = async () => {
        console.log("Capturing face...");

        // Detect face
        const detection = await faceapi
            .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (!detection) {
            alert("No face detected! Please look properly into the camera.");
            return;
        }

        console.log("Live face captured!");

        // ---------------------------
        // SEND capture descriptor to server
        // ---------------------------
        const descriptor = Array.from(detection.descriptor);

        try {
            const voterId = new URLSearchParams(window.location.search).get('voter_id');

            const res = await fetch("match_face.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    voter_id: voterId,
                    live_descriptor: descriptor
                })
            });

            const result = await res.json();

            // ---------------------------
            // RESULT HANDLING
            // ---------------------------
            if (result.match === true) {
                alert("Face Verified Successfully!");
                window.location.href = "dashboard.php?voter_id=" + voterId;
            } else {
                alert("Face NOT Matched! Verification Failed.");
            }

        } catch (error) {
            console.error("Error during face match:", error);
            alert("Server error. Please try again!");
        }
    };

}

// Auto-start when page loads
document.addEventListener("DOMContentLoaded", startFaceVerification);
