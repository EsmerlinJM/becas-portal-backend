<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MensajesConvocatoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mensajes_convocatorias')->insert([
            [
                'name' => 'Mensajes Base',

                'iniciada' => '<p><strong>Estimado candidato</strong></p>
                <p>Has iniciado el proceso de solicitud para una beca, a trav&eacute;s del programa Beca tu Futuro.</p>
                <p>Le agradecemos el inter&eacute;s que ha mostrado en la Convocatoria Becas Nacionales 2020 y le deseamos toda clase de &eacute;xitos en su futuro profesional.</p>
                <p><br />Reciba un atento saludo,</p>
                <p><strong>Ministerio de Educaci&oacute;n Superior, Ciencia y Tecnolog&iacute;a</strong></p>',

                'aprobada' => '<p><strong>Beca Aprobada</strong></p>
                <p>&iexcl;Felicidades!</p>
                <p>Nos honra comunicarle que su solicitud ha sido seleccionada para la concesi&oacute;n de beca para el programa Licenciatura en Educaci&oacute;n en Universidad Aut&oacute;noma de Santo Domingo.</p>
                <p>Le agradecemos el inter&eacute;s que ha mostrado en la Convocatoria Becas Nacionales 2020 y le deseamos toda clase de &eacute;xitos en su futuro profesional.</p>
                <p><br />Reciba un atento saludo,</p>
                <p><strong>Ministerio de Educaci&oacute;n Superior, Ciencia y Tecnolog&iacute;a</strong></p>
                <hr />
                <p><strong>Condiciones para mantener la beca</strong></p>
                <p>El r&eacute;gimen de la beca es de dedicaci&oacute;n exclusiva, por lo que es incompatible con cualquier otro tipo de beca o remuneraci&oacute;n econ&oacute;mica procedente de cualquier instituci&oacute;n o empresa espa&ntilde;ola, excepto en los casos de las pr&aacute;cticas obligatorias contempladas en los programas acad&eacute;micos que podr&aacute;n ser remuneradas con conocimiento expreso y autorizaci&oacute;n de la Fundaci&oacute;n.</p>
                <p>&nbsp;</p>
                <p>La Fundaci&oacute;n Carolina confirmar&aacute; regularmente, en colaboraci&oacute;n con las instituciones acad&eacute;micas, la adecuada participaci&oacute;n y progreso de las personas becadas, a fin de asegurar el nivel de &eacute;xito esperado. Las personas que finalmente resulten adjudicatarias de las becas se comprometen de forma irrenunciable a que volver&aacute;n a su pa&iacute;s o a cualquier otro de la Comunidad Iberoamericana de Naciones excepto Espa&ntilde;a, una vez haya finalizado la beca.</p>
                <p>&nbsp;</p>
                <p>El incumplimiento de estos requisitos y de aquellos otros que se establecen en la carta de compromiso que la persona becada deber&aacute; firmar para la aceptaci&oacute;n de la beca, as&iacute; como la comprobaci&oacute;n de la inexactitud de los datos aportados por la misma en el proceso de selecci&oacute;n.</p>',

                'rechazada' => '<p><strong>Beca Rechazada</strong></p>
                <p><strong>Estimado candidato</strong></p>
                <p>Lamentamos comunicarle que su solicitud no ha sido seleccionada para la concesi&oacute;n de beca para el programa Licenciatura en Educaci&oacute;n en Universidad Aut&oacute;noma de Santo Domingo.</p>
                <p>Le agradecemos el inter&eacute;s que ha mostrado en la Convocatoria Becas Nacionales 2020 y le deseamos toda clase de &eacute;xitos en su futuro profesional.</p>
                <p><br />Reciba un atento saludo,</p>
                <p><strong>Ministerio de Educaci&oacute;n Superior, Ciencia y Tecnolog&iacute;a</strong></p>
                <hr />
                <p><strong>Recomendaciones</strong></p>
                <p>Para futuras convocatorias le invitamos a revisar la evaluaci&oacute;n y mejorar los ejes de menor puntuaci&oacute;n.</p>',

                'evaluacion' => '<p><strong>Solicitud en Evaluaci&oacute;n</strong></p>
                <p><strong>Estimado Candidato</strong></p>
                <p>Le informamos que su solicitud para la concesi&oacute;n de beca para el programa Licenciatura en Educaci&oacute;n en Universidad Aut&oacute;noma de Santo Domingo est&aacute; siendo evaluada.</p>
                <p>Le exhortamos estar atento a las v&iacute;as de contacto para saber el estatus final de su solicitud.</p>
                <p>Reciba un atento saludo,</p>
                <p><strong>Ministerio de Educaci&oacute;n Superior, Ciencia y Tecnolog&iacute;a</strong></p>',

                'credito' => '<p><strong>Estimado candidato</strong></p>
                <p>Nos honra comunicarle que su solicitud ha sido seleccionada para la concesi&oacute;n de un cr&eacute;dito educativo a trav&eacute;s del fidecomiso "Beca tu Futuro".</p>
                <p>Le agradecemos el inter&eacute;s que ha mostrado en la Convocatoria Becas Nacionales 2020 y le deseamos toda clase de &eacute;xitos en su futuro profesional.</p>
                <p><br />Reciba un atento saludo,</p>
                <p><strong>Ministerio de Educaci&oacute;n Superior, Ciencia y Tecnolog&iacute;a</strong></p>',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()],
        ]);
    }
}