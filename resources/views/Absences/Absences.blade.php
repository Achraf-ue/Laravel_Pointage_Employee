@extends('admin.admin_master')
@section('admin')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    
                    <div class="col-sm-6">
                        <h4 class="page-title"></h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Departement</a></li>
                            <li class="breadcrumb-item active">Vue</li>
                        </ol>

                    </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                
                <div class="col-12"><div class="col-sm-12">
                    
                    <div class="float-right d-none d-md-block">
                    <a href="{{route('Ajouter.absence')}}" ><button type="button" class="btn btn-success waves-effect waves-light">+</button></a>
                    </div>
                    <div class="float-right mr-2 d-none d-md-block">
                        <a href="{{route('Ajouter.pointage')}}"><button type="button" class="btn btn-danger  waves-effect waves-light">Ajouter pointage</button></a>
                    </div>
                    <div class="form-group row" style="text-align: center">
                    
                        <div class="col-sm-10">
                            <select class="form-control" name="Departement" id="Departement" style="width: 200px">
                                <option value="Tous">Tous</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="table_1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <th>Id</th>
                                <th>Matricule</th>
                                <th>Nom </th>
                                <th>Actions</th>
                                
                                </thead>
    
    
                                <tbody class="Retard_Div">
                                    @foreach ( $Absences as $Absence )
                                    <tr>
     
                                     <td>{{$Absence->id}}</td>
                                     <td>{{$Absence->Cin}}</td>
                                     <td>{{$Absence->Nom_Employee}}</td>
                                     <th>
                                     <a class="view_detaiile_Absences" data-id="{{$Absence->id}}" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a>
                                     <a class="print_facture" data-id="{{$Absence->id}}" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="mdi mdi-cloud-print"></i></button></a>
                                     <a href="{{route('Ajouter.pointage')}}"><button type="button" class="btn btn-danger  waves-effect waves-light">Ajouter pointage</button></a>
                                     <object style="display: none;" data="your_url_to_pdf" type="application/pdf"><iframe style="height: 500px;width:750px" id="{{$Absence->id}}" class="myFrame"  src="{{asset($Absence->Motif_Fichier)}}"></iframe></object>
                                      
                                    
                                    
                                    
                                    </th>
    
                                     
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