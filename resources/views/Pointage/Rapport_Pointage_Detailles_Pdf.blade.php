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
    width: 150px;
}
</style>
</head>
<body>

<p style="text-align: center;">Rapport detailees pointage de :<span style="color: red">{{$Employee->Nom.' '.$Employee->Prenom}} de matricule {{$Employee->Cin}}</span></span>


<table style="width: 500px; margin-left:auto; 
margin-right:auto;" id="customers">
  <tr>
    <th class="th-1">Pointage</th>
    <th class="th-1">Entre</th>
    <th class="th-1">Sortir</th>
    <th class="th-1">Temps travailles</th>
  </tr>
  @foreach ($rapport_pointages as $rapport_pointage )
  <tr>
    <td class="th-1">1</td>
    <?php $date = Carbon\Carbon::parse($rapport_pointage->Date_Entre)->locale('fr_FR'); ?>
    <td>{{$date->format('H:i:s')}}</td>
    <?php $date = Carbon\Carbon::parse($rapport_pointage->Date_Sortir)->locale('fr_FR'); ?>
    <td>{{$date->format('H:i:s')}}</td>
    <?php $rapport_pointage->Temp_Travaille = intdiv($rapport_pointage->Temp_Travaille, 60).' Heures : '. ($rapport_pointage->Temp_Travaille % 60).' Minutes';?>
    <td>{{$rapport_pointage->Temp_Travaille}}</td>
  </tr>
  @endforeach
  <tr>
    <td></td>
    <td></td>
    <td>Totale</td>
    <?php $Totale = intdiv($Totale, 60).' Heures : '. ($Totale % 60).' Minutes';?>
    <td>{{$Totale}}</td>
  </tr>
  
</table>

</body>
</html>