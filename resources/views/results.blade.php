<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pengelompokan IP</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #a5d6a7; /* Light green border */
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #81c784; /* Medium green background for headers */
            color: white; /* White text in header */
        }

        tr:nth-child(even) {
            background-color: #c8e6c9; /* Alternating row color */
        }

        tr:hover {
            background-color: #aed581; /* Highlight row on hover */
        }

        a {
            color: #2e7d32; /* Link color matching the text color */
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline; /* Underline on hover for links */
        }
    </style>
</head>
<body>
    <h1>Hasil Klasifikasi IP: {{ $class }}</h1>

    @if($results->isEmpty())
        <p>Tidak ada data untuk kelas IP {{ $class }}.</p>
    @else
        <table>
            <tr>
                <th>No</th>
                <th>Domain</th>
                <th>IP Address</th>
            </tr>
            @foreach($results as $index => $result)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $result->domain }}</td>
                    <td>{{ $result->ip_address }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <a href="/">Kembali ke Upload</a>
</body>
</html>
