<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Tools\ResponseCodes;

use App\Http\Controllers\CountryController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ConvocatoriaTypeController;
use App\Http\Controllers\ConvocatoriaController;
use App\Http\Controllers\ConvocatoriaDetailController;
use App\Http\Controllers\OffererController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AplicationStatusController;
use App\Http\Controllers\AplicationController;
use App\Http\Controllers\AplicationDetailController;
use App\Http\Controllers\AplicationFormController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AudienceController;

use App\Http\Controllers\CampusController;
use App\Http\Controllers\InstitutionTypeController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\InstitutionOfferController;
use App\Http\Controllers\AcademicOfferController;
use App\Http\Controllers\AcademicOfferTypeController;
use App\Http\Controllers\DevelopmentAreaController;
use App\Http\Controllers\EducationLevelController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\InstitutionEvaluatorController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\FormularioDetailController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluationRequirementController;

use App\Http\Controllers\ParametroController;

use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\ScholarshipDetailController;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserFavoritesController;

use App\Http\Controllers\ExperienciaLaboralController;
use App\Http\Controllers\FormacionAcademicaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\SocioEconomicoController;

use App\Http\Controllers\DebuggerController;

use App\Http\Controllers\MensajesConvocatoriaController;
use App\Http\Controllers\MensajeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Verify email
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

#Debugger
Route::get('debugger/getData', [DebuggerController::class, 'getData'])->middleware('log.route');
Route::post('debugger/postData', [DebuggerController::class, 'postData'])->middleware('log.route');


Route::get('email/forgotPassword', [VerificationController::class, 'forgot'])->name('password.forgot');
Route::get('email/resetPassword', [VerificationController::class, 'reset'])->name('password.reset');

//Parametros
Route::get('/parametros/getAll', [ParametroController::class, 'parametros']);

#Paises
Route::get('/paises/getAll', [CountryController::class, 'index']);
Route::get('/paises/getOne', [CountryController::class, 'show']);
Route::get('/paises/search', [CountryController::class, 'search']);

#Provincias
Route::get('/provincias/getAll', [ProvinceController::class, 'index']);
Route::get('/provincias/getOne', [ProvinceController::class, 'show']);
Route::get('/provincias/search', [ProvinceController::class, 'search']);
Route::get('/provincias/byCountry', [ProvinceController::class, 'byCountry']);

#Municipios
Route::get('/municipios/getAll', [MunicipalityController::class, 'index']);
Route::get('/municipios/getOne', [MunicipalityController::class, 'show']);
Route::get('/municipios/search', [MunicipalityController::class, 'search']);
Route::get('/municipios/byProvince', [MunicipalityController::class, 'byProvince']);

#Sectores
Route::get('/sectores/getAll', [SectorController::class, 'index']);
Route::get('/sectores/getOne', [SectorController::class, 'show']);
Route::get('/sectores/search', [SectorController::class, 'search']);
Route::get('/sectores/byMunicipality', [SectorController::class, 'byMunicipality']);

#Logs
Route::get('/logs/getAll', [LogController::class, 'index']);
Route::get('/logs/getOne', [LogController::class, 'show']);
Route::post('/logs/store', [LogController::class, 'store']);
Route::post('/logs/search', [LogController::class, 'search']);

#Profile (Login + Register)
Route::post('/profile/register', [AuthController::class, 'register'])->name('register');
Route::post('/profile/login', [AuthController::class, 'login'])->name('login');
Route::post('/profile/loginCandidato', [AuthController::class, 'loginCandidato'])->name('loginCandidato');

#Convocatorias Tipos
Route::get('convocatorias/tipos/getAll', [ConvocatoriaTypeController::class, 'index']);
Route::post('convocatorias/tipos/show', [ConvocatoriaTypeController::class, 'show']);

#Convocatorias
Route::get('convocatorias/abiertas', [ConvocatoriaController::class, 'abiertas']);
Route::get('convocatorias/cerradas', [ConvocatoriaController::class, 'cerradas']);
Route::get('convocatorias/portal', [ConvocatoriaController::class, 'portal']);
Route::post('convocatorias/show', [ConvocatoriaController::class, 'show']);

#Convocatorias Detalles
Route::post('convocatorias/details/getAll', [ConvocatoriaDetailController::class, 'index']);
Route::post('convocatorias/details/search', [ConvocatoriaDetailController::class, 'search']);
Route::post('convocatorias/details/show', [ConvocatoriaDetailController::class, 'show']);

#Oferentes
Route::get('oferentes/getAll', [OffererController::class, 'index']);
Route::post('oferentes/show', [OffererController::class, 'show']);

#Horarios
Route::get('horarios/getAll', [ScheduleController::class, 'index']);
Route::post('horarios/show', [ScheduleController::class, 'show']);

#Audiencia (Publico)
Route::get('publico/getAll', [AudienceController::class, 'index']);
Route::post('publico/show', [AudienceController::class, 'show']);

#Instituciones Tipos
Route::get('instituciones/tipos/getAll', [InstitutionTypeController::class, 'index']);
Route::post('instituciones/tipos/show', [InstitutionTypeController::class, 'show']);

#Instituciones
Route::get('instituciones/getAll', [InstitutionController::class, 'index']);
Route::post('instituciones/show', [InstitutionController::class, 'show']);

#Areas de desarrollo
Route::get('areas/desarrollo/getAll', [DevelopmentAreaController::class, 'index']);
Route::post('areas/desarrollo/show', [DevelopmentAreaController::class, 'show']);

#Niveles Educativos
Route::get('niveles/educativos/getAll', [EducationLevelController::class, 'index']);
Route::post('niveles/educativos/byArea', [EducationLevelController::class, 'byArea']);
Route::post('niveles/educativos/show', [EducationLevelController::class, 'show']);

#Ofertas Academicas Tipos
Route::get('ofertas/academicas/tipos/getAll', [AcademicOfferTypeController::class, 'index']);
Route::post('ofertas/academicas/tipos/show', [AcademicOfferTypeController::class, 'show']);

#Mensajes
Route::post('/mensajes/create', [MessageController::class, 'store']);

#Becados
Route::post('becados/filter', [ScholarshipController::class, 'filter']);

Route::group(['middleware' => ['auth:api', 'verified']], function()
    {
        Route::post('/profile/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/profile/changepassword', [ProfileController::class, 'changePassword']);
        Route::post('/profile/getProfile', [ProfileController::class, 'getProfile']);
        Route::post('/profile/update', [ProfileController::class, 'update']);
        Route::post('/profile/updatePicture', [ProfileController::class, 'updatePicture']);

        #Favoritos
        Route::get('/favoritos/getAll', [UserFavoritesController::class, 'index']);
        Route::post('/favoritos/create', [UserFavoritesController::class, 'store']);
        Route::post('/favoritos/delete', [UserFavoritesController::class, 'destroy']);

        #Estadisticas
        Route::get('/estadisticas/convocatoria', [ParametroController::class, 'estadisticas_convocatoria']);
        Route::get('/estadisticas/generales', [ParametroController::class, 'estadisticas_generales']);

        #Usuarios
        Route::post('/users/getAll', [UserController::class, 'index']);
        Route::post('/users/show', [UserController::class, 'show']);
        Route::post('/users/createAdmin', [UserController::class, 'storeAdmin']);
        Route::post('/users/createInstitucion', [UserController::class, 'storeInstitucion']);
        Route::post('/users/createOferente', [UserController::class, 'storeOferente']);
        Route::post('/users/createSoloLectura', [UserController::class, 'storeSoloLectura']);
        Route::post('/users/update', [UserController::class, 'update']);
        Route::post('/users/resetpassword', [UserController::class, 'resetPassword']);

        #Mensajes
        Route::post('/mensajes/getAll', [MessageController::class, 'index']);
        Route::post('/mensajes/show', [MessageController::class, 'show']);
        Route::post('/mensajes/markRead', [MessageController::class, 'markRead']);
        Route::post('/mensajes/markUnRead', [MessageController::class, 'markUnRead']);
        Route::post('/mensajes/delete', [MessageController::class, 'destroy']);

        #Mensajes Internos
        Route::get('/mensajes/internos/getAll', [MensajeController::class, 'index']);
        Route::post('/mensajes/internos/show', [MensajeController::class, 'show']);
        Route::post('/mensajes/internos/compose_office', [MensajeController::class, 'composeBackOffice']);
        Route::post('/mensajes/internos/compose_candidate', [MensajeController::class, 'composeCandidato']);
        Route::post('/mensajes/internos/setRead', [MensajeController::class, 'setRead']);
        Route::post('/mensajes/internos/setUnread', [MensajeController::class, 'setUnread']);
        Route::post('/mensajes/internos/delete', [MensajeController::class, 'destroy']);

        #Evaluadores
        Route::post('/evaluators/getAll', [EvaluatorController::class, 'index']);
        Route::post('/evaluators/show', [EvaluatorController::class, 'show']);
        Route::post('/evaluators/create', [EvaluatorController::class, 'store']);
        Route::post('/evaluators/update', [EvaluatorController::class, 'update']);
        Route::post('/evaluators/delete', [EvaluatorController::class, 'destroy']);

        #Formularios
        Route::post('/formularios/getAll', [FormularioController::class, 'index']);
        Route::post('/formularios/show', [FormularioController::class, 'show']);
        Route::post('/formularios/create', [FormularioController::class, 'store']);
        Route::post('/formularios/update', [FormularioController::class, 'update']);
        Route::post('/formularios/delete', [FormularioController::class, 'destroy']);

        #Formularios Detalles
        Route::post('/formularios/details/byFormulario', [FormularioDetailController::class, 'byFormulario']);
        Route::post('/formularios/details/show', [FormularioDetailController::class, 'show']);
        Route::post('/formularios/details/update', [FormularioDetailController::class, 'update']);
        Route::post('/formularios/details/delete', [FormularioDetailController::class, 'destroy']);

        #Evaluaciones
        Route::post('/evaluaciones/getAll', [EvaluationController::class, 'index']);
        Route::post('/evaluaciones/show', [EvaluationController::class, 'show']);
        Route::post('/evaluaciones/create', [EvaluationController::class, 'store']);
        Route::post('/evaluaciones/update', [EvaluationController::class, 'update']);
        Route::post('/evaluaciones/delete', [EvaluationController::class, 'destroy']);

        #Requerimientos Evaluaciones
        Route::post('/evaluaciones/requerimientos/byEvaluacion', [EvaluationRequirementController::class, 'byEvaluacion']);
        Route::post('/evaluaciones/requerimientos/show', [EvaluationRequirementController::class, 'show']);
        Route::post('/evaluaciones/requerimientos/update', [EvaluationRequirementController::class, 'update']);
        Route::post('/evaluaciones/requerimientos/delete', [EvaluationRequirementController::class, 'destroy']);

        #Coordinadores
        Route::post('/coordinators/getAll', [CoordinatorController::class, 'index']);
        Route::post('/coordinators/show', [CoordinatorController::class, 'show']);
        Route::post('/coordinators/create', [CoordinatorController::class, 'store']);
        Route::post('/coordinators/update', [CoordinatorController::class, 'update']);
        Route::post('/coordinators/delete', [CoordinatorController::class, 'destroy']);

        Route::post('/ievaluators/add', [InstitutionEvaluatorController::class, 'add']);
        Route::post('/ievaluators/remove', [InstitutionEvaluatorController::class, 'remove']);

        #Mensajes Convocatorias
        Route::get('/convocatorias/mensajes/getAll', [MensajesConvocatoriaController::class, 'index']);
        Route::post('/convocatorias/mensajes/show', [MensajesConvocatoriaController::class, 'show']);
        Route::post('/convocatorias/mensajes/create', [MensajesConvocatoriaController::class, 'store']);
        Route::post('/convocatorias/mensajes/update', [MensajesConvocatoriaController::class, 'update']);
        Route::post('/convocatorias/mensajes/delete', [MensajesConvocatoriaController::class, 'destroy']);

        #Convocatorias Tipos
        Route::post('convocatorias/tipos/create', [ConvocatoriaTypeController::class, 'store']);
        Route::post('convocatorias/tipos/update', [ConvocatoriaTypeController::class, 'update']);
        Route::post('convocatorias/tipos/delete', [ConvocatoriaTypeController::class, 'destroy']);

        #Convocatorias
        Route::get('convocatorias/getAll', [ConvocatoriaController::class, 'index']);
        Route::get('convocatorias/pendientes', [ConvocatoriaController::class, 'pendientes']);
        Route::post('convocatorias/create', [ConvocatoriaController::class, 'store']);
        Route::post('convocatorias/update', [ConvocatoriaController::class, 'update']);
        Route::post('convocatorias/setOpen', [ConvocatoriaController::class, 'setOpen']);
        Route::post('convocatorias/setPending', [ConvocatoriaController::class, 'setPending']);
        Route::post('convocatorias/setClose', [ConvocatoriaController::class, 'setClose']);
        Route::post('convocatorias/setPublished', [ConvocatoriaController::class, 'setPublished']);
        Route::post('convocatorias/setUnPublished', [ConvocatoriaController::class, 'setUnPublished']);
        Route::post('convocatorias/delete', [ConvocatoriaController::class, 'destroy']);

        #Convocatorias Detalles
        Route::post('convocatorias/details/create', [ConvocatoriaDetailController::class, 'store']);
        Route::post('convocatorias/details/update', [ConvocatoriaDetailController::class, 'update']);
        Route::post('convocatorias/details/delete', [ConvocatoriaDetailController::class, 'destroy']);

        #Oferentes
        Route::post('oferentes/create', [OffererController::class, 'store']);
        Route::post('oferentes/update', [OffererController::class, 'update']);
        Route::post('oferentes/delete', [OffererController::class, 'destroy']);

        #Horarios
        Route::post('horarios/create', [ScheduleController::class, 'store']);
        Route::post('horarios/update', [ScheduleController::class, 'update']);
        Route::post('horarios/activate', [ScheduleController::class, 'activate']);
        Route::post('horarios/deactivate', [ScheduleController::class, 'deactivate']);
        Route::post('horarios/delete', [ScheduleController::class, 'destroy']);

        #Solicitudes Estados
        Route::get('solicitudes/estados/getAll', [AplicationStatusController::class, 'index']);
        Route::post('solicitudes/estados/show', [AplicationStatusController::class, 'show']);
        Route::get('solicitudes/estados/getCloseStatus', [AplicationStatusController::class, 'closeStatus']);

        #Solicitudes
        Route::post('solicitudes/create', [AplicationController::class, 'store']);
        Route::post('solicitudes/cancelar', [AplicationController::class, 'cancelar']);
        Route::post('solicitudes/cerrar', [AplicationController::class, 'cerrar']);
        Route::post('solicitudes/enviar', [AplicationController::class, 'enviar']);
        Route::get('solicitudes/getAll', [AplicationController::class, 'index']);
        Route::get('solicitudes/getByCandidato', [AplicationController::class, 'getByCandidato']);
        Route::post('solicitudes/getSolicitudes', [AplicationController::class, 'getSolicitudes']);

        Route::post('solicitudes/byEvaluator', [AplicationController::class, 'getByEvaluator']);
        Route::get('solicitudes/pendientes', [AplicationController::class, 'pendientes']);
        Route::get('solicitudes/enviadas', [AplicationController::class, 'enviadas']);
        Route::get('solicitudes/cerradas', [AplicationController::class, 'cerradas']);
        Route::post('solicitudes/show', [AplicationController::class, 'show']);

        #Solicitudes Evaluar!!
        Route::post('solicitudes/details/evaluate', [AplicationDetailController::class, 'evaluate']);

        #Solicitudes Contestar Formularios
        Route::post('solicitudes/forms/answer', [AplicationFormController::class, 'answer']);
        Route::post('solicitudes/forms/show', [AplicationFormController::class, 'show']);

        #Becados
        Route::get('becados/getAll', [ScholarshipController::class, 'index']);
        Route::get('becados/getEstados', [ScholarshipController::class, 'estados']);
        Route::post('becados/show', [ScholarshipController::class, 'show']);
        Route::post('becados/updateEstado', [ScholarshipController::class, 'updateEstado']);
        Route::get('becados/egresados', [ScholarshipController::class, 'egresados']);
        Route::get('becados/retirados', [ScholarshipController::class, 'retirados']);
        Route::get('becados/expulsados', [ScholarshipController::class, 'expulsados']);
        Route::get('becados/activos', [ScholarshipController::class, 'activos']);
        Route::get('becados/suspendidos', [ScholarshipController::class, 'suspendidos']);

        #Becados Portal Candidatos
        Route::get('becados/getMisBecas', [ScholarshipController::class, 'becado']);
        Route::get('becados/getMisCalificaciones', [ScholarshipDetailController::class, 'becado']);

        #Becados Details
        Route::get('becados/detalles/getAll', [ScholarshipDetailController::class, 'index']);
        Route::post('becados/detalles/filtros', [ScholarshipDetailController::class, 'filter']);
        Route::post('becados/detalles/show', [ScholarshipDetailController::class, 'show']);
        Route::post('becados/detalles/create', [ScholarshipDetailController::class, 'store']);
        Route::post('becados/detalles/update', [ScholarshipDetailController::class, 'update']);
        Route::post('becados/detalles/delete', [ScholarshipDetailController::class, 'destroy']);

        #Documentos
        Route::get('documentos/getAll', [DocumentController::class, 'index']);
        Route::get('documentos/forUser', [DocumentController::class, 'forUser']);
        Route::post('documentos/byAplication', [DocumentController::class, 'byAplication']);
        Route::post('documentos/show', [DocumentController::class, 'show']);
        Route::post('documentos/create', [DocumentController::class, 'store']);
        Route::post('documentos/delete', [DocumentController::class, 'destroy']);

        #Audiencia (Publico)
        Route::post('publico/create', [AudienceController::class, 'store']);
        Route::post('publico/update', [AudienceController::class, 'update']);
        Route::post('publico/delete', [AudienceController::class, 'destroy']);

        #Instituciones Tipos
        Route::post('instituciones/tipos/create', [InstitutionTypeController::class, 'store']);
        Route::post('instituciones/tipos/update', [InstitutionTypeController::class, 'update']);
        Route::post('instituciones/tipos/delete', [InstitutionTypeController::class, 'destroy']);

        #Instituciones
        Route::post('instituciones/create', [InstitutionController::class, 'store']);
        Route::post('instituciones/update', [InstitutionController::class, 'update']);
        Route::post('instituciones/delete', [InstitutionController::class, 'destroy']);

        #Instituciones Ofertas Academicas
        Route::get('instituciones/ofertas/getAll', [InstitutionOfferController::class, 'index']);
        Route::post('instituciones/ofertas/institucion', [InstitutionOfferController::class, 'byInstitution']);
        Route::post('instituciones/ofertas/show', [InstitutionOfferController::class, 'show']);
        Route::post('instituciones/ofertas/create', [InstitutionOfferController::class, 'store']);
        Route::post('instituciones/ofertas/update', [InstitutionOfferController::class, 'update']);
        Route::post('instituciones/ofertas/delete', [InstitutionOfferController::class, 'destroy']);

        #Campus
        Route::get('campus/getAll', [CampusController::class, 'index']);
        Route::post('campus/institucion', [CampusController::class, 'byInstitution']);
        Route::post('campus/show', [CampusController::class, 'show']);
        Route::post('campus/create', [CampusController::class, 'store']);
        Route::post('campus/update', [CampusController::class, 'update']);
        Route::post('campus/delete', [CampusController::class, 'destroy']);

        #Areas de Desarrollo
        Route::post('areas/desarrollo/create', [DevelopmentAreaController::class, 'store']);
        Route::post('areas/desarrollo/update', [DevelopmentAreaController::class, 'update']);
        Route::post('areas/desarrollo/activate', [DevelopmentAreaController::class, 'activate']);
        Route::post('areas/desarrollo/deactivate', [DevelopmentAreaController::class, 'deactivate']);
        Route::post('areas/desarrollo/delete', [DevelopmentAreaController::class, 'destroy']);

        #Niveles Educativos
        Route::post('niveles/educativos/create', [EducationLevelController::class, 'store']);
        Route::post('niveles/educativos/update', [EducationLevelController::class, 'update']);
        Route::post('niveles/educativos/delete', [EducationLevelController::class, 'destroy']);

        #Instituciones Carreras
        Route::post('instituciones/carreras/getAll', [AcademicOfferController::class, 'index']);
        Route::post('instituciones/carreras/byEducationLevel', [AcademicOfferController::class, 'byEducationLevel']);
        Route::post('instituciones/carreras/byOfferType', [AcademicOfferController::class, 'byOfferType']);
        Route::post('instituciones/carreras/show', [AcademicOfferController::class, 'show']);
        Route::post('instituciones/carreras/create', [AcademicOfferController::class, 'store']);
        Route::post('instituciones/carreras/update', [AcademicOfferController::class, 'update']);
        Route::post('instituciones/carreras/delete', [AcademicOfferController::class, 'destroy']);
        Route::post('instituciones/carreras/activate', [AcademicOfferController::class, 'activate']);
        Route::post('instituciones/carreras/deactivate', [AcademicOfferController::class, 'deactivate']);

        #Ofertas Academicas Tipos
        Route::post('ofertas/academicas/tipos/create', [AcademicOfferTypeController::class, 'store']);
        Route::post('ofertas/academicas/tipos/update', [AcademicOfferTypeController::class, 'update']);
        Route::post('ofertas/academicas/tipos/delete', [AcademicOfferTypeController::class, 'destroy']);


        #ExperienciaLaboral
        Route::get('/candidatos/experiencia/getAll', [ExperienciaLaboralController::class, 'index']);
        Route::get('/candidatos/experiencia/show', [ExperienciaLaboralController::class, 'show']);
        Route::post('/candidatos/experiencia/create', [ExperienciaLaboralController::class, 'store']);
        Route::post('/candidatos/experiencia/update', [ExperienciaLaboralController::class, 'update']);
        Route::post('/candidatos/experiencia/delete', [ExperienciaLaboralController::class, 'destroy']);

        #FormacionAcademica
        Route::get('/candidatos/formacion/getAll', [FormacionAcademicaController::class, 'index']);
        Route::get('/candidatos/formacion/show', [FormacionAcademicaController::class, 'show']);
        Route::post('/candidatos/formacion/create', [FormacionAcademicaController::class, 'store']);
        Route::post('/candidatos/formacion/update', [FormacionAcademicaController::class, 'update']);
        Route::post('/candidatos/formacion/delete', [FormacionAcademicaController::class, 'destroy']);

        #Notificaciones
        Route::get('/notificaciones/getAll', [NotificacionController::class, 'index']);
        Route::get('/notificaciones/show', [NotificacionController::class, 'show']);
        Route::post('/notificaciones/update', [NotificacionController::class, 'update']);
        Route::post('/notificaciones/delete', [NotificacionController::class, 'destroy']);

        #SocioEconomicos
        Route::get('/candidatos/economicos/get', [SocioEconomicoController::class, 'index']);
        Route::post('/candidatos/economicos/update', [SocioEconomicoController::class, 'update']);
    });




//FALL BACK ROUTE FOR NO URL FOUND
Route::fallback(function () {
    return response()->json([
        'status' => 'error', 'message' => 'Incorrect Route or not logged'], ResponseCodes::NOT_FOUND);
});
