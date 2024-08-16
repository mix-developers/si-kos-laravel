<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="hidden" id="formCustomerId" name="id">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Nama Fasilitas</label>
                        <input type="text" class="form-control" id="formCustomerName" name="nama_fasilitas" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCustomerBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Nama Fasilitas</label>
                        <input type="text" class="form-control" id="formCustomerName" name="nama_fasilitas" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createCustomerBtn">Save</button>
            </div>
        </div>
    </div>
</div>
@if (Auth::user()->role == 'Pemilik_kos')
    <div class="modal fade" id="create-fasilitas-tambahan" tabindex="-1" aria-labelledby="customersModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Fasilitas Tambahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for Create and Edit -->
                    <form id="createFasilitasTambahanForm">
                        <input type="hidden" name="id_kos" id="idKos" value="{{ $kos ? $kos->id : null }}">
                        <div class="mb-3">
                            <label for="formCustomerName" class="form-label">Nama Fasilitas</label>
                            <input type="text" class="form-control" id="formCustomerName" name="nama_fasilitas"
                                placeholder="Nama Fasilitas" required>
                        </div>
                        <div class="mb-3">
                            <label for="formCustomerName" class="form-label">Jumlah Fasilitas</label>
                            <input type="number" class="form-control" id="formCustomerName" name="jumlah"
                                value="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="formCustomerName" class="form-label">Kepemilikan Fasilitas</label>
                            <select name="milik" class="form-select">
                                <option value="Pribadi">Pribadi</option>
                                <option value="Bersama">Bersama</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="createFasilitasTambahanBtn">Save</button>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="modal fade" id="editFasiliasUmumModal" tabindex="-1" aria-labelledby="customersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Edit Fasilitas Umum : <span
                        id="namaFasilitasUmum"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="updateFasilitasUmumForm">
                    <input type="hidden" name="id" id="idFasilitasUmum">
                    <div class="mb-3">
                        <label for="jumlahFasilitasUmum" class="form-label">Jumlah Fasilitas</label>
                        <input type="number" class="form-control" id="jumlahFasilitasUmum" name="jumlah" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="">Ketersediaan</label>
                        <div class="form-check form-switch mb-2">

                            <input class="form-check-input" name="ketersediaan" type="checkbox"
                                id="ketersediaanFasilitasUmum" checked value="Y">

                            <label class="form-check-label text-primary" for="flexSwitchCheckChecked">Tersedia</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Kepemilikan Fasilitas</label>
                        <select name="milik" class="form-select" id="milikFasilitasUmums">
                            <option value="Pribadi">Pribadi</option>
                            <option value="Bersama">Bersama</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateFasilitasUmumBtn">Save</button>
            </div>
        </div>
    </div>
</div>
