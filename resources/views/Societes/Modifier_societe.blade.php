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
                            <form method="POST" action="{{route('Departement_Modifier')}}" >
                            @csrf
                            <input type="hidden" name="id" value="{{ $Deparetement->id }}">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nom département</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Nom département" value="{{$Deparetement->Deparetement_Nom}}"  name="Departement" id="Deparetement_Nom_1">
                                    </div>
                                </div>
                                <h5 style="text-align: center;">Horaire Lundi a vendredi</h5>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Hour Début </label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="time" value="{{$Deparetement->Date_Debut}}"   name="Date_Debut" id="Date_Debut">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Hour Fin</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="time" value="{{$Deparetement->Date_Fin}}"  name="Date_Fin" id="Date_Fin">
                                    </div>
                                </div>
                                <h5 style="text-align: center;">Horaire de samedi</h5>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Hour Début </label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="time" value="{{$Deparetement->Date_Debut_Samedi}}"   name="Date_Debut_1" id="Date_Debut">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Hour Fin</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="time" value="{{$Deparetement->Date_Fin_Samedi}}"  name="Date_Fin_1" id="Date_Fin">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Avertisement</label>
                                    <div class="col-sm-1">
                                       <input class="form-control" type="checkbox" id="Avertisement">
                                    </div>
                                </div>
                                <div id="Avertisement_div">
                                     <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Tolerane de retard</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="number" value="{{$Deparetement->tollerence}}" placeholder="0"  name="tollerence" id="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">penalite de retard</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="number" placeholder="0" value="{{$Deparetement->tollerence_soustraire}}" name="tollerence_soustraire" id="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Activation</label>
                                    <div class="col-sm-10">
                                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="tollerence_active">
                                          <option value="0" {{($Deparetement->tollerence_active == 0 ? "selected":"" )}}>Désactiver</option> 
                                          <option value="1" {{($Deparetement->tollerence_active == 1 ? "selected":"" )}} >Activer</option>  
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Modifier Département</button>
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