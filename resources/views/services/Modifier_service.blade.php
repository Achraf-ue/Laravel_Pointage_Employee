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
                        <div class="card-body">
                            <form method="POST" action="{{route('Service_Modifier_back_end')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$Service->id}}">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Departement</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Departement_employee" id="Departement_employee" style="width: 850px">
                                        @foreach ($Deparetements as $Deparetement)
                                        <option value="{{$Deparetement->id}}" {{($Deparetement->id == $Service->id_departement ? "selected":"" )}} >{{$Deparetement->Deparetement_Nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nom service</label>
                                <div class="col-sm-10">
                                   <input class="form-control" type="text" placeholder="Nom services" value="{{$Service->services}}"  name="Nom_service" id="Cin">
                                </div>
                            </div>
                                
                                
                                <button type="submit" class="btn btn-success waves-effect waves-light">Modifier Service</button>
                                <br>
                                <br>
                            </div>
                        </div>

                            </form>
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