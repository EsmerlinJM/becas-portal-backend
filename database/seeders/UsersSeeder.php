<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        if(env('APP_ENV') == 'production') {
            DB::table('users')->insert([
                [   'role_id'=>'1',
                    'institution_id' => null,
                    'offerer_id' => null,
                    'email'=>'alexander.hilario@ogtic.gob.do',
                    'email_verified_at'=> $date,
                    'password' => bcrypt('qLLNv9U287LYHAxK2Nz9'),
                    'created_at' => $date
                ],
            ]);

            DB::table('profiles')->insert([
                [
                    'user_id'=>'1',
                    'name'=>'Alexander Hilario',
                    'contact_phone'=>'+1 (809) 998-6610',
                    'contact_email'=>'alexander.hilario@ogtic.gob.do',
                    'created_at' => $date
                ],
            ]);

            DB::table('users')->insert([
                [   'role_id'=>'1',
                    'institution_id' => null,
                    'offerer_id' => null,
                    'email'=>'ivan.firestone@ogtic.gob.do',
                    'email_verified_at'=> $date,
                    'password' => bcrypt('2Un2a8MjJqrkuMpqJN6D'),
                    'created_at' => $date
                ],
            ]);

            DB::table('profiles')->insert([
                [
                    'user_id'=>'2',
                    'name'=>'Ivan Firestone',
                    'contact_phone'=>'+1 (829) 705-2424',
                    'contact_email'=>'ivan.firestone@ogtic.gob.do',
                    'created_at' => $date
                ],
            ]);

        } else {
            DB::table('users')->insert([
                [   'role_id'=>'1',
                    'institution_id' => null,
                    'offerer_id' => null,
                    'email'=>'admin@pruebas.com',
                    'email_verified_at'=> $date,
                    'password' => bcrypt('admin'),
                    'created_at' => $date
                ],
                [   'role_id'=>'2',
                    'institution_id' => null,
                    'offerer_id' => null,
                    'email'=>'evaluador@pruebas.com',
                    'email_verified_at'=>$date,
                    'password' => bcrypt('admin'),
                    'created_at' => $date
                ],
                [   'role_id'=>'3',
                    'institution_id' => null,
                    'offerer_id' => null,
                    'email'=>'coordinador@pruebas.com',
                    'email_verified_at'=>$date,
                    'password' => bcrypt('admin'),
                    'created_at'=>$date
                ],
                [   'role_id'=>'4',
                    'institution_id' => '1',
                    'offerer_id' => null,
                    'email'=>'institucion@pruebas.com',
                    'email_verified_at'=>$date,
                    'password' => bcrypt('admin'),
                    'created_at'=>$date
                ],
                [   'role_id'=>'5',
                    'institution_id' => null,
                    'offerer_id' => '1',
                    'email'=>'oferente@pruebas.com',
                    'email_verified_at'=>$date,
                    'password' => bcrypt('admin'),
                    'created_at'=>$date
                ],
                [   'role_id'=>'6',
                    'institution_id' => null,
                    'offerer_id' => null,
                    'email'=>'usuario@pruebas.com',
                    'email_verified_at'=>$date,
                    'password' => bcrypt('admin'),
                    'created_at'=>$date
                ],
            ]);

            DB::table('profiles')->insert([
                [
                    'user_id'=>'1',
                    'name'=>'Admin',
                    'contact_phone'=>'809-999-9999',
                    'contact_email'=>'admin@email.com',
                    'created_at' => $date
                ],
                [
                    'user_id'=>'4',
                    'name'=>'Institucion Superior',
                    'contact_phone'=>'809-999-9999',
                    'contact_email'=>'institucion@email.com',
                    'created_at' => $date
                ],
                [
                    'user_id'=>'5',
                    'name'=>'Oferente Pruebas',
                    'contact_phone'=>'809-999-9999',
                    'contact_email'=>'oferente@email.com',
                    'created_at' => $date
                ],
            ]);

            DB::table('coordinators')->insert([
                [
                    'user_id'=>'3',
                    'name'=>'Coordinador Pruebas',
                    'contact_phone'=>'809-999-9999',
                    'contact_email'=>'coordinator@email.com',
                    'created_at' => $date
                ]
            ]);

            DB::table('evaluators')->insert([
                [
                    'user_id'=>'2',
                    'coordinator_id'=>'1',
                    'name'=>'Evaluador Pruebas',
                    'contact_phone'=>'809-999-9999',
                    'contact_email'=>'evaluator@email.com',
                    'created_at' => $date
                ]
            ]);

            DB::table('candidates')->insert([
                [
                    'user_id'=>'6',
                    'country_id'=>'62',
                    'province_id'=>'1',
                    'municipality_id'=>'1',
                    'document_id'=>'12345678901',
                    'name'=>'Juan Jose',
                    'last_name' => 'Perez Mejia',
                    'born_date'=>'1990-01-01',
                    'contact_phone'=>'809-999-8989',
                    'contact_email'=>'juan.perez@email.com',
                    'address'=>'Calle H #34, El Brisal',
                    'created_at' => $date
                ]
            ]);
        }
    }


}