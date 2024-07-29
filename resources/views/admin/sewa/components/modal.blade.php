<!-- Modal for Create and Edit -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Detail Penyewaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered">
                    <tr>
                        <td><strong>Nama Penyewa</strong></td>
                        <td><span id="namaPenyewa"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Pengajuan Masuk</strong></td>
                        <td><span id="tanggalPengajuan"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Jangka Waktu Penyewaan</strong></td>
                        <td><span id="jangkaWaktu"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Jumlah Orang</strong></td>
                        <td><span id="jumlahOrang"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Pembayaran</strong></td>
                        <td class="text-danger fw-bold">Rp <span id="pembayaran"></span></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
