<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Type</title>
</head>
<body>
    <h2>Add New Type</h2>

    <form action="{{ route('uploadSparepart') }}" method="POST">
        @csrf

        <div>
            <label for="name">Spare Part Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="description">Description (Optional)</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <button type="submit">Add Spare Part</button>
    </form>
</body>
</html>
