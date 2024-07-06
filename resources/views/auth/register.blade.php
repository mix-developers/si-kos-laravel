@extends('layouts.auth.app')

@section('content')
    <div class="card" style="border-radius: 30px;">
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="{{ url('/') }}" class="app-brand-link gap-2">
                        {{-- logo aplikasi  --}}
                        <img src="{{ asset('img/logo.png') }}" alt="logo" style="height: 100px; width:auto;">
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Welcome to <i>{{ env('APP_NAME') ?? 'Laravel' }}</i>👋</h4>
                <p class="mb-4">Silahkan mengisi pendaftaran dibawah</p>

                <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
                    {{-- <input type="hidden" name="role" value="mahasiswa"> --}}

                    <div class="mb-3">
                        <label for="role" class="form-label" id="no-title">Sebagai</label>
                        <select class="form-select" id="role" name="role">
                            <option value="User">Pencari Kos</option>
                            <option value="Pemilik_kos">Pemilik Kos</option>
                        </select>
                        @error('role')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label" id="no-title">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap"
                            autofocus />
                        @error('name')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email"
                            autofocus />
                        @error('email')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password<br><small>*Minimal 8 atau lebih
                                    karakter</small></label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                        </div>
                        @error('password')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Konfirmasi Password</label>

                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation"
                                required autocomplete="new-password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit"
                            style="background-color:#005555; border-color:#005555">Daftar</button>
                    </div>
                </form>

                <p class="text-center">
                    <span>Sudah memiliki akun ?</span>
                    <a href="{{ route('login') }}">
                        <span>Login</span>
                    </a>
                </p>
            </form>
        </div>
    </div>
@endsection
