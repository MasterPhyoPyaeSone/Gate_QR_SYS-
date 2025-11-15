
<style>
        .profile-card {
            max-width: 800px;
            transition: all 0.3s ease;
        }
        .profile-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .qr-code {
            width: 120px;
            height: 120px;
            background: white;
            padding: 8px;
        }
        .detail-item {
            transition: all 0.2s ease;
        }
        .detail-item:hover {
            background-color: rgba(249, 250, 251, 0.8);

        }
        .edit-btn {
            transition: all 0.2s ease;
        }
        .edit-btn:hover {
            transform: scale(1.05);
        }
</style>


<x-navbar type="student">

    <div class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
        <div class="profile-card bg-white rounded-xl shadow-md overflow-hidden w-full">
            <!-- Profile Header -->
            <div class="bg-[#7380ec] p-6 text-white relative">
                <div class="absolute top-4 right-4 flex space-x-2">
                    <a href="/students/{{$student?->id}}/edit"><button class="edit-btn bg-white text-blue-600 p-2 rounded-full shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </button></a>
                </div>
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <div class="relative">
                        <img src="/storage/{{$student->image}}" alt="Student profile photo showing a smiling young adult with short brown hair wearing casual attire" class="profile-image rounded-full">
                        <span class="absolute bottom-2 right-2 bg-green-500 w-4 h-4 rounded-full border-2 border-white"></span>
                    </div>
                    <div class="flex-1 text-center md:text-left ml-[30px] mt-[20px]" style="margin-top: 50px">
                        <h1 class="text-2xl font-bold" id="userName">{{ strtoupper($student->name) }}</h1>
                        <h2 class="text-blue-100"  style="font-size: 15px" id="userId">{{$student->roll_number}}</h2>
                       
                    </div>
                    <div class="bg-white rounded-lg p-2 shadow-md hidden md:block mr-[50px]">
                        <a href="/students/{{$student->id}}/student_QRcode"><div id="qr-code" class="qr-code"></div></a>
                        {{-- <img src="https://placehold.co/500x500?text=QR+Code" alt="QR Code for student ID verification" class="qr-code rounded"> --}}
                        <p class="text-xs text-center mt-1 text-gray-600 font-medium">Student ID</p>
                    </div>
                </div>
            </div>
            <!-- Profile Details -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Contact Information -->
                <div class="space-y-3">
                    <h2 class="text-lg font-bold text-gray-700 border-b pb-2 ml-[10px]">Academic Information</h2>
                        <div class="detail-item bg-gray-50 p-4 rounded-lg">
                            <p class="text-xs text-blue-500">Major</p>
                            <p class="font-medium" id="major-detailed">{{$student->major}}</p>
                        </div>

                        <div class="detail-item bg-gray-50 p-4 rounded-lg">
                            <p class="text-xs text-blue-500">Current Year</p>
                            <p class="font-medium" id="major-detailed">{{$student->year}}</p>
                        </div>

                </div>

                <!-- Academic Information -->
                <div class="space-y-3">
                    <h2 class="text-lg font-bold text-gray-700 border-b pb-2 ml-[10px]">Content Details</h2>
                    <div class="detail-item bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-blue-500">Phone_No</p>
                        <p class="font-medium" id="major-detailed">0{{$student->ph_no}}</p>
                    </div>
                    <div class="detail-item bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-blue-500">Email </p>
                        <p class="font-medium" id="year-detailed">{{$student->email}}</p>
                    </div>
                </div>
                <!-- Meta Information -->
                <div class="md:col-span-2 space-y-3 pt-4 border-t">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 ml-[10px]">Account Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="detail-item bg-gray-50 p-4 rounded-lg">
                            <p class="text-xs text-blue-500">Account Created</p>
                            <p class="font-medium" id="created-at">{{$student->created_at}}</p>
                        </div>
                        <div class="detail-item bg-gray-50 p-4 rounded-lg">
                            <p class="text-xs text-blue-500">Last Updated</p>
                            <p class="font-medium" id="updated-at">{{$student->updated_at}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       

</x-navbar> 



<!-- Make sure you load QRCode.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    // User data - from Laravel
    const userData = {
        id: "{{ $student->roll_number }}",
        name: "{{ $student->name }}"
    };

    // Generate QR code
    const qrText = `User Information:\nUser ID: ${userData.id}\nName: ${userData.name}`;

    new QRCode(document.getElementById("qr-code"), {
        text: qrText,
        width: 180,
        height: 180,
        colorDark: "#1e293b",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.M
    });

    // Download QR code functionality
    document.getElementById("downloadBtn").addEventListener("click", function() {
        const canvas = document.querySelector("#qr-code canvas");
        if (canvas) {
            const link = document.createElement("a");
            link.download = `${userData.name}_${userData.id}_QR.png`;
            link.href = canvas.toDataURL("image/png");
            link.click();
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>


