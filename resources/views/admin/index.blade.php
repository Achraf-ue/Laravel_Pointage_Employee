@extends('admin.admin_master')
@section('admin')
<div class="content-page">
  <!-- Start content -->
  <div class="content">
      <div class="container-fluid">
          <div class="page-title-box">
              <div class="row align-items-center">
                  
                  <div class="col-sm-6">
                      <h4 class="page-title">Dashboard</h4>
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item active">Welcome to Veltrix Dashboard</li>
                      </ol>

                  </div>
                  <div class="col-sm-6">
                  
                      <div class="float-right d-none d-md-block">
                          <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="mdi mdi-settings mr-2"></i> Settings
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                  <a class="dropdown-item" href="#">Something else here</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#">Separated link</a>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
          <!-- end row -->
          
          <div class="row">
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div class="card-body">
                          <div class="mb-4">
                              <div class="float-left mini-stat-img mr-4">
                                  <img src="{{ asset('backend/assets/images/services-icon/01.png')}}" alt="" >
                              </div>
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">Département</h5>
                              <h4 class="font-500">{{$Departement_Count}}</h4>
                              
                          </div>
                          <div class="pt-2">
                              <div class="float-right">
                                  <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                              </div>

                              <p class="text-white-50 mb-0">Since last month</p>
                          </div>
                      </div>
                  </div>
              </div>
              
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div class="card-body">
                          <div class="mb-4">
                              <div class="float-left mini-stat-img mr-4">
                                  <img src="{{ asset('backend/assets/images/services-icon/02.png')}}" alt="" >
                              </div>
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                                Employé</h5>
                              <h4 class="font-500">{{$Employee_Count}}</h4>
                          </div>
                          <div class="pt-2">
                              <div class="float-right">
                                  <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                              </div>

                              <p class="text-white-50 mb-0">Since last month</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div class="card-body">
                          <div class="mb-4">
                              <div class="float-left mini-stat-img mr-4">
                                  <img src="{{ asset('backend/assets/images/services-icon/03.png')}}" alt="" >
                              </div>
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">Entre</h5>
                              <h4 class="font-500">{{$Count_Entre}}</h4>
                          </div>
                          <div class="pt-2">
                              <div class="float-right">
                                  <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                              </div>

                              <p class="text-white-50 mb-0">Since last month</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div class="card-body">
                          <div class="mb-4">
                              <div class="float-left mini-stat-img mr-4">
                                  <img src="{{ asset('backend/assets/images/services-icon/04.png')}}" alt="" >
                              </div>
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">Sortir</h5>
                              <h4 class="font-500">{{$Count_Sortir}}</h4>
                          </div>
                          <div class="pt-2">
                              <div class="float-right">
                                  <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                              </div>

                              <p class="text-white-50 mb-0">Since last month</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- end row -->

          <!--<div class="row">
              <div class="col-xl-9">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="mt-0 header-title mb-5">Monthly Earning</h4>
                          <div class="row">
                              <div class="col-lg-7">
                                  <div>
                                      <div id="ct-donut" class="ct-chart earning ct-golden-section"></div>
                                  </div>
                              </div>
                              <div class="col-lg-5">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="text-center">
                                              <p class="text-muted mb-4">This month</p>
                                              <h4>$34,252</h4>
                                              <p class="text-muted mb-5">It will be as simple as in fact it will be occidental.</p>
                                              <span class="peity-donut" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">4/5</span>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="text-center">
                                              <p class="text-muted mb-4">Last month</p>
                                              <h4>$36,253</h4>
                                              <p class="text-muted mb-5">It will be as simple as in fact it will be occidental.</p>
                                              <span class="peity-donut" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">3/5</span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                      </div>
                  </div>
                  
              </div>

             
          </div>-->
          <!-- end row -->
          <div class="row">
                
            <div class="col-12">
                <div class="card">
                    <div style="text-align: center" class="card-body">
                        
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="Employe" id="Employe_1">
                                <option value="Tous">Tous</option>
                                @foreach ($Employees as $Employe)
                                <option value="{{$Employe->Cin}}">{{$Employe->Cin}}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control form-control-default date-ranger" id="Range_1" name="date-ranger" style="width:190px;display:inline-block;margin-right:5px;">
                            <div class="float-right d-none d-md-block">
                                <a id="Cherche_Retard" ><button type="button" class="btn btn-success waves-effect waves-light">Cherche</button></a>
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
                                <th>Nom complet</th>
                                <th>Date Jour</th>
                                <th>Date entre</th>
                                <th>Retard</th>
                                <th>Detaille</th>
                            </tr>
                            </thead>


                            <tbody class="Retard_Div">
                            @foreach ($Retards as $Retard)
                            <tr>
                                <td id="Id_Retard">{{$Retard->id}}</td>
                                <td>{{$Retard->Cin}}</td>
                                <td>{{$Retard->Nom.' '.$Retard->Prenom}}</td>
                                <?php
                                $date = Carbon\Carbon::parse($Retard->Date_Jour)->locale('fr_FR');
                                //$date->year.' / '.$date->monthName.' / '.$date->dayName
                                ?>
                                <td>{{$date->year.' / '.$date->monthName.' / '.$date->dayName}} </td>
                                <td>{{$Retard->Date_Entre}}</td>
                                <td>{{$Retard->Temps_Retard.' Minutes'}}</td>
                                <th><a class="view_detaiile_retard" data-id="{{$Retard->id}}" ><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="ti-eye"></i></button></a> </th>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
         
          <!-- end row -->

          
          <!-- end row -->
      </div>
      <!-- container-fluid -->

  </div>
  <!-- content -->
</div>
@endsection
