<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sparepart</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif; /* Optional: Add a font for better appearance */
        }

        form {
            display: flex;
            flex-direction: column;
            width: 300px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        label {
            margin-top: 10px;
        }

        input, textarea {
            margin-top: 5px;
            padding: 5px;
            border: 1px solid #ccc; /* Add border to inputs */
            border-radius: 4px; /* Rounded corners */
        }

        textarea {
            resize: none; /* Prevent resizing */
            height: 80px; /* Fixed height for the textarea */
        }

        button {
            margin-top: 10px;
            padding: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px; /* Rounded corners for button */
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <form action="{{ route('editSparepart', $sparepart->id) }}" method="POST">
        <h2>Edit Sparepart</h2>
        @csrf
        @method('PUT')
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <div>
            <label for="name">Spare Part Name</label>
            <input type="text" id="name" name="name" value="{{$sparepart->name}}" required>
        </div>

        <div>
            <label for="description">Description (Optional)</label>
            <textarea id="description" name="description">{{$sparepart->description}}</textarea>
        </div>

        <div>
            <label for="status">Status</label>
            <input type="text" id="status" name="status" value="{{$sparepart->status}}" required>
        </div>

        <button type="submit">Edit Spare Part</button>
    </form>
</body>
</html>
