<?php

namespace App\Http\Controllers;

use App\Division;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\User;
use Image;
use Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('division');

        if ($request->has('search')) {
            $query = '%' . $request->search . '%';
            $users->where('name', 'LIKE', $query);
        }

        $users = $users->paginate(config('app.per_page'))->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $divisions = Division::all();
        return view('users.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4|max:50|string',
            'nip' => 'required|numeric|unique:users,nip',
            'ktp' => 'required|unique:users,ktp',
            'npwp' => 'required|unique:users,npwp',
            'address' => 'nullable|string|max:200',
            'photo' => 'nullable|image',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'birth_date' => 'required',
            'sallary' => 'required',
            'position' => 'required',
            'joined_at' => 'required',
            'contract_until' => 'required',
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

        $user->name = $request->name;
        $user->nip = $request->nip;
        $user->ktp = $request->ktp;
        $user->npwp = $request->npwp;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->birth_date = $request->birth_date;
        $user->sallary = $request->sallary;
        $user->position = $request->position;
        $user->joined_at = $request->joined_at;
        $user->contract_until = $request->contract_until;
        $user->division_id = $request->division_id;
        $user->save();

        return redirect()->route('users.index')->with('alert-success', 'Berhasil menambah pegawai!');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $divisions = Division::all();
        return view('users.edit', compact('user', 'divisions'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|min:4|max:50|string',
            'nip' => 'required|numeric|unique:users,nip,' . $user->id,
            'ktp' => 'required|unique:users,ktp,' . $user->id,
            'npwp' => 'required|unique:users,npwp,' . $user->id,
            'address' => 'nullable|string|max:200',
            'photo' => 'nullable|image',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'birth_date' => 'required',
            'sallary' => 'required',
            'position' => 'required',
            'joined_at' => 'required',
            'contract_until' => 'required',
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

        $user->name = $request->name;
        $user->nip = $request->nip;
        $user->ktp = $request->ktp;
        $user->npwp = $request->npwp;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->birth_date = $request->birth_date;
        $user->sallary = $request->sallary;
        $user->position = $request->position;
        $user->joined_at = $request->joined_at;
        $user->contract_until = $request->contract_until;
        $user->division_id = $request->division_id;

        $user->save();

        return redirect()->route('users.index')->with('alert-success', 'Berhasil mengubah pegawai!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('alert-success', 'Berhasil menghapus data pegawai');
    }
}
