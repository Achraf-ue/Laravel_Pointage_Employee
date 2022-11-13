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
                            <form method="POST" action="{{route('Ajouter.Absence_Back_End')}}" enctype="multipart/form-data" >
                            @csrf
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nom Employee</label>
                                    <div class="col-sm-10">
                                        <select class="form-control  Type" name="Employe" style="width: 200px">
                                            <option value="Tous">Tous</option>
                                            @foreach ($Employees as $Employe)
                                            <option value="{{$Employe->id}}">{{$Employe->Nom.' '.$Employe->Prenom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Date début</label>
                                    <div class="col-sm-10">
                                       <input class="form-control datepicker" autocomplete="off"  type="text" placeholder="Date début absence"  name="Date_Debut">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"   class="col-sm-2 col-form-label">Date Fin</label>
                                    <div class="col-sm-10">
                                       <input class="form-control datepicker" autocomplete="off" type="text"  placeholder="Date Fin absence"  name="Date_Fin" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"   class="col-sm-2 col-form-label">Motif d'absente</label>
                                    <div class="col-sm-10">
                                        <select class="form-control  Type" id="Motif_Absence_Fichier"  name="Motif" style="width: 200px">
                                            @foreach ( $Motifs as $Motif)
                                                <option value="{{$Motif->Motif_Absence}}">{{$Motif->Motif_Absence}}</option> 
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                                <div id="Motife_fichie_Input" class="form-group row">
                                    <label for="example-text-input"   class="col-sm-2 col-form-label">Motif d'absente fichier </label>
                                    <div class="col-sm-10">
                                        <input type="file" class="filestyle" data-input="false" name="Motif_Fichier" data-buttonname="btn-secondary">
                                    </div>
                                </div>
                               
                                <button type="submit" class="btn btn-success waves-effect waves-light">Ajouter absence</button>
                                <a href="{{route('index')}}" ><button type="button" class="btn btn-dark waves-effect waves-light">Anuller</button></a> 
                                

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