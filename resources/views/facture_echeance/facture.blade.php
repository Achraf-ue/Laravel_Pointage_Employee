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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">facture_echeances</a></li>
                            <li class="breadcrumb-item active">Vue</li>
                        </ol>

                    </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                
                <div class="col-12"><div class="col-sm-12">
                    
                <!--    <div class="float-right d-none d-md-block">
                    <a href="{{route('Ajouter.departement')}}" ><button type="button" class="btn btn-success waves-effect waves-light">+</button></a>
                    </div>  -->
                </div>
                
                <div class="card">
                    <div style="text-align: center" class="card-body">
                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Type_Facture" name="client">
                            <option value="">Type</option>
                            <option value="Client">Client</option>
                            <option value="Fourniseur" >Fourniseur</option>
                            <option value="Personne physique" >Personne physique</option>
                        </select>
                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="facture_client" name="client">
                            <option value="Tous">Clients</option>
                            <option value="client 1">Client 1</option>
                            <option value="client 2" >Client 2</option>
                            <option value="client 3" >Client 3</option>
                        </select>
                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="facture_fourniseur" name="client">
                            <option value="Tous">Fourniseur</option>
                            <option value="fourniseur 1">Fourniseur 1</option>
                            <option value="fourniseur 2" >Fourniseur 2</option>
                            <option value="fourniseur 3" >Fourniseur 3</option>
                            <option value="fourniseur 4" >Fourniseur 4</option>
                        </select>
                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="facture_perssone" name="client">
                            <option value="Tous">Personne physique</option>
                            <option value="Personne physique 1">Personne physique 1</option>
                            <option value="Personne physique 2" >Personne physique 2</option>
                            <option value="Personne physique 3" >Personne physique 3</option>
                        </select>
                    <br>
                    <br>
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Status">
                                <option value="">Status</option>
                                <option value="En cours" >En cours </option>
                                <option value="Payé" >Payé</option>
                            </select>
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="N_Facture">
                                <option value="">Factures</option>
                                @foreach ($facture_echeances as $facture_echeance)
                                <option value="{{$facture_echeance->id}}" >{{$facture_echeance->n_facture}}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control form-control-default date-ranger" id="Range_1" name="date-ranger" style="width:190px;display:inline-block;margin-right:5px;">
                            <div class="float-right d-none d-md-block">
                                <a id="Cherche_Facture" ><button type="button" class="btn btn-success waves-effect waves-light">Cherche</button></a>
                            </div>
                    </div>
            </div>
                    <div class="card">
                        
                        <div class="card-body">
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Generate_Facture" name="client">
                                <option value="0">Generate Option</option>
                                <option value="Pdf">Pdf</option>
                                <option value="Excel" >Excel</option>
                            </select>
                            <br>
                            <br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Raison sociale</th>
                                        <th>N facture</th> 
                                        <th>Date facture</th>
                                        <th>Date payement</th>
                                        <th>Crédit</th>
                                        <th>Début</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody class="factures_Div">
                                    @foreach ($facture_echeances as $facture_echeance)
                                    <tr>
                                        <td>{{$facture_echeance->id }}</td>
                                        <td>{{$facture_echeance->nom_complet}}</td>
                                        <td>{{$facture_echeance->n_facture}}</td>
                                        <?php $date = Carbon\Carbon::parse($facture_echeance->date_facture)->locale('fr_FR'); ?>
                                        <td>{{$date->format('Y-M-d').' / '.$date->dayName}}</td>
                                        <?php $date_payement_f = Carbon\Carbon::parse($facture_echeance->date_payement)->locale('fr_FR'); ?>
                                        @if($facture_echeance->date_payement != null)
                                        <td> {{$date_payement_f->format('Y-M-d').' / '.$date_payement_f->dayName}}</td>
                                        @else
                                        <td></td>
                                        @endif

                                        
                                        @if ($facture_echeance->type == "Client")
                                        <td>{{$facture_echeance->mantant}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        @if ($facture_echeance->type == "Fourniseur")
                                        <td>{{$facture_echeance->mantant}}</td>  
                                        @else
                                        <td></td>  
                                        @endif
    
                                        @if ($facture_echeance->status == "Payé")
                                        <td><span class="badge badge-success">{{$facture_echeance->status}}</span></td>
                                        @else
                                        <td><span class="badge badge-danger">{{$facture_echeance->status}}</span></td>
                                        @endif
                                        
                                        <td>
                                        @if ($facture_echeance->status == "En cours")
                                        <a href="{{route('Modifier_facture',$facture_echeance->id)}}"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a>  
                                        @endif
                                        <!--<a href="{{asset($facture_echeance->facture_pdf)}}"  download><button type="button"    class="btn btn-info waves-effect waves-light"><i class="mdi mdi-file-pdf"></i></button></a> --> 
                                        <a class="view_detaiile_facture" data-id="{{$facture_echeance->id}}" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a>
                                        <a class="print_facture" data-id="{{$facture_echeance->id}}" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="mdi mdi-cloud-print"></i></button></a>
                                        <object style="display: none" data="your_url_to_pdf" type="application/pdf"><iframe style="height: 500px;width:750px" id="{{$facture_echeance->id}}" class="myFrame"  src="{{asset($facture_echeance->facture_pdf)}}"></iframe></object>
                                         </td>
                                    </tr>
                                    @endforeach
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