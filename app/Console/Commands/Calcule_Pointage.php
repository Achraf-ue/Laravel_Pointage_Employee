<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Rapport_Pointage;

class Calcule_Pointage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Calcule:Pointage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcule Pointage';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        //DB::table('pointage__employees')->delete();
        $Employees = DB::table('employes')->get();
        foreach($Employees as $Employee)
        {
            
           
                $id = $Employee->id;
                $Somme  = DB::table('pointage__employees')->where('Date_Jour',Carbon::now()->addHour()->format('Y-m-d'))->where('Type_Pointage','Rapport')->where('Id_Employee',$id)->sum('Temp_Travaille');
                //$Retard = DB::table('retards')->where('Date_Jour',Carbon::now()->addHour()->format('Y-m-d'))->where('Id_Employee',$id)->first();
                $Date_Entree  = DB::table('pointage__employees')->where('Date_Jour',Carbon::now()->addHour()->format('Y-m-d'))->where('Type_Pointage','Entre')->where('Id_Employee',$id)->orderBy('Date_Entre','ASC')->pluck('Date_Entre')->first();
                $Date_Sortir  = DB::table('pointage__employees')->where('Date_Jour',Carbon::now()->addHour()->format('Y-m-d'))->where('Type_Pointage','Sortir')->where('Id_Employee',$id)->orderBy('Date_Sortir','DESC')->pluck('Date_Sortir')->first();
                $Nom_Departement  = DB::table('deparetements')->where('id',$Employee->Departement)->pluck('Deparetement_Nom')->first();
                $Retard       = DB::table('retards')->where('Date_Jour',Carbon::now()->addHour()->format('Y-m-d'))->where('Id_Employee',$id)->first();
               
                   $data = new Rapport_Pointage();
                   $data->Id_Employee = $id;
                   $data->Date_Jour = Carbon::now()->addHour()->format('Y-m-d');
                   $data->Nom_Employee = $Employee->Nom.' '.$Employee->Prenom;
                   $data->Dpartement = $Nom_Departement;
                   
                
                   if($Somme == '0')
                   {
                    $data->Temp_Traville = '0';
                    $data->Absence = '08:00';
                    $data->Opservation = 'Eregulie';
                   }
                   else
                   {
                    if($Retard != null)
                    {
                        $data->Id_Retard = $Retard->id;
                        $data->R_T = $Retard->Temps_Retard;
                    }
                    if($Somme <= '480')
                    {
                        $data->Temp_Traville = $Somme;
                        $data->Temp_Traville_supplementaire = '0';
                    }
                    else
                    {
                        if($Somme - '480' > 30)
                        $data->Temp_Traville_supplementaire = $Somme - '480';
                        else
                        $data->Temp_Traville_supplementaire = '0';
                        $data->Temp_Traville = '480'; 
                    }
                    

                    $data->Date_Entre = $Date_Entree;
                    $data->Date_Sortir = $Date_Sortir;
                   }
                   
                   $data->save();
                   $Data = array();
                   $Data['Temp_Retard'] = $data->id;
                   DB::table('pointage__employees')->where('Id_Employee',$id)->update($Data);
                   /*
                    $table->integer('Id_Employee');
                    $table->integer('Id_Retard')->nullable();
                    $table->date('Date_Jour');
                    $table->dateTime('Date_Entre')->nullable();
                    $table->dateTime('Date_Sortir')->nullable(); 
                    $table->string('Nom_Employee');
                    $table->integer('Temp_Traville');
                    $table->integer('Temp_Traville_supplementaire')->nullable();
                */
                /*$data = array();
                $data['Temp_Retard'] = $Somme;
                DB::table('pointage__employees')->where('Id_Employee',$id)->update($data);*/
        }
    }
}
