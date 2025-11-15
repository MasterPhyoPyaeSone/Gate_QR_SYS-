<!-- resources/views/qrcode.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>
</head>
<body>
    <h2>Generate QR & Save</h2>
    <input type="email" id="email" placeholder="Enter Email"><br><br>
    <div id="qrcode"></div>
    <button type="button" onclick="generateQR()">Generate QR</button>
    <button type="button" onclick="saveQR()">Save & Send Email</button>

    <script>
        let qr;

        function generateQR() {
            const email = document.getElementById("email").value;
            if (!email) return alert("Enter Email First!");

            document.getElementById("qrcode").innerHTML = "";
            qr = new QRCode(document.getElementById("qrcode"), {
                text: "QR-" + Date.now(),
                width: 200,
                height: 200
            });
        }

        async function saveQR() {
            const email = document.getElementById("email").value;
            if (!email) return alert("Enter Email First!");

            const canvas = document.querySelector('#qrcode canvas');
            if (!canvas) return alert("Generate QR first!");

            const base64Image = canvas.toDataURL("image/png");

            try {
                let res = await fetch("{{ url('/save-qr') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email: email,
                        qr_code: base64Image
                    })
                });

                let data = await res.json();

                if (data.success) {
                    alert("✅ QR saved & Email sent!");
                } else {
                    alert("❌ Something went wrong");
                }
            } catch (err) {
                console.error(err);
                alert("❌ Error sending request");
            }
        }
    </script>
</body>
</html>
