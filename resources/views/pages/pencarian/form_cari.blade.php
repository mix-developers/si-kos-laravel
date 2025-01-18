<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Form Action should point to the search route -->
                <form action="{{ route('search-kos') }}" method="GET">
                    <div class="mb-3">
                        <label for="price_min">Pilih Kisaran Harga KOS (cth. 100000)</label>
                        <div class="input-group">
                            <input type="number" name="price_min" id="price_min" aria-label="Harga minimum"
                                class="form-control" value="{{ request('price_min') }}" placeholder="Harga minimum">
                            <input type="number" name="price_max" id="price_max" aria-label="Harga maximum"
                                class="form-control" value="{{ request('price_max') }}" placeholder="Harga maximum">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="peruntukan">Pilih Peruntukan</label>
                                <select class="form-control" name="peruntukan" id="peruntukan">
                                    <option value="">Semua</option>
                                    <option value="Campuran"
                                        {{ request('peruntukan') == 'Campuran' ? 'selected' : '' }}>Campuran</option>
                                    <option value="Putri" {{ request('peruntukan') == 'Putri' ? 'selected' : '' }}>
                                        Putri</option>
                                    <option value="Putra" {{ request('peruntukan') == 'Putra' ? 'selected' : '' }}>
                                        Putra</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Pilih Alamat Jalan</label>
                                <select class="form-control" name="id_jalan">
                                    <option>Semua Jalan</option>
                                    @foreach (App\Models\Jalan::with(['kelurahan'])->get() as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request('id_jalan') == $item->id ? 'selected' : '' }}>{{ $item->jalan }}
                                            -
                                            {{ $item->kelurahan->kelurahan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        {{-- // Filter fasilitas pada form --}}
                        <div class="col-lg-6">
                            <h5>Filter Fasilitas</h5>
                            @foreach (App\Models\FasilitasKos::all() as $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="fasilitas-{{ $item->id }}"
                                        name="fasilitas[]" value="{{ $item->id }}"
                                        @if (in_array($item->id, request('fasilitas', []))) checked @endif>
                                    <label class="form-check-label" for="fasilitas-{{ $item->id }}">
                                        {{ $item->nama_fasilitas }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-6">
                            <h5>Filter Jumlah Fasilitas</h5>
                            {{-- // Filter berdasarkan jumlah fasilitas --}}
                            <div class="row">

                                @foreach (App\Models\FasilitasKos::all() as $item)
                                    <div class="col-6">
                                        <label for="jumlah-{{ $item->id }}">{{ $item->nama_fasilitas }}</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" id="jumlah-{{ $item->id }}"
                                            name="jumlah[{{ $item->id }}]" min="0" max="5"
                                            value="{{ old('jumlah.' . $item->id, request('jumlah.' . $item->id, 0)) }}"
                                            class="p-1 mb-3">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" style="width: 100%;">Cari KOS</button>
                </form>
            </div>
        </div>
    </div>
</section>
