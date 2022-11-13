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
                        
                        <div style="text-align: center" class="card-body">
                            
                                <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="Employe" id="Employe_1">
                                    <option value="">Nom complet</option>
                                    
                                </select>
                                <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="Employe" id="Pointage_Matricule">
                                    <option value="">Matricule</option>
                                   
                                </select>
                                <input type="text" class="form-control form-control-default date-ranger" id="Range_1" name="date-ranger" style="width:190px;display:inline-block;margin-right:5px;">
                                <div class="float-right d-none d-md-block">
                                    <a id="" ><button type="button" class="btn btn-success waves-effect waves-light">Cherche</button></a>
                                </div>
                            <br>
                            <br>
                                <div class="float-right d-none d-md-block">
                                    <a id="Telecharger_Pointage" ><button type="button" class="btn btn-success waves-effect waves-light">Telecharger Pointage</button></a>
                                </div>
                        </div>
                </div>
                    <div class="card">
                        
                        <div class="card-body">
                        
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Id employee</th>
                                    <th>Date de pointage</th>
                                    
                                </tr>
                                </thead>


                                <tbody class="Pointeuse_Div">
                               
                                   
                                     
                               
                         
                                </tbody>
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