<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Type</title>
</head>
<body>
    <h2>Assign Type</h2>
    {{$sparepart}}
    <form action="{{ route('assignType', ['id' => $sparepart->id]) }}" method="POST">
        @csrf
        @foreach ($sparepartTypes as $type)
            <div>
                <input type="checkbox" id="type_{{ $type->id }}" name="types[]" value="{{ $type->id }}">
                <label for="type_{{ $type->id }}">{{ $type->name }}</label>
            </div>
        @endforeach

        <button type="submit">Assign Type</button>
    </form>

</body>
</html>
