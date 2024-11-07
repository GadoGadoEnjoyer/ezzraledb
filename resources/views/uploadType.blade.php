<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Type</title>
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

        label {
            margin-top: 10px;
            display: block; /* Makes the label take a full line */
        }

        input {
            margin-top: 5px;
            padding: 10px;
            width: 100%; /* Full width input */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Ensures padding is included in the width */
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
        <h2>Add New Type</h2>

        <form action="{{ route('uploadType') }}" method="POST">
            @csrf

            <label for="name">Type Name</label>
            <input type="text" id="name" name="name" required>

            <button type="submit">Add Type</button>
        </form>
    </div>
</body>
</html>
