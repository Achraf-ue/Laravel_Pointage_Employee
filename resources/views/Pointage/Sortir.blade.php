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
                            <form method="POST" action="{{route('Pointage.Entre.Sortir')}}" >
                            @csrf
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Employee</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="Id_Employee" id="Id_Employee" style="width: 850px">
                                            @foreach ($Employees as $Employee)
                                            <option value="{{$Employee->id}}">{{$Employee->Nom.' '.$Employee->Prenom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Sortir Employee</button>
                            </div>
                        </div>

                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Date Sortir</th> 
                                </tr>
                                </thead>


                                <tbody class="">
                                @foreach ($Pointage_Entres as $Pointage_Entre)
                                <tr>
                                    <td>{{$Pointage_Entre->id }}</td>
                                    <td>{{$Pointage_Entre->Nom.' '.$Pointage_Entre->Prenom }}</td>
                                    <td>{{$Pointage_Entre->Date_Jour}}</td>
                                    <td>{{$Pointage_Entre->Date_Sortir}}</td>
                                </tr>
                                @endforeach
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