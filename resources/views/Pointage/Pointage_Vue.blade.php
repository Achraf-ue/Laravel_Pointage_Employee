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
                            
                                <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="Employe" id="Employe_1">
                                    <option value="">Nom complet</option>
                                    @foreach ($Employees as $Employe)
                                    <option value="{{$Employe->id}}">{{$Employe->Nom.' '.$Employe->Prenom}}</option>
                                    @endforeach
                                </select>
                                <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="Employe" id="Pointage_Matricule">
                                    <option value="">Matricule</option>
                                    @foreach ($Employees as $Employe)
                                    <option value="{{$Employe->id}}">{{$Employe->Cin}}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control form-control-default date-ranger" id="Range_1" name="date-ranger" style="width:190px;display:inline-block;margin-right:5px;">
                                <div class="float-right d-none d-md-block">
                                    <a id="Cherche_Pointage" ><button type="button" class="btn btn-success waves-effect waves-light">Cherche</button></a>
                                </div>
                        </div>
                </div>
                    <div class="card">
                        
                        <div class="card-body">
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Generate_Pdf_Retard" name="client">
                                <option value="0">Generate Option</option>
                                <option value="Pdf">Pdf</option>
                                <option value="Excel" >Excel</option>
                            </select>
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Matricule</th>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Date Entre</th>
                                    <th>Date Sortir</th>
                                    <th>Nombre hour travaille</th>
                                </tr>
                                </thead>


                                <tbody class="Pointage_Div">
                                @foreach ($Pointages as $Pointage)
                                <tr>
                                    <td>{{$Pointage->id}}</td>
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