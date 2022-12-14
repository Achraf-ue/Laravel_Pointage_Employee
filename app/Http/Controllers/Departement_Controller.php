<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Deparetement;

class Departement_Controller extends Controller
{
    //
    public function Departement_Vue()
    {
        $Deparetements = DB::table('deparetements')
        ->orderBy('created_at', 'desc')
        ->get();
        return view("departement.Departement",compact('Deparetements')); 
    }
    public function Departement_Filter(Request $request)
    {
        if($request->ajax())
        {
            $Filter_1 = $_GET['Filter_1'];
            $output ='';
            if($Filter_1 != 'Tous')
            $Deparetements = DB::table('deparetements')->where('id',$Filter_1)->get();
            else
            $Deparetements = DB::table('deparetements')->get();
            foreach($Deparetements as $Deparetement)
            $output .='<tr><td>'.$Deparetement->id.'</td><td>'.$Deparetement->Deparetement_Nom.'</td><td>'.$Deparetement->Date_Debut.'</td><td>'.$Deparetement->Date_Fin.'</td><td><a href='.route('Modifier_Departement_Vue',$Deparetement->id).'><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a></td></tr>';
            
            return response($output);
        }
         
    }
    public function Ajouter_Département(Request $request)
    {
       $data = new Deparetement();
       $data->Deparetement_Nom = $request->Deparetement_Nom;
       $data->Date_Debut = $request->Date_Debut;
       $data->Date_Debut_Samedi = $request->Date_Debut_1;
       $data->Date_Fin = $request->Date_Fin;
       $data->Date_Fin_Samedi = $request->Date_Fin_1;
       $data->tollerence_active = $request->tollerence_active;
       $data->tollerence_soustraire = $request->tollerence_soustraire;
       $data->tollerence = $request->tollerence;
       $Count  = Deparetement::where('Deparetement_Nom','=',$data->Deparetement_Nom)->count();
       if($Count == 0 && $data->Deparetement_Nom != null )
       {
        $data->save();
        $notification = array('message' => 'Bien Ajouter', 'alert-type' => 'success'); 
        $Deparetements = DB::table('deparetements')->orderBy('created_at', 'desc')->get();
        $Return_finale =  redirect()->route('Departement_Vue',compact('Deparetements'))->with($notification);
       }
       else
       {
        if($Count != 0)
        $Message = "Département déja exist";
        else
        if($data->Deparetement_Nom == null)
        $Message = "Donner un département";
        $notification = array('message' => $Message, 'alert-type' => 'error');
        $Return_finale =  redirect()->route('Ajouter.departement')->with($notification);
       }
      
       return $Return_finale;
    }
    public function Departement_Modifier(Request $request)
    {
        $Data = [];
        $id = $request->id;
        $Data = Deparetement::find($id);
        $Data->Deparetement_Nom = $request->Departement;
        $Data->Date_Debut = $request->Date_Debut;
        $Data->Date_Debut_Samedi = $request->Date_Debut_1;
        $Data->Date_Fin = $request->Date_Fin;
        $Data->Date_Fin_Samedi = $request->Date_Fin_1;
        $Data->tollerence_active = $request->tollerence_active;
        $Data->tollerence_soustraire = $request->tollerence_soustraire;
        $Data->tollerence = $request->tollerence;
        $Data->save();
        $Deparetement = Deparetement::find($id);
        $notification = array('message' => 'Bien modifier departement', 'alert-type' => 'success');
        return redirect()->route('Departement_Vue',compact('Deparetement'))->with($notification);

    }
    public function Departement_Modal(Request $request)
    {
        if($request->ajax())
        {
        $Id_departement = $_GET['Id_departement'];
        $Deparetement = DB::table('deparetements')->where('id','=',$Id_departement)->first();
        $Employees = DB::table('employes')->where('Departement','=',$Id_departement)->get();
        $output = '';
        $output .='<table border="0" width="100%">';
        foreach($Employees as $Employee)
        {
        $output .='<tr>
        <td style="padding:10px;">  
        <p>Nom complet       : '.$Employee->Nom.' '.$Employee->Prenom.'</p>';
        
        }
        $output .='<p>Plagehoraire  lundi à vendredi     : '.$Deparetement->Date_Debut.'  /  '.$Deparetement->Date_Fin.'</p>';
        $output .='<p>Plagehoraire  samedi     : '.$Deparetement->Date_Debut_Samedi.'  /  '.$Deparetement->Date_Fin_Samedi.'</p>';
        $output .= '</table>';

        return response($output);
        }
    }
}
