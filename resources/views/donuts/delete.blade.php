@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f9fafb;
    }
    h1 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #b91c1c;
    }
    .delete-container {
        max-width: 500px;
        margin: 50px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
    }
    .delete-container p {
        font-size: 1.1rem;
        margin-bottom: 25px;
        color: #374151;
    }
    .btn-danger {
        background: #dc2626;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    .btn-danger:hover {
        background: #b91c1c;
    }
    .btn-secondary {
        background: #6b7280;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        color: #fff;
        font-weight: bold;
        text-decoration: none;
        margin-left: 10px;
        transition: background 0.2s ease;
    }
    .btn-secondary:hover {
        background: #4b5563;
    }
</style>

<div class="delete-container">
    <h1>Delete Donut</h1>

    <p>Are you sure you want to delete <strong>{{ $donut->flavor }}</strong>?</p>

    <form action="{{ route('donuts.destroy', $donut->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-danger">Yes, Delete</button>
        <a href="{{ route('donuts.index') }}" class="btn-secondary">Cancel</a>
    </form>
</div>
@endsection
