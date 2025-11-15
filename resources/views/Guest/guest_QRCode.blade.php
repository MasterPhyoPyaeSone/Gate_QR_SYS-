<style>
    .dd {
        font-family: 'Poppins', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
        background: linear-gradient(135deg, #ffffff, #f6f8f9);
    }

    .card-container {
        perspective: 1200px;
        width: 7.5cm;
        height: 10.5cm;
        margin-bottom: 10px;

    }

    .card {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.8s;
        cursor: pointer;
    }

    .card.flip {
        transform: rotateY(180deg);
    }

    .card-side {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 10px;
        backface-visibility: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding: 8px;
        box-sizing: border-box;
        background: linear-gradient(to bottom right, #ffffff, #d0ebff);
        border: 2px solid #39a8f7;
        font-size: 0.8em;
    }

    :root {
        --avatar-size: 110px;
        /* quick size control */
        --avatar-radius: 9999px;
        /* fully round */
        --ring-size: 3px;
    }


    .card-front img.photo {
        width: var(--avatar-size);
        height: var(--avatar-size);
        border-radius: var(--avatar-radius);
        object-fit: cover;
        display: inline-block;
        background: #ddedfc;
        margin-top: 20px;
        margin-bottom: 20px;
        /* fallback bg */
        border: 0.5px solid rgb(50, 173, 255);
        /* gold border */
        box-shadow: 0 0 12px rgba(63, 154, 252, 0.6);
        /* optional glow */
    }

    .card-front img.logo {
        width: 1.2cm;
        height: 1.2cm;
        margin-bottom: 3px;
    }

    .school-name {
        text-align: center;
        font-weight: 700;
        font-size: 1.3 em;
        /* margin-bottom: 2px; */
    }

    .school-faculty {
        text-align: center;
        font-size: 0.9em;
        margin-bottom: 5px;
    }

    .card-front #student-info {
        width: 170px;
        text-align: center;
        font-size: 0.85em;
        line-height: 1.8;
        margin-bottom: 10px;
        background-color: rgb(232, 250, 255);
        padding: 10px;
        padding-left: 20px;
        border-radius: 10px;
        /* border: 0.3px solid #16aef5; */
        margin-top: 15px;
    }

    .card-front #student-info p {
        margin: 2px 0;
    }

    .academic-year {
        margin-top: auto;
        text-align: center;
        font-weight: 600;
        font-size: 0.75em;
        color: #333;
    }

    .card-back {
        transform: rotateY(180deg);
        text-align: center;
        color: #333;
        font-size: 0.75em;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .card-back h3 {
        margin-bottom: 5px;
        font-weight: 600;
        font-size: 0.8em;
    }

    .card-back #qrcode {
        background: white;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #74b9ff;
        margin-bottom: 5px;
    }

    .btn {
        padding: 6px 12px;
        background: #ffffff;
        color: #74b9ff;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background 0.2s, color 0.2s;
        margin: 5px;
        font-size: 0.8em;
        margin-top: 30px;
    }

    .btn:hover {
        background: #74b9ff;
        color: #fff;
    }

    .gg {
        display: flex;
        align-items: center;

    }

    .gg span {
        margin-right: 10px;
        font-weight: 600;
    }

    #card-name p {
        font-weight: 700;
    }

    .forname {
        display: flex;
        align-items: center;
        text-align: center;
        margin-bottom: -5px;
        justify-content: center;
    }
    .fornamee {
        display: flex;
        align-items: center;
        margin-bottom: -5px;
        text-align: center;
        justify-content: center;
        
    }


</style>
<x-navbar type="guest" style="display: flex">
    <div class="dd">
        <div class="card-container">
            <div class="card" id="student-card">
                <!-- Front -->
                <div class="card-side card-front" id="front-card">
                    <img class="logo" src="/storage/logo/logo.png" alt="School Logo">
                    <div class="school-name">Polytechnic University (Maubin)</div>
                    <div class="school-faculty">Faculty of Computing</div>
                    {{-- <img class="photo" id="card-photo" src="" alt="Student Photo" /> --}}
                    <div id="qrcode" style="width: 120px;height: 120px; margin-top:40px;margin-bottom:20px"></div>

                    <div id="student-info" style="align-content:center">
                        
                        @if ($user->gender === 'male')
                        <div class="forname">
                            {{-- <p style="text-transform: uppercase;font-weight: 700;font-size:10px;margin-right:6px;">U</p> --}}
                            <p id="card-name" style="text-transform: uppercase;font-weight: 700;font-size:10px;"></p>

                        </div>
                         @else
                        <div class="fornamee">

                            <p id="card-name" style="text-transform: uppercase;font-weight: 700;font-size:10px"></p>
                        </div>
                        @endif

                        <p id="card-roll" style="color: rgb(12, 176, 252);font-weight: 500;" class="hidden"></p>

                        <p id="card-year"></p>
                        <p id="card-major"></p>
                    </div>
                    <div class="academic-year">2024-2025 Academic Year</div>
                </div>
                <!-- Back -->
               
            </div>
        </div>

        <div>
            <button class="btn" onclick="downloadImages()">Download Images</button>
            {{-- <button class="btn" onclick="downloadPDF()">Download PDF</button> --}}
            <a href="/guests/{{$user->id}}/send_email_guest"><button class="btn">Send with Email</button></a>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        const studentData = {
            photo: '/storage/{{$user->image}}'
            , name: '{{$user->name}}'
            , roll: '{{$user->qr_token}}'
            , major: '{{$user->position}}'
            , year: ''
        };

        // Fill front
        // document.getElementById('card-photo').src = studentData.photo;
        document.getElementById('card-name').innerText = studentData.name;
        document.getElementById('card-roll').innerText = studentData.roll;
        document.getElementById('card-year').innerText = studentData.year;
        document.getElementById('card-major').innerText = studentData.major;

        // QR code
        new QRCode(document.getElementById('qrcode'), {
            // text: `${studentData.name} - ${studentData.roll_number}`
            text: `            User Information: 
            User ID: ${studentData.roll}
            Name: ${studentData.name}`
            , width: 256
            , height: 256
            , colorDark: "#1e293b"
            , colorLight: "#ffffff"
            , correctLevel: QRCode.CorrectLevel.M

        });

        // Flip card
        // const card = document.getElementById('student-card');
        // card.addEventListener('click', () => card.classList.toggle('flip'));

        // Download Images
        async function downloadImages() {
            const card = document.getElementById('student-card');
            card.classList.remove('flip');
            await new Promise(r => setTimeout(r, 100));

            const frontCanvas = await html2canvas(document.getElementById('front-card'), {
                scale: 3
            });
            const frontLink = document.createElement('a');
            frontLink.href = frontCanvas.toDataURL('image/png');
            frontLink.download = '{{$user->name}}(Guest).png';
            frontLink.click();

            const backCard = document.getElementById('back-card');
            const originalTransform = backCard.style.transform;
            backCard.style.transform = 'none'; // remove rotation temporarily
            const backCanvas = await html2canvas(backCard, {
                scale: 3
            });
            backCard.style.transform = originalTransform;
            const backLink = document.createElement('a');
            backLink.href = backCanvas.toDataURL('image/png');
            backLink.download = 'back.png';
            backLink.click();
        }

        // Download PDF
        async function downloadPDF() {
            const {
                jsPDF
            } = window.jspdf;
            const pdfWidth = 5.5;
            const pdfHeight = 8.5;
            const pdf = new jsPDF({
                orientation: 'portrait'
                , unit: 'cm'
                , format: [pdfWidth, pdfHeight]
            });

            const card = document.getElementById('student-card');
            card.classList.remove('flip');
            await new Promise(r => setTimeout(r, 100));

            const frontCanvas = await html2canvas(document.getElementById('front-card'), {
                scale: 3
            });
            const frontImg = frontCanvas.toDataURL('image/png');

            const backCard = document.getElementById('back-card');
            const originalTransform = backCard.style.transform;
            backCard.style.transform = 'none'; // remove rotation temporarily
            const backCanvas = await html2canvas(backCard, {
                scale: 3
            });
            backCard.style.transform = originalTransform;
            const backImg = backCanvas.toDataURL('image/png');

            pdf.addImage(frontImg, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.addPage();
            pdf.addImage(backImg, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save('student_card.pdf');
        }

        // Email button
        async function sendEmail() {
            await downloadImages();
            alert('Please attach front.png and back.png from your downloads to your email client.');
            window.location.href = "mailto:?subject=Student Card&body=Attached are the student card images.";
        }

    </script>
</x-navbar>
