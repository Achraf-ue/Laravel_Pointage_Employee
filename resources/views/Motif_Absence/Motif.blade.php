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
                   
                    <div class="form-group row">
                     <div class="float-left d-none d-md-block">
                    <a href="{{route('Ajouter.motif')}}" ><button type="button" class="btn btn-success waves-effect waves-light">+</button></a>
                    </div>
                    
                     <!--   <div class="col-sm-10">
                            <select class="form-control" name="Motif" id="Motif" style="width: 200px">
                                <option value="Tous">Tous</option>
                                @foreach ($Motifs as $Motif)
                                <option value="{{$Motif->id}}">{{$Motif->Motif_Absence}}</option>
                                @endforeach
                            </select> 
                        </div>-->
                    </div>   
                </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Motif Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody class="Motif_Absence_Div">
                                @foreach ($Motifs as $Motif)
                                <tr>
                                    <td>{{$Motif->id }}</td>
                                    <td>{{$Motif->Motif_Absence}}</td>
                                    <td>
                                    <a href="{{route('Modifier_motif',$Motif->id)}}"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a>  
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