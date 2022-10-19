<?php

namespace App\Http\Controllers;
use App\Models\facture_echeance;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Facture_Echeance_Controller extends Controller
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
    public function Ajouter_facture(Request $request)
    {
       /*$request->validate([
        'n_facture'=>'required'
       ]);*/
       $data = new facture_echeance();
       $data->type = $request->Type;
       $data->nom_complet = $request->nom_complet;
       $data->n_facture = $request->n_facture;
       $data->date_facture = $request->date_facture;
       $data->mantant = $request->mantant;
       $data->status = $request->status;
       $data->Payement = $request->payement;
       $data->Nemero_payement = $request->n_file;
       
       //$data->facture_pdf = $request->facture_pdf;
            
            $facture_pdf = $request->file('facture_pdf');
            
            $facture_gen = hexdec(uniqid());
            $facture_ext  = strtolower($facture_pdf->getClientOriginalExtension()); 
            $facture_name = $facture_gen.'.'.$facture_ext;
            $Up_Location = 'Backend/Factures/Pdf/';
            $Last_facture = $Up_Location.$facture_name;
            $facture_pdf->move($Up_Location,$facture_name);
            $data->facture_pdf = $Last_facture;



            $file_pdf = $request->file('payement_file');
            if($file_pdf != null)
            {
            $facture_gen = hexdec(uniqid());
            $facture_ext  = strtolower($facture_pdf->getClientOriginalExtension()); 
            $facture_name = $facture_gen.'.'.$facture_ext;
            $Up_Location = 'Backend/Factures/Pdf/';
            $Last_facture = $Up_Location.$facture_name;
            $file_pdf->move($Up_Location,$facture_name);
            $data->file_payement = $Last_facture;
            }
            else
            $data->file_payement = 'lien';
       $Factures = DB::table('facture_echeances')->where('n_facture','=',$data->n_facture)->first();
       if($Factures == null)
       {
        $data->save();
        if($request->status == 'En cours')
        {
            $Factures = DB::table('facture_echeances')->where('n_facture','=',$data->n_facture)->first();
            $data_notification  = new Notification();
            $data_notification->Lire_notification = '0';
            $data_notification->Titre = 'Facture de feference : '.$Factures->n_facture.'';
            $data_notification->Notifiaction = 'Facture de type '.$Factures->type.' et le nom complet '.$Factures->nom_complet.' et de mantant '.$Factures->mantant.' est de status en cours';
            $data_notification->id_fature = $Factures->id;
            $data_notification->save();
            /*$data = array();
            $data['Lire_notification'] = '0';
            $data['Titre'] = '0';
            $data['Notifiaction'] = '0';
            $data['id_fature'] = '0';
            DB::table('notifications')->insert($data);*/
        }
       }
       
       $facture_echeances = facture_echeance::all();
       return view('facture_echeance.facture',compact('facture_echeances'));
    }
    public function Modifier_facture(Request $request)
    {
        $data = [];
        $id = $request->id;
        $data = facture_echeance::find($id);
        //$data->type = $request->type;
        //$data->nom_complet = $request->nom_complet;
        $data->date_payement = $this->now_time;
        $data->n_facture = $request->n_facture;
        $data->date_facture = $request->date_facture;
        $data->mantant = $request->mantant;
        $data->status = $request->status;
        if($data->status == 'Payé')
        {
            $data_notification = [];
            $data_notification = Notification::where('id_fature',$id)->first();
            $data_notification->Lire_notification = '1';
            $data_notification->save();
            /*$Notification = array();
            $Notification['Lire_notification'] = '55';
            DB::table('notifications')->where('id_fature',$id)->update($Notification);*/
        }
        //$data->facture_pdf = $request->facture_pdf;
        $data->save();
        $facture_echeances = facture_echeance::all();
        $notification = array('message' => 'Bien modifier', 'alert-type' => 'success');
        return redirect()->route('factures_echeances',compact('facture_echeances'))->with($notification);
    }
    //Cherche_Facture
    public function Facture_Filter(Request $request)
    {
        if($request->ajax())
        {
            $Filter_1    = $_GET['Filter_1'];
            $Filter_2    = $_GET['Filter_2'];
            $Date_fin    = $_GET['Date_fin'];
            $Date_debut  = $_GET['Date_debut'];
            $Nom_complet = $_GET['Nom_complet'];
            $Type_Facture = $_GET['Type_Facture'];
            $output ='';
            $Factures =  DB::table('facture_echeances')->where('type','like','%'.$Type_Facture.'%')->where('nom_complet','like','%'.$Nom_complet.'%')->where('status','like','%'.$Filter_1.'%')->where('id','like','%'.$Filter_2.'%')->whereBetween('date_facture',[$Date_debut ,$Date_fin])->get();
            $Credit   =  DB::table('facture_echeances')->where('type','like','%'.$Type_Facture.'%')->where('nom_complet','like','%'.$Nom_complet.'%')->where('Type','like','%Client%')->where('status','like','%'.$Filter_1.'%')->where('id','like','%'.$Filter_2.'%')->whereBetween('date_facture',[$Date_debut ,$Date_fin])->sum('mantant');
            $Début    =  DB::table('facture_echeances')->where('type','like','%'.$Type_Facture.'%')->where('nom_complet','like','%'.$Nom_complet.'%')->where('Type','like','%Fourniseur%')->where('status','like','%'.$Filter_1.'%')->where('id','like','%'.$Filter_2.'%')->whereBetween('date_facture',[$Date_debut ,$Date_fin])->sum('mantant');
            foreach($Factures as $Facture)
            {
                $date = Carbon::parse($Facture->date_facture)->locale('fr_FR');
                $output .='<tr><td>'.$Facture->id.'</td><td>'.$Facture->nom_complet.'</td><td>'.$Facture->n_facture.'</td><td>'.$Facture->date_facture.'  '.$date->dayName.'</td>'.'<td>'.$Facture->	date_payement.'</td>';
                if($Facture->type == 'Client')
                $output .= '<td>'.$Facture->mantant.'</td>';
                else
                $output .= '<td></td>';
                if($Facture->type == 'Fourniseur')
                $output .= '<td>'.$Facture->mantant.'</td>';
                else
                $output .= '<td></td>';
                if($Facture->status == 'Payé')
                $output .= '<td><span class="badge badge-success">'.$Facture->status.'</span></td><td>';
                else
                $output .= '<td><span class="badge badge-danger">'.$Facture->status.'</span></td><td>';
                if($Facture->status == "En cours")
                $output .=    '<a href="'.route('Modifier_facture',$Facture->id).'"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a> '; 
                $output .= '<a class="view_detaiile_facture" data-id="'.$Facture->id.'" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a>
                <a class="print_facture" data-id="'.$Facture->id.'"><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="mdi mdi-cloud-print"></i></button></a>
                <object style="display: none" data="your_url_to_pdf" type="application/pdf"><iframe style="height: 500px;width:750px" id="'.$Facture->id.'" class="myFrame"  src="'.asset($Facture->facture_pdf).'"></iframe></object>
                </td></tr>';
            }
            $output .='<tr><td></td><td></td><td></td><td></td><td>Totale :</td><td>'.$Credit.'</td><td>'.$Début.'</td><td></td><td></td></tr>';
            return response($output);
        }
    }
    public function Facture_Modal(Request $request)
    {
        if($request->ajax())
        {
        $output = $Id_Facture = $_GET['Id_facture'];
        //$facture = DB::table('facture_echeances')->where('id','=',$Id_Facture)->pluck('facture_pdf')->first();
        $Facture = DB::table('facture_echeances')->where('id','=',$Id_Facture)->first();
        $output = '<h1 style="text-align: center;">Etat du facture  <a href="'.route('Etat.Facture.Pdf',$Facture->id).'"><button type="button"    class="btn btn-info waves-effect waves-light"><i class="mdi mdi-file-pdf"></i></button></a></h1>
                        <table style="width: 500px; margin-left:auto; 
                margin-right:auto; margin-bottom:20px;" id="customers">
                <tr>
                    <th colspan="2" class="th-1">Facture '.$Facture->id.'</th>
                </tr>
                <tr>
                    <td class="th-1">Facture ID</td>
                    <td>'.$Facture->id.'</td>
                </tr>
                <tr>
                    <td class="th-1">Type</td>
                    <td>'.$Facture->type.'</td>
                </tr>
                <tr>
                    <td class="th-1">Nom complet</td>
                    <td>'.$Facture->nom_complet.'</td>
                </tr>
                <tr>
                    <td class="th-1">N facture</td>
                    <td>'.$Facture->n_facture.'</td>
                </tr>
                <tr>
                    <td class="th-1">Date facure</td>';
                    $date = Carbon::parse($Facture->date_facture)->locale('fr_FR');
                    $output .= '<td>'.$Facture->date_facture.'  '.$date->dayName.'</td>
                </tr>
                <tr>
                    <td class="th-1">Date payement</td>
                    <td>'.$Facture->date_payement.'</td>
                </tr>
                <tr>
                    <td class="th-1">Mantant</td>
                    <td>'.$Facture->mantant .' '.'DH</td>
                </tr>
                <tr>
                    <td class="th-1">Statu</td>
                    <td>'.$Facture->status.'</td>
                </tr>
                </table>';
        return response($output);
        }
    }
    public function Generate_Pdf()
    {
            $Filter_1    = $_GET['Filter_1'];
            $Filter_2    = $_GET['Filter_2'];
            $Date_fin    = $_GET['Date_fin'];
            $Date_debut  = $_GET['Date_debut'];
            $Nom_complet = $_GET['Nom_complet'];
            $Type_Facture = $_GET['Type_Facture'];
            $Generate_Facture = $_GET['Generate_Facture'];
            
            $output ='';
            $Factures =  DB::table('facture_echeances')->where('type','like','%'.$Type_Facture.'%')->where('nom_complet','like','%'.$Nom_complet.'%')->where('status','like','%'.$Filter_1.'%')->where('id','like','%'.$Filter_2.'%')->whereBetween('date_facture',[$Date_debut ,$Date_fin])->get();
            $Credit   =  DB::table('facture_echeances')->where('type','like','%'.$Type_Facture.'%')->where('nom_complet','like','%'.$Nom_complet.'%')->where('Type','like','%Client%')->where('status','like','%'.$Filter_1.'%')->where('id','like','%'.$Filter_2.'%')->whereBetween('date_facture',[$Date_debut ,$Date_fin])->sum('mantant');
            $Début    =  DB::table('facture_echeances')->where('type','like','%'.$Type_Facture.'%')->where('nom_complet','like','%'.$Nom_complet.'%')->where('Type','like','%Fourniseur%')->where('status','like','%'.$Filter_1.'%')->where('id','like','%'.$Filter_2.'%')->whereBetween('date_facture',[$Date_debut ,$Date_fin])->sum('mantant');
            

        $fileName = ' ';
        if($Generate_Facture == 'Pdf')
        {
            $data = 'Laravel Sanctum';
            $pdf = PDF::loadView('facture_echeance.Facture_pdf',compact('Factures','Credit','Début'));
            $path = public_path('pdf/');
            $fileName =  time().'.'. 'pdf' ;
            $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        $fileName = 'http://localhost/Projet_Laravel/Gestion_Pointage/public/pdf/'.$fileName;
        }
        return response($fileName);
        
        /*$pdf = Pdf::loadView('facture_echeance.Facture_pdf');
        return response()->$pdf->download('invoice.pdf');*/
    }
    public function Etat_Facture_Pdf($id)
    {
        $Facture = facture_echeance::find($id);
        $pdf = PDF::loadView('facture_echeance.Etat_facture', compact('Facture'));
        $Nom =  'Etat_Facture_'.$Facture->n_facture.'_'.$Facture->nom_complet.'.pdf';
        return $pdf->download($Nom);
    }
}
