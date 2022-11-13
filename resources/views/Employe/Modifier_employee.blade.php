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
                            <form method="POST" action="{{route('Employee_Modifier_back_end')}}" enctype="multipart/form-data" >
                            @csrf
                                   <input class="form-control" type="hidden" value="{{$Employes->id}}"  name="id_employee">

                                   <div style="align-items: center;text-align:center"  class="">
                                    <img class="rounded-circle" src="{{asset($Employes->Employee_Image)}}" style="height: 150px;width:100px;"  alt="200x200"  data-holder-rendered="true">
                                </div>
                                <br>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Matricule</label>
                                <div class="col-sm-10">
                                   <input class="form-control" type="text" value="{{$Employes->Cin}}" placeholder="Matricule"  name="Matricule">
                                </div>
                            </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" value="{{$Employes->Nom}}" placeholder="Nom"  name="Nom" id="Nom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Prenom</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Prenom" value="{{$Employes->Prenom}}"    name="Prenom" id="Prenom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Adress</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Adress" value="{{$Employes->Adress}}"  name="Adress" id="Adress">
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
                                            <option value="{{$Deparetement->id}}"  {{($Deparetement->id == $Employes->Departement ? "selected":"" )}}>{{$Deparetement->Deparetement_Nom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Type changement</label>
                                    <div class="col-sm-10">
                                        <select class="form-control Type" name="Type_Changement" id="Type_Changement" style="width: 850px">
                                            <option value="1"  selected>Type Toujours</option>
                                            <option value="2" >Par Date</option>
                                        </select>
                                        <input type="text" class="form-control form-control-default date-ranger Date_Type_Changement" id="Range_1" name="date_ranger" style="width:190px;display:inline-block;margin-right:5px;background-color:#fec918;">
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Modifier Employee</button>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
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