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
                            <form method="POST" action="{{route('Ajouter_Employee_')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Matricule</label>
                                <div class="col-sm-10">
                                   <input class="form-control" type="text" placeholder="Matricule"  name="Cin" id="Cin">
                                </div>
                            </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Nom"  name="Nom" id="Nom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Prenom</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Prenom"    name="Prenom" id="Prenom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Telephone</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="telephone"    name="Telephone" id="telephone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Adress</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Adress" name="Adress" id="Adress">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"   class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="filestyle" data-input="false" name="Image" data-buttonname="btn-secondary">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Departement</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="Departement_employee" id="Departement_employee" style="width: 850px">
                                            @foreach ($Deparetements as $Deparetement)
                                            <option value="{{$Deparetement->id}}">{{$Deparetement->Deparetement_Nom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-success waves-effect waves-light">Ajouter Employee</button>
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