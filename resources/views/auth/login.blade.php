@extends('layouts.app')

@section('content')
<style>
/* Scoped login view styles */
.login-viewport{
  min-height: calc(100vh - 80px);
  display:flex;
  align-items:center;
  justify-content:center;
  padding:3rem 1rem;
  background: linear-gradient(135deg,#eef2ff 0%, #fff7ed 100%);
  box-sizing:border-box;
}
.login-card{
  width:100%;
  max-width:560px;
  background:linear-gradient(180deg, #ffffff, #fffaf0);
  border-radius:14px;
  box-shadow: 0 20px 50px rgba(2,6,23,0.12);
  padding:28px;
  border:1px solid rgba(15,23,42,0.04);
}
.brand{
  display:flex;
  align-items:center;
  gap:12px;
  margin-bottom:14px;
}
.brand .logo{
  width:48px;height:48px;border-radius:10px;background:linear-gradient(90deg,#f59e0b,#ef4444);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:20px;
}
.h2{font-size:20px;margin:0 0 6px 0;font-weight:800;color:#0f172a}
.lead{margin:0 0 14px 0;color:#475569}
.form-row{margin-bottom:12px}
.label{display:block;font-weight:700;margin-bottom:6px;color:#374151}
.input{
  width:100%;
  padding:10px 12px;
  border-radius:8px;
  border:1px solid #e6e9ef;
  background:#fff;
  box-sizing:border-box;
  font-size:14px;
  color:#0f172a;
}
.error{color:#dc2626;font-size:13px;margin-top:6px}
.actions{display:flex;gap:10px;align-items:center;margin-top:8px}
.btn-primary{
  background:linear-gradient(90deg,#f59e0b,#ef4444);
  color:#fff;padding:10px 14px;border-radius:10px;border:none;font-weight:700;cursor:pointer;
  box-shadow:0 8px 20px rgba(239,68,68,0.12);
}
.small{font-size:13px;color:#6b7280;margin-top:12px}
.footer-note{font-size:13px;color:#6b7280;margin-top:10px;background:#f8fafc;padding:10px;border-radius:8px;border:1px solid rgba(15,23,42,0.03)}
@media (max-width:520px){
  .login-card{padding:18px}
  .h2{font-size:18px}
}
</style>

<div class="login-viewport" role="main" aria-label="Login">
  <div class="login-card" role="region" aria-label="Login form">
    <div class="brand">
      <div class="logo">DN</div>
      <div>
        <div style="font-weight:800;color:#0f172a">DoughNot</div>
        <div style="font-size:13px;color:#6b7280">Sign in to continue</div>
      </div>
    </div>

    <h2 class="h2">Welcome back</h2>
    <p class="lead">Enter your name and email to log in. If you don't have an account, one will be created automatically.</p>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="form-row">
        <label for="name" class="label">Name</label>
        <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
        @error('name') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-row">
        <label for="email" class="label">Email address</label>
        <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="actions">
        <button type="submit" class="btn-primary">Sign in</button>
      </div>
    </form>

    <div class="footer-note">
      Note: accounts with an @student.dmmmsu.edu.ph email will be redirected to the management area. Other emails go to the shop.
    </div>
  </div>
</div>
@endsection