<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'address' => 'nullable|string|max:200',
            'phone' => 'nullable',
            'photo' => 'nullable|image',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ], [], [
            'name' => 'nama',
            'address' => 'alamat',
            'photo' => 'foto'
        ]);

        if (!is_null($request->photo)) {
            $file = $request->file('photo');
            $path = $file->hashName('photos');

            $image = Image::make($file);
            $image->fit(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::put($path, (string) $image->encode());
            $user->photo = $path;
        }

        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->back()->with('alert-success', 'Berhasil mengubah profil!');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string|current_password',
            'password' => 'required|string|confirmed',
        ]);

        $user = Auth::user();

        $user->password = bcrypt($request->password);
        $user->update();

        return redirect()->back()->with('alert-success', 'Password updated successfully!');
    }
}
