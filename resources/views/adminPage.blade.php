<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        h1 {
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        nav ul li {
            margin: 0 10px;
            text-align: center;
        }
        .link-group {
            margin-bottom: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <h1>Admin Dashboard</h1>
    <div class="container">
        <nav>
            <ul>
                <div class="link-group">
                    <li><a href="{{ route('createUser') }}">Create Users</a></li>
                    <li><a href="{{ route('viewUser') }}">View Users</a></li>
                </div>
                <div class="link-group">
                    <li><a href="{{ route('uploadSparepartForm') }}">Upload Sparepart</a></li>
                    <li><a href="{{ route('viewSparepart') }}">View Sparepart</a></li>
                </div>
            </ul>
        </nav>
    </div>
</body>
</html>
