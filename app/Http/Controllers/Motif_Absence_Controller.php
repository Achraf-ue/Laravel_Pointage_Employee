<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Motif_Absence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Motif_Absence_Controller extends Controller
{
    //
    public function Motif_Vue()
    {
        $Motifs = DB::table('motif__absences')
        ->orderBy('created_at', 'desc')
        ->get();
        return view("Motif_Absence.Motif",compact('Motifs'));
    }
    public function Ajouter_Motif(Request $request)
    {
       $data = new Motif_Absence();
       $data->Motif_Absence = $request->Motif_Absence;
       $Count  = Motif_Absence::where('Motif_Absence','=',$data->Motif_Absence)->count();
       if($Count == 0 )
       {

        $data->save();
        $notification = array('message' => 'Motif bien Ajouter', 'alert-type' => 'success');
        $Motifs = DB::table('motif__absences')
        ->orderBy('created_at', 'desc')
        ->get(); 
        $Return_finale =  redirect()->route('Motif_Vue',compact('Motifs'))->with($notification);
       }
       else
       {
        $notification = array('message' =>'Motif deja exist', 'alert-type' => 'error');
        $Return_finale =  redirect()->route('Ajouter.motif')->with($notification);
       }
       
       
       
       return $Return_finale;
    }
    public function Modifier_Motif(Request $request)
    {
        $Data = [];
        $id = $request->id;
        $Data = Motif_Absence::find($id);
        $Data->Motif_Absence = $request->Motif_Absence;
        $Data->save();
        $Motifs = Motif_Absence::find($id);
        $notification = array('message' => 'Bien modifier', 'alert-type' => 'success');
        return redirect()->route('Motif_Vue',compact('Motifs'))->with($notification);
    }
    
}
