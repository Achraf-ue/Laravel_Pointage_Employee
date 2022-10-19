<?php

namespace App\Http\Controllers;

use App\Models\Deparetement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pointage_Employee;
use App\Models\Retard;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
class Pointage_Employee_Controller extends Controller
{
    private $now;
    private $now_time;
    private $Time;
    public function __construct()
    {
        $this->now       = Carbon::now()->addHour()->format('Y-m-d');
        $this->now_time  = Carbon::now()->addHour();
        $this->Time      = Carbon::now()->addHour()->format('H:m:s');
        
    }
    public  function Pointage_()
    {
        $Employees = DB::table('employes')->orderBy('created_at','desc')->get();
        $Pointages = DB::select("select P_E.id,E.Cin,E.Nom,E.Prenom , P_E.Date_Jour,P_E.Temp_Travaille,P_E.Date_Entre,P_E.Date_Sortir,P_E.Type_Pointage from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id and P_E.Type_Pointage = 'Rapport' and P_E.Date_Jour = '$this->now'");
        return view('Pointage.Pointage_Vue',compact('Pointages','Employees'));
    }
    public  function Entre_Vue()
    {
        $date = $this->Time;
        $Employees = DB::table('employes')->orderBy('created_at','desc')->get();
        $Pointage_Entres = DB::select("select P_E.id,E.Cin,E.Nom,E.Prenom , P_E.Date_Jour,P_E.Date_Entre  from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id AND P_E.Type_Pointage = 'Entre' and P_E.Date_Jour  = '$this->now'");
        return view('Pointage.Entre',compact('Pointage_Entres','Employees','date'));
    }
    public function Sortir_Vue()
    {
        $Employees = DB::table('employes')->orderBy('created_at','desc')->get();
        $Pointage_Entres = DB::select("select P_E.id,E.Cin,E.Nom,E.Prenom , P_E.Date_Jour,P_E.Date_Sortir  from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id AND P_E.Type_Pointage = 'Sortir' and P_E.Date_Jour = '$this->now'");
        return view('Pointage.Sortir',compact('Pointage_Entres','Employees'));
    }
    public function Entre_Employee(Request $request)
    {
       $data = new Pointage_Employee();
       $data->Id_Employee = $request->Id_Employee;
       $data->Date_Jour = $this->now;
       $data->Date_Entre = $this->now_time;
       $data->Date_Sortir = $this->now_time; 
       $data->Type_Pointage = 'Entre';
       $Time = $this->Time;
       //$Count  = Pointage_Employee::where('Date_Jour','=',$this->now)->where('Id_Employee','=',$data->Id_Employee)->where('Type_Pointage','=','Entre')->count();
       $Count  = Pointage_Employee::where('Date_Jour','=',$this->now)->where('Id_Employee','=',$data->Id_Employee)->where('Type_Pointage','!=','Rapport')->count();
       $Employees = DB::table('employes')->orderBy('created_at', 'desc')->get();
       $Pointage_Entres = DB::select("select P_E.id,E.Cin,E.Nom,E.Prenom , P_E.Date_Jour,P_E.Date_Entre  from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id AND P_E.Type_Pointage = 'Entre' and P_E.Date_Jour  = '$this->now'");
       if($Count%2 == 0)
       {
        $data->save();
        if($Count == 0)
        {
        $Date_Entre_Departement = DB::table('deparetements')->join('employes', 'employes.Departement', '=', 'deparetements.id')->select('Date_Debut')->where('employes.id','=',$data->Id_Employee)->pluck('Date_Debut')->first();
        $Date_Entre_Departement = $this->now.' '.$Date_Entre_Departement;
        if($Date_Entre_Departement < $this->now_time)
        {
            $tollerence_Departement = DB::table('deparetements')->join('employes', 'employes.Departement', '=', 'deparetements.id')->select('tollerence')->where('employes.id','=',$data->Id_Employee)->pluck('tollerence')->first();
            $tollerence_Etat = DB::table('deparetements')->join('employes', 'employes.Departement', '=', 'deparetements.id')->select('tollerence_active')->where('employes.id','=',$data->Id_Employee)->pluck('tollerence_active')->first();
            $Totale  = Carbon::parse($Date_Entre_Departement)->addMinutes($tollerence_Departement);
            $diff = $this->now_time->diff($Date_Entre_Departement)->format('%I');
            //$diff = $this->now_time->diff($Date_Entre_Departement)->format('%H Heur %I minutes');
            $data = new Retard();
            $data->Id_Employee = $request->Id_Employee;
            $data->Date_Jour = $this->now;
            $data->Id_Departement = DB::table('deparetements')->join('employes', 'employes.Departement', '=', 'deparetements.id')->select('deparetements.id')->where('employes.id','=',$data->Id_Employee)->pluck('deparetements.id')->first();
            $data->Date_Entre = $this->now_time;
            $data->Temps_Retard = $diff;
            if($tollerence_Etat != 0)
            {
            if($Totale <=  $this->now_time)
                $data->Avertisement = "1";    
            else
                $data->Avertisement = "0";
            }
            else
            $data->Avertisement = "0";
            
            

            $data->save();
            $notification = array('message' =>'Person en retard '.$diff.' Minutes', 'alert-type' => 'error');
        }
        else
        $notification = array('message' => 'Bien Entre', 'alert-type' => 'success'); 
        }
        else
        $notification = array('message' => 'Bien Entre', 'alert-type' => 'success'); 
       }
       else
       $notification = array('message' =>'Employee Entre exist', 'alert-type' => 'error');
       return redirect()->route('Pointage.Entre',compact('Pointage_Entres','Employees'))->with($notification);
    }
    public function Sortir_Employee(Request $request)
    {
       $data = new Pointage_Employee();
       $data->Id_Employee = $request->Id_Employee;
       $data->Date_Jour = $this->now;
       $data->Date_Entre = $this->now_time;
       $data->Date_Sortir = $this->now_time; 
       $data->Type_Pointage = 'Sortir';
       $Count_Entre  = Pointage_Employee::where('Date_Jour','=',$this->now)->where('Id_Employee','=',$data->Id_Employee)->where('Type_Pointage','=','Entre')->count();     
       //$Count  = Pointage_Employee::where('Date_Jour','=',$this->now)->where('Id_Employee','=',$data->Id_Employee)->where('Type_Pointage','=','Sortir')->count();
       $Count  = Pointage_Employee::where('Date_Jour','=',$this->now)->where('Id_Employee','=',$data->Id_Employee)->where('Type_Pointage','!=','Rapport')->count();
       $Employees = DB::table('employes')->orderBy('created_at', 'desc')->get();
       $Pointage_Entres = DB::select("select P_E.id,E.Cin,E.Nom,E.Prenom , P_E.Date_Jour,P_E.Date_Entre  from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id AND P_E.Type_Pointage = 'Sortir' and P_E.Date_Jour  = '$this->now'");
       if($Count_Entre != 0)
       {
       if($Count%2 != 0 )
       {
        $data->save();
        $Entre  =  Pointage_Employee::where('Date_Jour','=',$this->now)->where('Id_Employee','=',$data->Id_Employee)->where('Type_Pointage','=','Entre')->orderBy('Date_Entre','desc')->first();
        $Sortir  = Pointage_Employee::where('Date_Jour','=',$this->now)->where('Id_Employee','=',$data->Id_Employee)->where('Type_Pointage','=','Sortir')->orderBy('Date_Sortir','desc')->first();
        $data = new Pointage_Employee();
        $data->Id_Employee = $request->Id_Employee;
        $data->Id_Entre = $Entre->id;
        $data->Id_Sortir = $Sortir->id;
        $data->Date_Jour = $this->now;
        $data->Date_Entre = $Entre->Date_Entre;
        $data->Date_Sortir = $Sortir->Date_Sortir; 
        $data->Type_Pointage = 'Rapport';
        $data->Temp_Travaille = Carbon::parse($Sortir->Date_Sortir)->diff(Carbon::parse($Entre->Date_Entre))->format('%I');
        $data->save();
        $notification = array('message' => 'Bien Sortir', 'alert-type' => 'success');
       }
       else
       $notification = array('message' =>'Employee Sortir exist', 'alert-type' => 'error');
       }
       else
       $notification = array('message' =>'Employee ne pas entre encore', 'alert-type' => 'error');
      
       return redirect()->route('Pointage.Sortir',compact('Pointage_Entres','Employees'))->with($notification);;
       //return dd($request->Id_Employee);
    }
    public function Pointage_Filter(Request $request)
    {
        if($request->ajax())
        {
            $Filter_1   = $_GET['Filter_1'];
            $Date_fin   = $_GET['Date_fin'];
            $Date_debut = $_GET['Date_debut'];
            $output ='';

            if($Filter_1 != '')
            $Pointages = DB::select("select P_E.id,E.Cin,P_E.Temp_Travaille,E.Nom,E.Prenom , P_E.Date_Jour,P_E.Date_Entre,P_E.Date_Sortir,P_E.Type_Pointage from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id AND E.id = '$Filter_1' and P_E.Type_Pointage = 'Rapport' and P_E.Date_Jour BETWEEN '$Date_debut' and '$Date_fin'");
            else
            if($Filter_1 == '')
            $Pointages = DB::select("select P_E.id,E.Cin,P_E.Temp_Travaille,E.Nom,E.Prenom , P_E.Date_Jour,P_E.Date_Entre,P_E.Date_Sortir,P_E.Type_Pointage from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id and P_E.Type_Pointage = 'Rapport' and P_E.Date_Jour BETWEEN '$Date_debut' and '$Date_fin'");
            /*else
            if($Filter_1 == 'Tous' && $Filter_2 != 'Tous')
            $Pointages = DB::select("select P_E.id,E.Cin,E.Nom,E.Prenom ,P_E.Temp_Travaille, P_E.Date_Jour,P_E.Date_Entre,P_E.Date_Sortir,P_E.Type_Pointage from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id AND  P_E.Type_Pointage = '$Filter_2' and P_E.Type_Pointage = 'Rapport'");
            if($Filter_1 != 'Tous' && $Filter_2 == 'Tous')
            $Pointages = DB::select("select P_E.id,E.Cin,E.Nom,E.Prenom ,P_E.Temp_Travaille, P_E.Date_Jour,P_E.Date_Entre,P_E.Date_Sortir,P_E.Type_Pointage from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id AND E.Cin = '$Filter_1' and P_E.Type_Pointage = 'Rapport'");
            */
            foreach($Pointages as $Pointage)
            $output .='<tr><td>'.$Pointage->id.'</td><td>'.$Pointage->Cin.'</td><td>'.$Pointage->Nom.' '.$Pointage->Prenom.'</td>'.'</td><td>'.$Pointage->Date_Jour.'</td>'.'</td><td>'.$Pointage->Date_Entre.'</td>'.'</td><td>'.$Pointage->Date_Sortir.'</td>'.'</td>'.'</td><td>'.$Pointage->Temp_Travaille.' '.' minutes</td></tr>';
            //$now = Carbon::now()->format('H:i:s');
            //date_default_timezone_get()
            return response($output);
        }
         
    }
    //Retards
    public function Retard_Modal(Request $request)
    {
        if($request->ajax())
        {
        $Id_Retard = $_GET['Id_Retard'];
        $Retards = DB::select("select retards.Avertisement,retards.id,employes.Cin,retards.Temps_Retard,retards.Date_Entre,deparetements.Deparetement_Nom,deparetements.Date_Debut,employes.Nom,employes.Prenom,retards.Date_Jour from retards INNER JOIN deparetements on deparetements.id = retards.Id_Departement INNER JOIN employes on employes.id = retards.Id_Employee and retards.id = '$Id_Retard'");
        foreach($Retards as $Retard)
        {
        $output ='<table border="0" width="100%">
        <tr>
        <td style="padding:10px;">  
        <p>Nom complet       : '.$Retard->Nom.' '.$Retard->Prenom.'</p>
        <p>Matricule         : '.$Retard->Cin.'</p>
        <p>Departement       : '.$Retard->Deparetement_Nom.'</p>
        <p>Departement Entre : '.$Retard->Date_Debut.'</p>
        <p>Date Entre        : '.$Retard->Date_Entre.'</p>
        <p style="color:red;">Retard            : '.$Retard->Temps_Retard.'</p>';
        if($Retard->Avertisement != 0)
        $output .= '<p style="color:red;">Retard            : Avertisement (Perssone a depasse la tollerence)</p>';
        $output .= '</table>"';
        }
        return response($output);
        }
    }
    public function Retard_Filter(Request $request)
    {
        if($request->ajax())
        {
            $Filter_1 = $_GET['Filter_1'];
            $Date_fin = $_GET['Date_fin'];
            $Date_debut = $_GET['Date_debut'];
            $output ='';

            if($Filter_1 != 'Tous')
            $Retards = DB::select("select retards.id,employes.Cin,retards.Temps_Retard,retards.Date_Entre,deparetements.Deparetement_Nom,employes.Nom,employes.Prenom,retards.Date_Jour from retards INNER JOIN deparetements on deparetements.id = retards.Id_Departement INNER JOIN employes on employes.id = retards.Id_Employee where retards.Date_Jour BETWEEN '$Date_debut' and '$Date_fin' and employes.id = '$Filter_1'");
            else
            if($Filter_1 == 'Tous')
            $Retards = DB::select("select retards.id,employes.Cin,employes.id,retards.Temps_Retard,retards.Date_Entre,deparetements.Deparetement_Nom,employes.Nom,employes.Prenom,retards.Date_Jour from retards INNER JOIN deparetements on deparetements.id = retards.Id_Departement INNER JOIN employes on employes.id = retards.Id_Employee where retards.Date_Jour BETWEEN '$Date_debut' and '$Date_fin'");
            /*else
            if($Filter_1 == 'Tous' && $Filter_2 != 'Tous')
            $Pointages = DB::select("select P_E.id,E.Cin,E.Nom,E.Prenom ,P_E.Temp_Travaille, P_E.Date_Jour,P_E.Date_Entre,P_E.Date_Sortir,P_E.Type_Pointage from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id AND  P_E.Type_Pointage = '$Filter_2' and P_E.Type_Pointage = 'Rapport'");
            if($Filter_1 != 'Tous' && $Filter_2 == 'Tous')
            $Pointages = DB::select("select P_E.id,E.Cin,E.Nom,E.Prenom ,P_E.Temp_Travaille, P_E.Date_Jour,P_E.Date_Entre,P_E.Date_Sortir,P_E.Type_Pointage from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id AND E.Cin = '$Filter_1' and P_E.Type_Pointage = 'Rapport'");
            */
            foreach($Retards as $Retard)
            $output .='<tr><td>'.$Retard->id.'</td><td>'.$Retard->Cin.'</td><td>'.$Retard->Nom.' '.$Retard->Prenom.'</td>'.'<td>'.$Retard->Date_Jour.'</td><td>'.$Retard->Date_Entre.'</td>'.'<td>'.$Retard->Temps_Retard.'</td>'.'<th><a class="view_detaiile_retard" data-id="'.$Retard->id.'" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a> </th></tr>';
            
            return response($output);
        }
         
    }


    public function Generate_Pointage_Pdf(Request $request)
    {
        if($request->ajax())
        {
            $Filter_1    = $_GET['Filter_1'];
            $Date_fin    = $_GET['Date_fin'];
            $Date_debut  = $_GET['Date_debut'];
            $Generate_Facture = $_GET['Generate_Facture'];
            
            $output ='';
            //$Pointage_employees  =  DB::table('pointage__employees')->where('Type_Pointage','like','%'.'Rapport'.'%')->where('Id_Employee','like','%'.$Filter_1.'%')->whereBetween('Date_Jour',[$Date_debut ,$Date_fin])->get();
            $Pointage_employees = DB::select("select P_E.id,E.Cin,E.Nom,E.Prenom , P_E.Date_Jour,P_E.Temp_Travaille,P_E.Date_Entre,P_E.Date_Sortir,P_E.Type_Pointage from  employes E , pointage__employees P_E where P_E.Id_Employee = E.id and P_E.Type_Pointage = 'Rapport' and P_E.Id_Employee like '%$Filter_1%' and Date_Jour between '$Date_debut' and '$Date_fin'  ");
            

        $fileName = ' ';
        if($Generate_Facture == 'Pdf')
        {
            $pdf = PDF::loadView('Pointage.Pdf_Pointage',compact('Pointage_employees'));
            $path = public_path('pdf/');
            $fileName =  time().'.'. 'pdf' ;
            $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        $fileName = 'http://localhost/Projet_Laravel/Gestion_Pointage/public/pdf/'.$fileName;
        }
        return response($fileName);
        //return response($Generate_Facture);
        }
        
        /*$pdf = Pdf::loadView('facture_echeance.Facture_pdf');
        return response()->$pdf->download('invoice.pdf');*/
    }


    //API teste 
    public function Function_1()
    {
        $deparetements = DB::table('deparetements')->orderBy('created_at','desc')->get();
        return response($deparetements);
    }
    public function Function_2($id)
    {
        $Count = DB::table('deparetements')->where('id','=',$id)->count();
        if($Count == 0)
        return response('Departement pas exist');
        else
        {
          $deparetements =   DB::table('deparetements')->where('id','=',$id)->get();
          return response($deparetements);
        }
        
    }
    public function Function_3($id)
    {
        $Count = DB::table('deparetements')->where('id','=',$id)->count();
        if($Count == 0)
        return response('Departement pas1 exist');
        else
        {
          $deleted = DB::table('deparetements')->where('id',$id)->delete();
          return response('Bien suprimmer');
        }
        
    }
    
}
