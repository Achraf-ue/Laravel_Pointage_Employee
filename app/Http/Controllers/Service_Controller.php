<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use Illuminate\Http\Request;

class Service_Controller extends Controller
{
    public function Service_vue()
    {
        $Services = DB::table('services')
            ->join('deparetements', 'services.id_departement', '=', 'deparetements.id')
            ->select('services.id','services.id_departement','services.services','deparetements.Deparetement_Nom')
            ->get();
            //return dd($Services);
        return view('services.Services',compact('Services'));
    }
    public function Service_Ajouter()
    {
        $Deparetements = DB::table('deparetements')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('services.Ajouter_service',compact('Deparetements'));
    }
    public function Ajouter_Service(Request $request)
    {
        $data = new Service();
        $data->id_departement = $request->Departement_employee;
        $data->services = $request->Nom_service;
        $data->save();
        $Services = DB::table('services')
            ->join('deparetements', 'services.id_departement', '=', 'deparetements.id')
            ->get();
        $notification = array('message' => 'Bien Ajouter', 'alert-type' => 'success');
        return redirect()->route('Service_Vue',compact('Services'))->with($notification);
    }
    public function Service_Modifier(Request $request)
    {
        $data = [];
        $id = $request->id  ;
        $data = Service::find($id);
        $data->id_departement = $request->Departement_employee;
        $data->services = $request->Nom_service;
        $data->save();
        $Services = DB::table('services')
            ->join('deparetements', 'services.id_departement', '=', 'deparetements.id')
            ->select('services.id','services.id_departement','services.services','deparetements.Deparetement_Nom')
            ->get();
        $notification = array('message' => 'Bien modifier', 'alert-type' => 'success');
        return redirect()->route('Service_Vue',compact('Services'))->with($notification);
    }
}
