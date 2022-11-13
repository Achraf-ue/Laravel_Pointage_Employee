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
    public function Employee_Modal(Request $request)
    {
        if($request->ajax())
        {
            $Id_employee = $_GET['Id_employee'];
            $output ='';
            $Employe  = DB::table('employes')->where('id',$Id_employee)->first();
            $Departement = DB::table('deparetements')
            ->join('employes', 'employes.Departement', '=', 'deparetements.id')
            ->where('employes.id',$Id_employee)
            ->first();
            $output ='<table border="0" width="100%">
                <tr>
                <td style="padding:10px;">  
                <p>Matricule         : '.$Employe->Cin.'</p>
                <p>Nom complet       : '.$Employe->Nom.' '.$Employe->Prenom.'</p>
                <p>telephone       : '.$Employe->telephone.'</p>
                
                <p>Departement        : '.$Departement->Deparetement_Nom.'</p>
                <p>Date Debut      : '.$Departement->Date_Debut.'</p>
                <p>Date Fin      : '.$Departement->Date_Fin.'</p>';
                $output .= '</table>';
            //$output = 'Matricule : '.$Employe->Cin.' Nom : '.$Employe->Nom.' Departement :'.$Departement->Deparetement_Nom.' Heure entre :'.$Departement->Date_Debut.' Heure sortir :'.$Departement->Date_Fin;
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
       $data->telephone = $request->Telephone;
       
       $data->Departement = $request->Departement_employee;
      
       $Count  = Employe::where('Cin','=',$data->Cin)->count();
       if($Count == 0 )
       {
                if($request->file('Image') != null)
                {
                $user_image = $request->file('Image');
                $name_gen = hexdec(uniqid());
                $img_ext  = strtolower($user_image->getClientOriginalExtension()); 
                $img_name = $name_gen.'.'.$img_ext;
                $Up_Location = 'Images/User_Profile/';
                $Last_image = $Up_Location.$img_name;
                $user_image->move($Up_Location,$img_name);
                $data->Employee_Image = $Last_image;
                }
                else
                $data->Employee_Image = 'backend/assets/images/users/202203112055download.jpg';
                
        
        
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
        $id = $request->id_employee;
        $data = Employe::find($id);
        $data->Departement_activation = '0';
        $data->Cin = $request->Matricule;
        $data->Nom = $request->Nom;
        $data->Prenom = $request->Prenom;
        $data->Adress = $request->Adress;
        if($request->Type_Changement == '1')
        $data->Departement = $request->Departement_employee;
        else
        if($request->Type_Changement == '2')
        {
            $data->Date_Debut = '2022-11-01';
            $data->Date_Fin =   '2022-11-07';
            $data->Departement_activation = '1';


        


        }
        if($request->file('Image') != null)
        {
                $user_image = $request->file('Image');
                $name_gen = hexdec(uniqid());
                $img_ext  = strtolower($user_image->getClientOriginalExtension()); 
                $img_name = $name_gen.'.'.$img_ext;
                $Up_Location = 'Images/User_Profile/';
                $Last_image = $Up_Location.$img_name;
                $user_image->move($Up_Location,$img_name);
                $data->Employee_Image = $Last_image;
        }
        $data->save();
        $Employes = Employe::find($id);
        $notification = array('message' => 'Bien modifier', 'alert-type' => 'success');
        return redirect()->route('Employee',compact('Employes'))->with($notification);
    }
}
