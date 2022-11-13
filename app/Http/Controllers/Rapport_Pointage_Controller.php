<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pointage_Employee;
use App\Models\Rapport_Pointage;
use App\Models\Retard;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Rapport_Pointage_Controller extends Controller
{
    public function Pointage_rapport()
    {
        $Rapport_Pointages = DB::table('rapport__pointages')->orderBy('created_at','desc')->get();
        $Motive_Absences = DB::table('motif__absences')->orderBy('created_at','desc')->get();
        $Employees = DB::table('employes')->orderBy('created_at','desc')->get();
        $Deparetements = DB::table('deparetements')->orderBy('created_at', 'desc')->get();
        return view('Pointage.Rapport_Pointage',compact('Rapport_Pointages','Motive_Absences','Employees','Deparetements'));
    }
    public function Generate__Rapport_Pointage_Pdf(Request $request)
    {
        if($request->ajax())
        {
            $Filter_1         = $_GET['Filter_1'];
            $Filter_2         = $_GET['Filter_2'];
            $Date_fin         = $_GET['Date_fin'];
            $Date_debut       = $_GET['Date_debut'];
            $Generate_Facture = $_GET['Generate_Facture'];
            $Employee     =     DB::table('employes')->where('id',$Filter_1)->first();
            if($Employee != null)
            $Deparetement =     DB::table('deparetements')->where('id',$Employee->Departement)->first();
            else
            $Deparetement = DB::table('deparetements')->first();
            $output ='';
            $Rapport_Pointages =  DB::table('rapport__pointages')->where('Dpartement','like','%'.$Filter_2.'%')->where('Id_Employee','like','%'.$Filter_1.'%')->whereBetween('Date_Jour',[$Date_debut ,$Date_fin])->get();
            if($Filter_1 > 1)
            {
                $Filter_1 = 0;
            }
            
            

        $fileName = ' ';
        if($Generate_Facture == 'Pdf')
        {
            $pdf = PDF::loadView('Pointage.Rapport_Pointage_Pdf',compact('Rapport_Pointages','Filter_1','Filter_2','Date_fin','Date_debut','Employee','Deparetement'));
            $path = public_path('pdf/');
            $fileName =  time().'.'. 'pdf' ;
            $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        $fileName = 'http://localhost/Projet_Laravel/Gestion_Pointage/public/pdf/'.$fileName;
        }
        //return response($fileName);
       
        }
         return response($fileName);
        /*$pdf = Pdf::loadView('facture_echeance.Facture_pdf');
        return response()->$pdf->download('invoice.pdf');*/
    }
    public function Change_Motive_Absence(Request $request)
    {
        if($request->ajax())
        {
            $ID_Rapport        = $_GET['ID_Rapport'];
            $Motive_Absence    = $_GET['Motive_Absence'];
            $data = array();
            $data['Opservation'] = $Motive_Absence;
            DB::table('rapport__pointages')->where('id',$ID_Rapport)->update($data);

        }
    }
    public function Chart_rapport(Request $request)
    {
        if($request->ajax())
        {
            $now  = Carbon::now()->format('Y-m-d');
            $Count_rtard = DB::table('retards')->where('read_at','!=','1')->count();
            $Count_absence = DB::table('absences')->where('read_at','!=','1')->count();
            //Congé
            $Count_Congé = DB::table('congés')->where('Date_Debut','<=',$now)->where('Date_Fin','>=',$now)->count();
         $a = [$Count_absence,$Count_rtard,$Count_Congé];
         return response($a);
        } 
    }
    public function Rapport_Pointage_Filter(Request $request)
    {
        if($request->ajax())
        {
            $Filter_1        = $_GET['Filter_1'];
            $Filter_2        = $_GET['Filter_2'];
            $Date_fin    = $_GET['Date_fin'];
            $Date_debut  = $_GET['Date_debut'];
            $Rapport_Pointages =  DB::table('rapport__pointages')->where('Dpartement','like','%'.$Filter_2.'%')->where('Id_Employee','like','%'.$Filter_1.'%')->whereBetween('Date_Jour',[$Date_debut ,$Date_fin])->get();
            $output ='<table id="Table_1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"><thead>
            <tr>
                <th>Jour</th>
                <th>Date</th>
                <th>Nom</th>
                <th>Departement</th>
                <th>Entre</th>
                <th>Sortir</th>
                <th>H.N</th>
                <th>25%</th>
                <th>50%</th>
                <th>100%</th>
                <th>Temp de retard</th>
                <th>Absence</th>
                <th>Opservation</th>
                <th>Action</th></tr></thead><tbody>';
           
            foreach($Rapport_Pointages as $Rapport_Pointage)
            {
                $date = Carbon::parse($Rapport_Pointage->Date_Jour)->locale('fr_FR');
                $date_Entre = Carbon::parse($Rapport_Pointage->Date_Entre)->locale('fr_FR');
                $date_Sortir = Carbon::parse($Rapport_Pointage->Date_Sortir)->locale('fr_FR');
                $Rapport_Pointage->R_T = intdiv($Rapport_Pointage->R_T, 60).':'. ($Rapport_Pointage->R_T % 60);
                $Rapport_Pointage->Temp_Traville = intdiv($Rapport_Pointage->Temp_Traville, 60).':'. ($Rapport_Pointage->Temp_Traville % 60);
                $Rapport_Pointage->Temp_Traville_supplementaire = intdiv($Rapport_Pointage->Temp_Traville_supplementaire, 60).':'. ($Rapport_Pointage->Temp_Traville_supplementaire % 60);
                $Motive_Absences = DB::table('motif__absences')->orderBy('created_at','desc')->get();
                $output .= '<tr id="'.$Rapport_Pointage->id.'"';
                if($Rapport_Pointage->Opservation == 'Eregulie')
                $output .= 'style="background-color:#fec918"';
                $output  .='><td>'.$date->dayName.'</td>
                <td>'.$Rapport_Pointage->Date_Jour.'</td>
                <td>'.$Rapport_Pointage->Nom_Employee.'</td>
                <td>'.$Rapport_Pointage->Dpartement.'</td>';
                if($Rapport_Pointage->Date_Entre != null)
                $output .='<td>'.$date_Entre->format('H:i:s').'</td>';
                else
                $output .= '<td></td>';
                if($Rapport_Pointage->Date_Sortir != null)
                $output .='<td>'.$date_Sortir->format('H:i:s').'</td>';
                else
                $output .= '<td></td>';
                $output .='<td>'.$Rapport_Pointage->Temp_Traville.'</td>
                <td>'.$Rapport_Pointage->Temp_Traville_supplementaire.'</td>
                <td>0</td><td>0</td>';
                if($Rapport_Pointage->R_T != null)
                $output .='<td>'.$Rapport_Pointage->R_T.'</td>';
                else
                $output .= '<td>0 Minutes</td>';
                $output .='<td>'.$Rapport_Pointage->Absence.'</td>
                <td><span class="Observation">';
                if($Rapport_Pointage->Opservation == 'Eregulie')
                {
                    if ($Rapport_Pointage->Absence !=  null)
                    {
                        $output .= '<select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Motive_Absence" name="Employe" id="Employe_1">';
                        foreach ( $Motive_Absences as $Motive_Absence )
                        $output .='<option  data-id="'.$Rapport_Pointage->id.'" value="'.$Motive_Absence->Motif_Absence.'">'.$Motive_Absence->Motif_Absence.'</option>';
                        $output .='</select>';
                    }

                }
                else
                $output .= $Rapport_Pointage->Opservation;
                $output .=' </span></td><td>';
                if($Rapport_Pointage->Id_Retard != null)
                $output .='<a class="view_detaiile_retard" data-id="'.$Rapport_Pointage->Id_Retard.'" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a>';
                if ($Rapport_Pointage->Absence ==  null)
                $output .=' <a class="view_detaiile_rapport_pointage" data-id="'.$Rapport_Pointage->id.'" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light">Detailles</button></a>';
                

                
                
                
                
                $output .= '</td></tr>';
            }
            $output .='</tbody></table>';


















            return response($output);

        }
    }
    public function Rapport_Modal(Request $request)
    {
        if($request->ajax())
        {
            $Id_Rapport        = $_GET['Id_Rapport'];
            $Rapport_Pointages = DB::table('pointage__employees')->where('Temp_Retard',$Id_Rapport)->where('Type_Pointage','Rapport')->get();
            $output = '<h1 style="text-align: center;">Rapport Pointage <a data-id="'.$Id_Rapport.'" class="rapport_detailles_pointage_pdf"><button type="button"   class="btn btn-info waves-effect waves-light"><i class="mdi mdi-file-pdf"></i></button></a></h1>
                        <table style="width: 500px; margin-left:auto; 
                margin-right:auto; margin-bottom:20px;" id="customers">
                <tr>
                <td class="th-1">Pointage</td>
                <td>Entre</td>
                <td>Sortir</td>
                <td>Temps Travaille</td>
                </tr>';
                $Totale = 0;
                foreach($Rapport_Pointages as $Rapport_Pointage)
                {
                     $Totale += $Rapport_Pointage->Temp_Travaille;
                     $date_Entre = Carbon::parse($Rapport_Pointage->Date_Entre)->locale('fr_FR'); 
                     $date_Sortir = Carbon::parse($Rapport_Pointage->Date_Sortir)->locale('fr_FR');
                     $Rapport_Pointage->Temp_Travaille = intdiv($Rapport_Pointage->Temp_Travaille, 60).':'. ($Rapport_Pointage->Temp_Travaille % 60);
                     $output .='<tr>
                    <td class="th-1">1</td>
                    <td>'.$date_Entre->format('H:i:s').'</td>
                    <td>'.$date_Sortir->format('H:i:s').'</td>
                    <td>'.$Rapport_Pointage->Temp_Travaille.'</td>
                </tr>';
                }
               
                $Totale = intdiv($Totale, 60).':'. ($Totale % 60);
                $output .='<tr>
                <td class="th-1"></td>
                <td></td>
                <td>Totale</td>
                <td>'.$Totale.'</td>
                </tr></table>';
            return response($output);



        }




    }
    //Rapport detailles 
    public function Generate_detailles__Rapport_Pointage_Pdf(Request $request)
    {
        if($request->ajax())
        {
            $Id_rapport  = $_GET['Id_rapport'];
            $Employee = DB::table('employes')
            ->join('rapport__pointages', 'employes.id', '=', 'rapport__pointages.Id_Employee')
            ->where('rapport__pointages.id',$Id_rapport)
            ->first();




            $rapport_pointages =  DB::table('pointage__employees')->where('Type_Pointage','Rapport')->where('Temp_Retard',$Id_rapport)->get();
            $Totale =  DB::table('pointage__employees')->where('Type_Pointage','Rapport')->where('Temp_Retard',$Id_rapport)->sum('Temp_Travaille');
            $fileName = ' ';
            
            $pdf = PDF::loadView('Pointage.Rapport_Pointage_Detailles_Pdf',compact('rapport_pointages','Totale','Employee'));
            $path = public_path('pdf/');
            $fileName =  time().'.'. 'pdf' ;
            $pdf->save($path . '/' . $fileName);
            $pdf = public_path('pdf/'.$fileName);
            $fileName = 'http://localhost/Projet_Laravel/Gestion_Pointage/public/pdf/'.$fileName;
        }
        return response($fileName);
    }
    //Fin rapport detailles
    public function Generate__Retard_Pointage_Pdf(Request $request)
    {
        if($request->ajax())
        {
            $Generate_Retards = $_GET['Generate_Retards'];
            $Filter_1 = $_GET['Filter_1'];
            $Date_fin = $_GET['Date_fin'];
            $Date_debut = $_GET['Date_debut'];
            $output ='';

            if($Filter_1 != 'Tous')
            $Retards = DB::select("select retards.id,employes.Cin,retards.Temps_Retard,retards.Date_Entre,deparetements.Deparetement_Nom,deparetements.Date_Debut,deparetements.Date_Fin,employes.Nom,employes.Prenom,retards.Date_Jour from retards INNER JOIN deparetements on deparetements.id = retards.Id_Departement INNER JOIN employes on employes.id = retards.Id_Employee where retards.Date_Jour BETWEEN '$Date_debut' and '$Date_fin' and employes.id = '$Filter_1'");
            else
            if($Filter_1 == 'Tous')
            $Retards = DB::select("select retards.id,employes.Cin,employes.id,retards.Temps_Retard,retards.Date_Entre,deparetements.Deparetement_Nom,deparetements.Date_Debut,deparetements.Date_Fin,employes.Nom,employes.Prenom,retards.Date_Jour from retards INNER JOIN deparetements on deparetements.id = retards.Id_Departement INNER JOIN employes on employes.id = retards.Id_Employee where retards.Date_Jour BETWEEN '$Date_debut' and '$Date_fin'");
            
            
            

        $fileName = ' ';
        if($Generate_Retards == 'Pdf')
        {
            $pdf = PDF::loadView('Pointage.Retard_Pdf',compact('Retards'));
            $path = public_path('pdf/');
            $fileName =  time().'.'. 'pdf' ;
            $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        $fileName = 'http://localhost/Projet_Laravel/Gestion_Pointage/public/pdf/'.$fileName;
        }
        //return response($fileName);
       
        }
         return response($fileName);
        /*$pdf = Pdf::loadView('facture_echeance.Facture_pdf');
        return response()->$pdf->download('invoice.pdf');*/
    }
}
