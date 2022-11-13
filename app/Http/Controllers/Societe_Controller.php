<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Societe;
use Illuminate\Http\Request;

class Societe_Controller extends Controller
{
    public function Societé_vue()
    {
        $Societes = DB::table('societes')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('Societes.Societes',compact('Societes'));
    }
    public function Societe_Ajouter(){
        return view('Societes.Ajouter_societe');
    }
    public function Societe_Ajouter_Back_end(Request $request)
    {
        $data = new Societe();
        $data->Nom_Societe = $request->Nom_Societe;
        $data->save();
        $Societes = DB::table('societes')
        ->orderBy('created_at', 'desc')
        ->get();
        $notification = array('message' => 'Bien Ajouter Sociéte', 'alert-type' => 'success');
        return redirect()->route('Societé_Vue',compact('Societes'))->with($notification);
    }
    public function Societe_Modal(Request $request)
    {
        if($request->ajax())
        {
        $Id_Societe = $_GET['Id_Societe'];
        $Deparetements = DB::table('deparetements')->where('Id_Societe','=',$Id_Societe)->get();
        $output = '';
        $output .='<table border="0" width="100%">';
        foreach($Deparetements  as $Deparetement)
        {
        $output .='<tr>
        <td style="padding:10px;">  
        <p>Nom departement       : '.$Deparetement->Deparetement_Nom.'</p>';
        
        }
        $output .= '</table>';

        return response($output);
        }
    }
}
