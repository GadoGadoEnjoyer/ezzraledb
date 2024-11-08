<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movement Records</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/table-sort-js/table-sort.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            cursor: pointer;
        }

        th:hover {
            background-color: #e9e9e9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h2>Movement Records</h2>
    <table id="movementsTable" class="table-sort table-arrows">
        <thead>
            <tr>
                <th>Spare Part Name</th>
                <th>Movement Type</th>
                <th data-sort-method="number">Quantity</th>
                <th>Reason</th>
                <th data-sort-method="number">Value</th>
                <th data-sort-method="date">Created At</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($movements as $movement)
                <tr>
                    <td>{{ $movement->sparepart->name }}</td>
                    <td>{{ ucfirst($movement->movement_type) }}</td>
                    <td>{{ $movement->qty }}</td>
                    <td>{{ $movement->reason }}</td>
                    <td>{{ $movement->value }}</td>
                    <td>{{ $movement->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Tablesort(document.getElementById('movementsTable'));
        });
    </script>
</body>
</html>
