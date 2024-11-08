<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spare Part Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .image-gallery img {
            margin: 5px;
            width: 200px; /* Set a consistent width for images */
            height: auto;
            border-radius: 4px; /* Optional: rounded corners */
        }

        .details, .types {
            margin-bottom: 20px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('adminPage') }}" class="btn">Back</a>
        <h2>{{ $sparepart->name }}</h2>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <div class="details">
            <p><strong>Description:</strong> {{ $sparepart->description }}</p>
            <p><strong>Current Quantity:</strong> {{ $sparepart->current_qty }}</p>
            <p><strong>Current Status:</strong> {{ $sparepart->status}}</p>
        </div>

        <h3>Image Gallery</h3>
        <div class="image-gallery">
            @foreach($images as $image)
                <img src="{{ asset('images/' . $image->image_path) }}" alt="{{ $image->alt_text }}">
            @endforeach
        </div>

        <a href="{{ route('uploadImageForm', ['id' => $sparepart->id]) }}">
            <button>Add Image</button>
        </a>
        <a href="{{ route('uploadMoveRecordForm', ['id' => $sparepart->id]) }}">
            <button>Add Movement Record </button>
        </a>
        <a href="{{ route('editSparepartForm', ['id' => $sparepart->id]) }}">
            <button>Edit Spare Part</button>
        </a>
    </div>
</body>
</html>
