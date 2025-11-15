<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GatePass QR System</title>
    <link rel="shortcut icon" href="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/f37813f7-bd0d-4a58-acaf-a35fa7de9b69.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="/static/style.css">
    <link rel="stylesheet" href="/static/pagination.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/html5-qrcode@2.0.11/dist/html5-qrcode.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- <link rel="stylesheet" href="{{ asset('/static/style.css') }}"> -->


    <style>
        #calendar {
            height: 75vh;
        }

        @media (max-height: 800px) {
            #calendar {
                height: 60vh;
            }
        }

        .chart-legend {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin: 0 15px 10px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            margin-right: 8px;
        }

        .legend-text {
            font-size: 14px;
            color: #555;
        }

        .chart-details {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .detail-item {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }

        .detail-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .detail-value {
            color: #7f8c8d;
        }

        .total-students {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            padding: 10px;
            background-color: #7380ec;
            border-radius: 8px;
            color: aliceblue;
            width: 300px;
            margin-left: 40px;
        }

        @media (max-width: 600px) {
            .chart-container {
                padding: 15px;
            }

            #studentChart {
                max-width: 300px;
            }

            .chart-header h2 {
                font-size: 20px;
            }
        }

        #studentChart {
            margin: 0 auto;
            max-width: 200px;
        }
    </style>
</head>

<body>

  @props(['type'])

    <header>
        <div class="logo" style="display: flex;align-items: center;font-size: 22px;font-weight: 600;">
            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/f37813f7-bd0d-4a58-acaf-a35fa7de9b69.png"
                alt="Company logo with QR code pattern in blue and white colors" class="h-10 w-10 rounded-lg">
            <div class="main"><h1 class="primary">QR<span class="danger">SM</span></h1></div>
        </div>
        <div class="navbar">
            <a href="/" class="{{ $type === 'home' ? 'active' : ''}}">
                <span class="material-icons-sharp">home</span>
                <h3>Home</h3>
            </a>
            <!-- <a href="timetable.html" onclick="timeTableAll()">
                <span class="material-icons-sharp">today</span>
                <h3>Time Table</h3>
            </a>  -->
            <a href="/entryData" class="{{ $type === 'entry' ? 'active' : '' }}">
                <span class="material-icons-sharp">grid_view</span>
                <h3>EntryRecord</h3>
            </a>
            <a href="/studentsDetail" class="{{$type === 'student' ? 'active' : ''}}">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z"/></svg> -->
                <span class="material-icons-sharp">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z"/></svg> -->
                    school
                </span>
                <h3>Student</h3>
            </a>
            <a href="/teachersDetail" class="{{ $type === 'teacher' ? 'active' : '' }}">

                <span class="material-icons-sharp">
                    co_present
                </span>
                <h3>Teacher</h3>
            </a>
            <a href="/staffsDetail" class="{{$type === 'staff' ? 'active' : ''}}">

                <span class="material-icons-sharp" style="font-size: 24px;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                        fill="#000000">
                        <path
                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17-62.5t47-43.5q60-30 124.5-46T480-440q67 0 131.5 16T736-378q30 15 47 43.5t17 62.5v112H160Zm320-400q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm160 228v92h80v-32q0-11-5-20t-15-14q-14-8-29.5-14.5T640-332Zm-240-21v53h160v-53q-20-4-40-5.5t-40-1.5q-20 0-40 1.5t-40 5.5ZM240-240h80v-92q-15 5-30.5 11.5T260-306q-10 5-15 14t-5 20v32Zm400 0H320h320ZM480-640Z" />
                    </svg>
                </span>
                <h3>Staff</h3>
            </a>
            {{-- <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M200-200v-560 179-19 400Zm80-240h221q2-22 10-42t20-38H280v80Zm0 160h157q17-20 39-32.5t46-20.5q-4-6-7-13t-5-14H280v80Zm0-320h400v-80H280v80Zm-80 480q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v258q-14-26-34-46t-46-33v-179H200v560h202q-1 6-1.5 12t-.5 12v56H200Zm480-200q-42 0-71-29t-29-71q0-42 29-71t71-29q42 0 71 29t29 71q0 42-29 71t-71 29ZM480-120v-56q0-24 12.5-44.5T528-250q36-15 74.5-22.5T680-280q39 0 77.5 7.5T832-250q23 9 35.5 29.5T880-176v56H480Z"/>
                    </svg> --}}
            {{-- <a href="/guestsDetail" class="{{$type === 'guest' ? 'active' : ''}}
                   
                <span class="material-icons-sharp" style="font-size: 24px;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M200-200v-560 179-19 400Zm80-240h221q2-22 10-42t20-38H280v80Zm0 160h157q17-20 39-32.5t46-20.5q-4-6-7-13t-5-14H280v80Zm0-320h400v-80H280v80Zm-80 480q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v258q-14-26-34-46t-46-33v-179H200v560h202q-1 6-1.5 12t-.5 12v56H200Zm480-200q-42 0-71-29t-29-71q0-42 29-71t71-29q42 0 71 29t29 71q0 42-29 71t-71 29ZM480-120v-56q0-24 12.5-44.5T528-250q36-15 74.5-22.5T680-280q39 0 77.5 7.5T832-250q23 9 35.5 29.5T880-176v56H480Z"/>
                    </svg>
                </span>
                <h3>Guest</h3>
            </a> --}}
            <a href="/guestsDetail" class="{{$type === 'guest' ? 'active' : ''}}">

                <span class="material-icons-sharp" style="font-size: 24px;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M200-200v-560 179-19 400Zm80-240h221q2-22 10-42t20-38H280v80Zm0 160h157q17-20 39-32.5t46-20.5q-4-6-7-13t-5-14H280v80Zm0-320h400v-80H280v80Zm-80 480q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v258q-14-26-34-46t-46-33v-179H200v560h202q-1 6-1.5 12t-.5 12v56H200Zm480-200q-42 0-71-29t-29-71q0-42 29-71t71-29q42 0 71 29t29 71q0 42-29 71t-71 29ZM480-120v-56q0-24 12.5-44.5T528-250q36-15 74.5-22.5T680-280q39 0 77.5 7.5T832-250q23 9 35.5 29.5T880-176v56H480Z"/>
                    </svg> 
                </span>
                <h3>Guest</h3>
            </a>
            
        </div>
        <!-- <div id="profile-btn" style="display: none;">
        </div> -->
        <!-- <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
            
        </div> -->
        {{-- <div class="">
                <a href="/logout">
                    <span class="material-icons-sharp" style="font-size: 30px; margin-top: 5px;">
                        account_circle
                    </span>
                    <!-- <h3>Profile</h3> -->
                </a>
            </div> --}}
    </header>

    {{$slot}}

    <script>
        // Initialize charts
        document.addEventListener('DOMContentLoaded', function () {
            // Bar Chart
            const barCtx = document.getElementById('barChart').getContext('2d');
            const barChart = new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Scans',
                        data: [12, 19, 8, 15, 10, 5, 7],
                        backgroundColor: 'rgba(79, 70, 229, 0.6)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Line Chart
            const lineCtx = document.getElementById('lineChart').getContext('2d');
            const lineChart = new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Monthly Scans',
                        data: [120, 150, 180, 165, 190, 210, 230, 245, 220, 200, 170, 140],
                        fill: false,
                        backgroundColor: 'rgba(79, 70, 229, 0.2)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        tension: 0.4,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // QR Scanner Logic
            const toggleBtn = document.getElementById('scanner-toggle');
            const scannerView = document.getElementById('scanner-view');
            const scanResult = document.getElementById('scan-result');
            const resultData = document.getElementById('result-data');
            let scannerActive = false;
            let html5QrCode;

            toggleBtn.addEventListener('click', function () {
                if (!scannerActive) {
                    // Start scanner
                    scannerView.innerHTML = '';
                    html5QrCode = new Html5Qrcode("scanner-view");
                    const config = { fps: 10, qrbox: { width: 250, height: 250 } };

                    html5QrCode.start(
                        { facingMode: "environment" },
                        config,
                        (decodedText, decodedResult) => {
                            // Handle scan result
                            resultData.textContent = decodedText;
                            scanResult.classList.remove('hidden');

                            // Stop scanner after successful scan
                            html5QrCode.stop().then(() => {
                                scannerActive = false;
                                toggleBtn.textContent = 'Start Scanner';
                            }).catch(err => {
                                console.error("Error stopping scanner:", err);
                            });
                        },
                        (errorMessage) => {
                            // Parse error, ignore
                        }
                    ).catch(err => {
                        console.error("Error starting scanner:", err);
                    });

                    scannerActive = true;
                    toggleBtn.textContent = 'Stop Scanner';
                    scanResult.classList.add('hidden');
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
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentDate = new Date();
            let notes = {}; // Object to store notes for each date

            // Update calendar to show current month
            updateCalendar(currentDate);

            // Navigation buttons
            document.getElementById('prev-month').addEventListener('click', function () {
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateCalendar(currentDate);
            });

            document.getElementById('next-month').addEventListener('click', function () {
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateCalendar(currentDate);
            });

            function updateCalendar(date) {
                // Update month-year display
                const monthYearElement = document.getElementById('month-year');
                const monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"];
                monthYearElement.textContent = `${monthNames[date.getMonth()]} ${date.getFullYear()}`;

                // Get first day of month and total days
                const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                const daysInMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

                // Get starting day (0-6, Sunday-Saturday)
                const startDay = firstDay.getDay();

                // Clear calendar
                const calendarDays = document.getElementById('calendar-days');
                calendarDays.innerHTML = '';

                // Fill in days from previous month
                for (let i = startDay - 1; i >= 0; i--) {
                    const dayElement = createDayElement('', 'text-gray-400');
                    calendarDays.appendChild(dayElement);
                }

                // Fill in current month days
                const today = new Date();
                for (let i = 1; i <= daysInMonth; i++) {
                    const isToday = i === today.getDate() &&
                        date.getMonth() === today.getMonth() &&
                        date.getFullYear() === today.getFullYear();

                    let dayClass = 'hover:bg-gray-100 cursor-pointer';
                    if (isToday) {
                        dayClass += ' bg-blue-100 border-2 border-blue-500';
                    }

                    const dayElement = createDayElement(i, dayClass, isToday);
                    dayElement.addEventListener('click', function () {
                        showDayNotes(date.getFullYear(), date.getMonth(), i);
                    });
                    calendarDays.appendChild(dayElement);
                }

                // Fill in days from next month
                const totalCells = Math.ceil((daysInMonth + startDay) / 7) * 7;
                const nextMonthDays = totalCells - (daysInMonth + startDay);

                for (let i = 1; i <= nextMonthDays; i++) {
                    const dayElement = createDayElement('', 'text-gray-400');
                    calendarDays.appendChild(dayElement);
                }
            }

            function createDayElement(day, additionalClasses, isToday = false) {
                const dayElement = document.createElement('div');
                dayElement.className = `p-4 min-h-16 flex flex-col ${additionalClasses}`;

                // Day number
                const dayNumber = document.createElement('span');
                dayNumber.className = 'text-center font-medium';
                dayNumber.textContent = day || '';

                dayElement.appendChild(dayNumber);

                return dayElement;
            }

            function showDayNotes(year, month, day) {
                const selectedDateElement = document.getElementById('selected-date');
                const date = new Date(year, month, day);
                selectedDateElement.textContent = date.toLocaleDateString('en-US', {
                    weekday: 'long',
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                });

                // const dayNotesElement = document.getElementById('day-notes');
                // dayNotesElement.innerHTML = '';

                // // Show existing notes for the selected date
                // const dateKey = date.toISOString().split('T')[0]; // Format: YYYY-MM-DD
                // if (notes[dateKey]) {
                //     notes[dateKey].forEach(note => {
                //         addNoteToDay(note);
                //     });
                // }

                // // Show the note input area
                // document.getElementById('note-input').value = ''; // Clear the input
                // document.getElementById('selected-day-info').classList.remove('hidden');

                // // Add event listener for the "Add Note" button
                // document.getElementById('add-note').onclick = function() {
                //     const noteText = document.getElementById('note-input').value;
                //     if (noteText) {
                //         if (!notes[dateKey]) {
                //             notes[dateKey] = [];
                //         }
                //         notes[dateKey].push(noteText);
                //         addNoteToDay(noteText);
                //         document.getElementById('note-input').value = ''; // Clear the input
                //     }
                // };
            }

            function addNoteToDay(note) {
                const noteElement = document.createElement('div');
                noteElement.className = 'p-2 bg-gray-100 text-gray-800 rounded';
                noteElement.textContent = note;
                document.getElementById('day-notes').appendChild(noteElement);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart data
            const data = {
                labels: [
                    'Students',
                    'Teachers',
                    'Satff',

                ],
                datasets: [{
                    data: [650, 180, 110],
                    backgroundColor: [
                        '#3498db',
                        '#2ecc71',
                        '#9b59b6',

                    ],
                    borderWidth: 0,
                    hoverOffset: 15
                }]
            };

            // Chart configuration
            const config = {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} students (${percentage}%)`;
                                }
                            },
                            bodyFont: {
                                size: 14
                            },
                            padding: 12
                        }
                    },
                    cutout: '65%',
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            };

            // Create the chart
            const ctx = document.getElementById('studentChart').getContext('2d');
            const studentChart = new Chart(ctx, config);

            // Create custom legend
            const legendContainer = document.querySelector('.chart-legend');
            data.labels.forEach((label, index) => {
                const legendItem = document.createElement('div');
                legendItem.className = 'legend-item';

                const colorBox = document.createElement('div');
                colorBox.className = 'legend-color';
                colorBox.style.backgroundColor = data.datasets[0].backgroundColor[index];

                const textSpan = document.createElement('span');
                textSpan.className = 'legend-text';
                textSpan.textContent = label;

                legendItem.appendChild(colorBox);
                legendItem.appendChild(textSpan);
                legendContainer.appendChild(legendItem);
            });
        });
    </script>
    <script src="timeTable.js"></script>
    <script src="app.js"></script>
</body>

</html>