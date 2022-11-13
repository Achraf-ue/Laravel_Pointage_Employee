<?php

namespace App\Http\Controllers;

use App\Models\Horaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Horaire_Controller extends Controller
{
            public function Horaire_vue()
            {
                    $Horaires = Horaire::all();
                    return view('Parametre.Horaire',compact('Horaires'));
            }
            public function Horaire_Modifier(Request $request)
            {
                $id = $request->id;
                $data = Horaire::find($id);
                $data->date_debut = $request->date_debut;
                $data->date_fin = $request->date_fin;

                $data->heure_entre_L_V = $request->heure_entre_L_V;
                $data->heure_sortir_L_V = $request->heure_sortir_L_V;
                $data->heure_entre_S = $request->heure_entre_S;
                $data->heure_sortir_S = $request->heure_sortir_S;


                $data->save();
                $Horaires = Horaire::all();
                $notification = array('message' => 'Bien modifier', 'alert-type' => 'success');
                return redirect()->route('Horiare_Vue',compact('Horaires'))->with($notification);
                //return dd($data);
            }
}
