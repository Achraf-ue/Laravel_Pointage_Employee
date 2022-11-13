<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{route('index')}}" class="waves-effect">
                        <i class="ti-home"></i> <span> Acceiul </span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span>Employé<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('Employee')}}">Employé</a></li>
                        <li><a href="{{route('Ajouter.Employee')}}" >Ajouter Employé</a></li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span>Congés<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{route('Congé.Vue')}}">Congés</a></li>
                                <li><a href="{{route('Ajouter.congé')}}">Ajouter Congé</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </li>
                <!--  Teste  -->
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-support"></i><span>Societé<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('Societé_Vue')}}">Societés</a></li>
                        <li><a href="{{route('Societe_Ajouter_Vue')}}">Ajouter Societé</a></li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-email"></i><span>Département<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{route('Departement_Vue')}}">Département</a></li>
                                <li><a href="{{route('Ajouter.departement')}}" >Ajouter département</a></li>
                                <li>
                                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-bookmark-alt"></i><span>Services<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                    <ul class="submenu"> 
                                        <li><a href="{{route('Service_Vue')}}">Services</a></li>
                                        <li><a href="{{route('Ajouter.Service')}}">Ajouter service</a></li>
                                    </ul>
                                </li>
                            </ul>
                            
                        </li>
                    </ul>
                </li>
                <!--Fin teste-->
                <li>
                    <a href="javascript:void(0);" class="waves-effect"> <i class="ti-email"></i><span>Calendrie des  fêtes  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('Fetes.Vue')}}">Fêtes</a></li>
                        <li><a href="{{route('Ajouter.Fete')}}">Ajoute fête</a></li> 
                        
                         
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span>Gestion pointage<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('Ajouter.pointage')}}">Ajouter Pointage <!--anomalie--></a></li>
                        <li><a href="{{route('Rapport_Pointage')}}">Rapport Pointage</a></li>
                        <li><a href="{{route('Pointage')}}">Pointage Employé</a></li>
                        <li><a href="{{route('Pointage.Entre')}}">Entre Employé</a></li>
                        <li><a href="{{route('Pointage.Sortir')}}">Sortir Employé</a></li>
                        <li><a href="{{route('Teste_Pointeuse')}}">Teste Pointeuse</a></li>
                        
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
                        <li><a href="{{route('Absences.vue')}}">Absences</a></li>
                        <li><a href="{{route('Ajouter.absence')}}">Ajoute absence</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-bookmark-alt"></i><span> Pointeuses <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('Pointeuse.Vue')}}">Pointeuses</a></li>
                        <li><a href="{{route('Ajouter.pointeuse')}}">Ajouter pointeuse</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-location-pin"></i><span> Parametre </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('Horiare_Vue')}}">Horiare ramadan</a></li>
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