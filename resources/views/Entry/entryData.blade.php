<x-navbar type='entry'>

   
        <!-- form design -->
        <div class="max-w-7xl mx-auto py-8" style="padding-top: 70px">
            <!-- <div class="container mx-auto p-4 max-w-6xl"> -->
                <!-- Header Section -->
                <div class="mb-8" style="margin-top: 40px">
                    <div class="flex justify-between items-center">
                        <div>

                        <h1 class="text-3xl font-bol" style="color: #7380ec;font-weight:700">Daily Entry Record</h1>
                        

                            {{-- <p class="text-gray-600">Track and manage entry records efficiently</p> --}}
                        </div>
                      
                    </div>
                    
                    <!-- System Overview Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div class="bg-white rounded-lg shadow p-4 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Total number of Entry</p>
                                    <h3 class="text-2xl font-bold text-blue-700">{{$in + $out}}</h3>
                                </div>
                                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow p-4 animate-fade-in" style="animation-delay: 0.1s;">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Today's In</p>
                                    <h3 class="text-2xl font-bold text-green-600">{{$in}}</h3>
                                </div>
                                <div class="p-3 rounded-full bg-green-100 text-green-600">
                                    <i class="fas fa-clipboard-check text-xl"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow p-4 animate-fade-in" style="animation-delay: 0.2s;">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Today's Out</p>
                                    <h3 class="text-2xl font-bold text-orange-600">{{$out}}</h3>
                                </div>
                                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                                    <span class="material-icons-sharp">
                                        output
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Main Content Section -->
                <main>
                    <!-- Record Selection and Filter Section -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6 animate-fade-in" style="animation-delay: 0.3s;">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <!-- Record Type Selection -->
                            <div class="flex items-center space-x-4">
                                <h2 class="text-lg font-semibold text-gray-700">Filter by</h2>
                               
                            </div>
                            
                            <!-- Date Picker -->  
                            <form action="/entryData">
                            <div class="d-flex" style="display: flex; gap:50px">
                            <div class="flex items-center space-x-2">
                                <label for="date" class="text-sm font-medium text-gray-700">Select Date:</label>
                                <input type="date" value="{{ request('date') }}" name="date" id="date" class="border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex items-center space-x-2">
                                <label for="date" class="text-sm font-medium text-gray-700">State:</label>

                                <select id="state"  name="state"  class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="">Select State</option>
                                    <option value="in" {{ old('state', request()->input('state')) === 'in' ? 'selected' : '' }}>Enter</option>
                                    <option value="out" {{ old('state', request()->input('state')) === 'out' ? 'selected' : '' }} >Out</option>
                                    {{-- <option value="Third" {{$type == 'update' ? $teacher->position == 'Third' ? 'selected' : '' :''}}>Third Year</option>
                                    <option value="Fourth" {{$type == 'update' ? $teacher->position == 'Fourth' ? 'selected' : '' :''}}>Fourth Year</option>
                                    <option value="Final" {{$type == 'update' ? $teacher->position == 'Final' ? 'selected' : '' :''}}>Final Year</option> --}}
                                </select>
                            </div>
                        </div>
                        </div>
                        
                        <!-- Search Filters -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4" style="padding-left:50px;gap:70px;">
                            <div>
                          

                                <label for="search-name" class="block text-sm font-medium text-gray-700 mb-1">Search by Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" value="{{ request('name') }}" name="name" id="search-name" placeholder="Enter name..." class="pl-10 w-[200px] border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                            
                            <div>
                                <label for="search-roll" class="block text-sm font-medium text-gray-700 mb-1">Search by ID </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-id-card text-gray-400"></i>
                                    </div>
                                    <input type="text" value="{{ request('user_id') }}" name="user_id" id="search-roll" placeholder="Enter roll number..." class="pl-10 w-[200px] border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                            
                           
                            
                            <div>
                                <label for="search-time-from" class="block text-sm font-medium text-gray-700 mb-1">From Time</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-clock text-gray-400"></i>
                                    </div>
                                    <input type="time" value="{{ request('S_time') }}" name="S_time" id="search-time-from" class="pl-10 w-[200px] border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                            
                            <div>
                                <label for="search-time-to" class="block text-sm font-medium text-gray-700 mb-1">To Time</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-clock text-gray-400"></i>
                                    </div>
                                    <input type="time" value="{{ request('E_time') }}"  name="E_time"  id="search-time-to" class="pl-10 w-[200px] border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex justify-end" style="gap: 20px">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200 flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <!-- <i class="fas fa-filter"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M440-160q-17 0-28.5-11.5T400-200v-240L168-736q-15-20-4.5-42t36.5-22h560q26 0 36.5 22t-4.5 42L560-440v240q0 17-11.5 28.5T520-160h-80Zm40-308 198-252H282l198 252Zm0 0Z"/></svg>
    
                                <span style="color: aliceblue;">Apply Filters</span>
                            </button>
                        </form>
                        <a href="/entryData">
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
                    <div class="bg-white rounded-lg shadow-md overflow-hidden animate-fade-in" style="animation-delay: 0.4s; ">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider " style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 75px;">
                                            Name 
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 40px;">
                                           Year / Rank
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 75px;">
                                            Time
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 75px;">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"style="color: #4299e1;font-size: 15px;font-weight: 500;padding-left: 45px;">
                                            Phone
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"style="color: #4299e1;font-size: 15px;font-weight: 500;">
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
                                            <div class="text-sm text-gray-900">{{$data->time->format('Y-m-d h:i A')}}</div>
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
                                            <span class="text-sm text-gray-900">
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
                            <div class="row d-flex justify-content-md-center mt-4">{{$entryData->links()}}</div>
                        </div>
                        
                       
                    </div>
                    
                </main>
        </div>
</x-navbar>