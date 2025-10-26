@extends('layouts.app')

@section('content')
<style>
/* Users index scoped styles */
.users-viewport{
  min-height: calc(100vh - 80px);
  padding:3rem 1rem;
  box-sizing:border-box;
  display:flex;
  justify-content:center;
  background: linear-gradient(135deg,#f8fafc 0%, #fff 100%);
}
.users-wrap{
  width:100%;
  max-width:1100px;
}
.header-row{
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:12px;
  margin-bottom:1rem;
}
.h1{font-size:28px;font-weight:800;margin:0;color:#0f172a}
.add-btn{background:linear-gradient(90deg,#10b981,#06b6d4);color:#fff;padding:10px 14px;border-radius:10px;text-decoration:none;font-weight:700;box-shadow:0 6px 18px rgba(6,95,70,0.08)}
.table-wrap{background:#fff;border-radius:12px;padding:14px;border:1px solid rgba(15,23,42,0.04);box-shadow:0 10px 30px rgba(2,6,23,0.04)}
.user-table{width:100%;border-collapse:collapse;font-family:inherit}
.user-table thead th{text-align:left;padding:12px 10px;border-bottom:1px solid rgba(15,23,42,0.06);color:#475569;font-weight:700;font-size:13px}
.user-table tbody td{padding:12px 10px;border-bottom:1px solid rgba(15,23,42,0.04);vertical-align:middle;color:#0f172a}
.avatar-sm{width:48px;height:48px;border-radius:999px;object-fit:cover;border:2px solid #fff;box-shadow:0 6px 18px rgba(2,6,23,0.06)}
.meta-small{font-size:13px;color:#6b7280}
.actions{display:flex;gap:8px}
.btn{padding:8px 10px;border-radius:8px;text-decoration:none;font-weight:700;border:1px solid rgba(15,23,42,0.06);background:#fff;color:#0f172a}
.btn-edit{background:linear-gradient(90deg,#f59e0b,#ef4444);color:#fff;border:none}

/* responsive: switch to stacked cards on small screens */
@media (max-width:800px){
  .user-table, .user-table thead {display:none}
  .user-list{display:block}
  .user-card{display:flex;gap:12px;align-items:center;padding:12px;margin-bottom:10px;border-radius:10px;background:#fff;border:1px solid rgba(15,23,42,0.04)}
  .user-card .col{flex:1}
}
@media (min-width:801px){
  .user-list{display:none}
}
</style>

<div class="users-viewport" role="main" aria-label="Users">
  <div class="users-wrap">
    <div class="header-row">
      <h1 class="h1">Users</h1>
      <a href="{{ route('login') ?? '#' }}" class="add-btn">Add User</a>
    </div>

    <div class="table-wrap" role="region" aria-label="Users table">
      @if($users->isEmpty())
        <div style="padding:28px;text-align:center;color:#64748b">No users found.</div>
      @else
        <!-- desktop table -->
        <table class="user-table" role="table" aria-label="Users list">
          <thead>
            <tr>
              <th></th>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Created At</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td style="width:64px">
                <img src="{{ asset($user->avatar ?? 'images/logo.png') }}" alt="avatar" class="avatar-sm" onerror="this.src='{{ asset('images/logo.png') }}'">
              </td>
              <td>#{{ $user->id }}</td>
              <td>
                <div style="font-weight:700">{{ $user->name }}</div>
                <div class="meta-small">Member</div>
              </td>
              <td>{{ $user->email }}</td>
              <td>{{ optional($user->created_at)->format('M d, Y') ?? '—' }}</td>
              <td style="text-align:right">
                <div class="actions" role="group" aria-label="User actions">
                  {{-- Edit button removed --}}
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <!-- mobile stacked list -->
        <div class="user-list" aria-hidden="false" style="margin-top:8px">
          @foreach($users as $user)
          <div class="user-card" role="listitem">
            <img src="{{ asset($user->avatar ?? 'images/logo.png') }}" alt="avatar" class="avatar-sm" onerror="this.src='{{ asset('images/logo.png') }}'">
            <div class="col">
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div style="font-weight:700">{{ $user->name }}</div>
                <div class="meta-small">#{{ $user->id }}</div>
              </div>
              <div class="meta-small" style="margin-top:6px">{{ $user->email }}</div>
              <div class="meta-small" style="margin-top:4px">Joined {{ optional($user->created_at)->format('M d, Y') ?? '—' }}</div>
            </div>

          </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</div>
@endsection