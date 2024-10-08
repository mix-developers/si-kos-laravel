<!-- Modal for Create and Edit -->
<div class="modal fade" id="createKelurahan" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah Kelurahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="kelurahanForm">
                    <div class="mb-3">
                        <label for="formCreateKelurahan" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" id="formCreateKelurahan" name="kelurahan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createKelurahanBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createJalan" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah Jalan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="jalanForm">
                    <div class="mb-3">
                        <label for="formCreateJalan" class="form-label">Pilih Kelurahan</label>
                        <select class="form-select" id="formCreateIdKelurahan" name="id_kelurahan" required>
                            @foreach (App\Models\Kelurahan::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->kelurahan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formCreateJalan" class="form-label">Jalan</label>
                        <input type="text" class="form-control" id="formCreateJalan" name="jalan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createJalanBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>
//edit
<!-- Modal for Create and Edit -->
<div class="modal fade" id="updateKelurahanModal" tabindex="-1" aria-labelledby="customersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Kelurahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="kelurahanFormUpdate">
                    <input type="hidden" name="id" id="formKelurahanId">
                    <div class="mb-3">
                        <label for="formCreateKelurahan" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" id="formUpdateKelurahan" name="kelurahan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateKelurahanBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="updateJalanModal" tabindex="-1" aria-labelledby="customersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Jalan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="jalanFormUpdate">
                    <input type="hidden" name="id" id="formJalanId">
                    <div class="mb-3">
                        <label for="formCreateJalan" class="form-label">Pilih Kelurahan</label>
                        <select class="form-select" id="formUpdateIdKelurahan" name="id_kelurahan" required>
                            @foreach (App\Models\Kelurahan::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->kelurahan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formCreateJalan" class="form-label">Jalan</label>
                        <input type="text" class="form-control" id="formUpdateJalan" name="jalan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateJalanBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>
