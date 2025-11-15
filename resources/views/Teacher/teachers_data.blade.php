
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Custom animation for form elements */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Custom checkbox */
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #4a5568;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
        }

        .custom-checkbox:checked {
            background-color: #4299e1;
            border-color: #4299e1;
        }

        .custom-checkbox:checked::after {
            content: "✓";
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 14px;
        }

        .container {
            text-align: center;
            padding: 2rem;
        }

        .btn-trigger {
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, #4ade80 0%, #22d3ee 100%);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(74, 222, 128, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-trigger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 222, 128, 0.4);
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
            background-color: #f0fdf4;
            color: #16a34a;
            font-size: 30px;
            border: 2px solid #bbf7d0;
            animation: bounceIn 0.5s ease-out;
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
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
            background-color: #edf2f7;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 20px;
        }

        .alert-progress-bar {
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, #4ade80 0%, #22d3ee 100%);
            transition: width 3s linear;
        }

        .credits {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 0.8rem;
            color: #718096;
        }

    </style>

    <x-navbar type='teacher'>
        <div class="max-w-7xl mx-auto py-8">
            
            <!-- <div class="container mx-auto p-4 max-w-6xl"> -->
            <!-- Header Section -->
            <div class="mb-8" style="margin-top: 80px;display: flex;">
                <div class="flex justify-between items-center">
                    <div>

                        <h1 class="text-3xl font-bol" style="color: #7380ec;font-weight:700">Teacher Data</h1>

                        <p class="text-gray-600">Track and manage attendance records efficiently</p>
                    </div>

                </div>

                @if (session('success'))
                <div class="alert-box" id="alertBox">
                    <div class="alert-icon">✓</div>
                    <h3 class="alert-title">Success!</h3>
                    <p class="alert-message">Operation completed successfully. This alert will automatically close shortly.</p>
                    <div class="alert-progress">
                        <div class="alert-progress-bar" id="progressBar"></div>
                    </div>
                </div>
                @endif

                <!-- System Overview Cards -->

            </div>

            <!-- Main Content Section -->
            <main>
                <!-- Record Selection and Filter Section -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6 animate-fade-in" style="animation-delay: 0.3s;">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Record Type Selection -->
                        <div class="flex items-center space-x-4">
                            {{-- <h2 class="text-lg font-semibold text-gray-700">Entry Record:</h2> --}}
                            <div class="flex flex-wrap gap-2">


                                {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6"> --}}
                                <div class="bg-white rounded-lg shadow p-4 animate-fade-in" style="width:300px">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-gray-500 text-sm font-medium">Total Teacherss</p>
                                            <h3 class="text-2xl font-bold text-blue-700">{{$totalAmount}}</h3>
                                        </div>
                                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                            <i class="fas fa-users text-xl"></i>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>

                            </div>
                        </div>

                       
                    </div>

                    <!-- Search Filters -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <form action="/teachersDetail">
                                <label for="search-name" class="block text-sm font-medium text-gray-700 mb-1">Search by Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" id="search-name" name="name" value="{{ request('name') }}" placeholder="Enter name..." class="pl-10 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                        </div>

                        <div>
                            <label for="search-roll" class="block text-sm font-medium text-gray-700 mb-1">Search by Teacher ID</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card text-gray-400"></i>
                                </div>
                                <input type="text" value="{{ request('teacher_id') }}" name="teacher_id" id="search-roll" placeholder="Enter roll number..." class="pl-10 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>


                        <div>
                            <label for="search-time-from" class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                            <div class="relative">
                                <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-clock text-gray-400"></i>
                                </div> -->
                                <!-- <input type="time" id="search-time-from" class="pl-10 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"> -->
                                <div class="mb-4">
                                    <!-- <label for="year" class="block font-bold text-gray-700 mb-1">Year *</label> -->
                                    <select id="year" name="position" class="form-input w-full px-4 py-2 border border-white-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <option value="">Positions</option>
                                        {{-- <option value="First Year" {{ request('position') == 'First Year' ? 'selected' : '' }}>First Year</option> --}}
                                        <option value="Professor" {{request('position') == 'Professor' ? 'selected' : ''  }}>Professor</option>
                                        <option value="Associate Professor" {{request('position') == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                        <option value="Lecturer" {{request('position') == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="search-time-to" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <div class="relative">
                               
                                <div class="mb-4">
                                    <!-- <label for="year" class="block font-bold text-gray-700 mb-1">Year *</label> -->
                                    <select id="year" name="department" class="form-input w-full px-4 py-2 border border-white-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <option value="">Select Department</option>

                                        {{-- <option value="Computer_Science" {{ request('department') == 'Computer_Science' ? 'selected' : '' }}>Computer_Science</option> --}}

                                        <option value="Computer Science" {{request('department') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                                        <option value="Computer Technology" {{request('department') == 'Computer Technology' ? 'selected' : '' }}>Computer Technology</option>
                                        <option value="Department of Information Science" {{request('department') == 'Department of Information Science' ? 'selected' : '' }}>Department of Information Science</option>
                                        <option value="Department of Computer" {{request('department') == 'Department of Computer' ? 'selected' : '' }}>Department of Computer</option>
                                        <option value="Language Department (English)" {{request('department') == 'Language Department (English)' ? 'selected' : '' }}>Language Department (English)</option>
                                        <option value="Natural Science (Physics)" {{request('department') == 'Natural Science (Physics)' ? 'selected' : '' }}>Natural Science (Physics)</option>
                                        <option value="Department of Information Technology Supporting and Maintenance" {{request('department') == 'Department of Information Technology Supporting and Maintenance' ? 'selected' : '' }}>Department of Information Technology Supporting and Maintenance</option>
                                        <option value="Department of Computing" {{request('department') == 'Department of Computing' ? 'selected' : '' }}>Department of Computing</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mt-4 flex gap-4 justify-end">

                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200 flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <!-- <i class="fas fa-filter"></i> -->
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                                <path d="M440-160q-17 0-28.5-11.5T400-200v-240L168-736q-15-20-4.5-42t36.5-22h560q26 0 36.5 22t-4.5 42L560-440v240q0 17-11.5 28.5T520-160h-80Zm40-308 198-252H282l198 252Zm0 0Z" />
                            </svg>
                            <span style="color: aliceblue;">Apply Filters</span>
                        </button>
                        </form>
                        <a href="/teachersDetail">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200 flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <!-- <i class="fas fa-filter"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                                    <path d="M120-280v-80h560v80H120Zm80-160v-80h560v80H200Zm80-160v-80h560v80H280Z" /></svg>
                                <span style="color: aliceblue;">Clear</span>
                            </button>
                        </a>
                    </div>


                </div>

                <!-- Attendance Records Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden animate-fade-in" style="animation-delay: 0.4s;">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>


                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider " style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 45px;">
                                        Name & ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;">
                                        Position
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 45px;">
                                        Department
                                    </th>
                                    <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 75px;">
                                        Email
                                    </th> -->
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 45px;">
                                        Phone
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;">
                                        Actions
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;">
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Sample Record 1 -->

                                @foreach($teachers as $tea)



                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="/storage/{{ $tea->image }}" alt="" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $tea->name }}</div>
                                                <div class="text-sm text-gray-500" style="color: #4299e1;">{{ $tea->teacher_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900" style="padding-left: 15px;">{{ $tea->position }}</div> <!-- Assuming you have a student_id property -->
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">


                                        <div class="text-sm text-gray-900">{{ $tea->department }}</div> <!-- Assuming you have a major property -->
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap pl-10">
                                        <span class="text-sm text-gray-900">
                                            0{{ $tea->ph_no }} <!-- Assuming you have a phone_number property -->
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap pl-10">
                                        @if($tea->active === 1)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Act
                                        </span>
                                        @else

                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Out
                                        </span>


                                        @endif

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="padding-left: 35px; display:flex;gap:15px;margin-top:8px">
                                        <a href="/teachers/{{$tea->id}}/edit">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3">
                                                <i class="fas fa-edit" style="color: #148df8; font-size: 15px;"></i>
                                            </button>
                                        </a>
                                        <form action="/teachers/{{ $tea->id }}/delete" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash-alt" style="color: #fa2222; font-size: 15px;"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap pl-10">
                                        <span class="text-sm text-gray-900">
                                            <a href="/teachers/{{$tea->id}}/detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: 1px;" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                                    <path d="M240-400q-33 0-56.5-23.5T160-480q0-33 23.5-56.5T240-560q33 0 56.5 23.5T320-480q0 33-23.5 56.5T240-400Zm240 0q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm240 0q-33 0-56.5-23.5T640-480q0-33 23.5-56.5T720-560q33 0 56.5 23.5T800-480q0 33-23.5 56.5T720-400Z" />
                                                </svg>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach



                            </tbody>
                        </table>

                    </div>




                    <!-- Pagination Links -->
                   
                    <div class="row d-flex justify-content-md-center mt-4">
                        <div class="bg-white p-2 rounded shadow-sm">
                            {{ $teachers->links() }}
                        </div>
                    </div>

                </div>


            </main>

            <!-- Add New Record Button -->
            <div class="mt-6 flex justify-end">
                <button class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200 flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <!-- <i class="fas fa-plus-circle"></i> -->
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                    </svg>
                    <a href="/teacher_register"> <span style="color: #f1f1f1;">Add New Teacher</span></a>
                </button>
            </div>
        </div>
    </x-navbar>

    <script>
        const alertBox = document.getElementById('alertBox');
        const progressBar = document.getElementById('progressBar');

        // Activate alert
        alertBox.classList.add('active');

        // Reset and animate progress bar
        progressBar.style.transition = 'none';
        progressBar.style.width = '100%';
        void progressBar.offsetWidth; // Trigger reflow
        progressBar.style.transition = 'width 3s linear';
        progressBar.style.width = '0%';

        // Hide alert after 4 seconds
        setTimeout(() => {
            alertBox.classList.remove('active');
        }, 3000);

    </script>
