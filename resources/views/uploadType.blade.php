<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Type</title>
</head>
<body>
    <h2>Add New Type</h2>

    <form action="{{ route('uploadType') }}" method="POST">
        @csrf

        <div>
            <label for="name">Type Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <button type="submit">Add Type</button>
    </form>

</body>
</html>
