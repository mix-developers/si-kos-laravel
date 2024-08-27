<!DOCTYPE html>
<html>

<head>
    <title>Pemberitahuan Penyewaan Kos</title>
</head>

<body>
    <h1>Pengajuan Penyewaan Kos</h1>
    <p>Halo,</p>
    <p>Kos kamu ada yang mau nyewa loh, dengan data sebagai berikut:</p>
    <ul>
        <li><strong>Nama Penyewa:</strong> {{ $sewa->nama_penyewa }}</li>
        <li><strong>Jumlah Orang:</strong> {{ $sewa->jumlah_orang }}</li>
        <li><strong>Jangka Waktu:</strong> {{ $sewa->jangka_waktu }}</li>
        <li><strong>Tanggal Sewa:</strong> {{ $sewa->tanggal_sewa }}</li>
        <li><strong>Nama Kos:</strong> {{ $kos->nama_kos }}</li>
    </ul>
    <p>Yuk login dan cek pada website..</p>
</body>

</html>
