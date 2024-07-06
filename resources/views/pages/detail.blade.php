@extends('layouts.frontend.app')

@section('content')
    <div class="hero">
        <div class="hero-slide">
            @if ($kos->foto_1 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_1) }}')">
                </div>
            @endif
            @if ($kos->foto_2 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_2) }}')">
                </div>
            @endif
            @if ($kos->foto_3 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_3) }}')">
                </div>
            @endif
            @if ($kos->foto_4 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_4) }}')">
                </div>
            @endif
            @if ($kos->foto_5 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_5) }}')">
                </div>
            @endif
            @if ($kos->foto_6 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_6) }}')">
                </div>
            @endif

        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center">
                    <h1 class="heading" data-aos="fade-up">
                        {{ $title }}
                    </h1>
                    <h5 class="text-white" data-aos="fade-up">Selamat datang di <mark>{{ $kos->nama_kos }}</mark>
                        <br>Pemilik :
                        {{ $kos->nama_pemilik }}
                        <br>Alamat :
                        {{ $kos->alamat_kos }}
                    </h5>

                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                @if ($kos->foto_1 != null)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                        <img src="{{ Storage::url($kos->foto_1) }}" alt="Image" class="img-fluid">
                    </div>
                @endif
                @if ($kos->foto_2 != null)
                    <div class="col-md-4 mt-lg-5" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ Storage::url($kos->foto_2) }}" alt="Image" class="img-fluid">
                    </div>
                @endif
                @if ($kos->foto_3 != null)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ Storage::url($kos->foto_3) }}" alt="Image" class="img-fluid">
                    </div>
                @endif

            </div>

        </div>
    </div>
    <section class="section">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <h1 class="mb-3">{{ $kos->nama_kos }} </h1>
                    <div class="d-flex align-items-center mb-4">
                        <strong class="p-2 border rounded text-success"
                            style="font-size: 14px;">{{ $kos->peruntukan }}</strong>
                        <i class="icon-star mx-2 text-success"></i> <b>5.0</b>
                        <span class="mx-2"> | Pemilik : {{ $kos->nama_pemilik }}</span>
                        <span class="mx-2"> | Alamat : {{ $kos->alamat_kos }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <h4><span class="icon-home2"></span> Banyak pilihan kamar untukmu</h4>
                        <a class="btn btn-primary btn-sm"
                            href="https://api.whatsapp.com/send?text={{ urlencode('Dengan harga Rp ' . number_format($kos->harga_kos) . ' kamu sudah bisa sewa di kos : ' . $kos->nama_kos . ', yuk cek di sini : ' . url('/kos', $kos->slug)) }}"
                            target="_blank">Bagikan KOS ini ke rekan anda di
                            WhatsApp</a>
                    </div>
                    <hr>
                    <h3 class="fw-bold">KOS ini menyediakan</h3>
                    <div class="mb-3 border p-3">
                        <span class="h1">{{ $kos->jumlah_pintu }}</span> <span class="text-black"
                            style="font-size:16px;">Pintu/KOS </span><br>
                        <div class="d-flex align-items-center h6 text-black">
                            <strong>Status KOS : </strong> <span
                                class="badge bg-{{ $kos->status == 'Open' ? 'success' : 'danger' }} mx-2">{{ $kos->status }}</span>
                        </div>
                        <div class="d-flex align-items-center h6 text-black">
                            <strong> Pintu/KOS Tersedia : </strong> <span
                                class="badge bg-success mx-2">{{ $kos->jumlah_pintu }}</span>
                        </div>
                    </div>
                    <h3 class="fw-bold">Yang Kamu dapatkan di KOS ini</h3>
                    <div class="row my-3">
                        @foreach (App\Models\FasilitasUmumKos::with(['fasilitas'])->where('id_kos', $kos->id)->where('ketersediaan', 1)->get() as $item)
                            <div class="col-md-6">
                                <div class="box-feature border mb-4 p-3">
                                    <span class="flaticon-house-2 mb-4 d-block-3"></span>
                                    <h3 class="text-black mb-3 fw-bold">{{ $item->fasilitas->nama_fasilitas }}
                                    </h3>
                                    <p>Jumlah : {{ $item->jumlah }} ({{ $item->milik }})</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <h3 class="fw-bold">Fasilitas Tambahan</h3>
                    <div class="row my-3">
                        @foreach (App\Models\FasilitasTambahanKos::where('id_kos', $kos->id)->get() as $item)
                            <div class="col-md-6">
                                <div class="box-feature border mb-4 p-3">
                                    <span class="flaticon-house-2 mb-4 d-block-3"></span>
                                    <h3 class="text-black mb-3 fw-bold">{{ $item->nama_fasilitas }}
                                    </h3>
                                    <p>Jumlah : {{ $item->jumlah }} ({{ $item->milik }})</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <h3 class="fw-bold">Ketentuan KOS</h3>
                    <p class="p-3 border">
                        {{ $kos->ketentuan_kos }}
                    </p>
                    <h3 class="fw-bold">Keterangan KOS</h3>
                    <p class="p-3 border">
                        {{ $kos->keterangan_kos }}
                    </p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="p-3 shadow-lg">
                        <div class="d-flex align-items-center mb-3">
                            <h2 class="mx-2 fw-bold">Rp {{ number_format($kos->harga_kos) }}</h2>
                            (per-bulan)
                        </div>
                        <div class="mb-3">
                            <label>Tanggal masuk</label>
                            <input type="date" class="form-control form-lg" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <a href="https://wa.me/" class="btn  btn-warning" style="display: block;"><i
                                    class="icon-phone"></i>
                                Tanya
                                Pemilik KOS</a>
                        </div>
                        <div class="mb-3">
                            <a href="" class="btn  btn-primary" style="display: block;">Ajukan Sewa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
