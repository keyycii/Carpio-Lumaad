@extends('layouts.app')

@section('content')
<style>
    .frappe-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .frappe-card {
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

    .frappe-card:hover {
        transform: translateY(-5px);
    }

    .frappe-title {
        color: #4a5568;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
        background: linear-gradient(45deg, #667eea, #764ba2);
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
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-1px);
    }

    .form-input:hover {
        border-color: #cbd5e0;
    }

    .file-input-container {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .file-input {
        width: 100%;
        padding: 1rem;
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        cursor: pointer;
        box-sizing: border-box;
        text-align: center;
        color: #667eea;
        font-weight: 500;
    }

    .file-input:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    .file-input::-webkit-file-upload-button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        margin-right: 1rem;
        transition: all 0.3s ease;
    }

    .file-input::-webkit-file-upload-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 10px rgba(102, 126, 234, 0.3);
    }

    .submit-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .image-preview {
        position: relative;
        margin-top: 1rem;
        text-align: center;
        display: none;
    }

    .preview-image {
        max-width: 200px;
        max-height: 200px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .frappe-container {
            padding: 1rem;
        }
        
        .frappe-card {
            padding: 2rem;
            margin: 1rem;
        }
        
        .frappe-title {
            font-size: 2rem;
        }
    }
</style>

<div class="frappe-container">
    <div class="frappe-card">
        <h1 class="frappe-title">Add Frappe</h1>
        
        <form action="{{ route('frappes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-input" placeholder="Enter frappe name" required>
            </div>
            
            <div class="form-group">
                <label for="size" class="form-label">Size</label>
                <input type="text" name="size" id="size" class="form-input" placeholder="e.g., Small, Medium, Large" required>
            </div>
            
            <div class="form-group">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-input" placeholder="0.00" step="0.01" required>
            </div>
            
            <div class="form-group">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-input" placeholder="Enter stock quantity" required>
            </div>
            
            <div class="file-input-container">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="file-input" accept="image/*" required>
                <div class="image-preview" id="imagePreview">
                    <img class="preview-image" id="previewImg" alt="Preview">
                </div>
            </div>
            
            <button type="submit" class="submit-btn">Save</button>
        </form>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').style.display = 'none';
    }
});
</script>
@endsection@extends('layouts.app')

@section('content')
<style>
    .frappe-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .frappe-card {
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

    .frappe-card:hover {
        transform: translateY(-5px);
    }

    .frappe-title {
        color: #4a5568;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
        background: linear-gradient(45deg, #667eea, #764ba2);
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
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-1px);
    }

    .form-input:hover {
        border-color: #cbd5e0;
    }

    .file-input-container {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .file-input {
        width: 100%;
        padding: 1rem;
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        cursor: pointer;
        box-sizing: border-box;
        text-align: center;
        color: #667eea;
        font-weight: 500;
    }

    .file-input:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    .file-input::-webkit-file-upload-button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        margin-right: 1rem;
        transition: all 0.3s ease;
    }

    .file-input::-webkit-file-upload-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 10px rgba(102, 126, 234, 0.3);
    }

    .submit-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .image-preview {
        position: relative;
        margin-top: 1rem;
        text-align: center;
        display: none;
    }

    .preview-image {
        max-width: 200px;
        max-height: 200px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .frappe-container {
            padding: 1rem;
        }
        
        .frappe-card {
            padding: 2rem;
            margin: 1rem;
        }
        
        .frappe-title {
            font-size: 2rem;
        }
    }
</style>

<div class="frappe-container">
    <div class="frappe-card">
        <h1 class="frappe-title">Add Frappe</h1>
        
        <form action="{{ route('frappes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-input" placeholder="Enter frappe name" required>
            </div>
            
            <div class="form-group">
                <label for="size" class="form-label">Size</label>
                <input type="text" name="size" id="size" class="form-input" placeholder="e.g., Small, Medium, Large" required>
            </div>
            
            <div class="form-group">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-input" placeholder="0.00" step="0.01" required>
            </div>
            
            <div class="form-group">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-input" placeholder="Enter stock quantity" required>
            </div>
            
            <div class="file-input-container">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="file-input" accept="image/*" required>
                <div class="image-preview" id="imagePreview">
                    <img class="preview-image" id="previewImg" alt="Preview">
                </div>
            </div>
            
            <button type="submit" class="submit-btn">Save</button>
        </form>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').style.display = 'none';
    }
});
</script>
@endsection