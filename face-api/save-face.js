console.log("save-face.js loaded");

async function startCapture() {

    const video = document.getElementById("video");
    const saveBtn = document.getElementById("saveFace");

    // Load models
    await Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri("face-api/models"),
        faceapi.nets.faceLandmark68Net.loadFromUri("face-api/models"),
        faceapi.nets.faceRecognitionNet.loadFromUri("face-api/models")
    ]);

    // Start camera
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => video.srcObject = stream)
        .catch(err => alert("Camera error"));

    // Save face on click
    saveBtn.onclick = async () => {

        const detection = await faceapi
            .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (!detection) {
            alert("No face detected! Try again.");
            return;
        }

        const descriptor = Array.from(detection.descriptor);
        const voterId = new URLSearchParams(window.location.search).get("voter_id");

        // Send descriptor to server
        const res = await fetch("store_descriptor.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                voter_id: voterId,
                descriptor: descriptor
            })
        });

        const data = await res.json();

        if (data.success) {
            alert("Face saved successfully!");
        } else {
            alert("Error saving face.");
        }
    };

}

document.addEventListener("DOMContentLoaded", startCapture);
