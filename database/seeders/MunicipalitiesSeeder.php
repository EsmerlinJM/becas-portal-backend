<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MunicipalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipalities')->insert([
            [ "name" => 'Santo Domingo de Guzman', "code" => '1', "identifier" => '100101', "province_code" => '1', "region_code" => '10', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Azua', "code" => '1', "identifier" => '50201', "province_code" => '2', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Las Charcas', "code" => '2', "identifier" => '50202', "province_code" => '2', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Las Yayas de Viajama', "code" => '3', "identifier" => '50203', "province_code" => '2', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Padre Las Casas', "code" => '4', "identifier" => '50204', "province_code" => '2', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Peralta', "code" => '5', "identifier" => '50205', "province_code" => '2', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Sabana Yegua', "code" => '6', "identifier" => '50206', "province_code" => '2', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Pueblo Viejo', "code" => '7', "identifier" => '50207', "province_code" => '2', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Tabara Arriba', "code" => '8', "identifier" => '50208', "province_code" => '2', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Guayabal', "code" => '9', "identifier" => '50209', "province_code" => '2', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Estebania', "code" => '10', "identifier" => '50210', "province_code" => '2', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Neiba', "code" => '1', "identifier" => '60301', "province_code" => '3', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Galvan', "code" => '2', "identifier" => '60302', "province_code" => '3', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Tamayo', "code" => '3', "identifier" => '60303', "province_code" => '3', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Villa Jaragua', "code" => '4', "identifier" => '60304', "province_code" => '3', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Los Rios', "code" => '5', "identifier" => '60305', "province_code" => '3', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Barahona', "code" => '1', "identifier" => '60401', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Cabral', "code" => '2', "identifier" => '60402', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Enriquillo', "code" => '3', "identifier" => '60403', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Paraiso', "code" => '4', "identifier" => '60404', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Vicente Noble', "code" => '5', "identifier" => '60405', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'El Peñon', "code" => '6', "identifier" => '60406', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'La Cienaga', "code" => '7', "identifier" => '60407', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Fundacion', "code" => '8', "identifier" => '60408', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Las Salinas', "code" => '9', "identifier" => '60409', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Polo', "code" => '10', "identifier" => '60410', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Jaquimeyes', "code" => '11', "identifier" => '60411', "province_code" => '4', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Dajabon', "code" => '1', "identifier" => '40501', "province_code" => '5', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Loma de Cabrera', "code" => '2', "identifier" => '40502', "province_code" => '5', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Partido', "code" => '3', "identifier" => '40503', "province_code" => '5', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Restauracion', "code" => '4', "identifier" => '40504', "province_code" => '5', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'El Pino', "code" => '5', "identifier" => '40505', "province_code" => '5', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'San Francisco de Macoris', "code" => '1', "identifier" => '30601', "province_code" => '6', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Arenoso', "code" => '2', "identifier" => '30602', "province_code" => '6', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Castillo', "code" => '3', "identifier" => '30603', "province_code" => '6', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Pimentel', "code" => '4', "identifier" => '30604', "province_code" => '6', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Villa Riva', "code" => '5', "identifier" => '30605', "province_code" => '6', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Las Guaranas', "code" => '6', "identifier" => '30606', "province_code" => '6', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Eugenio Maria de Hostos', "code" => '7', "identifier" => '30607', "province_code" => '6', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Comendador', "code" => '1', "identifier" => '70701', "province_code" => '7', "region_code" => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Banica', "code" => '2', "identifier" => '70702', "province_code" => '7', "region_code" => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'El Llano', "code" => '3', "identifier" => '70703', "province_code" => '7', "region_code" => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Hondo Valle', "code" => '4', "identifier" => '70704', "province_code" => '7', "region_code" => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Pedro Santana', "code" => '5', "identifier" => '70705', "province_code" => '7', "region_code" => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Juan Santiago', "code" => '6', "identifier" => '70706', "province_code" => '7', "region_code" => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'El Seibo', "code" => '1', "identifier" => '80801', "province_code" => '8', "region_code" => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Miches', "code" => '2', "identifier" => '80802', "province_code" => '8', "region_code" => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Moca', "code" => '1', "identifier" => '10901', "province_code" => '9', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Cayetano Germosen', "code" => '2', "identifier" => '10902', "province_code" => '9', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Gaspar Hernandez', "code" => '3', "identifier" => '10903', "province_code" => '9', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Jamao Al Norte', "code" => '4', "identifier" => '10904', "province_code" => '9', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'San Victor', "code" => '5', "identifier" => '10905', "province_code" => '9', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Jimani', "code" => '1', "identifier" => '61001', "province_code" => '10', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Duverge', "code" => '2', "identifier" => '61002', "province_code" => '10', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'La Descubierta', "code" => '3', "identifier" => '61003', "province_code" => '10', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Postrer Rio', "code" => '4', "identifier" => '61004', "province_code" => '10', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Cristobal', "code" => '5', "identifier" => '61005', "province_code" => '10', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Mella', "code" => '6', "identifier" => '61006', "province_code" => '10', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Higuey', "code" => '1', "identifier" => '81101', "province_code" => '11', "region_code" => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'San Rafael del Yuma', "code" => '2', "identifier" => '81102', "province_code" => '11', "region_code" => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'La Romana', "code" => '1', "identifier" => '81201', "province_code" => '12', "region_code" => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Guaymate', "code" => '2', "identifier" => '81202', "province_code" => '12', "region_code" => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Villa Hermosa', "code" => '3', "identifier" => '81203', "province_code" => '12', "region_code" => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'La Vega', "code" => '1', "identifier" => '21301', "province_code" => '13', "region_code" => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Constanza', "code" => '2', "identifier" => '21302', "province_code" => '13', "region_code" => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Jarabacoa', "code" => '3', "identifier" => '21303', "province_code" => '13', "region_code" => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Jima Abajo', "code" => '4', "identifier" => '21304', "province_code" => '13', "region_code" => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Nagua', "code" => '1', "identifier" => '31401', "province_code" => '14', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Cabrera', "code" => '2', "identifier" => '31402', "province_code" => '14', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'El Factor', "code" => '3', "identifier" => '31403', "province_code" => '14', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Rio San Juan', "code" => '4', "identifier" => '31404', "province_code" => '14', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Monte Cristi', "code" => '1', "identifier" => '41501', "province_code" => '15', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Castañuelas', "code" => '2', "identifier" => '41502', "province_code" => '15', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Guayubin', "code" => '3', "identifier" => '41503', "province_code" => '15', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Las Matas de Santa Cruz', "code" => '4', "identifier" => '41504', "province_code" => '15', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Pepillo Salcedo', "code" => '5', "identifier" => '41505', "province_code" => '15', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Villa Vasquez', "code" => '6', "identifier" => '41506', "province_code" => '15', "region_code" => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Pedernales', "code" => '1', "identifier" => '61601', "province_code" => '16', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Oviedo', "code" => '2', "identifier" => '61602', "province_code" => '16', "region_code" => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Bani', "code" => '1', "identifier" => '51701', "province_code" => '17', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Nizao', "code" => '2', "identifier" => '51702', "province_code" => '17', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Matanzas', "code" => '3', "identifier" => '51703', "province_code" => '17', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Puerto Plata', "code" => '1', "identifier" => '11801', "province_code" => '18', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Altamira', "code" => '2', "identifier" => '11802', "province_code" => '18', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Guananico', "code" => '3', "identifier" => '11803', "province_code" => '18', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Imbert', "code" => '4', "identifier" => '11804', "province_code" => '18', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Los Hidalgos', "code" => '5', "identifier" => '11805', "province_code" => '18', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Luperon', "code" => '6', "identifier" => '11806', "province_code" => '18', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Sosua', "code" => '7', "identifier" => '11807', "province_code" => '18', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Villa Isabela', "code" => '8', "identifier" => '11808', "province_code" => '18', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Villa Montellano', "code" => '9', "identifier" => '11809', "province_code" => '18', "region_code" => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Salcedo', "code" => '1', "identifier" => '31901', "province_code" => '19', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Tenares', "code" => '2', "identifier" => '31902', "province_code" => '19', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Villa Tapia', "code" => '3', "identifier" => '31903', "province_code" => '19', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Samana', "code" => '1', "identifier" => '32001', "province_code" => '20', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Sanchez', "code" => '2', "identifier" => '32002', "province_code" => '20', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Las Terrenas', "code" => '3', "identifier" => '32003', "province_code" => '20', "region_code" => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'San Cristobal', "code" => '1', "identifier" => '52101', "province_code" => '21', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Sabana Grande de Palenque', "code" => '2', "identifier" => '52102', "province_code" => '21', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ "name" => 'Bajos de Haina', "code" => '3', "identifier" => '52103', "province_code" => '21', "region_code" => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
