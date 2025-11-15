<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
</head>
<body> 
    {{-- <div class="alert-box" id="alertBox">
        <div class="alert-icon">✓</div>
        <h3 class="alert-title">Success!</h3>
        <p class="alert-message">Operation completed successfully. This alert will automatically close shortly.</p>
        <div class="alert-progress">
            <div class="alert-progress-bar" id="progressBar"></div>
        </div>
    </div> --}}

  
   
    <div class="alert-box" id="alertBox">
        <div class="alert-icon">✕</div>
        <h3 class="alert-title">Error!</h3>
        <p class="alert-message">Update Data must be unique !! </p>
        <div class="alert-progress">
            <div class="alert-progress-bar" id="progressBar"></div>
        </div>
    </div>
</body>
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
</html>