<?php

namespace Database\Seeders;

use App\Division;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCollection = collect(
            json_decode(Storage::disk('local')->get('employee.json'))
        )->sortBy('nip')->values();
        $divisions = Division::all();

        $join_date = now()->subYears(rand(1, 3));

        foreach ($usersCollection as $employee) {
            $join_date = $join_date->addDays(rand(1, 14));
            $join_at = $join_date->copy()->format('Y-m-d');
            $user = new User;
            $user->name = $employee->name;
            $user->email = str_replace(" ", "", strtolower($employee->name)) . '@ordivo.id';
            $user->nip = $employee->nip;
            $user->ktp = rand(1000000000000000, 9999999999999999);
            $user->npwp = rand(1000000000000000, 9999999999999999);
            $user->address = 'Bandung';
            $user->password = bcrypt('password');
            $user->role = isset($employee->role) ? $employee->role : 'employee';
            $user->birth_date = now()->subYears(rand(19, 30))->subDays(rand(1, 356));
            $user->sallary = $employee->sallary;
            $user->position = $employee->position;
            $user->division_id = $divisions->where('name', $employee->division)->first()->id;
            $user->joined_at = $join_at;
            $user->save();
        }
    }
}
