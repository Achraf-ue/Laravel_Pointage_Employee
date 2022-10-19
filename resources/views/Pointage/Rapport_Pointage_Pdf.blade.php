<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        td,th {
            border: 1px solid;
            font-size: 10px;
            text-align: center;
            height: 25px;
        }
        h1{
            text-align: center;
            color: red;
        }
    </style>
    <h1>Rapport de Pointage </h1>
    <p>Période pointage de {{$Date_debut}} à {{$Date_fin}}</p>
    @if ($Filter_1 == '0')
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead style="background-color: #1E90FF;color:white;">
            <tr>
                <th>Id employee</th>
                <th>N de carte </th>
                <th>Bloc houraire</th>
                <th>Entre</th>
                <th>Sortir</th>
                <th>Mtaricule</th>
                <th>Nom complet</th>
            </tr>
            </thead>

            
            <tbody class="Rapport_Pointage_Div">
                <tr>
            <td>{{$Employee->id}}</td>
            <td>76000</td>
            <td>{{$Deparetement->id}}</td>
            <td>{{$Deparetement->Date_Debut}}</td>
            <td>{{$Deparetement->Date_Fin}}</td>
            <td>{{$Employee->Cin}}</td>
            <td>{{$Employee->Nom.' '.$Employee->Prenom}}</td>
        </tr>
                
            </tbody>

    </table>
    @endif
    <br>
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead style="background-color: #1E90FF">
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
                <th>T.R</th>
                <th>Absence</th>
                <th>Opservation</th>
            </tr>
            </thead>

            <?php  $T_T = $H_S = $R_T = 0;  ?>
            <tbody class="Rapport_Pointage_Div">
                @foreach ($Rapport_Pointages as $Rapport_Pointage)
                <?php 
                $T_T += $Rapport_Pointage->Temp_Traville;
                $H_S += $Rapport_Pointage->Temp_Traville_supplementaire;
                if($Rapport_Pointage->R_T != null )
                $R_T += $Rapport_Pointage->R_T;
                ?>
                <tr @if($Rapport_Pointage->Opservation == 'Eregulie' ) style="background-color:#fec918" @endif >
                    <?php $date = Carbon\Carbon::parse($Rapport_Pointage->Date_Jour)->locale('fr_FR'); ?>
                    <td>{{$date->dayName}}</td>
                    <td>{{$Rapport_Pointage->Date_Jour}}</td>
                    <td>{{$Rapport_Pointage->Nom_Employee}}</td>
                    <td>{{$Rapport_Pointage->Dpartement}}</td>
                    <?php $date = Carbon\Carbon::parse($Rapport_Pointage->Date_Entre)->locale('fr_FR'); ?>
                    <td>{{$date->format('H:i:s') }}</td> 
                    <?php $date = Carbon\Carbon::parse($Rapport_Pointage->Date_Sortir)->locale('fr_FR'); ?>     
                    <td>{{$date->format('H:i:s')}}</td>
                    <?php $Rapport_Pointage->Temp_Traville = intdiv($Rapport_Pointage->Temp_Traville, 60).':'. ($Rapport_Pointage->Temp_Traville % 60);   ?>
                    <td>{{$Rapport_Pointage->Temp_Traville}}</td>
                    <?php $Rapport_Pointage->Temp_Traville_supplementaire = intdiv($Rapport_Pointage->Temp_Traville_supplementaire, 60).':'. ($Rapport_Pointage->Temp_Traville_supplementaire % 60);   ?>
                    <td>{{$Rapport_Pointage->Temp_Traville_supplementaire}}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>{{$Rapport_Pointage->R_T}}</td>
                    <td>{{$Rapport_Pointage->Absence}}</td>
                    
                    <td>
                    {{$Rapport_Pointage->Opservation}}
                    </td>
                </tr>
                @endforeach
                @if ($Filter_1 == '0')
                    
                <?php 
                $T_T = intdiv($T_T, 60).':'. ($T_T % 60);
                $H_S = intdiv($H_S, 60).':'. ($H_S % 60);
                $R_T = intdiv($R_T, 60).':'. ($R_T % 60);
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Totale:</td>
                    <td>{{$T_T}}</td>
                    <td>{{$H_S}}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>{{$R_T}}</td>
                    <td></td>
                    <td></td>
                    

                </tr>
                @endif
            </tbody>

    </table>
    
</body>
</html>