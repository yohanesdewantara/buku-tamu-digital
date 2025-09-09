<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
        }

        th {
            background: #eee;
        }

        h2 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Laporan Buku Tamu</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Keperluan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Kategori</th>
                <th>Dibuat Oleh</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            @foreach($guests as $g)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $g->name }}</td>
                    <td>{{ $g->institution }}</td>
                    <td>{{ $g->purpose }}</td>
                    <td>{{ $g->visit_date?->format('d/m/Y') }}</td>
                    <td>{{ $g->visit_time?->format('H:i') }}</td>
                    <td>{{ $g->category->name ?? '-' }}</td>
                    <td>{{ $g->creator->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
