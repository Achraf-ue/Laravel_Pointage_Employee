<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Rapport_Pointage;
use App\Models\Congé;
use App\Models\Absence;
use App\Models\Fetes;

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
        $Date_A = Carbon::now()->addHour()->format('Y-m-d');
        $date = Carbon::parse($Date_A)->locale('fr_FR');
        $Fete_T = 0;
        $Congé_Employee = 0;
        $Absence_Employee = 0;
        $Fete_Nom = '';
        $H_S_T = '';
        $H_S_T_F = '';
        $Fetes = Fetes::all();
        foreach($Fetes as $Fete)
        {
        $Date_Début = $Fete->Date_Debut;
        $Date_Fin = $Fete->Date_Fin;
        if(($Date_A >= $Date_Début) && ($Date_A <= $Date_Fin))
        {
            $Fete_T = 1;
            $Fete_Nom .= $Fete->Nom_Fete;
            $H_S_T_F = $Fete->H_S_T;
            break;
        }



        }
        

        foreach($Employees as $Employee)
        {
            
           
                $id = $Employee->id;
                $tollerence = 0;
                $Congé = DB::table('congés')->where('Id_Employee',$id)->first();
                if($Congé != null)
                {
                    if(($Date_A >= $Congé->Date_Debut) && ($Date_A <= $Congé->Date_Fin))
                    $Congé_Employee = 1;
                    $H_S_T = $Congé->H_S_T;

                }
                //Absences
                $Absence = DB::table('absences')->where('Id_Employee',$id)->first();
                if($Absence != null)
                {
                    if(($Date_A >= $Absence->Date_Debut) && ($Date_A <= $Absence->Date_Fin))
                    $Absence_Employee = 1;
                }
                    
                //Fin absences   
                        
                    
                
                $Somme  = DB::table('pointage__employees')->where('Date_Jour',Carbon::now()->addHour()->format('Y-m-d'))->where('Type_Pointage','Rapport')->where('Id_Employee',$id)->sum('Temp_Travaille');
                //$Retard = DB::table('retards')->where('Date_Jour',Carbon::now()->addHour()->format('Y-m-d'))->where('Id_Employee',$id)->first();
                $Date_Entree      = DB::table('pointage__employees')->where('Date_Jour',Carbon::now()->addHour()->format('Y-m-d'))->where('Type_Pointage','Entre')->where('Id_Employee',$id)->orderBy('Date_Entre','ASC')->pluck('Date_Entre')->first();
                $Date_Sortir      = DB::table('pointage__employees')->where('Date_Jour',Carbon::now()->addHour()->format('Y-m-d'))->where('Type_Pointage','Sortir')->where('Id_Employee',$id)->orderBy('Date_Sortir','DESC')->pluck('Date_Sortir')->first();
                $Departement      = DB::table('deparetements')->where('id',$Employee->Departement)->first();
                $Retard           = DB::table('retards')->where('Date_Jour',Carbon::now()->addHour()->format('Y-m-d'))->where('Id_Employee',$id)->first();


                if($Retard != null)
                {
                    if($Retard->Avertisement != '0')
                    {
                        if($Somme != 0)
                        $Somme = $Somme - $Departement->tollerence_soustraire;
                        $tollerence = $Departement->tollerence_soustraire;
                    }
                }
                    
                   $data = new Rapport_Pointage();
                   $data->tollerence = $tollerence;
                   $data->Id_Employee = $id;
                   $data->Date_Jour = Carbon::now()->addHour()->format('Y-m-d');
                   $data->Nom_Employee = $Employee->Nom.' '.$Employee->Prenom;
                   $data->Dpartement   = $Departement->Deparetement_Nom;
                   $data->Id_Departement = $Departement->id;
                   $data->Temp_Traville = $Somme;
                   $data->Temp_Traville_supplementaire   =   '0';
                   $data->Temp_Traville_supplementaire_1 =   '0';
                   $data->Temp_Traville_supplementaire_2 =   '0';
                   if($Somme == '0')
                   {
                    if($Fete_T == 0)
                    {
                    $data->Temp_Traville = '0';
                    $data->Absence = '08:00';
                    $data->Opservation = 'Eregulie';
                    //Table absence 
                    if($Absence_Employee == 0)
                    {
                    $data_A = new Absence();
                    $data_A->Id_Employee = $id;
                    $data_A->Id_Departement = $Employee->Departement;
                    $data_A->Nom_Employee = $Employee->Nom .' '.$Employee->Prenom;
                    $data_A->Cin = $Employee->Cin;
                    $data_A->Date_Debut = $Date_A;
                    $data_A->Date_Fin = $Date_A;
                    $data_A->Date_Fin = $Date_A;
                    $data_A->Motif = 'Eregulie';
                    $data_A->Motif_Fichier = 'Eregulie';
                    $data_A->Read_at = '0';
                    $data_A->save();
                    }
                    else
                    if($Absence_Employee == 1)
                    $data->Opservation = $Absence->Motif;
                    
                    //Fin table absence 
                    }
                    else
                    if($Fete_T == 1)
                    {
                        $data->Temp_Traville = '480';
                        $data->Opservation = $Fete_Nom;
                    }
                    if($Congé_Employee == 1)
                    {
                        $data->Absence = ' ';
                        $data->Temp_Traville = '480';                    
                        $data->Opservation = 'Congé';
                    }
                   }
                   else
                   {
                    if($Retard != null)
                    {
                        $data->Id_Retard = $Retard->id;
                        $data->R_T = $Retard->Temps_Retard;
                    }
                    if($Fete_T == 1)
                    {
                        //$data->Temp_Traville = '0';
                        //$data->Temp_Traville_supplementaire_2 = $Somme;
                        //Fetes
                        if($Fete_T == 1)
                        $data->Opservation = 'a travaille dans le fete de '.$Fete_Nom;
                        if($H_S_T_F == 0)
                        {
                            $data->Temp_Traville = $Somme;
                            $data->Temp_Traville_supplementaire =   '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T_F == 25)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = $Somme;
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T_F == 50)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = $Somme;
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T_F == 100)
                        { 
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = $Somme;
                        }
                        //Fin fetes

                        if($Congé_Employee == 1)
                        {
                            $data->Opservation = 'Congé mais travaille et le fete de '.$Fete_Nom;
                            if($H_S_T == 0)
                        {
                            $data->Temp_Traville = $Somme;
                            $data->Temp_Traville_supplementaire =   '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T == 25)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = $Somme;
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T == 50)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = $Somme;
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T == 100)
                        { 
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = $Somme;
                        }

                        }
                        
                    }
                    else
                    {
                    if($Somme <= '480')
                    {
                        //$data->Temp_Traville = $Somme;
                        //$data->Temp_Traville_supplementaire = '0';
                        //Fetes
                        if($Fete_T ==1)
                        $data->Opservation = 'a travaille dans le fete de '.$Fete_Nom;
                        if($H_S_T_F == 0)
                        {
                            $data->Temp_Traville = $Somme;
                            $data->Temp_Traville_supplementaire =   '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T_F == 25)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = $Somme;
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T_F == 50)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = $Somme;
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T_F == 100)
                        { 
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = $Somme;
                        }
                        //Fin fetes
                        if($Congé_Employee == 1)
                        {
                            $data->Opservation = 'Congé mais travaille';
                            if($H_S_T == 0)
                        {
                            $data->Temp_Traville = $Somme;
                            $data->Temp_Traville_supplementaire =   '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T == 25)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = $Somme;
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T == 50)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = $Somme;
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T == 100)
                        { 
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = $Somme;
                        }
                        }
                        
                    }
                    else
                    {
                        if($Somme - '480' >= 30)
                        {
                            $data->Temp_Traville_supplementaire = $Somme - '480';
                            $data->Temp_Traville = '480';
                        }
                        
                        else
                        {
                          $data->Temp_Traville_supplementaire = '0';
                          $data->Temp_Traville = '480';
                        }
                        //Fetes 
                        if($Fete_T == 1)
                        $data->Opservation = 'a travaille dans le fete de '.$Fete_Nom;
                        if($H_S_T_F == 0)
                        {
                            $data->Opservation = '';
                            $data->Temp_Traville = $Somme;
                            $data->Temp_Traville_supplementaire =   '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T_F == 25)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = $Somme;
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T_F == 50)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = $Somme;
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T_F == 100)
                        { 
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = $Somme;
                        }
                        //Fin fetes
                        

                        if($Congé_Employee == 1)
                        {
                            $data->Opservation = 'Congé mais travaille';
                        if($H_S_T == 0)
                        {
                            $data->Temp_Traville = $Somme;
                            $data->Temp_Traville_supplementaire =   '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T == 25)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = $Somme;
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T == 50)
                        {
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = $Somme;
                            $data->Temp_Traville_supplementaire_2 = '0';
                        }
                        else
                        if($H_S_T == 100)
                        { 
                            $data->Temp_Traville = '0';
                            $data->Temp_Traville_supplementaire = '0';
                            $data->Temp_Traville_supplementaire_1 = '0';
                            $data->Temp_Traville_supplementaire_2 = $Somme;
                        }
                        
                        }
                        
                    }
                    }
                    
                    

                    $data->Date_Entre =  $Date_Entree;
                    $data->Date_Sortir = $Date_Sortir;
                   }
                   
                   $data->save();
                   $Congé_Employee = 0;
                   $Absence_Employee = 0;
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
