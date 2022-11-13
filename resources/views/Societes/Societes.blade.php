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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Societées</a></li>
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
                    <a href="{{route('Societe_Ajouter_Vue')}}" ><button type="button" class="btn btn-success waves-effect waves-light">+</button></a>
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
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nom Societé</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody class="Departement_Div">
                                @foreach ($Societes as $Societe)
                                <tr>
                                    <td>{{$Societe->id}}</td>
                                    <td>{{$Societe->Nom_Societe}}</td>
                                    <td>
                                    <a href="{{route('Modifier_Departement_Vue',$Societe->id)}}"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a>  
                                    <a class="view_Societe_employee" data-id="{{$Societe->id}}" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a> 
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