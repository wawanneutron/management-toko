<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new User;
        $administrator->username = 'administrator';
        $administrator->name = 'Site Administrator';
        $administrator->email = 'adminlarashop@gmail.com';
        $administrator->roles = json_encode(['ADMIN']);
        $administrator->password = Hash::make('larashop');
        $administrator->avatar = null;
        $administrator->address = 'Tigaraksa, Kab. Tangerang';
        $administrator->phone = '+628552724';

        $administrator->save();

        $this->command->info('User Admin berhasil diinsert');
    }
}
