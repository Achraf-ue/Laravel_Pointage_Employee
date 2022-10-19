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
        td,th {border: 1px solid;}
        h1{
            text-align: center;
            color: red;
        }
    </style>
    <h1>Etat de Pointage </h1>
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead style="background-color: #fec918">
        <tr>
            
            <th>Matricule</th>
            <th>Employee</th>
            <th>Date</th>
            <th>Date Entre</th>
            <th>Date Sortir</th>
            <th>Nombre hour travaille</th>
        </tr>
        </thead>
        <tbody class="factures_Div">
        @foreach ( $Pointage_employees as $Pointage )
             <tr>
                <td>{{$Pointage->Cin}}</td>
                <td>{{$Pointage->Nom.' '.$Pointage->Prenom }}</td>      
                <td>{{$Pointage->Date_Jour}}</td>
                <td>{{$Pointage->Date_Entre}}</td>
                <td>{{$Pointage->Date_Sortir}}</td> 
                <td>{{$Pointage->Temp_Travaille.' '}} minutes </td> 
        </tr>  
        @endforeach
         
        </tbody>

    </table>
</body>
</html>