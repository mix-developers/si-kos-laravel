@php
    use App\Models\SewaKos;
    use App\Mail\ExpiredNotification;
    use Illuminate\Support\Facades\Mail;
    use Carbon\Carbon;

    $errors = []; // Untuk menampung pesan error
    $success = []; // Untuk menampung pesan sukses

    $sewaKosList = SewaKos::all();

    foreach ($sewaKosList as $sewaKos) {
        try {
            // Hitung tanggal akhir sewa
            $tanggalAkhir = Carbon::parse($sewaKos->tanggal_sewa)->addMonths($sewaKos->jangka_waktu);

            // Hitung selisih hari
            $selisihHari = Carbon::now()->diffInDays($tanggalAkhir, false);

            // Jika kurang dari 7 hari dan belum lewat
            if ($selisihHari > 0 && $selisihHari <= 7) {
                $kos = $sewaKos->kos; // Relasi ke model Kos
                Mail::to($sewaKos->user->email)->send(new ExpiredNotification($sewaKos, $kos, $sewaKos->id_user));
                $success[] = "Email berhasil dikirim ke {$sewaKos->user->email}";
            }
        } catch (\Exception $e) {
            $errors[] = "Gagal mengirim email ke {$sewaKos->user->email}: {$e->getMessage()}";
        }
    }
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('frontend_theme') }}/fonts/icomoon/style.css" />
    <link rel="stylesheet" href="{{ asset('frontend_theme') }}/fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="{{ asset('frontend_theme') }}/css/tiny-slider.css" />
    <link rel="stylesheet" href="{{ asset('frontend_theme') }}/css/aos.css" />
    <link rel="stylesheet" href="{{ asset('frontend_theme') }}/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>
        {{ $title ?? '' . env('APP_NAME') }}
    </title>
    @stack('css')
</head>

<body data-aos-easing="slide" data-aos-duration="800" data-aos-delay="0">
    <script>
        @if (!empty($errors))
            // Menampilkan pesan error
            console.log("Error:\n{!! implode('\n', $errors) !!}");
        @endif

        @if (!empty($success))
            // Menampilkan pesan sukses
            console.log("Sukses:\n{!! implode('\n', $success) !!}");
        @endif
    </script>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>
    @include('layouts.frontend.menu_front')
    @yield('content')
    <!-- /.site-footer -->
    @include('layouts.frontend.footer')
    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script src="{{ asset('frontend_theme') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend_theme') }}/js/tiny-slider.js"></script>
    <script src="{{ asset('frontend_theme') }}/js/aos.js"></script>
    <script src="{{ asset('frontend_theme') }}/js/navbar.js"></script>
    <script src="{{ asset('frontend_theme') }}/js/counter.js"></script>
    <script src="{{ asset('frontend_theme') }}/js/custom.js"></script>
    @stack('js')
</body>

</html>
