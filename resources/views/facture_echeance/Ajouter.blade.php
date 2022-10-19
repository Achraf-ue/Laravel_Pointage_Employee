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
                            <form method="POST" action="{{route('Ajouter_facture_echeances')}}" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Type" name="Type">
                                        <option value="0">Type </option>
                                        <option value="Client">Client</option>
                                        <option value="Fourniseur">Fourniseur</option>
                                        <option value="Personne_physique">Personne physique</option>
                                    </select>
                                </div>
                            </div>
                            <div id="Type_select" class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" name="client">
                                    </select>
                                </div>
                            </div>
                                <!--
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Client</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Client"  name="client">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">fourniseur</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Fourniseur"  name="fourniseur">
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Némero facture</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Némero facture"  name="n_facture">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Date facture</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Date facture" id="datepicker"   name="date_facture">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Mantant</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="number" placeholder="Mantant"  name="mantant">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Facture</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="file"  name="facture_pdf">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="status", id="Statu_facture">
                                            <option value="En cours"selected>En cours</option>
                                            <option value="Payé" >Payé</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="Payement_select" style="display: none">
                                <div  class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Payements</label>
                                    <div class="col-sm-10">
                                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="payement" id="Payement">
                                            <option value="0">Type</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Lettre de change">Lettre de change</option>
                                            <option value="Vairement">Vairement</option>
                                            <option value="Espece">Espece</option>
                                        </select>
                                    </div>
                                </div></div>
                                <div id="Payement_div" style="display: none">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Némero</label>
                                        <div class="col-sm-10">
                                           <input class="form-control" type="text" value="0" placeholder="Némero"  name="n_file">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">File</label>
                                        <div class="col-sm-10">
                                           <input class="form-control" type="file"  name="payement_file">
                                        </div>
                                    </div> 
                                </div>
                               
                                <button type="submit" class="btn btn-success waves-effect waves-light">Ajouter facture</button>
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