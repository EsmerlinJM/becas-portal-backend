<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            [ "name" => 'Distrito Nacional', "country_id" => '62', "code" => '1', "identifier" => '1001', "region_code" => '10',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Azua', "country_id" => '62', "code" => '2', "identifier" => '502', "region_code" => '5',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Baoruco', "country_id" => '62', "code" => '3', "identifier" => '603', "region_code" => '6',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Barahona', "country_id" => '62', "code" => '4', "identifier" => '604', "region_code" => '6',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Dajabon', "country_id" => '62', "code" => '5', "identifier" => '405', "region_code" => '4',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Duarte', "country_id" => '62', "code" => '6', "identifier" => '306', "region_code" => '3',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Elias Piña', "country_id" => '62', "code" => '7', "identifier" => '707', "region_code" => '7',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'El Seibo', "country_id" => '62', "code" => '8', "identifier" => '808', "region_code" => '8',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Espaillat', "country_id" => '62', "code" => '9', "identifier" => '109', "region_code" => '1',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Independencia', "country_id" => '62', "code" => '10', "identifier" => '610', "region_code" => '6',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'La Altagracia', "country_id" => '62', "code" => '11', "identifier" => '811', "region_code" => '8',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'La Romana', "country_id" => '62', "code" => '12', "identifier" => '812', "region_code" => '8',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'La Vega', "country_id" => '62', "code" => '13', "identifier" => '213', "region_code" => '2',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Maria Trinidad Sanchez', "country_id" => '62', "code" => '14', "identifier" => '314', "region_code" => '3',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Monte Cristi', "country_id" => '62', "code" => '15', "identifier" => '415', "region_code" => '4',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Pedernales', "country_id" => '62', "code" => '16', "identifier" => '616', "region_code" => '6',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Peravia', "country_id" => '62', "code" => '17', "identifier" => '517', "region_code" => '5',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Puerto Plata', "country_id" => '62', "code" => '18', "identifier" => '118', "region_code" => '1',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Hermanas Mirabal', "country_id" => '62', "code" => '19', "identifier" => '319', "region_code" => '3',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Samana', "country_id" => '62', "code" => '20', "identifier" => '320', "region_code" => '3',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'San Cristobal', "country_id" => '62', "code" => '21', "identifier" => '521', "region_code" => '5',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'San Juan', "country_id" => '62', "code" => '22', "identifier" => '722', "region_code" => '7',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'San Pedro de Macoris', "country_id" => '62', "code" => '23', "identifier" => '923', "region_code" => '9',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Sanchez Ramirez', "country_id" => '62', "code" => '24', "identifier" => '224', "region_code" => '2',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Santiago', "country_id" => '62', "code" => '25', "identifier" => '125', "region_code" => '1',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Santiago Rodriguez', "country_id" => '62', "code" => '26', "identifier" => '426', "region_code" => '4',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Valverde', "country_id" => '62', "code" => '27', "identifier" => '427', "region_code" => '4',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Monseñor Nouel', "country_id" => '62', "code" => '28', "identifier" => '228', "region_code" => '2',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Monte Plata', "country_id" => '62', "code" => '29', "identifier" => '929', "region_code" => '9',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Hato Mayor', "country_id" => '62', "code" => '30', "identifier" => '930', "region_code" => '9',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'San Jose de Ocoa', "country_id" => '62', "code" => '31', "identifier" => '531', "region_code" => '5',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            [ "name" => 'Santo Domingo', "country_id" => '62', "code" => '32', "identifier" => '1032', "region_code" => '10',  "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
        ]);
    }
}
