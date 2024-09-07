<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'jk' => ['required', 'string'],
            'role' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'file_ktp' => ['nullable', 'file', 'mimes:jpeg,png,pdf', 'max:2048'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $file_ktp_path = null;
        if (isset($data['file_ktp']) && $data['file_ktp'] instanceof \Illuminate\Http\UploadedFile) {
            $file = $data['file_ktp'];
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('ktp', $filename, 'public');
            $file_ktp_path = 'ktp/' . $filename;
        }
        return User::create([
            'role' => $data['role'],
            'status_pekerjaan' => $data['status_pekerjaan'] ?? null,
            'jk' => $data['jk'],
            'name' => $data['name'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'password' => Hash::make($data['password']),
            'file_ktp' => $file_ktp_path,
        ]);
    }
}
