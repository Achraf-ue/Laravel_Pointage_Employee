<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{route('index')}}" class="waves-effect">
                        <i class="ti-home"></i><span class="badge badge-primary badge-pill float-right">2</span> <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span>Employé<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('Employee')}}">Employé</a></li>
                        <li><a href="{{route('Ajouter.Employee')}}" >Ajouter Employé</a></li>
                        
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-email"></i><span>Département<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('Departement_Vue')}}">Département</a></li>
                        <li><a href="{{route('Ajouter.departement')}}" >Ajouter département</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span>Gestion pointage<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('Rapport_Pointage')}}">Rapport Pointage</a></li>
                        <li><a href="{{route('Pointage')}}">Pointage Employé</a></li>
                        <li><a href="{{route('Pointage.Entre')}}">Entre Employé</a></li>
                        <li><a href="{{route('Pointage.Sortir')}}">Sortir Employé</a></li>
                    </ul>
                </li>
                

               <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-receipt"></i><span>Absence <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span>Motif d'absence<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{route('Motif_Vue')}}">List Motif</a></li>
                                <li><a href="{{route('Ajouter.motif')}}">Ajouter motif</a></li>
                            </ul>
                        </li>
                        <li><a href="form-validation.html">Absences</a></li>
                        <li><a href="form-advanced.html">Ajoute absence</a></li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-receipt"></i><span>factures echeances <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li><a href="{{route('Ajouter_facture')}}">Ajoute facture</a></li>
                        <li><a href="{{route('factures_echeances')}}">factures</a></li>
                        
                    </ul>
                </li> -->
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>