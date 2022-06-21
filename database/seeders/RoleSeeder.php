<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $user = User::create([
            'name' => 'hossein pourghadiri',
            'phone' => '09398932183',
            'email' => 'hossein.654321@yahoo.com',
            'password' => Hash::make('mh11321132'),
            'status' => 1,
        ]);
        $user->syncRoles(Role::findByName('admin'));
    }
}
