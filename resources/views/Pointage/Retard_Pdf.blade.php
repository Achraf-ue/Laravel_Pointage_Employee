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
    <h1>Rapport de Retard </h1>
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead style="background-color: #1E90FF">
            <tr>
                <th>Id</th>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Departement</th>
                <th>Plage horaire</th>
                <th>Date Jour</th>
                
                <th>Heure entre</th>
                <th>Retard</th>
            </tr>
            </thead>

            <tbody class="Rapport_Pointage_Div">
                @foreach ($Retards as $Retard)
                <tr>
                    <td id="Id_Retard">{{$Retard->id}}</td>
                    <td>{{$Retard->Cin}}</td>
                    <td>{{$Retard->Nom.' '.$Retard->Prenom}}</td>
                    <td>{{$Retard->Deparetement_Nom}}</td>
                    <td>{{$Retard->Date_Debut.' '.$Retard->Date_Fin}}</td>
                    <?php
                    $date = Carbon\Carbon::parse($Retard->Date_Jour)->locale('fr_FR');?>
                    <td>{{$Retard->Date_Jour.' '.$date->dayName}} </td>
                    
                    <td>{{$Retard->Date_Entre}}</td>
                    <?php $Retard->Temps_Retard = intdiv($Retard->Temps_Retard, 60).' Heures : '. ($Retard->Temps_Retard % 60);   ?>
                    <td>{{$Retard->Temps_Retard.' Minutes'}}</td>
                </tr>
                @endforeach
            </tbody>

    </table>
    
</body>
</html>