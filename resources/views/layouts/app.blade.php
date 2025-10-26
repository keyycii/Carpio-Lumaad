<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ config('app.name', 'DoughNot') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    :root{
      --bg:#f8fafc;--card:#ffffff;--muted:#6b7280;--accent1:#f59e0b;--accent2:#ef4444;--accent-grad:linear-gradient(90deg,var(--accent1),var(--accent2));
      --nav-height:64px;
    }
    *{box-sizing:border-box}
    body{font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; margin:0;background:var(--bg);color:#0f172a}
    .app-header{height:var(--nav-height);display:flex;align-items:center;justify-content:space-between;padding:0 20px;background:#fff;border-bottom:1px solid rgba(15,23,42,0.04)}
    .brand{display:flex;align-items:center;gap:12px;text-decoration:none;color:var(--accent2);font-weight:800;font-size:18px}
    .brand .logo{width:36px;height:36px;border-radius:8px;display:inline-grid;place-items:center;color:#fff;font-weight:800;background:var(--accent-grad);box-shadow:0 6px 18px rgba(239,68,68,0.12)}
    .nav{display:flex;gap:10px;margin-left:18px}
    .nav a{color:#374151;text-decoration:none;padding:8px 10px;border-radius:8px;font-weight:600}
    .nav a:hover{background:#f3f4f6}
    .left{display:flex;align-items:center;gap:6px}
    .right{display:flex;align-items:center;gap:12px}
    .user-name{color:#111;font-weight:700}
    .btn-link{padding:8px 12px;border-radius:10px;background:var(--accent-grad);color:#fff;text-decoration:none;font-weight:700;box-shadow:0 8px 20px rgba(239,68,68,0.08)}
    .outline-btn{padding:8px 12px;border-radius:10px;background:#fff;border:1px solid rgba(15,23,42,0.06);color:#0f172a;text-decoration:none}
    main{padding:28px 40px}
    /* responsive */
    @media (max-width:860px){
      .nav{display:none}
    }
  </style>
</head>
<body>
  <header class="app-header" role="banner">
    <div class="left">
      <a class="brand" href="{{ route('homepage') }}">
        <span class="logo">DN</span>
        <span>DoughNot</span>
      </a>

      @php
        $isStudent = auth()->check() && \Illuminate\Support\Str::endsWith(strtolower(optional(auth()->user())->email ?? ''), '@student.dmmmsu.edu.ph');
      @endphp

      <nav class="nav" role="navigation" aria-label="Primary">
        @if($isStudent)
          <a href="{{ route('donuts.index') }}">Donuts</a>
          <a href="{{ route('frappes.index') }}">Frappes</a>
          <a href="{{ route('users.index') }}">Users</a>
        @endif
      </nav>
    </div>

    <div class="right" role="navigation" aria-label="User">
      @guest
        <a class="outline-btn" href="{{ route('login') }}">Login</a>
      @else
        <span class="user-name">{{ auth()->user()->name }}</span>
        <a class="outline-btn" href="{{ route('profile') }}">Profile</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
          @csrf
          <button type="submit" class="outline-btn" style="cursor:pointer">Logout</button>
        </form>
      @endguest
    </div>
  </header>

  <main role="main">
    @yield('content')
  </main>
</body>
</html>