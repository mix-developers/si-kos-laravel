@extends('layouts.frontend.app')

@section('content')
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('frontend_theme') }}/images/hero_bg_1.jpg')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading aos-init aos-animate" data-aos="fade-up">{{ $title ?? 'judul' }}</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200" class="aos-init aos-animate">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                {{ $title ?? 'judul' }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-6 mb-3">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="col-6 mb-3">
                        <input type="email" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="col-12 mb-3">
                        <input type="text" class="form-control" placeholder="Subject">
                    </div>
                    <div class="col-12 mb-3">
                        <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                    </div>

                    <div class="col-12">
                        <input type="submit" value="Send Message" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
