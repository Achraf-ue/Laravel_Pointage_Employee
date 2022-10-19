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
    <h1>Etat de facturation </h1>
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead style="background-color: #fec918">
        <tr>
            <th>Id</th>
            <th>Type</th>
            <th>Nom complet</th>
            <th>N facture</th> 
            <th>Date facture</th>
            <th>Date payement</th>
            <th>Crédit</th>
            <th>Début</th>
            <th>Status</th>
        </tr>
        </thead>


        <tbody class="factures_Div">
        @foreach ($Factures as $facture_echeance)
        <tr>
            <td>{{$facture_echeance->id }}</td>
            <td>{{$facture_echeance->type}}</td>
            <td>{{$facture_echeance->nom_complet}}</td>
            <td>{{$facture_echeance->n_facture}}</td>
            <?php $date = Carbon\Carbon::parse($facture_echeance->date_facture)->locale('fr_FR'); ?>
            <td>{{$facture_echeance->date_facture.'  '.$date->dayName}}</td>
            <td>{{$facture_echeance->date_payement}}</td>

            @if ($facture_echeance->type == "Client")
            <td>{{$facture_echeance->mantant}}</td>
            @else
            <td></td>
            @endif
            @if ($facture_echeance->type == "Fourniseur")
            <td>{{$facture_echeance->mantant}}</td>  
            @else
            <td></td>  
            @endif

            @if ($facture_echeance->status == "payé")
            <td><span class="badge badge-success">{{$facture_echeance->status}}</span></td>
            @else
            <td><span class="badge badge-danger">{{$facture_echeance->status}}</span></td>
            @endif </tr>@endforeach
            <tr><td></td><td></td><td></td><td></td><td></td><td>Totale : </td><td>{{$Credit}}</td><td>{{$Début}}</td><td></td></tr>  
        
        
        </tbody>
    </table>
</body>
</html>