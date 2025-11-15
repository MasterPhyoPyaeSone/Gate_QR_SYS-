<x-navbar type='home'>
    @if (session()->has('success'))
    <x-loginsuccess />
    @endif
    <div class="max-w-7xl mx-auto" style="display: flex;padding-top: 90px;justify-content: center;">

        <div class="max-w-7xl " style="display: flex;margin:0px">
            <main style="width: 500px;">

                <h1 class="text-3xl font-bol" style="color: #7380ec;font-weight:700">GatePass QR System</h1>


                <div class="subjects" style="">

                    <!-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6"> -->
                    <!-- Bar Chart -->
                    <div class="bg-white shadow rounded-lg p-6" style="width: 300px">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Scans This Week</h2>
                        <div class="chart-container">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>

                    <!-- Line Chart -->
                    <div class="bg-white shadow rounded-lg p-6" style="margin-left: 20px;width: 300px">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Monthly Scan Trend</h2>
                        <div class="chart-container">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>

                </div>


                <!-- circle chart  -->

                <div class="bg-white shadow rounded-lg" style="width: 650px; margin-top: 20px; padding: 20px;">

                    <div class="" style="display: flex; align-items: center;justify-content: space-between;">
                        <div class="" style="width: 400px; margin-left:-25px">
                            <canvas id="studentChart" style="font-size: 40px;"></canvas>

                            <div class="total-students">
                                Total Numbers: <strong>1,240</strong>
                            </div>

                            <div class="chart-legend"></div>
                        </div>

                        <div class="chart-details" style="width: 300px; margin-right: 30px;margin-left:20px;margin-top:-20px">
                            <h3>Program Details:</h3>
                            <div class="detail-item">
                                <span class="detail-label">Students:</span>
                                <span class="detail-value">650 students (57%)</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Teachers:</span>
                                <span class="detail-value">280 students (22.6%)</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Staff:</span>
                                <span class="detail-value">210 students (16.9%)</span>
                            </div>

                        </div>
                    </div>
                </div>



                <!-- Attendance Records Table -->


            </main>


            <div class="right" style=" padding-left:170px">


                <!-- calendar -->
                <div class="mx-auto px-4 py-8 flex bg-white items-center justify-center shadow rounded-lg" style=" width: 450px; height: 94.5%; margin-top: 35px;">
                    <!-- Header -->
                    <!-- <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Calendar Dashboard</h1>
                    <div class="mt-4 md:mt-0">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Create Event
                        </button>
                    </div>
                </div>
         -->
                    <div class=" mx-auto px-4 py-8" style="margin-top: -50px;">
                        <!-- Header -->
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <!-- <h1 class="text-3xl font-bold text-gray-800">Calendar Dashboard</h1>
                <div class="mt-4 md:mt-0">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Create Event
                    </button>
                </div> -->
                        </div>

                        <!-- Calendar Navigation -->
                        <div class="flex justify-between items-center mb-6 bg-white rounded-lg shadow p-4">
                            <button id="prev-month" class="p-2 text-gray-600 hover:text-gray-900 rounded-full hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <h2 id="month-year" class="text-xl font-semibold text-gray-800">Month Year</h2>
                            <button id="next-month" class="p-2 text-gray-600 hover:text-gray-900 rounded-full hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <!-- Calendar Grid -->
                        <div id="calendar" class="bg-white rounded-lg shadow-lg overflow-hidden" style="height: 400px;">
                            <!-- Weekdays Header -->
                            <div class="grid grid-cols-7 border-b">
                                <div class="py-3 text-center font-medium text-gray-500">Sun</div>
                                <div class="py-3 text-center font-medium text-gray-500">Mon</div>
                                <div class="py-3 text-center font-medium text-gray-500">Tue</div>
                                <div class="py-3 text-center font-medium text-gray-500">Wed</div>
                                <div class="py-3 text-center font-medium text-gray-500">Thu</div>
                                <div class="py-3 text-center font-medium text-gray-500">Fri</div>
                                <div class="py-3 text-center font-medium text-gray-500">Sat</div>
                            </div>

                            <!-- Days Grid - Will be populated by JavaScript -->
                            <div id="calendar-days" class="grid grid-cols-7 auto-rows-fr gap-0.5 p-1"></div>
                        </div>

                        <!-- Selected Day Info -->
                        <div id="selected-day-info" class="mt-6 bg-white rounded-lg shadow p-4 hidden">
                            <h3 class="text-lg font-semibold text-gray-800">Notes for <span id="selected-date"></span></h3>
                            <textarea id="note-input" class="w-full p-2 border border-gray-300 rounded" rows="3" placeholder="Write your note here..."></textarea>
                            <button id="add-note" class="mt-2 px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Add Note
                            </button>
                            <div id="day-notes" class="mt-2 space-y-2"></div>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto py-8">
        <h1 class="text-3xl font-bol" style="color: #7380ec;font-weight:700">Recently Entry Records</h1>

        <main>

            <!-- Attendance Records Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden animate-fade-in" style="animation-delay: 0.4s; ">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider " style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 75px;">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 40px;">
                                    Year
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 75px;">
                                    Time
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 75px;">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 45px;">
                                    Phone
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="color: #4299e1;font-size: 15px;font-weight: 500;">
                                    Status
                                </th>
                                <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"style="color: #4299e1;font-size: 15px;font-weight: 500;">
                                Actions
                            </th> -->
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Sample Record 1 -->

                            @foreach ( $entryData as $data)


                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img src="storage/{{ $data->student?->image ?? $data->teacher?->image ?? $data->staff?->image ?? '' }}" class="h-10 w-10 rounded-full">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{$data->name}}</div>
                                            <div class="text-sm text-gray-500" style="color: #4299e1;">{{$data->student?->roll_number ?? $data->teacher?->teacher_id ?? $data->staff?->staff_id}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900" style="padding-left: 15px;">
                                        {{ $data->student?->year ?? $data->teacher?->position ??  $data->staff?->position }}

                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900">{{$data->time}}</div>
                                    {{-- <div class="text-sm text-gray-500">May 15, 2023</div> --}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap pl-10">
                                    <span class="text-sm text-gray-900">
                                        {{-- {{ $data->student?->email }} --}}
                                        {{-- {{ $data->student?->email ?? $data->teacher?->email ?? $data->staff?->email ?? 'No'  }} --}}
                                        {{ $data->student?->email ?? $data->teacher?->email ?? $data->staff?->email ?? 'No' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap pl-10">
                                    <span class="text-sm">
                                        0{{ $data->student?->ph_no ?? $data->teacher?->ph_no ?? $data->staff?->ph_no ?? '' }}


                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap pl-10">
                                    @if ($data->state === 'in')
                                    <span class="px-2 inline-flex text-xs  leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $data->state }}

                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs  leading-5 font-semibold rounded-full bg-red-500 text-white">
                                        {{ $data->state }}

                                    </span>
                                    @endif

                                </td>

                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    {{-- <div class="row d-flex justify-content-md-center mt-4">{{$entryData->links()}}
                </div> --}}


                <div class="row d-flex justify-content-md-center mt-4">
                    <div class="bg-white p-2 rounded shadow-sm">
                        {{ $entryData->links() }}
                    </div>
                </div>




            </div>


          </div>

        </main>
    </div>
</x-navbar>
