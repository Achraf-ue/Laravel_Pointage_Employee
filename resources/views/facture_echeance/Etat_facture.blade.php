<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  text-align: center;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #04AA6D;
  color: white;
}
#customers td {
   height: 20px;
  text-align: center;
  background-color: #04AA6D;
  color: black;
}
#customers tr{
   width: 50px;
}
.th-1{
    width: 200px;
}
</style>
</head>
<body>

<h1 style="text-align: center;">Etat du facture</h1>


<table style="width: 500px; margin-left:auto; 
margin-right:auto;" id="customers">
  <tr>
    <th colspan="2" class="th-1">Facture {{$Facture->id}}</th>
  </tr>
  <tr>
    <td class="th-1">Facture ID</td>
    <td>{{$Facture->id}}</td>
  </tr>
  <tr>
    <td class="th-1">Type</td>
    <td>{{$Facture->type}}</td>
  </tr>
  <tr>
    <td class="th-1">Nom complet</td>
    <td>{{$Facture->nom_complet}}</td>
  </tr>
  <tr>
    <td class="th-1">N facture</td>
    <td>{{$Facture->n_facture}}</td>
  </tr>
  <tr>
    <td class="th-1">Date facure</td>
    <?php $date = Carbon\Carbon::parse($Facture->date_facture)->locale('fr_FR'); ?>
    <td>{{$Facture->date_facture.'  '.$date->dayName}}</td>
  </tr>
  <tr>
    <td class="th-1">Date payement</td>
    <td>{{$Facture->date_payement}}</td>
  </tr>
  <tr>
    <td class="th-1">Mantant</td>
    <td>{{$Facture->mantant.' '.'DH'}}</td>
  </tr>
  <tr>
    <td class="th-1">Statu</td>
    <td><span class="badge badge-success">{{$Facture->status}}</span></td>
  </tr>
</table>

</body>
</html>