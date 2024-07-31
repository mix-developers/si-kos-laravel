<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Form Action should point to the search route -->
                <form action="{{ route('search-kos') }}" method="GET">
                    <div class="mb-3">
                        <label for="price_min">Pilih Kisaran Harga KOS (cth. 100000)</label>
                        <div class="input-group">
                            <input type="number" name="price_min" id="price_min" 
                                   aria-label="Harga minimum" class="form-control"
                                   value="{{ request('price_min') }}" placeholder="Harga minimum">
                            <input type="number" name="price_max" id="price_max"
                                   aria-label="Harga maximum" class="form-control"
                                   value="{{ request('price_max') }}" placeholder="Harga maximum">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="peruntukan">Pilih Peruntukan</label>
                        <select class="form-control" name="peruntukan" id="peruntukan">
                            <option value="">Semua</option>
                            <option value="Campuran" {{ request('peruntukan') == 'Campuran' ? 'selected' : '' }}>Campuran</option>
                            <option value="Putri" {{ request('peruntukan') == 'Putri' ? 'selected' : '' }}>Putri</option>
                            <option value="Putra" {{ request('peruntukan') == 'Putra' ? 'selected' : '' }}>Putra</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" style="width: 100%;">Cari KOS</button>  
                </form>
            </div>
        </div>
    </div>
</section>
