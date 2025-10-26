@extends('layouts.app')

@section('content')
<style>
/* Scoped styles for frappes index */
.frappes-viewport{
  min-height: calc(100vh - 80px);
  padding:3rem 1rem;
  box-sizing:border-box;
  display:flex;
  justify-content:center;
  background: linear-gradient(135deg,#f8fafc 0%, #fff 100%);
}
.frappes-wrap{
  width:100%;
  max-width:1100px;
}
.header-row{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:1rem;
}
.h1{font-size:28px;font-weight:800;margin:0;color:#0f172a}
.add-btn{background:linear-gradient(90deg,#10b981,#06b6d4);color:#fff;padding:10px 14px;border-radius:10px;text-decoration:none;font-weight:700;box-shadow:0 6px 18px rgba(6,95,70,0.08)}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:18px}
.card{
  background:#fff;border-radius:12px;padding:12px;border:1px solid rgba(15,23,42,0.04);
  box-shadow:0 10px 30px rgba(2,6,23,0.04);display:flex;flex-direction:column;gap:10px;
}
.card-img{width:100%;height:160px;border-radius:8px;object-fit:cover;background:#f3f4f6}
.card-body{flex:1;display:flex;flex-direction:column;gap:8px}
.title{font-weight:800;color:#0f172a;margin:0;font-size:16px}
.meta{color:#6b7280;font-size:13px}
.row{display:flex;justify-content:space-between;align-items:center;gap:8px}
.price{font-weight:800;color:#111}
.stock{font-weight:700;color:#475569;background:#f1f5f9;padding:6px 8px;border-radius:8px;font-size:13px}
.actions{display:flex;gap:8px}
.btn{padding:8px 10px;border-radius:8px;text-decoration:none;font-weight:700;border:1px solid rgba(15,23,42,0.06);background:#fff;color:#0f172a}
.btn-edit{background:linear-gradient(90deg,#f59e0b,#ef4444);color:#fff;border:none}
.empty{padding:28px;border-radius:12px;text-align:center;color:#475569;background:#fff;border:1px dashed rgba(15,23,42,0.04)}
@media (max-width:600px){
  .card-img{height:120px}
  .h1{font-size:20px}
}
</style>

<div class="frappes-viewport" role="main" aria-label="Frappes">
  <div class="frappes-wrap">
    <div class="header-row">
      <h1 class="h1">Frappes</h1>
      <a href="{{ route('frappes.create') }}" class="add-btn">Add Frappe</a>
    </div>

    @if($frappes->isEmpty())
      <div class="empty">No frappes found. Click "Add Frappe" to create one.</div>
    @else
      <div class="grid" role="list">
        @foreach($frappes as $frappe)
        <article class="card" role="listitem" aria-label="{{ $frappe->name }}">
          @if($frappe->image)
            <img src="{{ asset('storage/' . $frappe->image) }}" alt="{{ $frappe->name }}" class="card-img" onerror="this.src='{{ asset('images/logo.png') }}'">
          @else
            <div class="card-img" aria-hidden style="display:flex;align-items:center;justify-content:center;font-size:28px;color:#0ea5a4">🥤</div>
          @endif

          <div class="card-body">
            <div style="display:flex;justify-content:space-between;align-items:start;gap:8px">
              <div>
                <h2 class="title">{{ \Illuminate\Support\Str::limit($frappe->name, 36) }}</h2>
                <div class="meta">Size: {{ $frappe->size ?? '—' }}</div>
              </div>
              <div style="text-align:right">
                <div class="price">₱{{ number_format($frappe->price, 2) }}</div>
                <div class="stock" style="margin-top:8px">{{ $frappe->stock }} in stock</div>
              </div>
            </div>

            <div style="margin-top:auto" class="row">
              <div class="meta">ID: {{ $frappe->id }}</div>
              <div class="actions" role="group" aria-label="Frappe actions">
                <a href="{{ route('frappes.edit', $frappe->id) }}" class="btn btn-edit">Edit</a>
                <a href="{{ route('frappes.confirm-delete', $frappe->id) }}" class="btn" style="border-color:rgba(239,68,68,0.12);color:#ef4444">Delete</a>
              </div>
            </div>
          </div>
        </article>
        @endforeach
      </div>

      <!-- pagination intentionally omitted (assumes $frappes is a Collection) -->
    @endif
  </div>
</div>
@endsection