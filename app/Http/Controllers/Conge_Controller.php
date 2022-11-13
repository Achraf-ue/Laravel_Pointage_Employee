<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Congé;
use Illuminate\Http\Request;

class Conge_Controller extends Controller
{
    public function Ajouter_Congé(Request $request)
    {
       $data = new Congé();
       $data->Id_Employee = $request->Employe;
       $Employee = DB::table('employes')->where('id',$request->Employe)->first();
       $data->Nom_Employee = $Employee->Nom.' '.$Employee->Prenom;
       $data->Date_Debut = $request->Date_Debut;
       $data->Date_Fin = $request->Date_Fin;
       $data->H_S_T = $request->H_S_T;
       $data->save();
       $notification = array('message' => 'Bien Ajouter congé', 'alert-type' => 'success'); 
       $Congés = Congé::all();
       return redirect()->route('Congé.Vue',compact('Congés'))->with($notification);
    }
    public function Congé_Modifier(Request $request)
    {
       $data = [];
       $id = $request->id;
       $data = Congé::find($id);
       $Employee = DB::table('employes')->where('id',$request->Employe)->first();
       $data->Id_Employee = $Employee->id;
       $data->Nom_Employee = $Employee->Nom.' '.$Employee->Prenom;
       $data->Date_Debut = $request->Date_Debut;
       $data->Date_Fin = $request->Date_Fin;
       $data->H_S_T = $request->H_S_T;
       $data->save();
       $notification = array('message' => 'Bien Modifier', 'alert-type' => 'success'); 
       $Congés = Congé::all();
       return redirect()->route('Congé.Vue',compact('Congés'))->with($notification);
    }

}
