<?php use Illuminate\Support\Facades\Auth;  ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Gestion Pointage</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

            <!--Chartist Chart CSS -->
            <link rel="stylesheet" href="{{ asset('backend/assets/plugins/chartist/css/chartist.min.css')}}">
            <!-- Sweet Alert -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
            <!-- DataTables -->
            <link href="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('backend/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
            <!--Select 2-->
            <link href="{{ asset('backend/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
            <!--Daterangebicker css-->
            <link rel="stylesheet" href="{{ asset('backend/assets/plugins/daterangepicker.css')}}">
            <!-- Responsive datatable examples -->
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
            <link href="{{ asset('backend/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('backend/assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('backend/assets/css/style.css')}}" rel="stylesheet" type="text/css">
        <style>
            .select2-search input:active{
                color: green;
            }
            .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
            width: 170px !important;
            display:inline-block;
            margin-right:50px;
            border-color:#BD362F;
           }
           .select2-container--default .select2-results__option--highlighted[aria-selected]{
               background-color:#FEC918;
           }
           #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  text-align: center;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #04AA6D;
  color: white;
}
#customers td {
   height: 20px;
  text-align: center;
  background-color: #04AA6D;
  color: black;
}
#customers tr{
   width: 50px;
}
.th-1{
    width: 200px;
}
        </style>
        <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto:300);
        html {
        height:90%;
        }
    
        .global {
            background-color:rgba(0,0,0,0.5);position:fixed; top:0;left:0;z-index:9999;width:100vw;height:100vh;display:none;
        }
        .global .back { position:absolute;top:50%;left:50%;transform:translate(-50%);}
        .back {
            margin:1em auto;
            font-family:"Roboto";
        }
        .back span {
            font-size:3em;
            color:#F2C640;
            background:#262B37;
            display:table-cell;
            box-shadow:inset 0 0 5px rgba(0,0,0,0.3), 0 5px 0 #ccc;
            padding: 0 15px;
            line-height: 100px;
            animation:jumb 2s infinite;
        }
        @keyframes jumb {
            0% {
                transform:translateY(0px)
            }
            50% {
                transform:translateY(-30px);
                box-shadow:0 15px 0 rgb(242, 198, 64);
            }
            100% {
                transform:translateY(0px)	
            }
        }
        .back span:nth-child(1) {
            animation-delay:.1s;
        }
        .back span:nth-child(2) {
            animation-delay:.2s;	
        }
        .back span:nth-child(3) {
            animation-delay:.1s;
        }
        .back span:nth-child(4) {
            animation-delay:.2s;	
        }
        .back span:nth-child(5) {
            animation-delay:.1s;
        }
        .back span:nth-child(6) {
            animation-delay:.2s;	
        }
        .back span:nth-child(7) {
            animation-delay:.1s;
        }
    .back span:nth-child(8) {
            animation-delay:.2s;
        }
    .back span:nth-child(9) {
            animation-delay:.1s;
        }
    .back span:nth-child(10) {
            animation-delay:.2s;
        }
    .back span:nth-child(11) {
            animation-delay:.1s;
        }
        </style>
    </head>

    <body>
        <div id="global" class="global">
            <span id="Loaders" class="back">
                <span>F</span>
                <span>I</span>
                <span>R</span>
                <span>I</span>
                <span>N</span>
                <span>F</span>
                <span>O</span>
            </span>
        </div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
             @include('admin.body.header');
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.body.sidebar');
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            @yield('admin')

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js" integrity="sha512-tMabqarPtykgDtdtSqCL3uLVM0gS1ZkUAVhRFu1vSEFgvB73niFQWJuvviDyBGBH22Lcau4rHB5p2K2T0Xvr6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>  
        <!-- jQuery  -->
        <script src="{{ asset('backend/assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/metisMenu.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{ asset('backend/assets/js/waves.min.js')}}"></script>
        <!-- Début -->  
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <!-- Fin --> 
        <!-- Datatable --> 
          <!-- Required datatable js -->
          <script src="{{ asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
          <!-- Buttons examples -->
          <script src="{{ asset('backend/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/jszip.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/pdfmake.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/vfs_fonts.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/buttons.print.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
          <!-- Responsive examples -->
          <script src="{{ asset('backend/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
  
          <!-- Datatable init js -->
          <script src="{{ asset('backend/assets/pages/datatables.init.js')}}"></script>       
        <!-- fin datatable -->
        <!--Chartist Chart-->
                <!-- peity JS -->
        <script src="{{ asset('backend/assets/plugins/peity-chart/jquery.peity.min.js')}}"></script>

        <script src="{{ asset('backend/assets/pages/dashboard.js')}}"></script>
        <!--{{ asset('backend/')}}-->
        <!-- App js -->
        <script src="{{ asset('backend/assets/js/app.js')}}"></script>
         <!-- Sweet-Alert  --> 
         <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
         <!--Select 2-->
         <script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js')}}"></script>
         <!--Toast-->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" ></script>
         <style> #toast-container > .toast-error { background-color:   #BD362F; } </style>
        <style> #toast-container > .toast-success { background-color: green; } </style>
        <!--daterangebicer-->
        <script src="{{asset('backend/assets/plugins/moment/moment.js')}}"></script>
        <script src="{{asset('backend/assets/plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('backend/assets/plugins/daterangepicker.js')}}"></script>
        <script src="{{ asset('backend/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}"></script>
        <script>
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type','info') }}"
         switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
         }
         @endif 
        </script>
        
    </body>
</html>

<div id="Modal_Retard_Detaille" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Retard Detailles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="Modal_Facture_Detaille" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Facture Detailles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body-facture">
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="Modal_Rapport_Pointage_Detaille" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Rapport Pointage Detailles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body-rapport">
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--  Modal absence   -->
<div id="Modal_Absences_Detaille" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Absenece Detailles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body-Absence">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Fin modal absence  -->
<div id="Modal_Employe_Detaille"  class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Detailles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body-employee">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="Modal_Societe_Detaille"  class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Detailles Societé</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body-s">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function(){
        
         $('#table_1').DataTable();
         $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
         $(document).on('change','.Motive_Absence', function(){
            var ID_Rapport  = $(this).find(':selected').data('id')
            var Motive_Absence  = $(this).val();
            $.ajax({
                     url: "{{ route('Change_Motive_Absence') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      ID_Rapport:ID_Rapport,Motive_Absence:Motive_Absence}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success("Bien change motive absence");
                        $(".Observation").html(Motive_Absence);
                        $('#'+ID_Rapport).css("background-color", "white");

                     }
                 });
            
            
        });
    $(document).on('click','.view_detaiile_retard', function(){
            var Id_Retard  = $(this).attr("data-id");
            //alert(Id_Retard);
        $.ajax({
                     url: "{{ route('Retard.Modal') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Id_Retard:Id_Retard}, beforeSend:function(){
                        $("#global").show();
                 },
                     success: function(response){
                        //toastr.success("Bien Recherche");
                        console.log(response);
                        $("#global").hide();
                        $('.modal-body').html(response); 
                        /* Inisialiser retard */
                                $.ajax({
                                url: "{{ route('Retard_Notification_') }}",
                                type: 'get',
                                data: {
                                "_token": "{{ csrf_token() }}", 
                                }, beforeSend:function(){
                            },
                                success: function(response){
                                    //toastr.success('Pointage bien telecharger');
                                    $(".Pointage_Retard_Notification").html(response);  
                                }
                            });
                        /* Fin */
                        //Teste
                        $("#pie-chart").remove();
                        $("#chart-container").append('<canvas id="pie-chart"></canvas>');
                        $.ajax({
              url: "{{ route('Chart_rapport_R') }}",
              type: 'get',
              data: {
               "_token": "{{ csrf_token() }}"}, beforeSend:function(){
          },
              success: function(response){
                                        new Chart(document.getElementById("pie-chart"), {
                            type: 'bar',
                            data: {
                            labels: ["Absences", "Retards",'Congé'],
                            datasets: [{
                                label: "",
                                backgroundColor: ["#3e95cd", "#8e5ea2","#fec918"],
                                data: response
                            }]
                            },
                            options: {
                                responsive : true,
                            title: {
                                display: true,
                            },
                            plugins: {
                                    datalabels: {
                                        formatter: function(value) {
                                            return value + ' %';
                                        },
                                        color: '#fff'
                                    }
                                }
                            
                            }    
                        });                

                            }
                        });
                        //Fin teste
                        $('#Modal_Retard_Detaille').modal('show'); 
                     }
                 });
        });
        /*Select 2*/
        $('#Departement').select2();
        $('#Departement_employee').select2();
        $('#Id_Employee').select2();
        $('#Motif').select2();
        $('#Pointage_Matricule').select2();
        /*Fin select 2*/
        /*Datatable*/
        
        /*Fin datatable*/
        
        
        $(document).on('click','#Delete', function(e){
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
       if (result.isConfirmed) {
       window.location.href = link;
       Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success')}})
        });
//Suprimmer pointeuse
$(document).on('click','#Delete_Pointeuse', function(e){
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
       if (result.isConfirmed) {
       window.location.href = link;
       Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success')}})
        });
//Fin suprimmer pointeuse
        


      /*$("#Notification").click(function(){
        $.ajax({
                     url: '/User/Notification',
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}"}, 
                      beforeSend:function(){
                    },
                     success: function(response){
                        $('#Notification_Count').remove();
                     }
        });
      });*/
      //Filter employee
      $('#Employe').select2();
      $('#Employe_1').select2();
      $('#Employe_2').select2();
      $('#Employe_3').select2();
      $(document).on('change','#Employe', function(){
       var Filter_1  = $("#Employe").val();
       //alert(Filter_1);
       if(Filter_1 != '')
       {
        $.ajax({
                     url: "{{ route('Employee.Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success("Bien Recherche");
                         $(".Departement_Div").html(response);
                     }
                 });
        }
      });
      //Filter Departement
      $(document).on('change','#Departement', function(){
       var Filter_1  = $("#Departement").val();
       //alert(Filter_1);
       if(Filter_1 != '')
       {
        $.ajax({
                     url: "{{ route('Departement.Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success("Bien Recherche");
                         $(".Departement_Div").html(response);
                     }
                 });
        }
      });
      /*$(document).on('change','#user_type', function(){
       var Filter_1  = $("#user_type").val();
       if(Filter_1 != '')
       {
        $.ajax({
                     url: '/User/Filter',
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success("Bien Recherche");
                         $(".div_1").html(response);
                     }
                 });
        }
      });*/
      $(document).on('click','#Cherche_Pointage', function(){
       var Filter_1  = $("#Employe_1").val();
       var Filter_3  = $("#Range_1").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
      
        $.ajax({
                     url: "{{ route('Pointage_Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success("Bien Recherche");
                         $(".Pointage_Div").html(response);
                     }
                 });
        
      });
      /*Retard filter*/
      $(document).on('click','#Cherche_Retard', function(){
       var Filter_1  = $("#Employe_1").val();
       var Filter_3  = $("#Range_1").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
       if(Filter_1 != '')
       {
        $.ajax({
                     url: "{{ route('Retard_Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin}, beforeSend:function(){
                 },
                     success: function(response){
                         toastr.success("Bien Recherche");
                         $(".Retard_Div").html(response);
                     }
                 });
        }
      });
      /*Fin retard filter*/
      /*Filter factures*/
      $('#Status').select2();
      $('#N_Facture').select2();
      $(document).on('click','#Cherche_Facture', function(){
       var Filter_1  = $("#Status").val();
       var Filter_2  = $("#N_Facture").val();
       var Filter_client  = $("#facture_client").val();
       var Filter_fourniseur  = $("#facture_fourniseur").val();
       var Filter_perssone  = $("#facture_perssone").val();
       var Type_Facture     = $("#Type_Facture").val(); 
       var Nom_complet = " ";
       if(Filter_client     != 'Tous')     Nom_complet = Filter_client
       if(Filter_fourniseur != 'Tous')     Nom_complet = Filter_fourniseur
       if(Filter_perssone   != 'Tous')     Nom_complet = Filter_perssone

       //salert(Nom_complet);
       var Filter_3  = $("#Range_1").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
       $("#Generate_Facture").prop("selectedIndex", 0).val();
        $.ajax({
                     url: "{{ route('Facture_Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin,Filter_2:Filter_2,Nom_complet:Nom_complet,Type_Facture:Type_Facture}, beforeSend:function(){
                        $("#global").show();
                 },
                     success: function(response){
                        //toastr.success("Bien Recherche");
                        $("#global").hide();
                         $(".factures_Div").html(response);
                     }
                 });
      });
      /*Fin filter factures*/
      //Generate pdf
      $(document).on('change','#Generate_Facture', function(){
       var Filter_1  = $("#Status").val();
       var Filter_2  = $("#N_Facture").val();
       var Filter_client  = $("#facture_client").val();
       var Filter_fourniseur  = $("#facture_fourniseur").val();
       var Filter_perssone  = $("#facture_perssone").val();
       var Type_Facture     = $("#Type_Facture").val(); 
       var Generate_Facture = $("#Generate_Facture").val();
       var Nom_complet = " ";
       if(Filter_client     != 'Tous')     Nom_complet = Filter_client
       if(Filter_fourniseur != 'Tous')     Nom_complet = Filter_fourniseur
       if(Filter_perssone   != 'Tous')     Nom_complet = Filter_perssone
       //salert(Nom_complet);
       var Filter_3  = $("#Range_1").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
        $.ajax({
                     url: "{{ route('Generate.Pdf') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin,Filter_2:Filter_2,Nom_complet:Nom_complet,Type_Facture:Type_Facture,Generate_Facture:Generate_Facture}, beforeSend:function(){
                        $("#global").show();
                 },
                     success: function(response){
                        $("#global").hide();
                        //alert(response);
                        //window.location.href = response;
                        if(response == ' ')
                        toastr.error("Pas disponible");
                        else
                        window.open(response,'_blank');
                        
                        //$(".factures_Div").html(response);
                     }
                 });
      });
      //Fin generate pdf
      //Facture cheque 
      $(document).on('change','#Payement', function(){
       var Payement  = $("#Payement").val();
       //alert(Payement);
       if(Payement == 'Cheque' || Payement == 'Lettre de change' || Payement == 'Vairement'  )
       $("#Payement_div").show();
       else
       if(Payement == 'Espece' )
       $("#Payement_div").hide();

       
      });
      //Fin facture cheque 
      //Statu_facture
      $(document).on('change','#Statu_facture', function(){
       var Statu_facture  = $("#Statu_facture").val();
       if(Statu_facture  == 'En cours')
       {
        $("#Payement_select").hide();
       }
       else
       if(Statu_facture == 'Payé' )
       {
        $("#Payement_select").show();
       }
       

       
      });
      /**/
      $('.Type').select2();
      $(document).on('change','#Type', function(){
       var Filter_1  = $("#Type").val();
       //alert(Filter_1);
       if(Filter_1 == 'Client')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label">Client</label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Type_1" name="nom_complet"><option value="Client 1">Client 1 </option><option value="Client 2">Client 2</option><option value="Client 3">Client 3</option><option value="Client 4">Client 4</option></select></div>');
       if(Filter_1 == 'Fourniseur')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label">Fourniseur</label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Type_1"  name="nom_complet"><option value="Fourniseur 1">Fourniseur 1 </option><option value="Fourniseur 2">Fourniseur 2</option><option value="Fourniseur 3">Fourniseur 3</option><option value="Fourniseur 4">Fourniseur 4</option></select></div>');
       if(Filter_1 == 'Personne_physique')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label">Personne physique</label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Type_1"  name="nom_complet"><option value="Personne physique 1">Personne physique 1 </option><option value="Personne physique 2">Personne physique 2</option><option value="Personne physique 3">Personne physique 3</option><option value="Personne physique 4">Personne physique 4</option></select></div>');
       else
       if(Filter_1 == '0')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label"></label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Type_1"  name="nom_complet"></select></div>');
       $('#Type_1').select2();
       /*if(Filter_1 != '')
       {
        $.ajax({
                     url: "{{ route('Facture_Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin,Filter_2:Filter_2}, beforeSend:function(){
                 },
                     success: function(response){
                         toastr.success("Bien Recherche");
                         $(".factures_Div").html(response);
                     }
                 });
        }*/
      });
      
      /**/
      /*Rangebicker*/
      var start =moment().subtract(100,'year');
      var end = moment().add(100,'year');
      function cb(start, end) {$('#sRange_1 span').html('Achraf');}//start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
      $('#Range_1').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            applyLabel: 'Appliquer',
            customRangeLabel: 'Personnalisée',
        },
        
        startDate: start,
        endDate: end,
        ranges: {
           'Aujourd_hui': [moment(), moment()],
           'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
           'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
           'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')],
           'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
       }, cb);

      //cb(start, end);
    /*Fin rangebicker*/
    /*Rangebicker*/
    var start =moment().subtract(100,'year');
      var end = moment().add(100,'year');
      function cb(start, end) {$('#sRange_2 span').html('Achraf');}//start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
      $('#Range_2').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            applyLabel: 'Appliquer',
            customRangeLabel: 'Personnalisée',
        },
        
        startDate: start,
        endDate: end,
        ranges: {
           'Aujourd_hui': [moment(), moment()],
           'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
           'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
           'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')],
           'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
       }, cb);

      //cb(start, end);
    /*Fin rangebicker*/
    //
    $("#Avertisement_div").hide();
    $("#Avertisement").change(function() {
    if(this.checked) {
        $("#Avertisement_div").toggle(700);
    }else{
        $("#Avertisement_div").toggle(700);;
    }
    });
     
    //
    //Modal facture
    $(document).on('click','.view_detaiile_facture', function(){
            var Id_facture  = $(this).attr("data-id");
            
        if(Id_facture != 0)
       {
        $.ajax({
                     url: "{{ route('Facture.Modal') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Id_facture:Id_facture}, beforeSend:function(){
                 },
                     success: function(response){
                        //toastr.success("Bien Recherche");
                        $('.modal-body-facture').html(response); //This 
                        $('#Modal_Facture_Detaille').modal('show'); 
                     }
                 });
        }
        });
    //Fin modal facture
    $(document).on('click','.print_facture', function(){
            var Id_facture  = $(this).attr("data-id");
            var myIframe = document.getElementById(Id_facture).contentWindow;
            myIframe.focus();
            myIframe.print();
            return false;
    });
    //Generate pdf retars
    $(document).on('change','#Generate_Pdf_Retard', function(){

       var Filter_1  = $("#Employe_1").val();
       var Generate_Facture = $("#Generate_Pdf_Retard").val();
       //salert(Nom_complet);
       var Filter_3  = $("#Range_1").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
        $.ajax({
                     url: "{{ route('Generate.Pointage.Pdf') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin,Generate_Facture:Generate_Facture}, beforeSend:function(){
                        $("#global").show();
                 },
                     success: function(response){
                        $("#global").hide();
                        if(response == ' ')
                        toastr.error("Pas disponible");
                        else
                        window.open(response,'_blank');
                        //console.log(response);
                     }
                 });
      });
    //Fin generate pdf reatrd
    //Rapport Pointage 
$(document).on('change','#Generate_Pdf_Rapport_Pointage', function(){
        var Generate_Facture = $("#Generate_Pdf_Rapport_Pointage").val();
        var Filter_1  = $("#Rapport_Pointage_Matricule").val();
        var Filter_2  = $("#Rapport_Pointage_Departement").val();
        var Filter_3  = $("#Range_1").val();
        var Date_debut = Filter_3.slice(0,10);
        var Date_fin = Filter_3.slice(13,23); 

 $.ajax({
              url: "{{ route('Generate.Pointage.Rapport.Pdf') }}",
              type: 'get',
              data: {
               "_token": "{{ csrf_token() }}", 
               Generate_Facture:Generate_Facture,Filter_1:Filter_1,Filter_2:Filter_2,Date_debut:Date_debut,Date_fin:Date_fin}, beforeSend:function(){
                $("#global").show();
          },
              success: function(response){
                 $("#global").hide();
                 if(response == ' ')
                 toastr.error("Pas disponible");
                 else
                 window.open(response,'_blank');
                 console.log(response);
              }
          });
});
//Fin generate pdf reatrd
//Fin rapport pointage 


//Detaille rapport pointage employee
$(document).on('click','.view_detaiile_rapport_pointage', function(){
            var Id_Rapport  = $(this).attr("data-id");
        $.ajax({
                     url: "{{ route('Rapport.Modal') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Id_Rapport:Id_Rapport}, beforeSend:function(){
                 },
                     success: function(response){
                        //toastr.success("Bien Recherche");
                        $('.modal-body-rapport').html(response); //This 
                        $('#Modal_Rapport_Pointage_Detaille').modal('show'); 
                     }
                 });
        });
//Fin  detailles rapport pointage employee
    
//Recherche Pointage employe
$(document).on('click','#Cherche_Rapport_Pointage', function(){
            
        var Filter_1  = $("#Rapport_Pointage_Matricule").val();
        var Filter_2  = $("#Rapport_Pointage_Departement").val();
        var Filter_3  = $("#Range_1").val();
        var Date_debut = Filter_3.slice(0,10);
        var Date_fin = Filter_3.slice(13,23);        
        $.ajax({
                     url: "{{ route('Rapport.Pointage.filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Filter_2:Filter_2,Date_debut:Date_debut,Date_fin:Date_fin}, beforeSend:function(){
                        $("#global").show();
                 },
                     success: function(response){
                        toastr.success("Bien Recherche");
                        $("#global").hide();
                        
                        $(".Rapport_Pointage_Div").html(response);
                        $("#Table_1").DataTable();
                        //$("#Generate_Pdf_Rapport_Pointage").val("");
                        $('#Generate_Pdf_Rapport_Pointage').prop('selectedIndex',0);


                        
                         
                     }
                 });
        });

//Fin recherche pointage employee
$("#Table_1").DataTable();

//Telecharger pointage
$(document).on('click','#Telecharger_Pointage', function(){   
            $.ajax({
                         url: "{{ route('Telecharger_Pointage') }}",
                         type: 'get',
                         data: {
                          "_token": "{{ csrf_token() }}", 
                        }, beforeSend:function(){
                            $("#global").show();
                     },
                         success: function(response){
                            toastr.success('Pointage bien telecharger');
                            $(".Pointeuse_Div").html(response);
                            
                            $("#global").hide();
                              
                         }
                     });
            });
    
//Fin telecharger pointage
$.ajax({
                         url: "{{ route('Retard_Notification_') }}",
                         type: 'get',
                         data: {
                          "_token": "{{ csrf_token() }}", 
                        }, beforeSend:function(){
                     },
                         success: function(response){
                            //toastr.success('Pointage bien telecharger');
                            $(".Pointage_Retard_Notification").html(response);  
                         }
                     });
//Type_Changement
$(".Date_Type_Changement").hide();
$(document).on('change','#Type_Changement', function(){   
            var Type  = $("#Type_Changement").val();
            if(Type == 1)
            $(".Date_Type_Changement").hide();
            else
            $(".Date_Type_Changement").show();

            });

//Fin Type_Changement
//Notification absences
$.ajax({
                        url: "{{ route('Absences_Notification_') }}",
                        type: 'get',
                        xdata: {
                          "_token": "{{ csrf_token() }}", 
                        }, beforeSend:function(){
                     },
                         success: function(response){
                            //toastr.success('Absences');
                            $(".Pointage_Absences_Notification").html(response);  
                         }
                     });
//Fin notification absences
//Modal absence
$(document).on('click','.view_detaiile_Absences', function(){
            var Id_Absence  = $(this).attr("data-id");
        $.ajax({
                     url: "{{ route('Absence.Modal') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Id_Absence:Id_Absence}, beforeSend:function(){
                        $("#global").show();
                 },
                     success: function(response){
                        //toastr.success("Bien Recherche");
                        console.log(response);
                        $("#global").hide();
                        $('.modal-body-Absence').html(response); 
                        // Inisialiser retard 
                        $.ajax({
                                url: "{{ route('Absences_Notification_') }}",
                                type: 'get',
                                xdata: {
                                "_token": "{{ csrf_token() }}", 
                                }, beforeSend:function(){
                            },
                                success: function(response){
                                    //toastr.success('Absences');
                                    $(".Pointage_Absences_Notification").html(response);  
                                }
                            });
                        // Fin
                        //Teste
                        $("#pie-chart").remove();
                        $("#chart-container").append('<canvas id="pie-chart"></canvas>');
                        $.ajax({
              url: "{{ route('Chart_rapport_R') }}",
              type: 'get',
              data: {
               "_token": "{{ csrf_token() }}"}, beforeSend:function(){
          },
              success: function(response){
                                        new Chart(document.getElementById("pie-chart"), {
                            type: 'bar',
                            data: {
                            labels: ["Absences", "Retards",'Congé'],
                            datasets: [{
                                label: "",
                                backgroundColor: ["#3e95cd", "#8e5ea2","#fec918"],
                                data: response
                            }]
                            },
                            options: {
                                responsive : true,
                            title: {
                                display: true,
                            },
                            plugins: {
                                    datalabels: {
                                        formatter: function(value) {
                                            return value + ' %';
                                        },
                                        color: '#fff'
                                    }
                                }
                            
                            }    
                        });                

                            }
                        });
                        //Fin teste
                        $('#Modal_Absences_Detaille').modal('show'); 
                     }
                 });
        });
//Fin modal absence

//Rapport pointage detailles 
$(document).on('click','.rapport_detailles_pointage_pdf', function(){
    var Id_rapport  = $(this).attr("data-id");
    alert(Id_rapport);
    $.ajax({
              url: "{{ route('Generate.Pointage.Rapport.Detailles.Pdf') }}",
              type: 'get',
              data: {
               "_token": "{{ csrf_token() }}",
               Id_rapport:Id_rapport
            }, beforeSend:function(){
                $("#global").show();
          },
              success: function(response){
                 $("#global").hide();
                 window.open(response,'_blank');
                 console.log(response);
              }
          });
});
//Fin rapport pointage detailles


//Graph pie pointage 

$.ajax({
              url: "{{ route('Chart_rapport_R') }}",
              type: 'get',
              data: {
               "_token": "{{ csrf_token() }}"}, beforeSend:function(){
          },
              success: function(response){
                                        new Chart(document.getElementById("pie-chart"), {
                            type: 'bar',
                            data: {
                            labels: ["Absences", "Retards",'Congé'],
                            datasets: [{
                                label: "",
                                backgroundColor: ["#3e95cd", "#8e5ea2","#fec918"],
                                data: response
                            }]
                            },
                            options: {
                                responsive : true,
                            title: {
                                display: true,
                            },
                            plugins: {
                                    datalabels: {
                                        formatter: function(value) {
                                            return value + ' %';
                                        },
                                        color: '#fff'
                                    }
                                }
                            
                            }    
                        });                

                            }
          });
//Fin graph pie pointage
//View detailles employee
$(document).on('click','.view_employee', function(){
    var Id_employee  = $(this).attr("data-id");
    //alert(Id_employee);
    $.ajax({
              url: "{{ route('Employee.Modal') }}",
              type: 'get',
              data: {
               "_token": "{{ csrf_token() }}",
               Id_employee:Id_employee
            }, beforeSend:function(){
                //$("#global").show();
          },
              success: function(response){
                 //$("#global").hide();
                 $('.modal-body-employee').html(response); //This 
                 $('#Modal_Employe_Detaille').modal('show');
              }
          });
});
//Fin view detailles employe
//Generate_Pdf_Rapport_Pointage
//Generate_Pdf_Retards_Pointage
$(document).on('change','#Generate_Pdf_Retards_Pointage', function(){
        var Generate_Retards = $("#Generate_Pdf_Retards_Pointage").val();
        var Filter_1  = $("#Employe_1").val();
        var Filter_3  = $("#Range_1").val();
        var Date_debut = Filter_3.slice(0,10);
        var Date_fin = Filter_3.slice(13,23);

 $.ajax({
              url: "{{ route('Generate.Retard.Pointage.Pdf') }}",
              type: 'get',
              data: {
               "_token": "{{ csrf_token() }}", 
               Generate_Retards:Generate_Retards,Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin}, beforeSend:function(){
                $("#global").show();
          },
              success: function(response){
                 $("#global").hide();
                 if(response == ' ')
                 toastr.error("Pas disponible");
                 else
                 window.open(response,'_blank');
                 console.log(response);
              }
    });
});
////////////////////////////////////////////////////////////////////
//Absence filter
$(document).on('click','#Cherche_Absence', function(){
       var Filter_1  = $("#Employe_3").val();
       var Filter_3  = $("#Range_2").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
       //alert('teste');
       
        $.ajax({
                     url: "{{ route('Absence.Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin}, beforeSend:function(){
                 },
                     success: function(response){
                         toastr.success("Bien Recherche");
                         $(".Absence_Div").html(response);
                     }
                 });
      });
//Fin absence filter 
//
$(document).on('change','#Generate_Pdf_Absence_Pointage', function(){
        var Generate_Absence = $("#Generate_Pdf_Absence_Pointage").val();
        var Filter_1  = $("#Employe_3").val();
       var Filter_3  = $("#Range_2").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
       //alert(Generate_Absence);

 $.ajax({
              url: "{{ route('Absence.Pdf') }}",
              type: 'get',
              data: {
               "_token": "{{ csrf_token() }}", 
                Generate_Absence :Generate_Absence ,Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin}, beforeSend:function(){
                $("#global").show();
          },
              success: function(response){
                 $("#global").hide();
                 if(response == ' ')
                 toastr.error("Pas disponible");
                 else
                 window.open(response,'_blank');
                 console.log(response);
              }
    });
});
//
//Departement detailles 
$(document).on('click','.view_departement_employee', function(){
    var Id_departement  = $(this).attr("data-id");
    $.ajax({
              url: "{{ route('Departement.Modal') }}",
              type: 'get',
              data: {
               "_token": "{{ csrf_token() }}",
               Id_departement:Id_departement
            }, beforeSend:function(){
                $("#global").show();
          },
              success: function(response){
                 $("#global").hide();
                 $('.modal-body-employee').html(response); //This 
                 $('#Modal_Employe_Detaille').modal('show');
              }
          });
});
//Fin departement detailles
//Profile user
$('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });


});
//Fin profile user
$(document).on('click','.print_facture', function(){
            var Id_facture  = $(this).attr("data-id");
            //alert(Id_facture);
            var myIframe = document.getElementById(Id_facture).contentWindow;
            myIframe.focus();
            myIframe.print();
});
//
$("#Motife_fichie_Input").hide();
$(document).on('change','#Motif_Absence_Fichier', function(){
    var Motife_Type = $("#Motif_Absence_Fichier").val();
    if(Motife_Type != 'Eregulie' )
    {
        $("#Motife_fichie_Input").show();
    }
    else 
    $("#Motife_fichie_Input").hide();

});
//View Sociéte
$(document).on('click','.view_Societe_employee', function(){
    var Id_Societe  = $(this).attr("data-id");
    //alert(Id_Societe);
    $.ajax({
              url: "{{ route('Societe.Modal') }}",
              type: 'get',
              data: {
               "_token": "{{ csrf_token() }}",
               Id_Societe:Id_Societe
            }, beforeSend:function(){
                $("#global").show();
          },
              success: function(response){
                 $("#global").hide();
                 $('.modal-body-s').html(response); //This 
                 $('#Modal_Societe_Detaille').modal('show');
              }
          });
});
//Fin view societé

</script>
