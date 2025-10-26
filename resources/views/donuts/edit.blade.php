@extends('layouts.app')

@section('content')
<style>
    .donut-container {
        background: linear-gradient(135deg, #ff9a56 0%, #ffad56 50%, #ff6b6b 100%);
        min-height: 100vh;
        padding: 2rem 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .donut-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 0 auto;
        padding: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.3s ease;
    }

    .donut-card:hover {
        transform: translateY(-5px);
    }

    .donut-title {
        color: #4a5568;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
        background: linear-gradient(45deg, #ff6b6b, #ff9a56);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-input {
        width: 100%;
        padding: 1rem;
        border: 2px solid #fed7d7;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #ff6b6b;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        transform: translateY(-1px);
    }

    .form-input:hover {
        border-color: #ff9a56;
    }

    .current-image-section {
        margin-bottom: 1.5rem;
        text-align: center;
        padding: 1.5rem;
        background: rgba(255, 107, 107, 0.05);
        border-radius: 12px;
        border: 2px dashed rgba(255, 107, 107, 0.3);
    }

    .current-image {
        max-width: 200px;
        max-height: 200px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .current-image:hover {
        transform: scale(1.05);
    }

    .image-label {
        color: #ff6b6b;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .file-input {
        width: 100%;
        padding: 1rem;
        border: 2px dashed #ff9a56;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        cursor: pointer;
        box-sizing: border-box;
    }

    .file-input:hover {
        border-color: #ff6b6b;
        background: rgba(255, 107, 107, 0.05);
    }

    .submit-btn {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff9a56 100%);
        color: white;
        padding: 1rem 2.5rem;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .donut-container {
            padding: 1rem;
        }
        
        .donut-card {
            padding: 2rem;
            margin: 1rem;
        }
        
        .donut-title {
            font-size: 2rem;
        }
    }
</style>

<div class="donut-container">
    <div class="donut-card">
        <h1 class="donut-title">Edit Donut</h1>
        
        <form action="{{ route('donuts.update', $donut->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="flavor" class="form-label">Flavor</label>
                <input type="text" name="flavor" id="flavor" class="form-input" value="{{ $donut->flavor }}" required>
            </div>
            
            <div class="form-group">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-input" value="{{ $donut->price }}" step="0.01" required>
            </div>
            
            <div class="form-group">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-input" value="{{ $donut->stock }}" required>
            </div>
            
            @if ($donut->image)
                <div class="current-image-section">
                    <label class="image-label">Current Image</label>
                    <div>
                        <img src="{{ asset('storage/' . $donut->image) }}" alt="Current donut image" class="current-image">
                    </div>
                </div>
            @endif
            
            <div class="form-group">
                <label for="image" class="form-label">Change Image</label>
                <input type="file" name="image" id="image" class="file-input" accept="image/*">
            </div>
            
            <button type="submit" class="submit-btn">Update</button>
        </form>
    </div>
</div>
@endsection