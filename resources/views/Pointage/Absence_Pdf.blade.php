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
    <h1>Rapport d'Absences </h1>
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead style="background-color: #1E90FF">
            <tr>
                <th>Id</th>
                <th>Matricule</th>
                <th>Nom </th>
                <th>Date</th>
            </tr>
            </thead>

            <tbody class="Rapport_Pointage_Div">
                @foreach ( $Absences as $Absence )
                                <tr>
 
                                 <td>{{$Absence->id}}</td>
                                 <td>{{$Absence->Cin}}</td>
                                 <td>{{$Absence->Nom_Employee}}</td>
                                 <td>{{$Absence->Date_Debut}}</td>
                                 
                             </tr> 
                             @endforeach
            </tbody>

    </table>
    
</body>
</html>