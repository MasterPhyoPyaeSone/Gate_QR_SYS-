
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

    </style>

    <x-navbar type='staff'>
        <div class="max-w-7xl mx-auto py-8">
            <!-- <div class="container mx-auto p-4 max-w-6xl"> -->
            <!-- Header Section -->
            <div class="mb-8" style="margin-top: 80px;display: flex;" >
                <div class="flex justify-between items-center">
                    <div>

                        <h1 class="text-3xl font-bol" style="color: #7380ec;font-weight:700">Staff Data</h1>

                        <p class="text-gray-600">Track and manage attendance records efficiently</p>
                    </div>

                </div>

               

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
                                            <p class="text-gray-500 text-sm font-medium">Total Staff</p>
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
                            <form action="/staffsDetail">
                                <label for="search-name" class="block text-sm font-medium text-gray-700 mb-1">Search by Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" id="search-name" name="name" value="{{ request('name') }}" placeholder="Enter name..." class="pl-10 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                        </div>

                        <div>
                            <label for="search-roll" class="block text-sm font-medium text-gray-700 mb-1">Search by Staff ID</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card text-gray-400"></i>
                                </div>
                                <input type="text" value="{{ request('staff_id') }}" name="staff_id" id="search-roll" placeholder="Enter roll number..." class="pl-10 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                                        {{-- <option value="First" {{ request('position') == 'First' ? 'selected' : '' }}>First Year</option> --}}
                                        <option value="General Staff" {{request('position') == 'General Staff' ? 'selected' : '' }}>General Staff </option>
                                        <option value="Office Staff" {{request('position') == 'Office Staff' ? 'selected' : '' }}>Office Staff </option>
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
                        <a href="/staffsDetail">
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

                                @foreach($staffs as $staf)



                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="/storage/{{ $staf->image }}" alt="" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $staf->name }}</div>
                                                <div class="text-sm text-gray-500" style="color: #4299e1;">{{ $staf->staff_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900" style="padding-left: 15px;">{{ $staf->position }}</div> <!-- Assuming you have a student_id property -->
                                    </td>
                                 
                                    <td class="px-6 py-4 whitespace-nowrap pl-10">
                                        <span class="text-sm text-gray-900">
                                            0{{ $staf->ph_no }} <!-- Assuming you have a phone_number property -->
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap pl-10">
                                        @if($staf->active === 1)
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
                                        <a href="/staffs/{{$staf->id}}/edit">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3">
                                                <i class="fas fa-edit" style="color: #148df8; font-size: 15px;"></i>
                                            </button>
                                        </a>
                                        <form action="/staffs/{{ $staf->id }}/delete" method="POST">
                                            @method('delete')
                                            @csrf
                                        <button class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash-alt" style="color: #fa2222; font-size: 15px;"></i>
                                        </button>
                                       </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap pl-10">
                                        <span class="text-sm text-gray-900">
                                            <a href="/staffs/{{$staf->id}}/detail">
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
                            {{ $staffs->links() }}
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
                    <a href="/staff_register"> <span style="color: #f1f1f1;">Add New Staff</span></a>
                </button>
            </div>
        </div>
    </x-navbar>
