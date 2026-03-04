<!DOCTYPE html>
<html>
<head>
    <title>Laporan Mahasiswa</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .title { text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="title">LAPORAN DATA MAHASISWA MAGANG</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Universitas</th>
                <th>Divisi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $mhs)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->universitas }}</td>
                <td>{{ $mhs->divisi->nama_divisi }}</td>
                <td>{{ $mhs->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>