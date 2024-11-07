<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Type</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4; /* Light background color */
        }

        .container {
            width: 400px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sparepart-info {
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .checkbox-group {
            margin-top: 10px;
        }

        input[type="checkbox"] {
            margin-right: 10px; /* Space between checkbox and label */
        }

        label {
            margin-left: 5px; /* Space between checkbox and label */
        }

        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%; /* Full width button */
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Assign Type</h2>
        <div class="sparepart-info">
            {{ $sparepart->name }} <!-- Display the spare part name -->
        </div>
        <form action="{{ route('assignType', ['id' => $sparepart->id]) }}" method="POST">
            @csrf
            <div class="checkbox-group">
                @foreach ($sparepartTypes as $type)
                    <div>
                        <input type="checkbox" id="type_{{ $type->id }}" name="types[]" value="{{ $type->id }}">
                        <label for="type_{{ $type->id }}">{{ $type->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit">Assign Type</button>
        </form>
    </div>
</body>
</html>
