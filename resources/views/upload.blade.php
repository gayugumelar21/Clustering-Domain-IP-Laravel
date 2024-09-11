<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek IP Address</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9; /* Light green background */
            color: #2e7d32; /* Darker green text */
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #1b5e20; /* Dark green for the heading */
        }

        form {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #a5d6a7; /* Light green border */
            border-radius: 8px;
            background-color: #ffffff; /* White background for forms */
        }

        input[type="file"], select, button {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #a5d6a7; /* Light green border */
            border-radius: 4px;
        }

        button {
            background-color: #81c784; /* Medium green background for buttons */
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #66bb6a; /* Darker green on hover */
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .success {
            background-color: #c8e6c9; /* Light green for success messages */
            color: #2e7d32; /* Dark green text */
        }

        .error {
            background-color: #ffcdd2; /* Light red for error messages */
            color: #c62828; /* Dark red text */
        }
    </style>
</head>
<body>
    <h1>Unggah File Domain</h1>

    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="domain_file" required>
        <button type="submit">Unggah dan Cek IP</button>
    </form>

    <form action="{{ route('results') }}" method="POST">
        @csrf
        <label for="ip_class">Pilih kelas IP:</label>
        <select name="ip_class" id="ip_class" required>
            <option value="Class A">Class A</option>
            <option value="Class B">Class B</option>
            <option value="Class C">Class C</option>
        </select>
        <button type="submit">Tampilkan Hasil</button>
    </form>
</body>
</html>
