@extends('layouts.auth.app')

@section('content')
    <div class="card" style="border-radius:30px;">
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
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
                <p class="mb-4">Silahkan login terlebih dahulu</p>

                <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Enter your email address" autofocus />
                        @error('email')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                            <a href="{{ route('password.request') }}">
                                <small>Forgot Password?</small>
                            </a>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            @error('password')
                                <span class="text-danger" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }} />
                            <label class="form-check-label" for="remember-me"> Ingat Login </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit"
                            style="background-color:#005555; border-color:#005555">Masuk</button>
                    </div>
                </form>

                <p class="text-center">
                    <span>Belum memiliki akun ?</span>
                    <a href="{{ route('register') }}">
                        <span>Buat Akun</span>
                    </a>
                </p>
            </form>
        </div>
    </div>
@endsection
