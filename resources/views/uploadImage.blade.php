<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Upload Image</h2>
    <form action="{{ route('uploadImage', $sparepart->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="alt_text" class="form-control" placeholder="Enter Name">
        <div class="form-group">
            <label for="image">Choose Image</label>
            <input type="file" class="form-control" name="image_path" id="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
</body>
</html>
