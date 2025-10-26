@extends('layouts.app')

@section('content')
<style>
.profile-edit-wrap{max-width:900px;margin:0 auto}
.card{background:#fff;border-radius:12px;padding:22px;box-shadow:0 12px 30px rgba(2,6,23,.08)}
.row{display:flex;gap:18px;align-items:flex-start;flex-wrap:wrap}
.col-left{flex:1}
.col-side{width:260px}
.avatar-preview{width:96px;height:96px;border-radius:999px;object-fit:cover;border:4px solid #fff;box-shadow:0 8px 20px rgba(2,6,23,.08)}
.form-row{margin-bottom:12px}
.label{display:block;font-weight:700;margin-bottom:6px}
.input, .file {width:100%;padding:10px;border-radius:8px;border:1px solid #e6e9ef}
.btn{display:inline-block;padding:10px 16px;border-radius:10px;text-decoration:none;font-weight:700}
.btn-primary{background:linear-gradient(90deg,#f59e0b,#ef4444);color:#fff;border:none}
.small{font-size:13px;color:#6b7280}
.notice{background:#fffbeb;border:1px solid #f5deb3;padding:10px;border-radius:8px;margin-bottom:12px}
</style>

<div class="profile-edit-wrap">
  <div class="card">
    <h2 style="margin:0 0 14px 0">Edit Profile</h2>

    @if(session('success'))
      <div class="notice">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-left">
          <div class="form-row">
            <label class="label">Name</label>
            <input name="name" class="input" value="{{ old('name', $user->name) }}">
            @error('name') <div class="small" style="color:#dc2626">{{ $message }}</div> @enderror
          </div>

          <div class="form-row">
            <label class="label">Email</label>
            <input name="email" class="input" value="{{ old('email', $user->email) }}">
            @error('email') <div class="small" style="color:#dc2626">{{ $message }}</div> @enderror
          </div>

          <div style="margin-top:14px">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <a href="{{ route('profile') }}" class="btn" style="margin-left:8px">Cancel</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection