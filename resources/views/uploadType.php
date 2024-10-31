<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Spare Part</title>
</head>
<body>
    <h2>Add New Spare Part</h2>

    <form action="{{ route('uploadSparepart') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div>
            <label for="name">Spare Part Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="current_qty">Quantity</label>
            <input type="number" id="current_qty" name="current_qty" min="0" required>
        </div>

        <div>
            <label for="description">Description (Optional)</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <button type="submit">Add Spare Part</button>
    </form>
</body>
</html>
