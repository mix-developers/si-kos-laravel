<!DOCTYPE html>
<html>

<head>
    <title>Pemberitahuan penyewaan Kos Akan berakhir</title>
</head>

<body>
    <h1>Penyewaan Kos akan berakhir</h1>
    <p>Halo {{ $sewa->user->name }},</p>
    <p>Masa sewa Anda untuk kos <strong>{{ $kos->nama }}</strong> akan berakhir pada
        <strong>{{ $sewa->tanggal_sewa->addMonths($sewa->jangka_waktu)->format('d M Y') }}</strong>.
    </p>
    <p>Kos yang kamu sewa akan segera berakhir dalam 1 minggu. dengan keterangan penyewaan :</p>
    <ul>
        <li><strong>Nama Penyewa:</strong> {{ $sewa->nama_penyewa }}</li>
        <li><strong>Jumlah Orang:</strong> {{ $sewa->jumlah_orang }}</li>
        <li><strong>Jangka Waktu:</strong> {{ $sewa->jangka_waktu }}</li>
        <li><strong>Tanggal Sewa:</strong> {{ $sewa->tanggal_sewa }}</li>
        <li><strong>Tanggal Berakhir:</strong>
            {{ date('Y-m-d', strtotime($sewa->tanggal_sewa . ' +' . $sewa->jangka_waktu . ' months')) }}</li>
        <li><strong>Nama Kos:</strong> {{ $kos->nama_kos }}</li>
    </ul>
    <p>Ajukan penyewaan ulang dalam 1 minggu yang akan datang untuk memperpanjang sewa</p>
    <p>Terima kasih,</p>
</body>

</html>
