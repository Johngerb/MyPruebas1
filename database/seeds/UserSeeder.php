<?php

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
        User::create([

            'id'=>'1',
            'name'=>'Super Administrador',
            'cedula'=>'0704081991',
            'edad'=>39,
            'apellidos'=>'Barriga Arizabala',
            'estado'=> 1,
            'email'=> 'johngerb80@gmail.com',
            'password'=> bcrypt('jgba1980'),
            'email_verified_at'=>"2019-04-01 12:31:15",
              
        ]);
    }
}
