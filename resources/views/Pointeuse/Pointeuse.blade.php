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
                    <a href="{{route('Ajouter.pointeuse')}}" ><button type="button" class="btn btn-success waves-effect waves-light">+</button></a>
                    </div>
                    <br>
                    <br>
                </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Nom pointeuse</th>
                                    <th>Adress ip</th>
                                    <th>port</th> 
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody class="Departement_Div">
                                    @foreach ($Pointeuses as $Pointeuse )
                                <tr>
                                    <td>{{$Pointeuse->Nom_pointeuse}}</td>
                                    <td>{{$Pointeuse->Adress_ip}}</td>
                                    <td>{{$Pointeuse->port}}</td>
                                    <td>
                                        <a href="{{route('Pointeuse.Moidfier',$Pointeuse->id)}}"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a> 
                                        <a id="Delete_Pointeuse" href="{{route('Pointeuse.Delete',$Pointeuse->id)}}"><button type="button"  class="btn btn-danger waves-effect waves-light">delete</button></a> 
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