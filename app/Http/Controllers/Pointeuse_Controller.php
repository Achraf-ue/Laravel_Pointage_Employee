<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pointeuse;
use Illuminate\Support\Facades\DB;



class Pointeuse_Controller extends Controller
{
    public function Ajouter_pointeuse(Request $request)
    {
       $data = new Pointeuse();
       $data->Nom_pointeuse = $request->Nom;
       $data->Adress_ip = $request->adress_ip;
       $data->port = $request->port;
       $data->save();
       $notification = array('message' => 'Bien Ajouter', 'alert-type' => 'success'); 
       $Pointeuses = Pointeuse::all();
       return redirect()->route('Pointeuse.Vue',compact('Pointeuses'))->with($notification);
    }
    public function Pointeuse_Delete($id)
    {
        $deleted = DB::table('pointeuses')->where('id',$id)->delete();
        $notification = array(
            'message' => 'Pointeuse deleted Successfully', 
            'alert-type' => 'error'
        );
        $Pointeuses = Pointeuse::all();
        return redirect()->route('Pointeuse.Vue',compact('Pointeuses'))->with($notification);
    }
    public function Pointeuse_Modifier(Request $request)
    {
        
        $data = [];
        $id = $request->Id;
        $data = Pointeuse::find($id);
        $data->Nom_pointeuse = $request->Nom;
        $data->Adress_ip = $request->Adress_ip;
        $data->port = $request->port;
        $data->save();
        $notification = array('message' => 'Bien modifier', 'alert-type' => 'success'); 
        $Pointeuses = Pointeuse::all();
        return redirect()->route('Pointeuse.Vue',compact('Pointeuses'))->with($notification);
        //return dd($data);
    }
}
