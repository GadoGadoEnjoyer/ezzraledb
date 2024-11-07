<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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
    <form action="{{ route('updateUser', $user->id) }}" method="POST">
        <h2>Update User</h2>
        @csrf
        @method('PUT')
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>

        <label for="role">Role</label>
        <input type="text" id="role" name="role" value="{{ $user->role }}" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password">

        <button type="submit">Update</button>
    </form>
</body>
</html>
