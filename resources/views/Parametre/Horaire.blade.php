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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Employee</a></li>
                            <li class="breadcrumb-item active">Vue</li>
                        </ol>
                    </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                
                <div class="col-12"><div class="col-sm-12">
                </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Horaire</th>
                                    <th>Date debut</th>
                                    <th>Date fin</th> 
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody class="Departement_Div">
                                    @foreach ($Horaires as $Horaire)
                                <tr style="text-align: center;">
                                    
                                        
                                    
                                    <td>{{$Horaire->Nom_Houraire}}</td>
                                    <td>{{$Horaire->date_debut}}</td>
                                    <td>{{$Horaire->date_fin}}</td>
                                    
                                    <td>
                                        <a href="{{route('Modifier_Horaire_Vue',$Horaire->id)}}"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a> 
                                        <br>
                                        <br>
                                        <a><input type="checkbox" id="switch1" switch="none" checked/>
                                            <label for="switch1" data-on-label="Oui"
                                                    data-off-label="Non"></label></a>
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