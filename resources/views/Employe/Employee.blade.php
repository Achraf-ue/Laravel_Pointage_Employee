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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Employee</a></li>
                            <li class="breadcrumb-item active">Vue</li>
                        </ol>
                    </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                
                <div class="col-12"><div class="col-sm-12">
                    
                    <div class="float-right d-none d-md-block">
                    <a href="{{route('Ajouter.Employee')}}" ><button type="button" class="btn btn-success waves-effect waves-light">+</button></a>
                    </div>
                    <div class="form-group row" style="text-align: center">
                    
                        <div class="col-sm-10">
                            <select class="form-control" name="Employe" id="Employe" style="width: 200px">
                                <option value="Tous">Tous</option>
                                @foreach ($Employes as $Employe)
                                <option value="{{$Employe->Cin}}">{{$Employe->Nom.' '.$Employe->Prenom}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Prenom</th> 
                                    <th>Adress</th>
                                    <th>Telephone</th>
                                    <th>Image</th>
                                    <th>Departement</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody class="Departement_Div">
                                @foreach ($Employes as $Employe)
                                <tr style="text-align: center;">
                                    <td>{{$Employe->id }}</td>
                                    <td>{{$Employe->Cin }}</td>
                                    <td>{{$Employe->Nom}}</td>
                                    <td>{{$Employe->Prenom}}</td>
                                    <td>{{$Employe->Adress}}</td>
                                    <td><a href="{{'https://wa.me/+212'.substr($Employe->telephone, 1)}}" id="Wattsap" style="margin-top: 10px;"  target="_blank" ><i class="fab fa-whatsapp-square fa-3x"></i></a></td>
                                    <td><img class="d-flex mr-3 rounded-circle" src="{{asset($Employe->Employee_Image)}}" alt="Generic placeholder image" height="64"></td>
                                    <td>{{$Employe->Deparetement_Nom}}</td>
                                    <td>
                                <a href="{{route('Employee.Moidfier',$Employe->id)}}"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a> 
                                <a id="Delete" href="{{route('Employee.Delete',$Employe->id)}}"><button type="button"  class="btn btn-danger waves-effect waves-light">delete</button></a> 
                                <a class="view_employee" data-id="{{$Employe->id}}" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a>
                                <!--
                                $watssap_finale = "https://wa.me/+21".$Num;
                                -->
                                    </td>
                                   
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