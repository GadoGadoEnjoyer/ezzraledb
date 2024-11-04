<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Movement Record</title>
</head>
<body>
    <h2>Add Movement Record</h2>

    <form action="{{ route('uploadMoveRecord') }}" method="POST">
        @csrf

        <div>
            <label for="sparepart_id">Spare Part</label>
            <select name="sparepart_id" id="sparepart_id">
                @foreach ($spareparts as $sparepart)
                    <option value="{{ $sparepart->id }}">{{ $sparepart->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="movement_type">Type</label>
            <select name="movement_type" id="movement_type">
                <option value="in">In</option>
                <option value="out">Out</option>
            <label for="qty">Quantity</label>
            <input type="number" id="qty" name="qty" required>
            <label for="reason">Reason</label>
            <textarea id="reason" name="reason"></textarea>
            <label for="value">Value</label>
            <input type="number" id="value" name="value" required>
        </div>


        <button type="submit">Add Movement Record</button>
    </form>
</body>
</html>
