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
                    <a href="{{route('Ajouter.Fete')}}" ><button type="button" class="btn btn-success waves-effect waves-light">+</button></a>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row" style="text-align: center">
                    
                        <div style="display: none;" class="col-sm-10">
                            <select class="form-control" name="Departement" id="Departement" style="width: 200px">
                                <option value="Tous">Tous</option>
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
                                    <th>Nom Fete</th>
                                    <th>Date début</th>
                                    <th>Date fin</th> 
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody class="Departement_Div">
                                @foreach ($Fetes as $Fete)
                                <tr>
                                    <td>{{$Fete->id }}</td>
                                    <td>{{$Fete->Nom_Fete}}</td>
                                    <td>{{$Fete->Date_Debut}}</td>
                                    <td>{{$Fete->Date_Fin}}</td>
                                    <td>
                                    <a href="{{route('Modifier_Fete_Vue',$Fete->id)}}"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a>
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