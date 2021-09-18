<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicOffer;
use App\Models\Convocatoria;
use App\Models\ConvocatoriaDetail;
use App\Models\Aplication;
use App\Models\AplicationDetail;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Campus;
use App\Models\User;
use App\Models\Institution;
use App\Models\Offerer;
use App\Models\Candidate;
use App\Models\EducationLevel;
use App\Models\Scholarship;
use App\Models\ScholarshipDetail;
use App\Models\InstitutionOffer;
use App\Models\UserFavorites;
use App\Models\Message;

use App\Models\ExperienciaLaboral;
use App\Models\FormacionAcademica;
use App\Models\Notificacion;
use App\Models\SocioEconomico;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        // Roles
        $this->call(RolesSeeder::class);

        //Modulos
        $this->call(ModulosSeeder::class);

        // Permissions
        $this->call(PermissionsSeeder::class);

        // Role Permissions
        $this->call(RolePermissionsSeeder::class);

        // Role Modules
        $this->call(RoleModulosSeeder::class);

        // Countries
        $this->call(CountriesSeeder::class);

        // Provinces
        $this->call(ProvincesSeeder::class);

        // Municipalities
        $this->call(MunicipalitiesSeeder::class);

        // Sectors
        $this->call(SectorsSeeder::class);

        // Mensajes Convocatorias Base
        $this->call(MensajesConvocatoriaSeeder::class);

        // Users
        $this->call(UsersSeeder::class);
        // User::factory()->count(5)->admin()->create();
        // User::factory()->count(30)->evaluador()->create();
        // User::factory()->count(10)->coordinador()->create();
        // User::factory()->count(200)->ies()->create();
        // User::factory()->count(50)->oferente()->create();
        // User::factory()->count(100)->usuario()->create();

        if(env('APP_ENV') != 'production') {

            // Candidates
            // Candidate::factory()->count(100)->create();
            SocioEconomico::factory()->count(100)->create(); //Se Crean los Candidatos en Base al Modelo SocioEconomico on the Fly

            // Messages
            Message::factory()->count(200)->create();

        }


        // Audiences
        $this->call(AudiencesSeeder::class);

        // Institutions (Types, Institutions)
        $this->call(InstitutionTypesSeeder::class);

        if(env('APP_ENV') != 'production') {

            Institution::factory()->count(20)->universidad()->create();
            Institution::factory()->count(20)->politecnico()->create();
            Institution::factory()->count(20)->negocio()->create();
            Institution::factory()->count(20)->itecnico()->create();
            Institution::factory()->count(20)->idioma()->create();

            // Offerers
            Offerer::factory()->count(100)->create();

            // Campuses
            Campus::factory()->count(100)->create();

        }
        // Development Areas
        $this->call(DevelopmentAreasSeeder::class);

        if(env('APP_ENV') != 'production') {
            // Education Levels
            EducationLevel::factory()->count(50)->create();

        }

        // Schedules
        $this->call(SchedulesSeeder::class);

        // Academic Offers (Types, Academic Offers)
        $this->call(AcademicOfferTypesSeeder::class);

        if(env('APP_ENV') != 'production') {
            AcademicOffer::factory()->count(100)->create();

            // Institutions Offers
            InstitutionOffer::factory()->count(200)->create();
        }




        // Evaluations, requeriments
        $this->call(EvaluationsSeeder::class);
        $this->call(EvaluationRequirementsSeeder::class);

        // Formularios, detalles de formulario
        $this->call(FormularioSeccionSeeder::class);
        $this->call(FormulariosSeeder::class);
        $this->call(FormularioDetailsSeeder::class);



        // Convocatorias, details
        $this->call(ConvocatoriaTypesSeeder::class);

        if(env('APP_ENV') != 'production') {
            // Convocatoria::factory()->count(20)->create();
            $this->call(ConvocatoriasSeeder::class);
            ConvocatoriaDetail::factory()->count(400)->create();
        }


        // Aplications (Status, Aplication, Details)
        $this->call(AplicationStatusesSeeder::class);

        if(env('APP_ENV') != 'production') {
            Aplication::factory()->count(100)->create();
            AplicationDetail::factory()->count(200)->create();

            // Scholarship, details
            Scholarship::factory()->count(100)->create();
            ScholarshipDetail::factory()->count(1000)->create();

            // Favoritos
            UserFavorites::factory()->count(200)->create();

            // Experiencia Laboral, Formacion Academica y Datos Socio Economicos
            ExperienciaLaboral::factory()->count(300)->create();
            FormacionAcademica::factory()->count(300)->create();

            //Creo un SocioEconomico para el Candidato #1
            SocioEconomico::factory()->count(1)->candidato()->create();


            Notificacion::factory()->count(600)->create();
        }
    }
}