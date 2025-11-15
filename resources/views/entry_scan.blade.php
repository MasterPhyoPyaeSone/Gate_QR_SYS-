<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-600 py-4 px-6">
                <h1 class="text-2xl font-bold text-white">
                    <i class="fas fa-qrcode mr-2"></i> QR Code Scanner & Database Storage
                </h1>
            </div>

            <!-- Upload Form -->
            <div class="p-6 border-b">
                <form action="{{ route('qr.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="flex flex-col space-y-2">
                        <label class="text-lg font-medium text-gray-700">
                            <i class="fas fa-upload mr-2"></i>Upload QR Code Image
                        </label>
                        <div class="flex items-center space-x-4">
                            <input type="file" name="qr_image" accept="image/*" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100" required>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                                <i class="fas fa-save mr-2"></i> Scan & Store
                            </button>
                        </div>
                        @error('qr_image')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </form>

                <!-- Camera Scan Option -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-700 mb-2">
                        <i class="fas fa-camera mr-2"></i>Or Scan Live
                    </h2>
                    <div id="reader" class="w-full h-64 border-2 border-dashed border-gray-300 rounded-lg mb-4"></div>
                    <button onclick="startScanner()" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
                        <i class="fas fa-play mr-2"></i> Start Scanner
                    </button>
                </div>
            </div>

            <!-- Scanned Data Table -->
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-700 mb-4">
                    <i class="fas fa-database mr-2"></i>Stored QR Codes
                </h2>

                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($qrCodes as $qr)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $qr->user_id }}</td>
                                <td class="px-6 py-4">{{ $qr->name }}</td>
                                {{-- <td class="px-6 py-4">
                                        @if($qr->image_path)
                                            <img src="{{ asset('storage/' . $qr->image_path) }}" alt="QR Code Image" class="h-16 w-16 object-cover">
                                @else
                                <span class="text-gray-400">No image</span>
                                @endif
                                </td> --}}
                                <td class="px-6 py-4">
                                    {{ $qr->time }}
                                </td>
                                @if ( $qr->state === "in")
                                <td class="px-6 py-4" style="color:chartreuse">
                                    {{ $qr->state }}
                                </td>
                                @else
                                <td class="px-6 py-4" style="color:rgb(252, 70, 19)">
                                    {{ $qr->state }}
                                </td>
                                @endif

                                {{-- <td class="px-6 py-4 whitespace-nowrap">{{ $qr->created_at->format('Y-m-d H:i:s') }}</td> --}}
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    No QR codes scanned yet
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Scanner Library -->
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>

    <script>
        function startScanner() {

           

// start
            const html5QrCode = new Html5Qrcode("reader");

            html5QrCode.start({
                    facingMode: "environment"
                }, {
                    fps: 10
                    , qrbox: 150
                }
                , (decodedText) => {
                    fetch("{{ route('qr.storeByScann') }}", {
                            method: "POST"
                            , headers: {
                                "Content-Type": "application/json"
                                , "Accept": "application/json"
                                , "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            }
                            , body: JSON.stringify({
                                qr_text: decodedText
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                alert('QR code scanned and stored successfully!');
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error storing QR code: ' + error.message);
                        })
                        .finally(() => {
                            html5QrCode.stop();
                        });
                }
                , (errorMessage) => {
                    console.warn(`QR error = ${errorMessage}`);
                }
            );
        }

    </script>
</body>
</html>
