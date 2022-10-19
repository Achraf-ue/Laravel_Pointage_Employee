<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Departement_Controller;
use App\Http\Controllers\Pointage_Employee_Controller;
use App\Http\Controllers\Motif_Absence_Controller;
use App\Http\Controllers\Facture_Echeance_Controller;
use App\Http\Controllers\Employes;
use App\Http\Controllers\Rapport_Pointage_Controller;
use App\Models\Deparetement;
use App\Models\Employe;
use App\Models\Pointage_Employee;
use App\Models\Motif_Absence;
use App\Models\Notification;
use App\Models\Retard;
use App\Models\Rapport_Pointage;
use App\Models\facture_echeance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $Departement_Count = Deparetement::all()->count();
        $Employee_Count = Employe::all()->count();
        $now  = Carbon::now()->format('Y-m-d');
        $Count_Entre   = Pointage_Employee::where('Date_Jour','=',$now)->where('Type_Pointage','=','Entre')->count();
        $Count_Sortir  = Pointage_Employee::where('Date_Jour','=',$now)->where('Type_Pointage','=','Sortir')->count();
        $Employees = DB::table('employes')->orderBy('created_at','desc')->get();
        //$Retards = DB::table('retards')->join('employes', 'employes.id', '=', 'retards.Id_Employee')->join('deparetements', 'retards.Id_Departement', '=', 'deparetements.id')->select('Cin','retard.id');
        $Retards = DB::select("select retards.id,employes.Cin,retards.Temps_Retard,retards.Date_Entre,deparetements.Deparetement_Nom,employes.Nom,employes.Prenom,retards.Date_Jour from retards INNER JOIN deparetements on deparetements.id = retards.Id_Departement INNER JOIN employes on employes.id = retards.Id_Employee");
        return view('admin.index',compact('Departement_Count','Employee_Count','Count_Entre','Count_Sortir','Retards','Employees'));
    })->name('index');
//Admin route 
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'Logout')->name('admin.logout');     
});
//Déparetement route
Route::controller(Departement_Controller::class)->group(function () {
    Route::get('/Département/Vue', 'Departement_Vue')->name('Departement_Vue');
    Route::get('/Département/Ajoute',function(){return view('departement.Ajouter_departement');})->name('Ajouter.departement');
    Route::post('/Département/Ajouter','Ajouter_Département')->name('Ajouter_Département');
    Route::get('/Département/Modifier/{id}',function($id){$Deparetement = Deparetement::find($id);return view('departement.Modifier_departement',compact('Deparetement'));})->name('Modifier_Departement_Vue');
    Route::post('/Département/Modifier_','Departement_Modifier')->name('Departement_Modifier');
    Route::get('/Departement/Filter','Departement_Filter')->name('Departement.Filter');    
});
//Employé route
Route::controller(Employes::class)->group(function () {
    Route::get('/Employee/Vue',function(){ $Employes = DB::select('SELECT E.id,E.Cin,E.Nom,E.Prenom,E.Adress,D.Deparetement_Nom  FROM employes E INNER JOIN  deparetements D ON E.Departement  = D.id');return view('Employe.Employee',compact('Employes'));})->name('Employee');
    Route::get('/Employee/Filter','Employee_Filter')->name('Employee.Filter');
    Route::get('/Employee/Ajoute',function(){$Deparetements = DB::table('deparetements')->orderBy('created_at','desc')->get();return view('Employe.Ajouter_employee',compact('Deparetements'));})->name('Ajouter.Employee');
    Route::post('/Employee/Ajouter','Ajouter_Employee')->name('Ajouter_Employee_');
    Route::get('/Employee/Delete/{id}','Employee_Delete')->name('Employee.Delete');
    Route::get('/Employee/Modifier/{id}',function($id){$Deparetements = DB::table('deparetements')->orderBy('created_at','desc')->get();$Employes = Employe::find($id);return view('Employe.Modifier_employee',compact('Employes','Deparetements'));})->name('Employee.Moidfier');
    Route::post('/Employee/Modifier','Employee_Modifier')->name('Employee_Modifier');  
});
//Pointage Employee Route
Route::controller(Pointage_Employee_Controller::class)->group(function () {
    Route::get('/Pointage','Pointage_')->name('Pointage');
    Route::get('/Pointage/Entre','Entre_Vue')->name('Pointage.Entre');
    Route::get('/Pointage/Sortir','Sortir_Vue')->name('Pointage.Sortir');
    Route::post('/Pointage/Entre/Ajouter','Entre_Employee')->name('Pointage.Entre.Ajouter');
    Route::post('/Pointage/Sortir/Ajouter','Sortir_Employee')->name('Pointage.Entre.Sortir');
    Route::get('/Pointage/Filter','Pointage_Filter')->name('Pointage_Filter');
    Route::get('/Retard/Filter_home','Retard_Filter')->name('Retard_Filter');
    Route::get('/Retard/Filter','Retard_Modal')->name('Retard.Modal'); 

    Route::get('/Retard/PDF','Generate_Pointage_Pdf')->name('Generate.Pointage.Pdf');
    
});
//Rapport pointage 
Route::controller(Rapport_Pointage_Controller::class)->group(function () {
    Route::get('/Rapport_Pointage','Pointage_rapport')->name('Rapport_Pointage');
    Route::get('/Rapoort/Filter/Modal','Rapport_Modal')->name('Rapport.Modal');
    Route::get('/Rapoort/Filter','Rapport_Pointage_Filter')->name('Rapport.Pointage.filter'); 
    Route::get('/Rapport/Motive_Absence','Change_Motive_Absence')->name('Change_Motive_Absence');
    Route::get('/Rapprt_Pointage/PDF','Generate__Rapport_Pointage_Pdf')->name('Generate.Pointage.Rapport.Pdf');
    
});
//Fin rapportb pointage 
Route::controller(Motif_Absence_Controller::class)->group(function () {
    Route::get('/Motif_Absence/Vue', 'Motif_Vue')->name('Motif_Vue');
    Route::get('/Motif_Absence/Ajoute',function(){return view('Motif_Absence.Ajouter_motif');})->name('Ajouter.motif');
    Route::post('/Motif_Absence/Ajoute/Ajouter','Ajouter_Motif')->name('Ajouter.motif_absence');
    Route::get('/Motif_Absence/Modifier/{id}',function($id){$Motif = Motif_Absence::find($id);return view('Motif_Absence.Modifier_motif',compact('Motif'));})->name('Modifier_motif');
    Route::post('/Motif_Absence/Modifier','Modifier_Motif')->name('Modifier_Motif_F');




});
Route::controller(Facture_Echeance_Controller::class)->group(function () {
    Route::get('/facture_echeances/vue',function(){
        $facture_echeances = facture_echeance::all();
        return view('facture_echeance.facture',compact('facture_echeances'));
    })->name('factures_echeances');
    Route::get('/factures_echeances/Ajoute',function(){return view('facture_echeance.Ajouter');})->name('Ajouter_facture');
    Route::post('/factures_echeances/Ajoute/Ajouter','Ajouter_facture')->name('Ajouter_facture_echeances');
    Route::get('/facture_echeances/Modifier/{id}',function($id){$facture_echeance = facture_echeance::find($id);return view('facture_echeance.Modifier',compact('facture_echeance'));})->name('Modifier_facture');
    Route::post('/facture_echeances/Modifier','Modifier_facture')->name('modifier_facture_echeances');
    Route::get('/facture/Filter','Facture_Filter')->name('Facture_Filter');
    Route::get('/Facture/Model','Facture_Modal')->name('Facture.Modal'); 
    Route::get('/facture/PDF','Generate_Pdf')->name('Generate.Pdf');
    Route::get('/facture/Etat/Pdf/{id}','Etat_Facture_Pdf')->name('Etat.Facture.Pdf');



});
});
