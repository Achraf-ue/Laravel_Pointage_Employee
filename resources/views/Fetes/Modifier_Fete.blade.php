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
                            <form method="POST" action="{{route('Fete_Modifier_Back_end')}}" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" name="id" value="{{$Fete->id}}">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nom fete</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Nom Fete" value="{{$Fete->Nom_Fete}}"  name="Fete_Nom" id="Deparetement_Nom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Date début</label>
                                    <div class="col-sm-10">
                                       <input class="form-control datepicker" value="{{$Fete->Date_Debut}}" type="text" placeholder="Date début"  name="Date_Debut">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"   class="col-sm-2 col-form-label">Date Fin</label>
                                    <div class="col-sm-10">
                                       <input class="form-control datepicker" type="text" value="{{$Fete->Date_Fin}}"  placeholder="Date Fin"  name="Date_Fin" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"   class="col-sm-2 col-form-label">Calcule heure sup</label>
                                    <div class="col-sm-10">
                                        <select class="form-control  Type" name="H_S_T" style="width: 200px">
                                            <option value="0"   {{($Fete->H_S_T ==  '0' ? "selected":"" )}} >Heur normale</option> 
                                            <option value="25" {{($Fete->H_S_T ==   '25' ? "selected":"" )}}>25%</option>
                                            <option value="50" {{($Fete->H_S_T ==   '50' ? "selected":"" )}}>50%</option>
                                            <option value="100" {{($Fete->H_S_T ==  '100' ? "selected":"" )}}>100%</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Modifier Fete</button>
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