<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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

        input {
            margin-top: 5px;
            padding: 5px;
        }

        button {
            margin-top: 10px;
            padding: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <body>
    <form action="{{ route('createUser')}}" method="POST">
        <h2>Create User</h2>
        @csrf
        @if (session('status'))
        <div class="alert alert-fail">
            {{ session('status') }}
        </div>
        @endif
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="role">Role</label>
        <input type="text" id="role" name="role" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Create</button>
    </form>
</body>
</html>
