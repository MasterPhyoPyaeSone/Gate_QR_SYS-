<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate Pass System Login Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-image:url("https://chfcanada.coop/wp-content/uploads/2025/08/Cyber-Guard-graphic.jpg") ;
            background-size: contain;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            position: relative;
            overflow: hidden;
            transform: translateY(20px);
            opacity: 0;
            animation: slideUp 0.8s ease forwards;
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #333;
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e1e1;
            border-radius: 12px;
            font-size: 1rem;
            background: transparent;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-label {
            position: absolute;
            left: 20px;
            top: 15px;
            color: #999;
            font-size: 1rem;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-input:focus + .form-label,
        .form-input:not(:placeholder-shown) + .form-label {
            top: -10px;
            left: 15px;
            font-size: 0.8rem;
            background: white;
            padding: 0 8px;
            color: #667eea;
            font-weight: 600;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-me input {
            width: 16px;
            height: 16px;
            accent-color: #667eea;
        }

        .remember-me label {
            color: #666;
            font-size: 0.9rem;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #999;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e1e1e1;
        }

        .divider span {
            padding: 0 15px;
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid #e1e1e1;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            color: #666;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: #667eea;
            color: #667eea;
        }

        .signup-link {
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }

        .signup-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .floating-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.3), rgba(118, 75, 162, 0.3));
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
                margin: 10px;
            }
            
            .login-header h1 {
                font-size: 1.8rem;
            }
            
            .remember-forgot {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    {{-- @if(session('error'))
    <x-loginFail/>
    @endif --}}
    @if(session()->has('error'))
    <div style="color:red">
        {{-- {{ session('error') }} --}}
        <x-loginFail/>
    </div>
   @endif

    <div class="login-container">
        <div class="floating-particles" id="particles"></div>
        
        <div class="login-header">
            <h1>Login</h1>
            <p>Sign in to Gate Pass System</p>
        </div>
       

        <form id="loginForm" action="/login" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="username" autocomplete="new-password" class="form-input" id="email" placeholder=" " required>
                <label for="email" class="form-label">Username</label>
            </div>

            <div class="form-group">
                <input type="password" autocomplete="new-password" name="password" class="form-input" id="password" placeholder=" " required>
                <label for="password" class="form-label">Password</label>
                <button type="button" class="password-toggle" id="togglePassword">
                    👁️
                </button>
            </div>

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                {{-- <a href="#" class="forgot-password">Forgot Password?</a> --}}
            </div>

            <button type="submit" class="login-btn" id="loginBtn">
                Login
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create floating particles
            createParticles();
            
            // Password toggle functionality
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.textContent = type === 'password' ? '👁️' : '🔒';
            });

            // Form submission
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const successMessage = document.getElementById('successMessage');

            // loginForm.addEventListener('submit', function(e) {
            //     e.preventDefault();
                
            //     const email = document.getElementById('email').value;
            //     const password = document.getElementById('password').value;

            //     // Simple validation
            //     if (!email || !password) {
            //         loginForm.classList.add('shake');
            //         setTimeout(() => loginForm.classList.remove('shake'), 500);
            //         return;
            //     }

            //     // Simulate login process
            //     loginBtn.textContent = 'Signing in...';
            //     loginBtn.disabled = true;

            //     setTimeout(() => {
            //         successMessage.style.display = 'block';
            //         loginBtn.textContent = 'Success!';
            //         loginBtn.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
                    
            //         // Simulate redirect
            //         setTimeout(() => {
            //             alert('Login successful! (This is a demo)');
            //             resetForm();
            //         }, 2000);
            //     }, 1500);
            // });

            function resetForm() {
                loginForm.reset();
                loginBtn.textContent = 'Sign In';
                loginBtn.disabled = false;
                loginBtn.style.background = 'linear-gradient(135deg, #667eea, #764ba2)';
                successMessage.style.display = 'none';
            }

            // Input focus effects
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', () => {
                    input.parentElement.classList.remove('focused');
                });
            });

            // Create floating particles
            function createParticles() {
                const particlesContainer = document.getElementById('particles');
                const particleCount = 15;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    
                    // Random properties
                    const size = Math.random() * 15 + 5;
                    const posX = Math.random() * 100;
                    const posY = Math.random() * 100;
                    const delay = Math.random() * 5;
                    const duration = Math.random() * 3 + 4;
                    
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.left = `${posX}%`;
                    particle.style.top = `${posY}%`;
                    particle.style.animationDelay = `${delay}s`;
                    particle.style.animationDuration = `${duration}s`;
                    
                    particlesContainer.appendChild(particle);
                }
            }

            // Add hover effect to social buttons
            const socialBtns = document.querySelectorAll('.social-btn');
            socialBtns.forEach(btn => {
                btn.addEventListener('mouseenter', () => {
                    btn.style.transform = 'translateY(-5px) scale(1.1)';
                });
                
                btn.addEventListener('mouseleave', () => {
                    btn.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
    </script>
</body>
</html>

