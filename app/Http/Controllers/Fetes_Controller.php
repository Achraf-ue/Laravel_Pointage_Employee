<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Fetes;
use Illuminate\Http\Request;

class Fetes_Controller extends Controller
{
    public function Ajouter_fete(Request $request)
    {
       $data = new Fetes();
       $data->Nom_Fete = $request->Fete_Nom;
       $data->Date_Debut = $request->Date_Debut;
       $data->Date_Fin = $request->Date_Fin;
       $data->H_S_T = $request->H_S_T;
       $data->save();
       $notification = array('message' => 'Bien Ajouter', 'alert-type' => 'success'); 
       $Fetes = Fetes::all();
       return redirect()->route('Fetes.Vue',compact('Fetes'))->with($notification);
    }
    public function Fete_Modifier(Request $request)
    {
       $data = [];
       $id = $request->id;
       $data = Fetes::find($id);
       $data->Nom_Fete = $request->Fete_Nom;
       $data->Date_Debut = $request->Date_Debut;
       $data->Date_Fin = $request->Date_Fin;
       $data->H_S_T = $request->H_S_T;
       $data->save();
       $notification = array('message' => 'Bien Modifier', 'alert-type' => 'success'); 
       $Fetes = Fetes::all();
       return redirect()->route('Fetes.Vue',compact('Fetes'))->with($notification);
    }
}
