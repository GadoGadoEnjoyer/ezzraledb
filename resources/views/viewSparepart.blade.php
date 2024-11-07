<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spare Parts List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sparepart-card {
            width: 300px;
            padding: 15px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        input[type="text"] {
            width: 300px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form {
            margin-bottom: 20px;
        }


    </style>
</head>
<body>
    @if(auth()->user() && auth()->user()->role == 'admin')
        <a href="{{ route('adminPage') }}" class="btn">Back to Admin</a>
    @endif
    <div class="container">
        <h2>Spare Parts List</h2>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
         @endif
        <!-- Search by name form -->
        <form action="{{ route('viewSparepart') }}" method="GET">
            <input type="text" name="query" placeholder="Search by name...">
            <button type="submit">Search</button>
        </form>

        <div id="spareparts-list">
            @forelse($spareparts as $sparepart)
                <div class="sparepart-card">
                    <h3>{{ $sparepart->name }}</h3>
                    <p>Description: {{ $sparepart->description }}</p>
                    <p>Current Quantity: {{ $sparepart->current_qty }}</p>
                    <p>Status: {{ $sparepart->status }}</p>
                    <a href="{{ route('viewSparepartDetail', $sparepart->id) }}">
                        <button>View Details</button>
                    </a>
                </div>
            @empty
                <p>No spare parts found matching your criteria.</p>
            @endforelse
        </div>

        <!-- Custom pagination controls -->
        <div class="custom-pagination">
            @if ($spareparts->onFirstPage())
                <span class="disabled">Previous</span>
            @else
                <a href="{{ $spareparts->previousPageUrl() }}">Previous</a>
            @endif

            <!-- Loop through the page numbers -->
            @for ($i = 1; $i <= $spareparts->lastPage(); $i++)
                <a href="{{ $spareparts->url($i) }}" class="{{ $i == $spareparts->currentPage() ? 'active' : '' }}">
                    {{ $i }}
                </a>
            @endfor

            @if ($spareparts->hasMorePages())
                <a href="{{ $spareparts->nextPageUrl() }}">Next</a>
            @else
                <span class="disabled">Next</span>
            @endif
        </div>

</body>
</html>

