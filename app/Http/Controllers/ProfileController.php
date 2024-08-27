<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Profile',
        ];
        return view('admin.akun.profile', $data);
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'no_hp' => 'string',
                'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
                'current_password' => 'nullable|required_with:new_password',
                'new_password' => 'nullable|min:8|max:12|required_with:current_password',
                'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
                'file_ktp' => 'nullable|file|mimes:jpeg,png,pdf',
            ]);


            $user = User::findOrFail(Auth::user()->id);
            $user->name = $request->input('name');
            $user->no_hp = $request->input('no_hp');
            $user->email = $request->input('email');

            if (!is_null($request->input('current_password'))) {
                if (Hash::check($request->input('current_password'), $user->password)) {
                    $user->password = $request->input('new_password');
                } else {
                    return redirect()->back()->withInput();
                }
            }
            if ($request->hasFile('file_ktp')) {
                $file = $request->file('file_ktp');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('ktp', $filename, 'public');

                $user->file_ktp = 'ktp/' . $filename;
            }

            $user->save();

            return redirect()->back()->withSuccess('Profile  berhasil di ubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
