<!DOCTYPE html>
<html>

<head>
    <title>Music Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        input[type="file"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2>Music Upload Form</h2>
    <form action="{{ route('upload.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="musicFile">Select a music file:</label>
        <input type="file" name="musicFile" id="musicFile">

        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>

        <label for="title">Title:</label>
        <input type="text" name="title" id="title">

        <label for="author">Author:</label>
        <input type="text" name="author" id="author">

        <input type="submit" value="Upload">
    </form>
</body>

</html>