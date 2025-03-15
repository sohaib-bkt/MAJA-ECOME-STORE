<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h1>Create Product</h1>

    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
        </div>

        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <div>
            <label for="images">Images (multiple):</label>
            <input type="file" id="images" name="images[]" accept="image/*" multiple required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
