<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0" style="border-radius: 12px;">
            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="loginModalLabel" style="font-family: 'Poppins', sans-serif; color: #2C1810;">
                    Masuk ke Akun Anda
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Description -->
                <p class="text-muted small mb-4">Masukkan email dan password Anda untuk melanjutkan</p>

                <!-- Alert Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Gagal Login!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Login Form -->
                <form id="loginForm" method="POST" action="{{ route('login.post') }}" novalidate>
                    @csrf

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text bg-light border-end-0" style="color: #8B3A3A;">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                   id="email" name="email" placeholder="contoh@email.com" 
                                   value="{{ old('email') }}" required>
                            <div class="invalid-feedback d-block" id="emailError">
                                @error('email')
                                    {{ $message }}
                                @else
                                    Format email tidak valid
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="password" class="form-label fw-bold mb-0">Password</label>
                            <a href="#" class="text-decoration-none small" style="color: #8B3A3A;">
                                Lupa Password?
                            </a>
                        </div>
                        <div class="input-group has-validation">
                            <span class="input-group-text bg-light border-end-0" style="color: #8B3A3A;">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Masukkan password Anda" required>
                            <button class="btn btn-light border-start-0" type="button" id="togglePassword">
                                <i class="fas fa-eye text-muted"></i>
                            </button>
                            <div class="invalid-feedback d-block w-100" id="passwordError">
                                @error('password')
                                    {{ $message }}
                                @else
                                    Password minimal 8 karakter
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Ingat saya di komputer ini
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2" id="loginBtn" style="background-color: #8B3A3A; border-color: #8B3A3A;">
                        <span id="btnText">Masuk</span>
                        <span id="btnSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                    </button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-0 pt-0">
                <p class="text-muted small w-100 text-center">
                    Belum punya akun? 
                    <a href="#" class="text-decoration-none fw-bold" style="color: #8B3A3A;">
                        Daftar di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Login Modal Styling */
    #loginModal .modal-content {
        background: #ffffff;
    }

    #loginModal .form-label {
        color: #333333;
        font-size: 0.95rem;
    }

    #loginModal .form-control {
        height: 44px;
        border-color: #ddd;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    #loginModal .form-control:focus {
        border-color: #8B3A3A;
        box-shadow: 0 0 0 0.2rem rgba(139, 58, 58, 0.25);
    }

    #loginModal .form-control.is-invalid {
        border-color: #dc3545;
        background-image: none;
    }

    #loginModal .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    #loginModal .invalid-feedback {
        font-size: 0.875rem;
        color: #dc3545;
        margin-top: 4px;
    }

    #loginModal .input-group-text {
        border-color: #ddd;
    }

    #loginModal .btn-primary {
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    #loginModal .btn-primary:hover:not(:disabled) {
        background-color: #2C1810;
        border-color: #2C1810;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 58, 58, 0.3);
    }

    #loginModal .btn-primary:disabled {
        background-color: #ccc;
        border-color: #ccc;
        cursor: not-allowed;
    }

    #loginModal .modal-header {
        padding: 24px 24px 0 24px;
    }

    #loginModal .modal-body {
        padding: 20px 24px;
    }

    #loginModal .modal-footer {
        padding: 0 24px 24px 24px;
    }

    #loginModal .text-muted {
        color: #999999;
    }

    /* Alert styling */
    #loginModal .alert {
        border: none;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    #loginModal .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    /* Responsive */
    @media (max-width: 576px) {
        #loginModal .modal-dialog {
            margin: 1rem;
        }

        #loginModal .modal-body {
            padding: 16px 20px;
        }

        #loginModal .form-control {
            font-size: 16px; /* Prevent zoom on iOS */
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePasswordBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (togglePasswordBtn) {
            togglePasswordBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        }

        // Form validation and submission
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loginBtn = document.getElementById('loginBtn');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');

        if (emailInput) {
            // Real-time email validation
            emailInput.addEventListener('blur', function() {
                validateEmail();
            });

            emailInput.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateEmail();
                }
            });
        }

        if (passwordInput) {
            // Real-time password validation
            passwordInput.addEventListener('blur', function() {
                validatePassword();
            });

            passwordInput.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validatePassword();
                }
            });
        }

        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                // Validate before submit
                if (!validateEmail() || !validatePassword()) {
                    e.preventDefault();
                    return false;
                }

                // Show loading state
                loginBtn.disabled = true;
                btnText.classList.add('d-none');
                btnSpinner.classList.remove('d-none');
            });
        }

        function validateEmail() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isValid = emailInput.value.trim() !== '' && emailRegex.test(emailInput.value);

            if (!isValid && emailInput.value.trim() !== '') {
                emailInput.classList.add('is-invalid');
                return false;
            } else {
                emailInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validatePassword() {
            const isValid = passwordInput.value.length >= 8;

            if (!isValid && passwordInput.value.trim() !== '') {
                passwordInput.classList.add('is-invalid');
                return false;
            } else {
                passwordInput.classList.remove('is-invalid');
                return true;
            }
        }
    });
</script>
