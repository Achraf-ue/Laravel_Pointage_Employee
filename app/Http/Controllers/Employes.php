<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Employe;

use Illuminate\Http\Request;

class Employes extends Controller
{
    
    public function Employee_Filter(Request $request)
    {
        if($request->ajax())
        {
            $Filter_1 = $_GET['Filter_1'];
            $output ='';
            if($Filter_1 != 'Tous')
            $Employes  = DB::table('employes')->where('Cin',$Filter_1)->get();
            else
            $Employes  = DB::table('employes')->get();
            foreach($Employes as $Employe)
            $output .='<tr><td>'.$Employe->Cin.'</td><td>'.$Employe->Nom.'</td><td>'.$Employe->Prenom.'</td><td>'.$Employe->Adress.'</td><td>'.$Employe->Departement.'</td><td><a href='.route('Employee.Moidfier',$Employe->id).'><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a> <a href='.route('Employee.Delete',$Employe->id).'> <button type="button" class="btn btn-danger waves-effect waves-light">Suprimmer</button></a></td></tr>';
            return response($output);
        }
         
    }
    
    public function Ajouter_Employee(Request $request)
    {
       $data = new Employe();
       $data->Cin = $request->Cin;
       $data->Nom = $request->Nom;
       $data->Prenom = $request->Prenom;
       $data->Adress = $request->Adress;
       $data->Departement = $request->Departement_employee;
      
       $Count  = Employe::where('Cin','=',$data->Cin)->count();
       if($Count == 0 )
       {
        $data->save();
        $notification = array('message' => 'Bien Ajouter', 'alert-type' => 'success'); 
        $Employes = DB::table('employes')->orderBy('created_at', 'desc')->get();
        $Return_finale =  redirect()->route('Employee',compact('Employes'))->with($notification);
       }
       else
       {
        $notification = array('message' =>'Cin deja exist', 'alert-type' => 'error');
        $Return_finale =  redirect()->route('Ajouter.Employee')->with($notification);
       }
      
       return $Return_finale;
    }
    public function Employee_Delete($id)
    {
        $deleted = DB::table('employes')->where('id',$id)->delete();
        $notification = array(
            'message' => 'User deleted Successfully', 
            'alert-type' => 'error'
        );
        $Employes = DB::table('employes')
        ->orderBy('created_at', 'desc')
        ->get();
        return redirect()->route('Employee',compact('Employes'))->with($notification);
    }
    public function Employee_Modifier(Request $request)
    {
        $data = [];
        $id = $request->id;
        $data = Employe::find($id);
        $data->Cin = $request->Cin;
        $data->Nom = $request->Nom;
        $data->Prenom = $request->Prenom;
        $data->Adress = $request->Adress;
        $data->Departement = $request->Departement_employee;
        $data->save();
        $Employes = Employe::find($id);
        $notification = array('message' => 'Bien modifier', 'alert-type' => 'success');
        return redirect()->route('Employee',compact('Employes'))->with($notification);

    }
}
