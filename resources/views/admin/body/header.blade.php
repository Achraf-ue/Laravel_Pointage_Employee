<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="index.html" class="logo">
            <span>
                    <img src="{{ asset(Auth::user()->profile_photo_path)}}" alt="" height="60">
                </span>
        </a>
    </div>
    <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">
            <!-- language-->
            <!-- full screen -->
            <!-- notification retrd -->
            <!-- Teste  -->
            <li class="dropdown notification-list list-inline-item">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-clipboard-account-outline noti-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                    <!-- item-->
                    
                    <div class="slimscroll notification-item-list">
                        <!-- item-->
                        <a href="{{route('Ajouter.Employee')}}" class="dropdown-item notify-item active">
                            <p class="notify-details">Ajouter employee<span class="text-muted"></span></p>
                        </a>
                        <a href="{{route('Ajouter.departement')}}" class="dropdown-item notify-item active">
                            <p class="notify-details">Ajouter departement<span class="text-muted"></span></p>
                        </a>  
                        <a href="{{route('Ajouter.Fete')}}" class="dropdown-item notify-item active">
                            <p class="notify-details">Ajouter Fetes<span class="text-muted"></span></p>
                        </a>  
                        <a href="{{route('Ajouter.absence')}}" class="dropdown-item notify-item active">
                            <p class="notify-details">Ajouter Absences<span class="text-muted"></span></p>
                        </a>
                        <a href="{{route('Ajouter.congé')}}" class="dropdown-item notify-item active">
                            <p class="notify-details">Ajouter congé<span class="text-muted"></span></p>
                        </a>  
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <p class="notify-details">Ajouter pointeuse<span class="text-muted"></span></p>
                        </a>               
                </div>
            </li>
            <!-- Fin teste  -->
            <li class="dropdown notification-list list-inline-item">
                <div class="Pointage_Retard_Notification" >
                
                </div>
            </li>
            <!-- Fin notification retard -->
            <!-- notification Absences  -->
            <li class="dropdown notification-list list-inline-item">
                <div class="Pointage_Absences_Notification" >
                
                </div>
            </li>
            <!-- Fin notification absences   -->
            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('backend/assets/images/users/202203112055download.jpg')}}" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                        <a class="dropdown-item text-danger" href="{{route('admin.logout')}}"><i class="mdi mdi-power text-danger"></i>Déconnexion</a>
                    </div>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        <!--    <li class="d-none d-sm-block">
                <div class="dropdown pt-3 d-inline-block">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Create
                        </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </li>  -->
        </ul>

    </nav>

</div>
