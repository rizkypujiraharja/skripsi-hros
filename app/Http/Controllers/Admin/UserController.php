<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\User;
use Image;
use Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::latest();

        if ($request->has('search')) {
            $query = '%' . $request->search . '%';
            $users->where('name', 'LIKE', $query);
        }

        $users = $users->paginate(config('app.per_page'))->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $jabatans = Jabatan::all();
        return view('admin.users.create', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|numeric|unique:users,nip',
            'name' => 'required|min:4|max:50|string',
            'address' => 'nullable|string|max:200',
            'phone' => 'nullable',
            'photo' => 'nullable|image',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'limit_balance' => 'required|numeric|min:0',
        ], [], [
            'name' => 'nama',
            'address' => 'alamat',
            'photo' => 'foto'
        ]);

        $user = new User;

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

        $user->nip = $request->nip;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->limit_balance = $request->limit_balance;
        $user->jabatan_id = $request->jabatan_id;
        $user->save();

        return redirect()->route('users.index')->with('alert-success', 'Berhasil menambah pegawai!');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $jabatans = Jabatan::all();
        return view('admin.users.edit', compact('user', 'jabatans'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'nip' => 'required|numeric|unique:users,nip,' . $user->id,
            'name' => 'required|min:4|max:50|string',
            'address' => 'nullable|string|max:200',
            'phone' => 'nullable',
            'photo' => 'nullable|image',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'limit_balance' => 'required|numeric|min:0',
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

        $user->nip = $request->nip;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->limit_balance = $request->limit_balance;
        $user->jabatan_id = $request->jabatan_id;
        $user->save();

        return redirect()->route('users.index')->with('alert-success', 'Berhasil mengubah pegawai!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('alert-success', 'Berhasil menghapus data pegawai');
    }
}
