
    <link rel="stylesheet" href="/static/student_regForm.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <style>
        .container {
            text-align: center;
            padding: 2rem;
        }

        .btn-trigger {
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-trigger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .btn-trigger:active {
            transform: translateY(0);
        }

        .btn-trigger::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .btn-trigger:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 1;
            }

            20% {
                transform: scale(25, 25);
                opacity: 0;
            }

            100% {
                opacity: 0;
                transform: scale(40, 40);
            }
        }

        .alert-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.8);
            background-color: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 1000;
            max-width: 90%;
            width: 350px;
        }

        .alert-box.active {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        .alert-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background-color: #fef2f2;
            color: #dc2626;
            font-size: 30px;
            font-weight: bold;
            border: 2px solid #fecaca;
            animation: pulse 0.5s ease-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            70% {
                transform: scale(1.1);
                opacity: 1;
            }

            100% {
                transform: scale(1);
            }
        }

        .alert-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #2d3748;
        }

        .alert-message {
            font-size: 0.9rem;
            color: #4a5568;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .alert-progress {
            height: 4px;
            background-color: #fee2e2;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 20px;
        }

        .alert-progress-bar {
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, #f87171 0%, #ef4444 100%);
            transition: width 5s linear;
        }

        .credits {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 0.8rem;
            color: #718096;
        }

    </style>


    @props(['type','teacher'])  
    <x-navbar type='teacher'>

        <div class="max-w-4xl mx-auto py-8">
           

            {{-- @if (session('error'))
            <div class="alert-box" id="alertBox">
                <div class="alert-icon">✕</div>
                <h3 class="alert-title">Error!</h3>
                <p class="alert-message">{{ session('error') }}</p>
                <div class="alert-progress">
                    <div class="alert-progress-bar" id="progressBar"></div>
                </div>
            </div>
            @endif --}}
            @if (session()->has('error'))
            <x-fail />
            @endif
            @if (session()->has('success'))
            <x-success />
            @endif

            <form action="{{$type==='create' ? '/teacher_register' : '/teachers/'.$teacher->id.'/update'}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-container p-6 md:p-10">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Left Column - Photo Upload -->
                        <div class="w-full md:w-1/3">
                            <div class="photo-upload rounded-lg p-6 flex flex-col items-center justify-center h-full">
                                <div class="mb-4 w-40 h-40 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                                    {{-- <img id="preview-img" src="{{ $type == 'update' ?  '/storage/'.$student->image : 'https://media.istockphoto.com/id/1208175274/vector/avatar-vector-icon-simple-element-illustrationavatar-vector-icon-material-concept-vector.jpg?s=612x612&w=0&k=20&c=t4aK_TKnYaGQcPAC5Zyh46qqAtuoPcb-mjtQax3_9Xc='}}" alt="Student profile photo placeholder" class="w-full h-full object-cover"> --}}
                                    <img id="preview-img" src="{{ $type == 'update' && $teacher->image ? asset('storage/'.$teacher->image) : 'https://media.istockphoto.com/id/1208175274/vector/avatar-vector-icon-simple-element-illustrationavatar-vector-icon-material-concept-vector.jpg?s=612x612&w=0&k=20&c=t4aK_TKnYaGQcPAC5Zyh46qqAtuoPcb-mjtQax3_9Xc='}}">
                                </div>
                                <input type="file" name="image" id="student-photo" accept="image/*" class="hidden">
                                <button id="upload-btn" class="px-4 py-2 bg-indigo-100 text-indigo-600 rounded-md font-bold">Upload Photo</button>
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG (Max 2MB)</p>
                            </div>
                        </div>

                        <!-- Right Column - Form Fields -->
                        <div class="w-full md:w-2/3">

                            <h1 class="text-3xl font-bold  mb-1  text-gradient-to-r from-indigo-500 to-purple-600">{{$type== 'update' ? "Teacher Information" : "Teacher Registration"}}</h1>
                            <p class="text-gray-600 mb-6">Please fill out all the required information</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Roll Number -->
                                <div class="mb-4">
                                    <lable for="name" class="block font-bold text-gray-700 mb-1">Teacher ID *</label>
                                        <input type="text" value="{{$type == 'update' ? $teacher->teacher_id : ''}}" name="teacher_id" id="roll-number" required class="form-input font-light w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <!-- Name -->
                                <div class="mb-4">
                                    <label for="name" class="block font-bold text-gray-700 mb-1">Full Name *</label>
                                    <input type="text" value="{{ $type == 'update' ? $teacher->name : ''}}" name="name" id="name" required class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>

                                <!-- Year -->
                                <div class="mb-4">
                                    <label for="year" class="block font-bold text-gray-700 mb-1">Position *</label>
                                    <select id="year" name="position" required class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <option value="">Select Position</option>
                                        <option value="Professor" {{$type == 'update' ? $teacher->position == 'Professor' ? 'selected' : '' : '' }}>Professor</option>
                                        <option value="Associate Professor" {{$type == 'update' ? $teacher->position == 'Associate Professor' ? 'selected' : '' :''}}>Associate Professor</option>
                                        <option value="Lecturer" {{$type == 'update' ? $teacher->position == 'Lecturer' ? 'selected' : '' :''}}>Lecturer</option>
                                        {{-- <option value="Fourth" {{$type == 'update' ? $teacher->position == 'Fourth' ? 'selected' : '' :''}}>Fourth Year</option>
                                        <option value="Final" {{$type == 'update' ? $teacher->position == 'Final' ? 'selected' : '' :''}}>Final Year</option> --}}
                                    </select>
                                </div>
                                <!-- Major -->
                                <div class="mb-4">
                                    <label for="major" class="block font-bold text-gray-700 mb-1">Department *</label>
                                    <select id="major" name="department" required class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <option value="">Select Department</option>

                                        <option value="Computer Science" {{$type == 'update' ? $teacher->department == 'Computer Science' ? 'selected' : '' :''}}>Computer Science</option>
                                        <option value="Computer Technology" {{$type == 'update' ? $teacher->department == 'Computer Technology' ? 'selected' : '' :''}}>Computer Technology</option>
                                        <option value="Department of Information Science" {{$type == 'update' ? $teacher->department == 'Department of Information Science' ? 'selected' : '' :''}}>Department of Information Science</option>
                                        <option value="Department of Computer" {{$type == 'update' ? $teacher->department == 'Department of Computer' ? 'selected' : '' :''}}>Department of Computer</option>
                                        <option value="Language Department (English)" {{$type == 'update' ? $teacher->department == 'Language Department (English)' ? 'selected' : '' :''}}>Language Department (English)</option>                                        
                                        <option value="Natural Science (Physics)" {{$type == 'update' ? $teacher->department == 'Natural Science (Physics)' ? 'selected' : '' :''}}>Natural Science (Physics)</option>
                                        <option value="Department of Information Technology Supporting and Maintenance" {{$type == 'update' ? $teacher->department == 'Department of Information Technology Supporting and Maintenance' ? 'selected' : '' :''}}>Department of Information Technology Supporting and Maintenance</option>
                                        <option value="Department of Computing" {{$type == 'update' ? $teacher->department == 'Department of Computing' ? 'selected' : '' :''}}>Department of Computing</option>


                                    </select>
                                </div>
                            </div>
                            <!-- Gender -->
                            <div class="mb-4 mt-6">
                                <label class="block font-bold text-gray-700 mb-1">Gender *</label>
                                <div class="flex space-x-12">
                                    <label class="inline-flex items-center">
                                        <input type="radio" {{$type == 'update' ? $teacher->gender == 'male' ? 'checked' : '' :''}} name="gender" value="male" required class="form-radio h-4 w-4 text-indigo-600">
                                        <span class="ml-2 text-gray-700">Male</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" {{$type == 'update' ? $teacher->gender == 'female' ? 'checked' : '' :''}} name="gender" value="female" class="form-radio h-4 w-4 text-indigo-600">
                                        <span class="ml-2 text-gray-700">Female</span>
                                    </label>
                                    {{-- <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="other" class="form-radio h-4 w-4 text-indigo-600">
                            <span class="ml-2 text-gray-700">Other</span>
                        </label> --}}
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-10">
                                <div class="mb-4">
                                    <label for="phone" class="block font-bold text-gray-700 mb-1">Phone Number *</label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">+95</span>
                                        <input type="tel" value="{{$type == 'update' ? $teacher->ph_no :''}}" name="ph_no" id="phone" required class="form-input flex-1 rounded-none rounded-r-md px-4 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" pattern="[0-9]{10}">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="block font-bold text-gray-700 mb-1">Email *</label>
                                    <input type="email" value="{{$type == 'update' ? $teacher->email : ''}}" name="email" id="email" required class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>

                            </div>

                            <!-- Submit Button -->
                            <div class="mt-8">

                                @if ($type == 'create')
                                <button type="submit" class="submit-btn w-full text-white font-bold py-3 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Register Teacher</button>
                                @else
                                <button type="submit" class="submit-btn w-full text-white font-bold py-3 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Update Teacher</button>
                                @endif


                            </div>
            </form>
        </div>
        </div>
        </div>
        </div>




        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Photo upload functionality
                const uploadBtn = document.getElementById('upload-btn');
                const photoInput = document.getElementById('student-photo');
                const previewImg = document.getElementById('preview-img');

                uploadBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    photoInput.click();
                });

                photoInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            alert('File size exceeds 2MB limit');
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(event) {
                            previewImg.src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Form validation
                const form = document.querySelector('.form-container');
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Validate all required fields
                    const requiredFields = [
                        'roll-number'
                        , 'name'
                        , 'year'
                        , 'major'
                        , 'email'
                        , 'phone'
                    ];

                    let isValid = true;

                    requiredFields.forEach(fieldId => {
                        const field = document.getElementById(fieldId);
                        if (!field.value) {
                            field.classList.add('border-red-500');
                            isValid = false;
                        } else {
                            field.classList.remove('border-red-500');
                        }
                    });

                    // Check gender selection
                    const genderSelected = document.querySelector('input[name="gender"]:checked');
                    if (!genderSelected) {
                        alert('Please select gender');
                        isValid = false;
                    }

                    if (isValid) {
                        // Here you would normally submit the form data
                        alert('Registration successful!');
                        // form.reset();
                        // previewImg.src = 'https://placehold.co/200x200';
                    }
                });
            });

        </script>
    </x-navbar>

