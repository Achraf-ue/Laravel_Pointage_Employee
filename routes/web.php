<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Departement_Controller;
use App\Http\Controllers\Pointage_Employee_Controller;
use App\Http\Controllers\Motif_Absence_Controller;
use App\Http\Controllers\Facture_Echeance_Controller;
use App\Http\Controllers\Employes;
use App\Http\Controllers\Pointeuse_Controller;
use App\Http\Controllers\Rapport_Pointage_Controller;
use App\Http\Controllers\Fetes_Controller;
use App\Http\Controllers\Conge_Controller;
use App\Http\Controllers\Absence_Controller;
use App\Http\Controllers\Horaire_Controller;
use App\Http\Controllers\Service_Controller;
use App\Http\Controllers\Societe_Controller;
use App\Models\Societe;
use App\Models\Service;
use App\Models\Deparetement;
use App\Models\Employe;
use App\Models\Pointeuse;
use App\Models\Pointage_Employee;
use App\Models\Motif_Absence;
use App\Models\Horaire;
use App\Models\Notification;
use App\Models\Retard;
use App\Models\Rapport_Pointage;
use App\Models\facture_echeance;
use App\Models\Fetes;
use App\Models\Congé;
use APP\Models\Absence;
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
        $now  = Carbon::now()->format('Y-m-d');
        $Departement_Count = Deparetement::all()->count();
        $Employee_Count = Employe::all()->count();
        $Count_rtard = DB::table('retards')->where('read_at','!=','1')->count();
        $Count_absence = DB::table('absences')->where('read_at','!=','1')->count();
        //Congé
        $Count_Congé = DB::table('congés')->where('Date_Debut','<=',$now)->where('Date_Fin','>=',$now)->count();
        //Fin congé
        
        $Count_Entre   = Pointage_Employee::where('Date_Jour','=',$now)->where('Type_Pointage','=','Entre')->count();
        $Count_Sortir  = Pointage_Employee::where('Date_Jour','=',$now)->where('Type_Pointage','=','Sortir')->count();
        $Employees = DB::table('employes')->orderBy('created_at','desc')->get();
        $Absences = DB::table('absences')->orderBy('created_at','desc')->get();
        //$Retards = DB::table('retards')->join('employes', 'employes.id', '=', 'retards.Id_Employee')->join('deparetements', 'retards.Id_Departement', '=', 'deparetements.id')->select('Cin','retard.id');
        $Retards = DB::select("select retards.id,employes.Cin,retards.Temps_Retard,retards.Date_Entre,deparetements.Deparetement_Nom,employes.Nom,employes.Prenom,retards.Date_Jour from retards INNER JOIN deparetements on deparetements.id = retards.Id_Departement INNER JOIN employes on employes.id = retards.Id_Employee");
        return view('admin.index',compact('Absences','Departement_Count','Employee_Count','Count_Entre','Count_Sortir','Retards','Employees','Count_rtard','Count_absence','Count_Congé'));
    })->name('index');
//Admin route 
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'Logout')->name('admin.logout');
    Route::get('/admin/Profile', 'Profile_User')->name('admin.profile');
    Route::post('/admin/Profile/Update', 'Update_User')->name('admin.profile.update');
});
//Déparetement route
Route::controller(Departement_Controller::class)->group(function () {
    Route::get('/Département/Vue', 'Departement_Vue')->name('Departement_Vue');
    Route::get('/Département/Ajoute',function(){return view('departement.Ajouter_departement');})->name('Ajouter.departement');
    Route::post('/Département/Ajouter','Ajouter_Département')->name('Ajouter_Département');
    Route::get('/Département/Modifier/{id}',function($id){$Deparetement = Deparetement::find($id);return view('departement.Modifier_departement',compact('Deparetement'));})->name('Modifier_Departement_Vue');
    Route::post('/Département/Modifier_','Departement_Modifier')->name('Departement_Modifier');
    Route::get('/Departement/Filter','Departement_Filter')->name('Departement.Filter');
    Route::get('/Departement/Modal','Departement_Modal')->name('Departement.Modal');    
});
//Employé route
Route::controller(Employes::class)->group(function () {
    Route::get('/Employee/Vue',function(){ $Employes = DB::select('SELECT E.telephone,E.Employee_Image,E.id,E.Cin,E.Nom,E.Prenom,E.Adress,D.Deparetement_Nom  FROM employes E INNER JOIN  deparetements D ON E.Departement  = D.id');return view('Employe.Employee',compact('Employes'));})->name('Employee');
    Route::get('/Employee/Filter','Employee_Filter')->name('Employee.Filter');
    Route::get('/Employee/Ajoute',function(){$Deparetements = DB::table('deparetements')->orderBy('created_at','desc')->get();return view('Employe.Ajouter_employee',compact('Deparetements'));})->name('Ajouter.Employee');
    Route::post('/Employee/Ajouter','Ajouter_Employee')->name('Ajouter_Employee_');
    Route::get('/Employee/Delete/{id}','Employee_Delete')->name('Employee.Delete');
    Route::get('/Employee/Modifier/{id}',function($id){$Deparetements = DB::table('deparetements')->orderBy('created_at','desc')->get();$Employes = Employe::find($id);return view('Employe.Modifier_employee',compact('Employes','Deparetements'));})->name('Employee.Moidfier');
    Route::post('/Employee/Modifier_back_end','Employee_Modifier')->name('Employee_Modifier_back_end');
    Route::get('/Employee/Modal','Employee_Modal')->name('Employee.Modal');










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
    Route::get('/Retard/Notification','Retard_Notification')->name('Retard_Notification_'); 
    Route::get('/Retard/PDF','Generate_Pointage_Pdf')->name('Generate.Pointage.Pdf');
    Route::get('/Pointage/Ajouter',function(){
        $Employees = DB::table('employes')->orderBy('created_at','desc')->get();
        return view('Pointage.Ajouter_pointage',compact('Employees'));})->name('Ajouter.pointage');
    Route::post('/Pointage/Ajouter/Back_end','Ajouter_Pointage')->name('Ajouter.pointage.back_end');

    Route::get('/Pointage/Teste_Ponteuse','ponteuse_vue')->name('Teste_Pointeuse');
    Route::get('/Pointage/Telecharger_Pontage/Pointeuse','ZkTeco')->name('Telecharger_Pointage');

   
    
});
//Rapport pointage 
Route::controller(Rapport_Pointage_Controller::class)->group(function () {
    Route::get('/Rapport_Pointage','Pointage_rapport')->name('Rapport_Pointage');
    Route::get('/Rapoort/Filter/Modal','Rapport_Modal')->name('Rapport.Modal');
    Route::get('/Rapoort/Filter','Rapport_Pointage_Filter')->name('Rapport.Pointage.filter'); 
    Route::get('/Rapport/Motive_Absence','Change_Motive_Absence')->name('Change_Motive_Absence');
    Route::get('/Rapprt_Pointage/PDF','Generate__Rapport_Pointage_Pdf')->name('Generate.Pointage.Rapport.Pdf');
    Route::get('/Rapprt_Pointage/Detailles/PDF','Generate_detailles__Rapport_Pointage_Pdf')->name('Generate.Pointage.Rapport.Detailles.Pdf');
    Route::get('/Rapport/Chart/Rapport','Chart_rapport')->name('Chart_rapport_R');
    Route::get('/Rapport/Rapport/Pdf','Generate__Retard_Pointage_Pdf')->name('Generate.Retard.Pointage.Pdf');

    





    
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
Route::controller(Fetes_Controller::class)->group(function () {
    Route::get('/Fétes/vue',function(){
        $Fetes = Fetes::all();
        return view('Fetes.Fetes',compact('Fetes'));
    })->name('Fetes.Vue');
    Route::get('/Fétes/Ajoute',function(){return view('Fetes.Ajouter_fete');})->name('Ajouter.Fete');
    Route::post('/Fétes/Ajoute/back-end','Ajouter_fete')->name('Ajouter.Fete_Back_End');
    Route::get('/Fétes/Modifier/{id}',function($id){$Fete = Fetes::find($id);return view('Fetes.Modifier_Fete',compact('Fete'));})->name('Modifier_Fete_Vue');
    Route::post('/Fétes/Modifier_back_end','Fete_Modifier')->name('Fete_Modifier_Back_end');
});

Route::controller(Conge_Controller::class)->group(function () {
    Route::get('/Congé/vue',function(){
        $Congés = Congé::all();
        return view('Congé.Congé',compact('Congés'));
    })->name('Congé.Vue');
    Route::get('/Congé/Ajoute',function(){
    $Employees = DB::table('employes')->orderBy('created_at','desc')->get();
    return view('Congé.Ajouter_congé',compact('Employees'));})->name('Ajouter.congé');
    Route::post('/Congé/Ajoute/back-end','Ajouter_Congé')->name('Ajouter.Congé_Back_End');
    Route::get('/Congé/Modifier/{id}',function($id){$Employees = DB::table('employes')->orderBy('created_at','desc')->get();$Congé = Congé::find($id);return view('Congé.Modifier_Congé',compact('Congé','Employees'));})->name('Modifier_Congé_Vue');
    Route::post('/Congé/Modifier_back_end','Congé_Modifier')->name('Congé_Modifier_Back_end');







});
//Absences_Notification_
Route::controller(Absence_Controller::class)->group(function () {
    Route::get('/Absences',function(){
        $Absences = DB::table('absences')->orderBy('created_at','desc')->get();
        return view('Absences.Absences',compact('Absences'));
    })->name('Absences.vue');

    Route::get('/Absence/Ajoute',function(){
        $Motifs = DB::table('motif__absences')->orderBy('created_at', 'desc')->get();
        $Employees = DB::table('employes')->orderBy('created_at','desc')->get();
        return view('Absences.Ajouter_absence',compact('Employees','Motifs'));})->name('Ajouter.absence');


    Route::get('/Absences/Notification','Absences_Notification')->name('Absences_Notification_');
    Route::post('/Absence/Ajoute/back-end','ajouter_absence')->name('Ajouter.Absence_Back_End');
    Route::get('/Absences/Modal','Absence_Modal')->name('Absence.Modal');  
    
    Route::get('/Absence/Filter','Absence_Filter')->name('Absence.Filter');
    Route::get('/Absence/Pdf','Generate__Absence_Pointage_Pdf')->name('Absence.Pdf');

    //Absence_Filter









});

Route::controller(Pointeuse_Controller::class)->group(function () {
    Route::get('/Pointeuse/vue',function(){
        $Pointeuses = Pointeuse::all();
        return view('Pointeuse.Pointeuse',compact('Pointeuses'));
    })->name('Pointeuse.Vue');
    Route::get('/Pointeuse/Ajoute',function(){
    return view('Pointeuse.Ajouter_pointeuse');})->name('Ajouter.pointeuse');
    Route::post('/Pointeuse/Ajoute/bACK8END','Ajouter_pointeuse')->name('Ajouter.Pointeuse_Back_End');
    Route::get('/Pointeuse/Modifier/{id}',function($id){$Pointeuse = Pointeuse::find($id);return view('Pointeuse.Modifier_pointeuse',compact('Pointeuse'));})->name('Pointeuse.Moidfier');
    Route::post('/Pointeuse/Modifier/Back_end','Pointeuse_Modifier')->name('Pointeuse.Modifier.Back_End');
    Route::get('/Pointeuse/Delete/{id}','Pointeuse_Delete')->name('Pointeuse.Delete');
});

Route::controller(Service_Controller::class)->group(function () {
    Route::get('/Service/Vue', 'Service_vue')->name('Service_Vue');
    Route::get('/Service/Ajouter', 'Service_Ajouter')->name('Ajouter.Service');
    Route::post('/Service/Ajouter/Back_end','Ajouter_Service')->name('Ajouter.Service.back_end');
    //Modifier
    Route::get('/Service/Modifier/{id}',function($id){$Deparetements = DB::table('deparetements')->orderBy('created_at','desc')->get();$Service = Service::find($id);return view('services.Modifier_service',compact('Service','Deparetements'));})->name('Modifier_Services_Vue');
    Route::post('/Service/Modifier_','Service_Modifier')->name('Service_Modifier_back_end');
    //Fin modifier


});




Route::controller(Horaire_Controller::class)->group(function () {
    Route::get('/Horaire/Vue', 'Horaire_vue')->name('Horiare_Vue');
    //Modifier
    Route::get('/Horaire/Modifier/{id}',function($id){$Horaire = Horaire::find($id);return view('Parametre.Modifier_Horaire',compact('Horaire'));})->name('Modifier_Horaire_Vue');
    Route::post('/Horaire/Modifier_','Horaire_Modifier')->name('Horaire_Modifier_back_end');
    //Fin modifier
});



Route::controller(Societe_Controller::class)->group(function () {
    Route::get('/Societé/Vue', 'Societé_vue')->name('Societé_Vue');
    //Ajouter
    Route::get('/Societé/Ajouter','Societe_Ajouter')->name('Societe_Ajouter_Vue');
    Route::post('/Societé/Ajouter_','Societe_Ajouter_Back_end')->name('Societe_Ajouter_back_end');
    //Fin ajouter
    Route::get('/Societé/Modal','Societe_Modal')->name('Societe.Modal');    
});












});
