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
                            <form method="POST" action="{{route('Ajouter_Département')}}" >
                            @csrf
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nom département</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Nom département"  name="Deparetement_Nom" id="Deparetement_Nom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Hour Début </label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="time" value="09:00"   name="Date_Debut" id="Date_Debut">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Hour Fin</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="time" value="18:00"  name="Date_Fin" id="Date_Fin">
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
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Minute n'est pas depasse</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="number" placeholder="0"  name="Deparetement_Nom" id="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Combien de minutes allez vous perdere ?</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="number" placeholder="0"  name="Deparetement_Nom" id="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Activation</label>
                                    <div class="col-sm-10">
                                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="Employe">
                                            <option value="1">Activer</option>
                                            <option value="0" selected>Désactiver</option>
                                        </select>
                                    </div>
                                </div>
                                </div>
                               
                                <button type="submit" class="btn btn-success waves-effect waves-light">Ajouter Département</button>
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

    <footer class="footer">
        © 2019 Veltrix <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</span>.
    </footer>

</div>
@endsection