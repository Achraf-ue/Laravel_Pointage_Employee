@extends('admin.admin_master')
@section('admin')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    
                    <div class="col-sm-6">
                        <h4 class="page-title">Form Elements</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Veltrix</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Form Elements</li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <div style="text-align: center" class="card-body">
                            
                                <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Rapport_Pointage_Departement">
                                    <option value="">Departement</option>
                                    @foreach ($Deparetements as $Deparetement)
                                    <option value="{{$Deparetement->Deparetement_Nom}}">{{$Deparetement->Deparetement_Nom}}</option>
                                    @endforeach
                                    
                                </select>
                                <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type"  id="Rapport_Pointage_Matricule">
                                    <option value="">Nom complet</option>
                                    @foreach ($Employees as $Employe)
                                    <option value="{{$Employe->id}}">{{$Employe->Nom.' '.$Employe->Prenom}}</option>
                                    @endforeach
                                    
                                </select>
                                <input type="text" class="form-control form-control-default date-ranger" id="Range_1" name="date-ranger" style="width:190px;display:inline-block;margin-right:5px;">
                                <div class="float-right d-none d-md-block">
                                    <a id="Cherche_Rapport_Pointage" ><button type="button" class="btn btn-success waves-effect waves-light">Cherche</button></a>
                                </div>
                        </div>
                </div>
                    <div class="card">
                        
                        <div class="card-body">
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Generate_Pdf_Rapport_Pointage">
                                <option value="0">Generate Option</option>
                                <option value="Pdf">Pdf</option>
                                <option value="Excel" >Excel</option>
                            </select>
                            <br>
                            <br>    
                            <div class="Rapport_Pointage_Div">
                            <table id="Table_1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
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
                                    <th>Temp de retard</th>
                                    <th>Absence</th>
                                    <th>Opservation</th>
                                    <th>Pénalité</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                
                                <tbody>
                                    @foreach ($Rapport_Pointages as $Rapport_Pointage)
                                    <?php  $id = $Rapport_Pointage->id  ?>
                                    <tr id="{{$id}}" 
                                    @if ($Rapport_Pointage->Opservation == 'Eregulie' ) style="background-color:#fec918"
                                    @elseif ($Rapport_Pointage->Opservation == 'Ajouté manuellement') style="background-color:#3498DB" @endif>
                                        <?php $date = Carbon\Carbon::parse($Rapport_Pointage->Date_Jour)->locale('fr_FR'); ?>
                                        <td>{{$date->dayName}}</td>
                                        <td>{{$Rapport_Pointage->Date_Jour}}</td>
                                        <td>{{$Rapport_Pointage->Nom_Employee}}</td>
                                        <td>{{$Rapport_Pointage->Dpartement}}</td>
                                        @if ($Rapport_Pointage->Date_Entre != null)
                                        <?php $date = Carbon\Carbon::parse($Rapport_Pointage->Date_Entre)->locale('fr_FR'); ?>
                                        <td>{{$date->format('H:i:s') }}</td> 
                                        @else
                                        <td></td>
                                        @endif

                                        @if ($Rapport_Pointage->Date_Sortir != null)
                                        <?php $date = Carbon\Carbon::parse($Rapport_Pointage->Date_Sortir)->locale('fr_FR'); ?>     
                                        <td>{{$date->format('H:i:s')}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        <?php $Rapport_Pointage->Temp_Traville = intdiv($Rapport_Pointage->Temp_Traville, 60).':'. ($Rapport_Pointage->Temp_Traville % 60);   ?>
                                        <td>{{$Rapport_Pointage->Temp_Traville}}</td>
                                        <?php $Rapport_Pointage->Temp_Traville_supplementaire = intdiv($Rapport_Pointage->Temp_Traville_supplementaire, 60).':'. ($Rapport_Pointage->Temp_Traville_supplementaire % 60);   ?>
                                        <td>{{$Rapport_Pointage->Temp_Traville_supplementaire}}</td>
                                        <?php $Rapport_Pointage->Temp_Traville_supplementaire_1 = intdiv($Rapport_Pointage->Temp_Traville_supplementaire_1, 60).':'. ($Rapport_Pointage->Temp_Traville_supplementaire_1 % 60);   ?>
                                        <td>{{$Rapport_Pointage->Temp_Traville_supplementaire_1}}</td>
                                        <?php $Rapport_Pointage->Temp_Traville_supplementaire_2 = intdiv($Rapport_Pointage->Temp_Traville_supplementaire_2, 60).':'. ($Rapport_Pointage->Temp_Traville_supplementaire_2 % 60);   ?>
                                        <td>{{$Rapport_Pointage->Temp_Traville_supplementaire_2}}</td>
                                        @if ($Rapport_Pointage->R_T != null)
                                        <?php $Rapport_Pointage->R_T = intdiv($Rapport_Pointage->R_T, 60).' heures : '. ($Rapport_Pointage->R_T % 60).' minutes';?>
                                            <td>{{$Rapport_Pointage->R_T}}</td>
                                        @else
                                        <td></td>
                                        @endif

                                        
                                        <td>{{$Rapport_Pointage->Absence}}</td>
                                        
                                        <td>
                                        <span class="Observation">
                                            @if ($Rapport_Pointage->Opservation == 'Eregulie' )
                                                 @if ($Rapport_Pointage->Absence !=  null)
                                                <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Motive_Absence" name="Employe" id="">
                                                        @foreach ( $Motive_Absences as $Motive_Absence )
                                                            <option  data-id="{{$id}}" value="{{$Motive_Absence->Motif_Absence}} {{($Motive_Absence->Motif_Absence ==  $Rapport_Pointage->Opservation  ? "selected":"" ) }}    ">{{$Motive_Absence->Motif_Absence}}</option>
                                                        @endforeach
                                            </select>
                                            @endif
                                            @else
                                                {{$Rapport_Pointage->Opservation}}
                                            @endif
                                        
                                           
                                        </span>
                                        </td>
                                        <td>
                                            {{$Rapport_Pointage->tollerence.' Minutes'}}
                                        </td>
                                        
                                        <td>
                                            @if ($Rapport_Pointage->Id_Retard != null)
                                            <a class="view_detaiile_retard" data-id="{{$Rapport_Pointage->Id_Retard}}" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a>
                                            @endif
                                            @if ($Rapport_Pointage->Absence ==  null)
                                            <a class="view_detaiile_rapport_pointage" data-id="{{$id}}" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light">Detailles</button></a>
                                            @endif
                                            

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
           


        </div>
        <!-- container-fluid -->

    </div>
    <!-- content -->

</div>
@endsection