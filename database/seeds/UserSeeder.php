<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->nip = '111111111111';
        $user->name = 'Bambang Nurhidayat';
        $user->address = 'Baleendah, Bandung';
        $user->photo = '';
        $user->email = 'gina@ordivo.com';
        $user->password = bcrypt('secret123');
        $user->role = 'hrd';
        $user->save();
    }
}
