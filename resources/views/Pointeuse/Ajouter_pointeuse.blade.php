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
                            <form method="POST" action="{{route('Ajouter.Pointeuse_Back_End')}}" >
                            @csrf
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nom Pointeuse</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Nom Pointeuse"  name="Nom" id="Deparetement_Nom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Adress Ip</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Adress ip"  name="adress_ip" id="Deparetement_Nom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Port</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Port"  name="port" id="Deparetement_Nom">
                                    </div>
                                </div>
                                
                                
                               
                                <button type="submit" class="btn btn-success waves-effect waves-light">Ajouter Pointeuse</button>
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