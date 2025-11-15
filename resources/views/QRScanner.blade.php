<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/html5-qrcode@2.0.11/dist/html5-qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .scanner-container {
            width: 100%;
            max-width: 500px;
            aspect-ratio: 1;
            position: relative;
            border: 2px dashed #e5e7eb;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        #reader {
            width: 100%;
            height: 100%;
        }

        .no-scans {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #6b7280;
            font-style: italic;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        #preview {
            max-width: 200px;
            margin-top: 20px;
            border: 1px solid #ccc;
            margin-left: 80px
        }

        #result {
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <x-navbar type="student">
        <div class="w-4xl py-8">
            <main class="flex-grow">
                <div class="" style="width: 1110px; margin-top: 80px;margin-left: 200px;">
                    <!-- Scanner Section -->
                    <div class="bg-white shadow rounded-lg p-6 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-medium text-gray-900">QR Code Scanner</h2>
                            <button id="scanner-toggle" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Start Scanner
                            </button>
                        </div>
                        <div class="flex">
                            <div class="">
                                <div class="scanner-container" id="scanner-view" style="width: 350px; height: 250px; padding-top: 10px; ">
                                    <div class="no-scans">Scanner inactive. Click "Start Scanner" to begin.</div>


                                </div>
                                <input type="file" id="fileInput" accept="image/*">
                                <img id="preview" />
                            </div>
                            <div class="mt-4 ">
                                <div id="scan-result" class="p-4   bg-gray-50 rounded-lg border border-gray-200" style="background: #a0f7cd; width: 670px; margin-left: 30px; margin-bottom: 50px;">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <h3 class="text-lg font-medium text-gray-900">Scan Result</h3>
                                            <div class="mt-1">
                                                <p class="text-sm text-gray-500 mb-2" id="scan-type"></p>
                                                <div class="bg-white p-3 rounded border border-gray-200">
                                                    <p class="text-sm font-mono break-all" id="result-data"></p> <br>
                                                    <p id="result" class="text-sm text-gray-500 mb-2" style="margin-left: 80px"></p>
                                                </div>
                                            </div>
                                            <!-- <div class="mt-4 flex space-x-3">
                                            <button class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                Save to History
                                            </button>
                                            <button onclick="copyToClipboard()" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                Copy Content
                                            </button>
                                        </div> -->
                                        </div>
                                    </div>

                                </div>
                                <!-- Recent Scans -->
                                <div class="bg-white shadow rounded-lg overflow-hidden" style="margin-left: 30px;margin-top: -20px; width: 670px;">
                                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                        <h2 class="text-lg font-medium text-gray-900">Recent Scans</h2>
                                        <button id="clear-scans" class="text-sm text-red-600 hover:text-red-800">
                                            Clear All
                                        </button>
                                    </div>
                                    <div class="divide-y divide-gray-200">
                                        <div class="px-6 py-4 flex justify-between items-center">
                                            <div>
                                                <p class="text-sm text-gray-500">2023-06-15 14:30</p>
                                                <p class="font-medium">https://example.com/product/1234</p>
                                            </div>
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Success</span>
                                        </div>
                                        <div class="px-6 py-4 flex justify-between items-center">
                                            <div>
                                                <p class="text-sm text-gray-500">2023-06-15 11:45</p>
                                                <p class="font-medium">WIFI:T:WPA;S:MyNetwork;P:securepassword;</p>
                                            </div>
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Success</span>
                                        </div>
                                        <div class="px-6 py-4 flex justify-between items-center">
                                            <div>
                                                <p class="text-sm text-gray-500">2023-06-14 09:20</p>
                                                <p class="font-medium">BEGIN:VCARD...</p>
                                            </div>
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Success</span>
                                        </div>
                                    </div>
                                    <div class="px-6 py-4 bg-gray-50 text-right">
                                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </main>

            {{-- <div id="result"></div> --}}



        </div>
    </x-navbar>
    <script>
        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {

            // QR Scanner Logic
            const toggleBtn = document.getElementById('scanner-toggle');
            const scannerView = document.getElementById('scanner-view');
            const scanResult = document.getElementById('scan-result');
            const resultData = document.getElementById('result-data');
            let scannerActive = false;
            let html5QrCode;

            toggleBtn.addEventListener('click', function() {
                if (!scannerActive) {
                    // Start scanner
                    scannerView.innerHTML = '';
                    html5QrCode = new Html5Qrcode("scanner-view");
                    const config = {
                        fps: 10
                        , qrbox: {
                            width: 250
                            , height: 250
                        }
                    };

                    html5QrCode.start({
                            facingMode: "environment"
                        }
                        , config
                        , (decodedText, decodedResult) => {
                            // Handle scan result
                            resultData.textContent = decodedText;
                            const scanType = detectScanType(decodedText);
                            document.getElementById('scan-type').textContent = `Type: ${scanType}`;
                            scanResult.classList.remove('hidden');
                            // Add to recent scans
                            addRecentScan(decodedText, scanType);

                            // Stop scanner after successful scan
                            html5QrCode.stop().then(() => {
                                scannerActive = false;
                                toggleBtn.textContent = 'Start Scanner';
                            }).catch(err => {
                                console.error("Error stopping scanner:", err);
                            });
                        }
                        , (errorMessage) => {
                            // Parse error, ignore
                        }
                    ).catch(err => {
                        console.error("Error starting scanner:", err);
                    });

                    scannerActive = true;
                    toggleBtn.textContent = 'Stop Scanner';
                    // scanResult.classList.add('hidden');
                } else {
                    // Stop scanner
                    if (html5QrCode) {
                        html5QrCode.stop().then(() => {
                            scannerActive = false;
                            toggleBtn.textContent = 'Start Scanner';
                            scannerView.innerHTML = '<div class="no-scans">Scanner inactive. Click "Start Scanner" to begin.</div>';
                        }).catch(err => {
                            console.error("Error stopping scanner:", err);
                        });
                    }
                }
            });

            function detectScanType(text) {
                if (text.startsWith('http://') || text.startsWith('https://')) {
                    return 'URL';
                } else if (text.startsWith('WIFI:')) {
                    return 'WiFi Credentials';
                } else if (text.startsWith('BEGIN:VCARD')) {
                    return 'Contact Card';
                } else if (/^\d+$/.test(text)) {
                    return 'Numeric Code';
                } else {
                    return 'Text';
                }
            }

            function addRecentScan(data, type) {
                const recentScans = document.querySelector('.divide-y');
                const now = new Date();
                const timestamp = now.toISOString().replace('T', ' ').substring(0, 19);

                const scanItem = document.createElement('div');
                scanItem.className = 'px-6 py-4 flex justify-between items-center';
                scanItem.innerHTML = `
                    <div>
                        <p class="text-sm text-gray-500">${timestamp}</p>
                        <p class="font-medium">${data.length > 50 ? data.substring(0, 50) + '...' : data}</p>
                        <p class="text-xs text-gray-400">${type}</p>
                    </div>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Success</span>
                `;

                recentScans.prepend(scanItem);
            }

            function copyToClipboard() {
                const text = document.getElementById('result-data').textContent;
                navigator.clipboard.writeText(text).then(() => {
                    alert('Copied to clipboard!');
                });
            }
        });

    </script>

    {{-- uplad image scan  --}}
    <script>
       
        const fileInput = document.getElementById("fileInput");
        const preview = document.getElementById("preview");
        const resultDiv = document.getElementById("result");

        fileInput.addEventListener("change", function() {
            const file = fileInput.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;

                // create canvas to read image pixels
                const img = new Image();
                img.src = e.target.result;
                img.onload = function() {
                    const canvas = document.createElement("canvas");
                    const ctx = canvas.getContext("2d");
                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0, img.width, img.height);

                    const imageData = ctx.getImageData(0, 0, img.width, img.height);
                    const code = jsQR(imageData.data, img.width, img.height);

                    if (code) {
                        let formatted = code.data.replace(/\n/g, "<br>");
                        resultDiv.innerHTML = "✅ QR Code Result:<br>" + formatted;

                        // Controller ဆီ ပို့
                        // fetch("{{ route('qr.verify') }}", {
                        //         method: "POST"
                        //         , headers: {
                        //             "Content-Type": "application/json"
                        //             , "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        //         }
                        //         , body: JSON.stringify({
                        //             data: code.data
                        //         })
                        //     })
                        //     .then(res => res.json())
                        //     .then(response => {
                        //         // Controller response အရ result ပြန်ပြခြင်း
                        //         resultDiv.innerHTML += "<br>" + response.message;
                        //     })
                        //     .catch(err => {
                        //         console.error(err);
                        //         resultDiv.innerHTML += "<br>❌ Error checking QR code!";
                        //     });

                    } 
                    else {
                        resultDiv.innerHTML = "❌ No QR code found.";
                    }


                };
            };
            reader.readAsDataURL(file);
        });

    </script>

</body>
</html>
