<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class Absence_Controller extends Controller
{
    public function Absences_Notification(Request $request)
    {
        if($request->ajax())
        {
        $Count = DB::table('absences')->where('read_at','=','0')->count();
        $Absences = DB::table('absences')->where('read_at','=','0')->get();
        $output = '<a  id="Notification" class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
        <i class="mdi mdi-bell-outline noti-icon"></i>
        <span class="badge badge-pill badge-danger noti-icon-badge" id="Notification_Count">'.$Count.'</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                    <!-- item-->
                    <h6 style="text-align: center" class="dropdown-item-text">
                            Notifications Absences '.$Count.'
                    </h6>
                    <div class="slimscroll notification-item-list">';
                    foreach($Absences as $Absence)
                    {
                     $output .='<a data-id="'.$Absence->id.'" class="dropdown-item notify-item active view_detaiile_Absences">
                     <div class="notify-icon bg-warning"><i class="mdi mdi-message-text-outline"></i></div>
                     <p class="notify-details">Absence de '.$Absence->Nom_Employee.' <span class="text-muted">Matricule : De '.$Absence->Cin.' absente à '.$Absence->Date_Debut.'</span></p>
                     </a>'; 
                    }


                    $output .='</div>';
        return response($output);
        }

        
    }
    //Absence mdal
    public function Absence_Modal(Request $request)
    {
        if($request->ajax())
        {
        $Id_Absence = $_GET['Id_Absence'];
        $Absences = DB::table('absences')->where('id','=',$Id_Absence)->get();
        foreach($Absences as $Absence)
        {
        $Departement = DB::table('deparetements')->where('id','=',$Absence->Id_Departement)->first();
        $output ='<table border="0" width="100%">
        <tr>
        <td style="padding:10px;">  
        <p>Nom complet       : '.$Absence->Nom_Employee.'</p>
        <p>Matricule         : '.$Absence->Cin.'</p>
        <p>Motif         : '.$Absence->Motif.'</p>
        <p>Date Debut absence      : '.$Absence->Date_Debut.'</p>
        <p>Departement     : '.$Departement->Deparetement_Nom.'</p>
        <p>Plage horaire      : '.$Departement->Date_Debut.' - '.$Departement->Date_Fin.'</p>
        
        
        ';
        if($Absence->Date_Debut != $Absence->Date_Fin)
        $output .=' <p>Date absente      : '.$Absence->Date_Fin.'</p>';
        $output .= '</table>';
        }
        $data = [];
        $data = Absence::find($Id_Absence);
        $data->read_at = '1';
        $data->save();
        return response($output);
        }
    }
    //Fin absence mdal
    //Ajouter absence
    public function ajouter_absence(Request $request)
    {
        $Employee = DB::table('employes')->where('id',$request->Employe)->first();
        $data = new Absence();
        $data->Id_Employee = $request->Employe;
        $data->Nom_Employee = $Employee->Nom.' '.$Employee->Prenom;
        $data->Id_Departement = $Employee->Departement;
        $data->Cin = $Employee->Cin;
        $data->Date_Debut = $request->Date_Debut;
        $data->Date_Fin = $request->Date_Fin;
        $data->Motif = $request->Motif;
        $data->Motif_Fichier = '0';
        $data->Read_at = '0';
        //Motif pdf
        if($request->file('Motif_Fichier'))
        {
            $Motif_pdf = $request->file('Motif_Fichier');
            
            $facture_gen = hexdec(uniqid());
            $facture_ext  = strtolower($Motif_pdf ->getClientOriginalExtension()); 
            $facture_name = $facture_gen.'.'.$facture_ext;
            $Up_Location = 'Backend/Factures/Pdf/';
            $Last_facture = $Up_Location.$facture_name;
            $Motif_pdf ->move($Up_Location,$facture_name);
            $data->Motif_Fichier = $Last_facture;
        }
        
        //Fn pdf
        $data->save();
        $notification = array('message' => 'Absence de '.$request->Date_Debut.' à '.$request->Date_Fin.' bien  Ajouter', 'alert-type' => 'success'); 
        $Absences = DB::table('absences')->orderBy('created_at','desc')->get();
        return  redirect()->route('Absences.vue',compact('Absences'))->with($notification);
    }
    //Fin ajouter absence 
    //Absence filter
    public function Absence_Filter(Request $request)
    {
        if($request->ajax())
        {
            $Filter_1 = $_GET['Filter_1'];
            $Date_fin = $_GET['Date_fin'];
            $Date_debut = $_GET['Date_debut'];
            $output ='';

            if($Filter_1 != 'Tous')
            $Absences = DB::table('absences')->where('Id_Employee',$Filter_1)->whereBetween('Date_Debut', [$Date_debut ,$Date_fin])->get();//
            else
            if($Filter_1 == 'Tous')
            $Absences = DB::table('absences')->whereBetween('Date_Debut', [$Date_debut ,$Date_fin])->get();//
            foreach($Absences as $Absence)
            $output .='<tr><td>'.$Absence->id.'</td><td>'.$Absence->Cin.'</td><td>'.$Absence->Nom_Employee.'</td><td>'.$Absence->Date_Debut.'</td><td><a class="view_detaiile_Absences" data-id="'.$Absence->id.'" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a></td></tr>';
            //$output .='<tr><td>'.$Absences->id.'</td><td>'.$Absences->Cin.'</td><td>'.$Absence->Nom_Employee.' '.$Absence->Date_Debut.'</td>'.'<td><a class="view_detaiile_Absences" data-id="'.$Absence->id.'" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a></td></tr>';
            return response($output);
        }
    }
    //Fin absence filter
    //
    public function Generate__Absence_Pointage_Pdf(Request $request)
    {
        if($request->ajax())
        {
            $Generate_Absence = $_GET['Generate_Absence'];
            $Filter_1 = $_GET['Filter_1'];
            $Date_fin = $_GET['Date_fin'];
            $Date_debut = $_GET['Date_debut'];
            $output ='';

            if($Filter_1 != 'Tous')
            $Absences = DB::table('absences')->where('Id_Employee',$Filter_1)->whereBetween('Date_Debut', [$Date_debut ,$Date_fin])->get();//
            else
            if($Filter_1 == 'Tous')
            $Absences = DB::table('absences')->whereBetween('Date_Debut', [$Date_debut ,$Date_fin])->get();//
            

        $fileName = ' ';
        if($Generate_Absence == 'Pdf')
        {
            $pdf = PDF::loadView('Pointage.Absence_Pdf',compact('Absences'));
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
    //
}
