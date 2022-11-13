@extends('admin.admin_master')
@section('admin')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    
                    <div class="col-sm-6">
                        <h4 class="page-title">Admin</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Profile</a></li>
                        </ol>

                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
            <!-- end row -->

            


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                           <form method="POST" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
                            @csrf
                           <div style="align-items: center;text-align:center"  class="">
                               <img class="rounded-circle" style="height: 150px;width:100px;" src="{{asset($User->profile_photo_path)}}"  alt="200x200"  data-holder-rendered="true">
                           </div>
                           <br>
                           <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nom</label>
                                <div class="col-sm-10">
                                    <input name="name" class="form-control" value="{{$User->name}}"  type="text"  id="example-text-input">
                                </div>
                            </div>
                           <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="{{$User->email}}"  id="example-text-input"disabled>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input name="user_image" class="form-control" type="file"  id="image">
                                </div>
                                </div>
                                <div class="form-group row">
                                    
                                    <div class="col-sm-10">
                                        <img id="showImage" src="{{asset($User->profile_photo_path)}}"  style="height: 100px;" class="" alt="200x200" data-holder-rendered="true">
                                    </div>
                                </div>
                            <input type="submit" class="btn btn-outline-primary waves-effect waves-light" value="Update Profile">
                        </form>
                        </div>
                    </div>
                </div>

            </div>


            


        </div>
        <!-- container-fluid -->

    </div>
    <!-- content -->
</div>
@endsection
