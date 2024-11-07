<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movement Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Movement Record for<br>{{$sparepart->name}}</h2>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('uploadMoveRecord', ['id' => $sparepart->id]) }}" method="POST">
            @csrf
            <div>
                <label for="movement_type">Type</label>
                <select name="movement_type" id="movement_type" required>
                    <option value="in">In</option>
                    <option value="out">Out</option>
                </select>
            </div>

            <div>
                <label for="qty">Quantity</label>
                <input type="number" id="qty" name="qty" min="1" required>
            </div>

            <div>
                <label for="reason">Reason</label>
                <textarea id="reason" name="reason" rows="3"></textarea>
            </div>

            <div>
                <label for="value">Value</label>
                <input type="number" id="value" name="value" min="0" required>
            </div>

            <button type="submit">Add Movement Record</button>
        </form>
    </div>
</body>
</html>
