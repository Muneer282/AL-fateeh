@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>إنشاء حساب</h2>
            <p>انضم إلينا الآن في معرض الفتيح</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">الاسم الثلاثي</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input id="password" type="password" name="password" required class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">تأكيد كلمة المرور</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control">
            </div>

            <button type="submit" class="btn btn-full">إنشاء الحساب</button>

            <div class="auth-divider">
                <span>أو</span>
            </div>

            <a href="{{ route('auth.google') }}" class="btn-google">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
                <span>التسجيل باستخدام جوجل</span>
            </a>

            <div class="auth-footer">
                لديك حساب بالفعل؟ <a href="{{ route('login') }}">سجل دخول</a>
            </div>
        </form>
    </div>
</div>

<style>
/* Reusing styles from login or they can be moved to app.css */
.auth-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
    padding: 40px 0;
}

.auth-card {
    background: rgba(20, 20, 20, 0.8);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 102, 0, 0.2);
    border-radius: 20px;
    padding: 40px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    animation: fadeIn 0.5s ease-out;
}

.auth-header {
    text-align: center;
    margin-bottom: 30px;
}

.auth-header h2 {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 10px;
}

.auth-header p {
    color: #888;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #ccc;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    color: #fff;
    font-size: 1rem;
    transition: var(--transition);
}

.form-control:focus {
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 10px var(--primary-glow);
}

.is-invalid {
    border-color: #ff4444;
}

.error-msg {
    color: #ff4444;
    font-size: 0.85rem;
    margin-top: 5px;
    display: block;
}

.btn-full {
    width: 100%;
    padding: 14px;
    font-size: 1.1rem;
    margin-bottom: 20px;
}

.auth-divider {
    text-align: center;
    margin: 20px 0;
    position: relative;
}

.auth-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: rgba(255, 255, 255, 0.1);
    z-index: 1;
}

.auth-divider span {
    background: #141414;
    padding: 0 15px;
    color: #666;
    position: relative;
    z-index: 2;
    font-size: 0.9rem;
}

.btn-google {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    padding: 12px;
    background: #fff;
    color: #000;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 600;
    transition: var(--transition);
}

.btn-google:hover {
    background: #f1f1f1;
    transform: translateY(-2px);
}

.btn-google img {
    width: 20px;
}

.auth-footer {
    text-align: center;
    margin-top: 25px;
    color: #888;
}

.auth-footer a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection
