@extends('layouts.app')

@section('title', 'Login - Interlude Penerbit Buku')

@section('content')

<!-- Login Page -->
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">
            <div class="card shadow-lg border-0" style="border-radius: 12px;">
                <!-- Card Header -->
                <div class="card-header border-0 bg-transparent" style="padding: 40px 40px 0 40px;">
                    <h3 class="card-title fw-bold text-center mb-2" style="font-family: 'Poppins', sans-serif; color: #2C1810;">
                        Login Admin Interlude
                    </h3>
                </div>

                <!-- Card Body -->
                <div class="card-body" style="padding: 30px 40px;">


                    <!-- Login Form -->
                    <form id="loginForm" method="POST" action="{{ route('login.post') }}" novalidate>
                        @csrf

                        <!-- Password Validation Alert -->
                        @php
                            $submittedPassword = session()->getOldInput()['password'] ?? null;
                            $hasPasswordError = $errors->has('password') && $submittedPassword !== null && $submittedPassword !== '';
                            $showPasswordAlert = !empty(session('error')) || $hasPasswordError;
                        @endphp
                        <div class="alert alert-danger alert-dismissible fade show {{ $showPasswordAlert ? '' : 'd-none' }}" id="passwordAlert" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <span id="passwordAlertText">
                                @if (session('error'))
                                    {{ session('error') }}
                                @else
                                    {{ $errors->first('password', 'Password minimal 8 karakter.') }}
                                @endif
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

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
                                <div class="invalid-feedback" id="emailError">
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
                                <div class="invalid-feedback w-100" id="passwordError">
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
            </div>

            <!-- Back to Home Link -->
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-decoration-none" style="color: #8B3A3A;">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
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
            const passwordAlert = document.getElementById('passwordAlert');
            const passwordAlertText = document.getElementById('passwordAlertText');
            const isValid = passwordInput.value.length >= 8;

            if (!isValid && passwordInput.value.trim() !== '') {
                passwordInput.classList.add('is-invalid');
                if (passwordAlert) {
                    passwordAlertText.textContent = 'Password minimal 8 karakter.';
                    passwordAlert.classList.remove('d-none');
                }
                return false;
            } else {
                passwordInput.classList.remove('is-invalid');
                if (passwordAlert) {
                    passwordAlert.classList.add('d-none');
                }
                return true;
            }
        }
    });
</script>
@endsection
