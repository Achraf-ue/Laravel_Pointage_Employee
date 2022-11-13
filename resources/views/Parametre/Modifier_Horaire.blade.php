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
                            <form method="POST" action="{{route('Horaire_Modifier_back_end')}}" >
                            @csrf
                            <input type="hidden" name="id" value="{{$Horaire->id}}">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Date début</label>
                                <div class="col-sm-10">
                                   <input class="form-control datepicker"  type="text" value="{{$Horaire->date_debut}}"  name="date_debut">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input"   class="col-sm-2 col-form-label">Date Fin</label>
                                <div class="col-sm-10">
                                   <input class="form-control datepicker" type="text" value="{{$Horaire->date_fin}}"   name="date_fin" >
                                </div>
                            </div>
                                <h5 style="text-align: center;">Horaire Lundi a vendredi</h5>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Hour Début </label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="time" value="{{$Horaire->heure_entre_L_V}}"   name="heure_entre_L_V" id="Date_Debut">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Hour Fin</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="time" value="{{$Horaire->heure_sortir_L_V}}"  name="heure_sortir_L_V" id="Date_Fin">
                                    </div>
                                </div>
                                <h5 style="text-align: center;">Horaire de samedi</h5>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Hour Début </label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="time" value="{{$Horaire->heure_entre_S}}"   name="heure_entre_S" id="Date_Debut">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Hour Fin</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="time" value="{{$Horaire->heure_sortir_S}}"  name="heure_sortir_S" id="Date_Fin">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Modifier Horaire ramadan</button>
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