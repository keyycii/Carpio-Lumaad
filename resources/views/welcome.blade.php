@extends('layouts.app')

@section('content')
<style>
/* Local view styles so design works even if layout CSS differs */
.welcome-viewport{
  min-height: calc(100vh - 80px); /* leave room for navbar */
  display:flex;
  align-items:center;
  justify-content:center;
  padding:3rem 1rem;
  background: linear-gradient(135deg,#4f46e5 0%, #8b5cf6 45%, #ec4899 100%);
  color:#0f172a;
  box-sizing:border-box;
}
.welcome-card{
  width:100%;
  max-width:1100px;
  background:linear-gradient(180deg, rgba(255,255,255,0.95), rgba(255,255,255,0.88));
  border-radius:18px;
  box-shadow: 0 20px 50px rgba(2,6,23,0.35);
  overflow:hidden;
  display:flex;
  gap:0;
  align-items:stretch;
  border:1px solid rgba(255,255,255,0.15);
}
.welcome-left{
  flex:1.6;
  padding:36px;
  display:flex;
  gap:20px;
  align-items:flex-start;
}
.welcome-right{
  flex:1;
  padding:28px;
  background:linear-gradient(180deg, rgba(255,255,255,0.98), rgba(250,250,250,0.95));
}
.logo{
  width:96px;
  height:96px;
  border-radius:999px;
  object-fit:cover;
  box-shadow:0 8px 24px rgba(13,17,23,0.18);
  border:6px solid #fff;
  flex-shrink:0;
}
.h1{
  margin:0 0 6px 0;
  font-size:28px;
  line-height:1.05;
  color:#0f172a;
  font-weight:800;
}
.lead{
  margin:6px 0 14px 0;
  color:#334155;
  max-width:44rem;
}
.btn-row{display:flex;gap:10px;flex-wrap:wrap;margin-top:10px;}
.btn{
  display:inline-block;padding:10px 16px;border-radius:10px;text-decoration:none;font-weight:700;
  transition:transform .12s ease, box-shadow .12s ease;
}
.btn-primary{
  background:linear-gradient(90deg,#fbbf24,#fb7185);
  color:#fff;box-shadow:0 8px 20px rgba(251,113,133,0.18);
}
.btn-muted{
  background:#fff;border:1px solid rgba(15,23,42,0.06);color:#0f172a;
}
.btn:hover{transform:translateY(-3px)}
.pop-item{display:flex;gap:12px;align-items:center;padding:10px;border-radius:10px;background:#fff;margin-bottom:12px;box-shadow:0 6px 18px rgba(2,6,23,0.06)}
.pop-icon{width:44px;height:44px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:20px}
.meta{font-size:13px;color:#475569}

/* responsive */
@media (max-width:900px){
  .welcome-card{flex-direction:column}
  .welcome-left,.welcome-right{padding:20px}
  .logo{width:72px;height:72px}
  .h1{font-size:22px}
}
</style>

<div class="welcome-viewport" role="main" aria-label="Welcome">
  <div class="welcome-card" role="region" aria-label="Hero card">
    <div class="welcome-left">
      <img src="{{ asset('logo.png') }}" alt="DoughNot logo" class="logo" onerror="this.style.display='none'">
      <div>
        <h1 class="h1">Welcome to DoughNot</h1>
        <p class="lead">Freshly made donuts and handcrafted frappes — baked and blended daily. Order online or visit our shop.</p>

        <div class="btn-row" role="navigation" aria-label="Primary actions">
          <a class="btn btn-primary" href="{{ url('/shop') }}">Start Shopping</a>
          <a class="btn btn-muted" href="{{ route('login') }}">Login</a>
        </div>

        <ul style="margin-top:16px;color:#64748b;line-height:1.6">
          <li>Daily fresh batches</li>
          <li>Customizable frappes</li>
          <li>Fast local delivery</li>
        </ul>
      </div>
    </div>

    <aside class="welcome-right" aria-label="Popular items">
      <h3 style="margin:0 0 12px 0;font-weight:700;color:#0f172a">Popular right now</h3>

      <div class="pop-item">
        <div class="pop-icon" style="background:#fff7ed">🍩</div>
        <div>
          <div style="font-weight:700">Strawberry Cream Donut</div>
          <div class="meta">Best-seller • ₱49.00</div>
        </div>
      </div>

      <div class="pop-item">
        <div class="pop-icon" style="background:#fff1f2">☕</div>
        <div>
          <div style="font-weight:700">Caramel Frappe</div>
          <div class="meta">Rich & creamy • ₱89.00</div>
        </div>
      </div>

      <div style="margin-top:14px;font-size:13px;color:#64748b">Tip: Click "Start Shopping" to browse our menu.</div>
    </aside>
  </div>
</div>
@endsection