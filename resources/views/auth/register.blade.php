@extends('layouts.auth.app')

@section('content')
    <div class="card" style="border-radius: 30px;">
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
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
                {{-- <div class="mb-3">
                    <label for="name" class="form-label" id="no-title">Upload Foto KTP</label>
                    <input type="file" class="form-control" id="file_ktp" name="file_ktp" autofocus required>
                    @error('file_ktp')
                        <span class="text-danger" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div> --}}
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
                    <label for="no_hp" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email"
                        autofocus />
                    @error('email')
                        <span class="text-danger" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No. HP/WA (aktif)</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="+62" autofocus
                        required />
                    @error('no_hp')
                        <span class="text-danger" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="jk" name="jk" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    @error('jk')
                        <span class="text-danger" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="mb-3" id="status_pekerjaan">
                    <label for="status_pekerjaan" class="form-label">Status Pekerjaan</label>
                    <input type="text" class="form-control" id="" name="status_pekerjaan">
                    @error('status_pekerjaan')
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


                <p class="text-center">
                    <span>Sudah memiliki akun ?</span>
                    <a href="{{ route('login') }}">
                        <span>Login</span>
                    </a>
                </p>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var roleSelect = document.getElementById('role');
            var ktpField = document.getElementById('file_ktp');
            var statusPekerjaanField = document.getElementById('status_pekerjaan');

            function toggleFields() {
                if (roleSelect.value === 'User') {
                    // ktpField.style.display = 'block';
                    statusPekerjaanField.style.display = 'block';
                } else {
                    // ktpField.style.display = 'none';
                    statusPekerjaanField.style.display = 'none';
                }
            }
            // Initialize visibility based on the default or current value
            toggleFields();

            // Add event listener to handle changes
            roleSelect.addEventListener('change', toggleFields);
        });
    </script>
@endsection
