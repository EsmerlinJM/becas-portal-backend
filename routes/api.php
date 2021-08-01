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
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify'); // Make sure to keep this as your route name
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');


Route::get('/paises/getAll', [CountryController::class, 'index']);
Route::get('/paises/getOne', [CountryController::class, 'show']);
Route::get('/paises/search', [CountryController::class, 'search']);

Route::get('/provincias/getAll', [ProvinceController::class, 'index']);
Route::get('/provincias/getOne', [ProvinceController::class, 'show']);
Route::get('/provincias/search', [ProvinceController::class, 'search']);
Route::get('/provincias/byCountry', [ProvinceController::class, 'byCountry']);

Route::get('/municipios/getAll', [MunicipalityController::class, 'index']);
Route::get('/municipios/getOne', [MunicipalityController::class, 'show']);
Route::get('/municipios/search', [MunicipalityController::class, 'search']);
Route::get('/municipios/byProvince', [MunicipalityController::class, 'byProvince']);

Route::get('/sectores/getAll', [SectorController::class, 'index']);
Route::get('/sectores/getOne', [SectorController::class, 'show']);
Route::get('/sectores/search', [SectorController::class, 'search']);
Route::get('/sectores/byMunicipality', [SectorController::class, 'byMunicipality']);

Route::get('/logs/getAll', [LogController::class, 'index']);
Route::get('/logs/getOne', [LogController::class, 'show']);
Route::post('/logs/store', [LogController::class, 'store']);
Route::post('/logs/search', [LogController::class, 'search']);

Route::post('/profile/register', [AuthController::class, 'register']);
Route::post('/profile/login', [AuthController::class, 'login']);

Route::get('convocatorias/tipos/getAll', [ConvocatoriaTypeController::class, 'index']);
Route::post('convocatorias/tipos/show', [ConvocatoriaTypeController::class, 'show']);

Route::get('convocatorias/getAll', [ConvocatoriaController::class, 'index']);
Route::get('convocatorias/pendientes', [ConvocatoriaController::class, 'pendientes']);
Route::get('convocatorias/abiertas', [ConvocatoriaController::class, 'abiertas']);
Route::get('convocatorias/publicadas', [ConvocatoriaController::class, 'publicadas']);
Route::post('convocatorias/show', [ConvocatoriaController::class, 'show']);

Route::post('convocatorias/details/getAll', [ConvocatoriaDetailController::class, 'index']);
Route::post('convocatorias/details/show', [ConvocatoriaDetailController::class, 'show']);

Route::get('oferentes/getAll', [OffererController::class, 'index']);
Route::post('oferentes/show', [OffererController::class, 'show']);

Route::get('horarios/getAll', [ScheduleController::class, 'index']);
Route::post('horarios/show', [ScheduleController::class, 'show']);

Route::get('publico/getAll', [AudienceController::class, 'index']);
Route::post('publico/show', [AudienceController::class, 'show']);

Route::get('instituciones/tipos/getAll', [InstitutionTypeController::class, 'index']);
Route::post('instituciones/tipos/show', [InstitutionTypeController::class, 'show']);

Route::get('instituciones/getAll', [InstitutionController::class, 'index']);
Route::post('instituciones/show', [InstitutionController::class, 'show']);

Route::get('instituciones/ofertas/getAll', [InstitutionOfferController::class, 'index']);
Route::post('instituciones/ofertas/institucion', [InstitutionOfferController::class, 'byInstitution']);
Route::post('instituciones/ofertas/show', [InstitutionOfferController::class, 'show']);

Route::get('campus/getAll', [CampusController::class, 'index']);
Route::post('campus/institucion', [CampusController::class, 'byInstitution']);
Route::post('campus/show', [CampusController::class, 'show']);

Route::get('areas/desarrollo/getAll', [DevelopmentAreaController::class, 'index']);
Route::post('areas/desarrollo/show', [DevelopmentAreaController::class, 'show']);

Route::get('niveles/educativos/getAll', [EducationLevelController::class, 'index']);
Route::post('niveles/educativos/byArea', [EducationLevelController::class, 'byArea']);
Route::post('niveles/educativos/show', [EducationLevelController::class, 'show']);

Route::get('ofertas/academicas/tipos/getAll', [AcademicOfferTypeController::class, 'index']);
Route::post('ofertas/academicas/tipos/show', [AcademicOfferTypeController::class, 'show']);

Route::get('ofertas/academicas/getAll', [AcademicOfferController::class, 'index']);
Route::post('ofertas/academicas/byEducationLevel', [AcademicOfferController::class, 'byEducationLevel']);
Route::post('ofertas/academicas/byOfferType', [AcademicOfferController::class, 'byOfferType']);
Route::post('ofertas/academicas/show', [AcademicOfferController::class, 'show']);

Route::group(['middleware' => ['auth:api', 'verified']], function()
    {
        Route::post('/profile/logout', [AuthController::class, 'logout']);
        Route::post('/profile/changepassword', [ProfileController::class, 'changePassword']);
        Route::post('/profile/getProfile', [ProfileController::class, 'getProfile']);
        Route::post('/profile/update', [ProfileController::class, 'update']);

        Route::post('/users/getAll', [UserController::class, 'index']);
        Route::post('/users/show', [UserController::class, 'show']);
        Route::post('/users/create', [UserController::class, 'store']);
        Route::post('/users/update', [UserController::class, 'update']);
        Route::post('/users/resetpassword', [UserController::class, 'resetPassword']);

        Route::post('/evaluators/getAll', [EvaluatorController::class, 'index']);
        Route::post('/evaluators/show', [EvaluatorController::class, 'show']);
        Route::post('/evaluators/create', [EvaluatorController::class, 'store']);
        Route::post('/evaluators/update', [EvaluatorController::class, 'update']);
        Route::post('/evaluators/delete', [EvaluatorController::class, 'destroy']);

        Route::post('/coordinators/getAll', [CoordinatorController::class, 'index']);
        Route::post('/coordinators/show', [CoordinatorController::class, 'show']);
        Route::post('/coordinators/create', [CoordinatorController::class, 'store']);
        Route::post('/coordinators/update', [CoordinatorController::class, 'update']);
        Route::post('/coordinators/delete', [CoordinatorController::class, 'destroy']);

        Route::post('/ievaluators/add', [InstitutionEvaluatorController::class, 'add']);
        Route::post('/ievaluators/remove', [InstitutionEvaluatorController::class, 'remove']);

        Route::post('convocatorias/tipos/create', [ConvocatoriaTypeController::class, 'store']);
        Route::post('convocatorias/tipos/update', [ConvocatoriaTypeController::class, 'update']);
        Route::post('convocatorias/tipos/delete', [ConvocatoriaTypeController::class, 'destroy']);

        Route::post('convocatorias/create', [ConvocatoriaController::class, 'store']);
        Route::post('convocatorias/update', [ConvocatoriaController::class, 'update']);
        Route::post('convocatorias/publish', [ConvocatoriaController::class, 'publish']);
        Route::post('convocatorias/unpublish', [ConvocatoriaController::class, 'unpublish']);
        Route::post('convocatorias/open', [ConvocatoriaController::class, 'open']);
        Route::post('convocatorias/standby', [ConvocatoriaController::class, 'standby']);
        Route::post('convocatorias/delete', [ConvocatoriaController::class, 'destroy']);

        Route::post('convocatorias/details/create', [ConvocatoriaDetailController::class, 'store']);
        Route::post('convocatorias/details/update', [ConvocatoriaDetailController::class, 'update']);
        Route::post('convocatorias/details/delete', [ConvocatoriaDetailController::class, 'destroy']);

        Route::post('oferentes/create', [OffererController::class, 'store']);
        Route::post('oferentes/update', [OffererController::class, 'update']);
        Route::post('oferentes/delete', [OffererController::class, 'destroy']);

        Route::post('horarios/create', [ScheduleController::class, 'store']);
        Route::post('horarios/update', [ScheduleController::class, 'update']);
        Route::post('horarios/activate', [ScheduleController::class, 'activate']);
        Route::post('horarios/deactivate', [ScheduleController::class, 'deactivate']);
        Route::post('horarios/delete', [ScheduleController::class, 'destroy']);

        Route::get('solicitudes/estados/getAll', [AplicationStatusController::class, 'index']);
        Route::post('solicitudes/estados/show', [AplicationStatusController::class, 'show']);
        Route::get('solicitudes/estados/getCloseStatus', [AplicationStatusController::class, 'closeStatus']);

        Route::post('solicitudes/create', [AplicationController::class, 'store']);
        Route::post('solicitudes/cancelar', [AplicationController::class, 'cancelar']);
        Route::post('solicitudes/cerrar', [AplicationController::class, 'cerrar']);
        Route::post('solicitudes/enviar', [AplicationController::class, 'enviar']);
        Route::get('solicitudes/getAll', [AplicationController::class, 'index']);
        Route::get('solicitudes/pendientes', [AplicationController::class, 'pendientes']);
        Route::get('solicitudes/enviadas', [AplicationController::class, 'enviadas']);
        Route::get('solicitudes/cerradas', [AplicationController::class, 'cerradas']);
        Route::post('solicitudes/show', [AplicationController::class, 'show']);

        Route::post('solicitudes/details/evaluate', [AplicationDetailController::class, 'evaluate']);

        Route::post('solicitudes/forms/answerMultiple', [AplicationFormController::class, 'answerMultiple']);
        Route::post('solicitudes/forms/answer', [AplicationFormController::class, 'answer']);
        Route::post('solicitudes/forms/show', [AplicationFormController::class, 'show']);

        Route::get('documentos/getAll', [DocumentController::class, 'index']);
        Route::get('documentos/forUser', [DocumentController::class, 'forUser']);
        Route::post('documentos/byAplication', [DocumentController::class, 'byAplication']);
        Route::post('documentos/show', [DocumentController::class, 'show']);
        Route::post('documentos/create', [DocumentController::class, 'store']);
        Route::post('documentos/delete', [DocumentController::class, 'destroy']);

        Route::post('publico/create', [AudienceController::class, 'store']);
        Route::post('publico/update', [AudienceController::class, 'update']);
        Route::post('publico/delete', [AudienceController::class, 'destroy']);

        Route::post('instituciones/tipos/create', [InstitutionTypeController::class, 'store']);
        Route::post('instituciones/tipos/update', [InstitutionTypeController::class, 'update']);
        Route::post('instituciones/tipos/delete', [InstitutionTypeController::class, 'destroy']);

        Route::post('instituciones/create', [InstitutionController::class, 'store']);
        Route::post('instituciones/update', [InstitutionController::class, 'update']);
        Route::post('instituciones/delete', [InstitutionController::class, 'destroy']);

        Route::post('instituciones/ofertas/create', [InstitutionOfferController::class, 'store']);
        Route::post('instituciones/ofertas/update', [InstitutionOfferController::class, 'update']);
        Route::post('instituciones/ofertas/delete', [InstitutionOfferController::class, 'destroy']);

        Route::post('campus/create', [CampusController::class, 'store']);
        Route::post('campus/update', [CampusController::class, 'update']);
        Route::post('campus/delete', [CampusController::class, 'destroy']);

        Route::post('areas/desarrollo/create', [DevelopmentAreaController::class, 'store']);
        Route::post('areas/desarrollo/update', [DevelopmentAreaController::class, 'update']);
        Route::post('areas/desarrollo/activate', [DevelopmentAreaController::class, 'activate']);
        Route::post('areas/desarrollo/deactivate', [DevelopmentAreaController::class, 'deactivate']);
        Route::post('areas/desarrollo/delete', [DevelopmentAreaController::class, 'destroy']);

        Route::post('niveles/educativos/create', [EducationLevelController::class, 'store']);
        Route::post('niveles/educativos/update', [EducationLevelController::class, 'update']);
        Route::post('niveles/educativos/delete', [EducationLevelController::class, 'destroy']);

        Route::post('ofertas/academicas/tipos/create', [AcademicOfferTypeController::class, 'store']);
        Route::post('ofertas/academicas/tipos/update', [AcademicOfferTypeController::class, 'update']);
        Route::post('ofertas/academicas/tipos/delete', [AcademicOfferTypeController::class, 'destroy']);

        Route::post('ofertas/academicas/create', [AcademicOfferController::class, 'store']);
        Route::post('ofertas/academicas/update', [AcademicOfferController::class, 'update']);
        Route::post('ofertas/academicas/delete', [AcademicOfferController::class, 'destroy']);
        Route::post('ofertas/academicas/activate', [AcademicOfferController::class, 'activate']);
        Route::post('ofertas/academicas/deactivate', [AcademicOfferController::class, 'deactivate']);

    });


    //FALL BACK ROUTE FOR NO URL FOUND
Route::fallback(function () {
    return response()->json([
        'status' => 'error', 'message' => 'Incorrect Route'], ResponseCodes::NOT_FOUND);
});