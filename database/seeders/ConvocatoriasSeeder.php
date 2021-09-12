<?php

namespace Database\Seeders;

use App\Models\Convocatoria;
use App\Models\Coordinator;
use App\Models\Audience;
use App\Models\Evaluation;
use App\Models\ConvocatoriaType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ConvocatoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('convocatorias')->insert([

            //1ER SET
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas Nacionales 2020',
                'start_date' => '2020-01-01',
                'end_date' => '2020-12-01',
                'status' => 'Cerrada',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => true,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas Lenguas 2021',
                'start_date' => '2021-01-01',
                'end_date' => '2021-06-01',
                'status' => 'Cerrada',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => false,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas Internacionales 2021',
                'start_date' => '2021-10-01',
                'end_date' => '2021-12-20',
                'status' => 'Abierta',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => false,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas de Investigacion 2022',
                'start_date' => '2022-10-01',
                'end_date' => '2022-12-20',
                'status' => 'Pendiente',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => false,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],


            //2DO SET
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas Nacionales 2019',
                'start_date' => '2019-01-01',
                'end_date' => '2019-12-01',
                'status' => 'Cerrada',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => true,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas Europeas 2021',
                'start_date' => '2021-01-01',
                'end_date' => '2021-06-01',
                'status' => 'Cerrada',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => false,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas Nacionales 2021',
                'start_date' => '2021-10-01',
                'end_date' => '2021-12-20',
                'status' => 'Abierta',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => false,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas de Investigacion 2023',
                'start_date' => '2023-10-01',
                'end_date' => '2023-12-20',
                'status' => 'Pendiente',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => false,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            //3ER SET
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas Nacionales 2018',
                'start_date' => '2018-01-01',
                'end_date' => '2018-12-01',
                'status' => 'Cerrada',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => true,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas Boston 2021',
                'start_date' => '2021-01-01',
                'end_date' => '2021-06-01',
                'status' => 'Cerrada',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => false,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'coordinator_id' => Coordinator::all()->random()->id,
                'convocatoria_type_id' => ConvocatoriaType::all()->random()->id,
                'audience_id'   => Audience::all()->random()->id,
                'evaluation_id'     => Evaluation::all()->random()->id,
                'name'  => 'Convocatoria Becas de Investigacion 2024',
                'start_date' => '2024-10-01',
                'end_date' => '2024-12-20',
                'status' => 'Pendiente',
                'image_url' => 'https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/wonderlane-6zlgM-GUd6I-unsplash.jpg',
                'image_ext'  => 'jpg',
                'image_size' => '1024',
                'published' => false,
                'requisitos' => '<div><div><strong>REQUISITOS GENERALES:</strong></div><ul><li>Nacionalidad dominicana.</li><li>Promedio de calificaciones del Bachillerato 80 de 100.</li>
                <li>Seleccionar de acuerdo de la oferta de la convocatoria publicada.</li></ul><div><strong>DOCUMENTOS REQUERIDOS:</strong></div><ul><li>Formulario de solicitud en l&iacute;nea (disponible con la apertura de la convocatoria).</li><li>Una (1) foto 2&times;2.</li><li>Fotocopia de la c&eacute;dula de identidad.</li>
                <li>Acta de nacimiento original. (Si es menor de edad).</li><li>R&eacute;cord de Calificaciones del Bachillerato, legalizado por el Ministerio de Educaci&oacute;n de la Rep&uacute;blica Dominicana, MINERD.</li><li>Certificaci&oacute;n original de conclusi&oacute;n del Bachillerato.</li><li>R&eacute;cord de calificaciones de la Universidad, en caso de haber iniciado la carrera.<strong>&nbsp;</strong></li></ul></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
