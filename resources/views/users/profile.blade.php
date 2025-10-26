@extends('layouts.app')

@section('content')
<style>
/* Scoped styles for profile view (keep existing styles or replace as needed) */
.profile-viewport{min-height:calc(100vh - 80px);display:flex;align-items:center;justify-content:center;padding:3rem 1rem;background:linear-gradient(135deg,#4f46e5 0%, #8b5cf6 45%, #ec4899 100%);box-sizing:border-box}
.profile-card{width:100%;max-width:920px;background:linear-gradient(180deg, rgba(255,255,255,0.98), rgba(255,255,255,0.95));border-radius:16px;box-shadow:0 20px 50px rgba(2,6,23,0.25);overflow:hidden;border:1px solid rgba(255,255,255,0.18);display:grid;grid-template-columns:1fr 360px}
@media (max-width:900px){.profile-card{grid-template-columns:1fr}}
.profile-hero{padding:28px 32px}
.profile-side{padding:28px 24px;background:linear-gradient(180deg, rgba(250,250,250,0.9), rgba(245,245,245,0.9));border-left:1px solid rgba(0,0,0,0.03)}
.avatar{width:96px;height:96px;border-radius:999px;object-fit:cover;border:6px solid #fff;box-shadow:0 10px 30px rgba(2,6,23,0.12)}
.name{font-size:20px;font-weight:800;margin:0;color:#0f172a}
.meta{color:#6b7280;margin:6px 0 12px 0}
.id-chip{display:inline-block;padding:8px 12px;border-radius:10px;background:linear-gradient(90deg,#f59e0b,#ef4444);color:#fff;font-weight:700;font-family:ui-monospace,monospace}
.info-row{display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px dashed rgba(15,23,42,0.04)}
.info-left{color:#475569;font-weight:600}
.info-right{color:#0f172a;font-weight:700}
.btn{padding:10px 14px;border-radius:10px;text-decoration:none;font-weight:700;border:1px solid rgba(15,23,42,0.06);background:#fff;color:#0f172a}
.btn-primary{background:linear-gradient(90deg,#f59e0b,#ef4444);color:#fff;border:none}
.small{font-size:13px;color:#6b7280}
.notice{margin-bottom:12px;padding:12px;border-radius:10px;background:#fff7ed;border:1px solid rgba(245,158,11,0.12);color:#92400e;font-weight:700;text-align:center}
</style>

<div class="profile-viewport" role="main" aria-label="User profile">
  <div class="profile-card" role="region" aria-label="Profile card">
    <div class="profile-hero">
      <div class="notice">Security Notice — keep your personal information private.</div>

      <div style="display:flex;gap:16px;align-items:center">
        <img src="{{ asset($user->avatar ?? 'images/logo.png') }}" alt="avatar" class="avatar" onerror="this.src='{{ asset('images/logo.png') }}'">
        <div>
          <h1 class="name">{{ $user->name }}</h1>
          <div class="meta">Active Member • <span class="small">Since {{ optional($user->created_at)->format('M d, Y') ?? '—' }}</span></div>
          <div class="small">Unique account details shown below — share only with support when required.</div>
        </div>
      </div>

      <div style="margin-top:20px">
        <div class="info-row">
          <div class="info-left">User ID</div>
          <div class="info-right"><span class="id-chip">#{{ $user->id }}</span></div>
        </div>

        <div class="info-row">
          <div class="info-left">Email</div>
          <div class="info-right" style="max-width:56%">{{ $user->email }}</div>
        </div>

        <div style="margin-top:16px" class="small">Note: Your User ID is best used when contacting support. Keep it private.</div>

        <div style="margin-top:18px" class="actions" aria-label="profile actions">
          <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
          </form>
        </div>
      </div>
    </div>

    <aside class="profile-side" aria-label="Account summary">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px">
        <div class="small">Account Status</div>
        <div class="small" style="color:#065f46;font-weight:700">@if($isStudent) VERIFIED @else CUSTOMER @endif</div>
      </div>

      <div style="margin-top:14px;border-top:1px dashed rgba(15,23,42,0.04);padding-top:12px">
        <div class="small">Member Since</div>
        <div style="font-weight:700;margin-top:6px">{{ optional($user->created_at)->format('M d, Y') ?? '—' }}</div>
      </div>

      <div style="margin-top:16px;border-top:1px dashed rgba(15,23,42,0.04);padding-top:12px">
        <div class="small">Quick Links</div>

        @if($isStudent)
          <!-- management links for student accounts -->
          <nav style="display:flex;flex-direction:column;gap:8px;margin-top:8px">
            <a href="{{ route('donuts.index') }}" class="btn" style="width:100%;text-align:left">Donuts</a>
            <a href="{{ route('frappes.index') }}" class="btn" style="width:100%;text-align:left">Frappes</a>
            <a href="{{ route('users.index') }}" class="btn" style="width:100%;text-align:left">Users</a>
          </nav>
        @else
          <!-- customer view: show shop link only -->
          <div style="margin-top:8px;display:flex;flex-direction:column;gap:8px">
            <a href="{{ route('shop.index') }}" class="btn" style="width:100%;text-align:left;background:#f3f4f6;color:#0f172a;border:none">Go to Shop</a>
            <div class="small" style="margin-top:6px;color:#64748b">You are signed in as a customer. Management areas are hidden.</div>
          </div>
        @endif
      </div>
    </aside>
  </div>
</div>
@endsection