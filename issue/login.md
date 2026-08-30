# Login Component - Interlude Penerbit Buku

## Deskripsi Proyek

Membangun komponen **Login** yang bersih, modern, dan responsif untuk website Interlude Penerbit Buku. Komponen ini akan memungkinkan pengguna untuk masuk ke akun mereka dengan email dan password.

---

## Konteks & User Flow

### Trigger Point
- Pengguna mengklik menu **"Login"** di Navbar Halaman Utama (Home Page)
- Dapat ditampilkan sebagai:
  - **Modal/Dialog** melayang dengan backdrop blur (overlay) 
  - **Halaman Login Khusus** (dedicated login page)
  - Rekomendasi: **Modal** untuk UX yang lebih seamless

### Navigation Flow
```
Home Page → Klik "Login" → Modal/Page Login → 
  ├─ Success → Redirect ke Dashboard/Home (authenticated)
  ├─ Forgot Password → Redirect ke halaman reset password
  └─ Register → Redirect ke halaman signup
```

---

## Struktur & Elemen Input

### 1. Form Header
- **Judul**: "Masuk ke Akun" atau "Selamat Datang Kembali"
- **Deskripsi**: "Masukkan email dan password Anda untuk melanjutkan"
- **Close Button** (jika modal): 'X' di pojok kanan atas

### 2. Input Fields

#### Field 1: Email
- **Type**: `email`
- **Label**: "Email"
- **Placeholder**: "contoh@email.com"
- **Ikon**: Email/Amplop di sisi kiri input
- **Validation**: 
  - Format email valid (mengandung @ dan domain)
  - Tidak boleh kosong
- **Error Message**: Tampil di bawah field jika invalid

#### Field 2: Password
- **Type**: `password` (dengan toggle visibility)
- **Label**: "Password"
- **Placeholder**: "Masukkan password Anda"
- **Ikon Kiri**: Kunci/Lock
- **Ikon Kanan**: Eye/Mata icon (toggle show/hide password)
- **Validation**:
  - Tidak boleh kosong
  - Minimal 8 karakter
- **Error Message**: Tampil di bawah field jika invalid
- **Helper Link**: "Lupa Password?" di sebelah kanan label

### 3. Tombol Utama

#### Login Button
- **Text**: "Masuk" atau "Login"
- **Type**: Primary Button (Full-width)
- **Color**: Brand accent color (Maroon #8B3A3A)
- **States**:
  - Default: Normal appearance
  - Hover: Darker shade + shadow effect
  - Focus: Glow effect + border highlight
  - Loading: Spinner icon + disabled state
  - Disabled: Greyed out appearance

### 4. Links & CTA

#### Forgot Password
- **Text**: "Lupa Password?"
- **Position**: Right side of password label
- **Style**: Link text (no background)
- **Action**: Redirect ke halaman reset password

#### Sign Up Link
- **Text**: "Belum punya akun? Daftar di sini"
- **Position**: Bottom of card
- **Style**: Link text (accent color)
- **Action**: Redirect ke halaman registrasi

---

## Validasi & State Handling

### Client-Side Validation

#### Email Validation
```javascript
// Valid email format
- Harus mengandung @ symbol
- Harus memiliki domain (contoh: .com, .co.id, dll)
- Regex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
- Real-time validation saat user meninggalkan field (onBlur)
```

#### Password Validation
```javascript
// Password requirements
- Tidak boleh kosong
- Minimal 8 karakter
- Maksimal 255 karakter
- Real-time feedback saat user mengetik
```

### Error Display
- **Position**: Tepat di bawah field yang bermasalah
- **Color**: Merah (#dc3545 atau #FF4444)
- **Font Size**: Kecil (0.875rem/14px)
- **Icon**: Warning icon (⚠️) di samping pesan
- **Animation**: Fade in smoothly
- **Contoh**: 
  ```
  ⚠️ Format email tidak valid
  ⚠️ Password minimal 8 karakter
  ```

### State Management

#### 1. Default State
- Semua input kosong
- Error message tersembunyi
- Button login aktif (enabled)
- Tidak ada loading indicator

#### 2. Focused State
- Input field: Border glow dengan warna accent
- Cursor aktif di input
- Placeholder visible
- Helper text muncul (jika ada)

#### 3. Validation Error State
- Input field: Red border (#dc3545)
- Background: Light red/pink tint
- Error message: Visible di bawah field
- Ikon error di sebelah text
- Button: Tetap enabled sampai user fix

#### 4. Loading State
- Button login: Disabled (grey color)
- Button text: Diganti dengan spinner icon
- Spinner: Animated rotating icon
- Other inputs: Disabled (tidak bisa diubah)
- Duration: Sampai server respond

#### 5. Success State
- Modal close atau Redirect ke page berikutnya
- Session/Token tersimpan
- User diarahkan ke dashboard atau home page

---

## Desain & Styling

### Brand Colors Integration
```css
--primary-color: #2C1810;      /* Coklat tua - untuk text */
--accent-color: #8B3A3A;       /* Maroon - untuk button & highlights */
--light-bg: #F5F1ED;           /* Off-white - untuk background */
--error-color: #dc3545;        /* Merah - untuk error messages */
--text-primary: #333333;
--text-secondary: #666666;
```

### Card Container
- **Background**: White (#ffffff) atau Light background (#F5F1ED)
- **Border Radius**: 12px-16px (rounded corners)
- **Shadow**: `0 10px 30px rgba(0,0,0,0.1)` (soft shadow)
- **Padding**: 40px (desktop), 24px (mobile)
- **Max Width**: 400px (desktop), 100% (mobile dengan margin)

### Input Field Styling
- **Height**: 44px-48px (touch-friendly)
- **Padding**: 12px 16px dengan ikon
- **Border**: 1px solid #ddd
- **Border Radius**: 6px-8px
- **Font Size**: 16px (prevent zoom on mobile)
- **Transition**: 0.3s ease

#### Input States:
- **Default**: Gray border (#ddd)
- **Hover**: Light gray border (#ccc)
- **Focus**: Accent color border + subtle glow + shadow
- **Error**: Red border (#dc3545) + light red background
- **Disabled**: Gray background + lighter text

### Typography
- **Judul**: Lora serif, 24px, bold (#2C1810)
- **Deskripsi**: Poppins sans-serif, 14px, #666666
- **Label**: Poppins sans-serif, 14px, bold, #333333
- **Placeholder**: Poppins sans-serif, 14px, #999999
- **Error Text**: Poppins sans-serif, 12px, #dc3545
- **Link**: Poppins sans-serif, 14px, #8B3A3A (accent)

### Responsiveness

#### Desktop (≥1024px)
- Modal width: 400px
- Centered on screen
- Padding: 40px
- Full backdrop

#### Tablet (768px - 1023px)
- Modal width: 90% atau 380px
- Centered on screen
- Padding: 32px

#### Mobile (< 768px)
- Full width - padding 16px
- Bottom-sheet style atau overlay penuh
- Padding: 24px
- Font slightly smaller

---

## Implementasi Teknis

### Stack & Dependencies
- **Backend**: Laravel Sanctum/Passport untuk authentication
- **Frontend**: Blade template + Bootstrap 5
- **Validation**: Laravel Form Request (backend) + JavaScript (client-side)
- **Icons**: Font Awesome 6
- **JavaScript**: Vanilla JS atau Alpine.js

### File Structure
```
resources/
├── views/
│   ├── auth/
│   │   ├── login.blade.php          # Login page (jika dedicated page)
│   │   └── modal/
│   │       └── login-modal.blade.php # Login modal component
│   └── components/
│       └── login-form.blade.php      # Reusable login form
├── css/
│   └── auth.css                      # Custom auth styling
└── js/
    └── auth.js                       # Auth form handling & validation
```

### Routes
```php
// Web routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');

// API routes (jika menggunakan SPA)
Route::post('/api/login', [AuthController::class, 'apiLogin']);
```

### Controller
```php
// app/Http/Controllers/Auth/AuthController.php
- showLogin(): View login page/modal
- login(): Handle login request
- logout(): Handle logout
```

### Form Request
```php
// app/Http/Requests/LoginRequest.php
- email: required|email|exists:users,email
- password: required|min:8|max:255
```

---

## Features Tambahan

### 1. Remember Me (Optional)
- Checkbox "Ingat saya di komputer ini"
- Menyimpan session lebih lama (14 hari)
- Position: Sebelah kiri tombol login

### 2. Social Login (Optional)
- Tombol "Login dengan Google"
- Tombol "Login dengan Facebook"
- Position: Sebelah bawah password field atau setelah tombol login
- Style: Outline buttons dengan ikon

### 3. Password Strength Indicator (Optional)
- Visual indicator untuk password strength
- Bar berwarna (merah → kuning → hijau)
- Text: "Lemah", "Sedang", "Kuat"

### 4. Two-Factor Authentication (Future)
- OTP verification setelah login sukses
- SMS atau email code

---

## Accessibility & UX Best Practices

### Accessibility Checklist
- ✅ Proper `<label>` tags linked to inputs via `for` attribute
- ✅ ARIA labels untuk icon-only buttons
- ✅ Keyboard navigation (Tab, Enter, Escape)
- ✅ Color contrast ratio ≥ 4.5:1
- ✅ Focus indicators visible
- ✅ Form validation announcement untuk screen readers
- ✅ Error messages linked to inputs via `aria-describedby`

### UX Best Practices
- ✅ Disable login button saat loading
- ✅ Clear error messages dalam bahasa yang jelas
- ✅ Minimal field - hanya email & password
- ✅ Large, touch-friendly buttons (minimum 44x44px)
- ✅ Proper font size (≥16px) to prevent mobile zoom
- ✅ Password toggle visibility untuk mobile UX
- ✅ Form submission dengan Enter key support
- ✅ Loading state indication

---

## Security Considerations

### Input Sanitization
- Laravel automatically sanitizes inputs
- HTML entities encoding untuk error messages
- No client-side password validation only

### Password Handling
- Never log passwords
- Use HTTPS for all auth endpoints
- Hash passwords dengan bcrypt (Laravel default)
- Implement rate limiting untuk login attempts
- Add CSRF protection untuk form submission

### Session Management
- Use secure session cookies
- Set HttpOnly flag
- Set SameSite=Lax/Strict
- Implement session timeout
- Regenerate session ID setelah login

---

## Implementation Phases

### Phase 1: Backend Setup
- [ ] Create User model (jika belum ada)
- [ ] Create migration untuk users table
- [ ] Setup authentication middleware
- [ ] Create LoginRequest form validation
- [ ] Create AuthController
- [ ] Setup routes

### Phase 2: Frontend - Modal Component
- [ ] Create login-modal.blade.php
- [ ] Add Bootstrap 5 form styling
- [ ] Add custom CSS (auth.css)
- [ ] Add Font Awesome icons
- [ ] Implement responsive design

### Phase 3: Form Validation
- [ ] Client-side validation (JavaScript)
- [ ] Real-time validation feedback
- [ ] Error message display
- [ ] Form submission handling

### Phase 4: Loading & States
- [ ] Loading state UI
- [ ] Success/error handling
- [ ] Toast/alert notifications
- [ ] Redirect logic

### Phase 5: Integration & Testing
- [ ] Integrate dengan Navbar (trigger login modal)
- [ ] Test modal open/close
- [ ] Test form validation
- [ ] Test responsive design
- [ ] Browser compatibility testing

### Phase 6: Polish & Deploy
- [ ] Code formatting (Pint)
- [ ] Performance optimization
- [ ] Security review
- [ ] Final testing
- [ ] Commit & push to GitHub

---

## Wireframe / Visual Layout

```
┌─────────────────────────────────────────┐
│                                     [X] │  ← Close button
├─────────────────────────────────────────┤
│                                         │
│       Masuk ke Akun Anda                │
│  Masukkan email dan password Anda      │
│                                         │
│  ✉️ Email *                             │
│  [________________________]              │
│  Format email tidak valid (error)      │
│                                         │
│  🔒 Password *      [Lupa Password?]    │
│  [________________________] 👁️          │
│  Password minimal 8 karakter (error)   │
│                                         │
│  [ ] Ingat saya di komputer ini        │
│                                         │
│  ┌─────────────────────────────────┐   │
│  │  Masuk                          │   │ ← Primary Button
│  └─────────────────────────────────┘   │
│                                         │
│  Belum punya akun? Daftar di sini      │
│                                         │
└─────────────────────────────────────────┘
```

---

## Notes & Recommendations

1. **Modal vs Dedicated Page**:
   - Modal: Better UX untuk flow di halaman home
   - Dedicated Page: Better untuk share direct link
   - Rekomendasi: Mulai dengan modal, bisa diperluas ke page

2. **Error Messages**:
   - Jangan pernah validasi "User not found"
   - Gunakan generic message: "Email atau password salah"
   - Untuk security

3. **Rate Limiting**:
   - Implement untuk mencegah brute force
   - Contoh: 5 attempts per menit per IP
   - Show countdown untuk lockout

4. **Testing**:
   - Unit test untuk validation logic
   - Feature test untuk login flow
   - Test success & error scenarios
   - Test responsive design

5. **Future Enhancements**:
   - Social login (Google, Facebook)
   - 2FA/MFA support
   - Biometric authentication
   - Progressive Web App (PWA) support

---

## Acceptance Criteria

- ✅ Modal/Page loads dengan benar
- ✅ Email & password inputs functional
- ✅ Real-time validation works
- ✅ Error messages display correctly
- ✅ Loading state shows during submission
- ✅ Success redirects user
- ✅ Close modal/go back works
- ✅ Responsive pada mobile/tablet/desktop
- ✅ Keyboard navigation works
- ✅ Accessibility standards met
- ✅ Secure (HTTPS, CSRF, rate limiting)

---

## Resources & Documentation

- [Laravel Authentication](https://laravel.com/docs/11/authentication)
- [Bootstrap Form Controls](https://getbootstrap.com/docs/5.3/forms/form-control/)
- [Web Content Accessibility Guidelines (WCAG)](https://www.w3.org/WAI/WCAG21/quickref/)
- [OWASP Authentication Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Authentication_Cheat_Sheet.html)

---

**Status**: 🚀 Ready for Implementation  
**Last Updated**: 2026-08-31
