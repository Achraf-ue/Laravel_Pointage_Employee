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
                    <a href="{{route('Ajouter.departement')}}" ><button type="button" class="btn btn-success waves-effect waves-light">+</button></a>
                    </div>
                    <div class="float-right mr-2 d-none d-md-block">
                        <a href="{{route('Ajouter.Employee')}}" ><button type="button" class="btn btn-danger  waves-effect waves-light">Ajouter employee</button></a>
                    </div>
                    <div class="form-group row" style="text-align: center">
                    
                        <div class="col-sm-10">
                            <select class="form-control" name="Departement" id="Departement" style="width: 200px">
                                <option value="Tous">Tous</option>
                                @foreach ($Deparetements as $Deparetement)
                                <option value="{{$Deparetement->id}}">{{$Deparetement->Deparetement_Nom}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nom Departement</th>
                                    <th>Heure début</th>
                                    <th>Heure fin</th> 
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody class="Departement_Div">
                                @foreach ($Deparetements as $Deparetement)
                                <tr>
                                    <td>{{$Deparetement->id }}</td>
                                    <td>{{$Deparetement->Deparetement_Nom}}</td>
                                    <td>{{$Deparetement->Date_Debut}}</td>
                                    <td>{{$Deparetement->Date_Fin}}</td>
                                    <td>
                                    <a href="{{route('Modifier_Departement_Vue',$Deparetement->id)}}"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a>  
                                    <a class="view_departement_employee" data-id="{{$Deparetement->id}}" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a> 
                                    </td>
                                   
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